<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Department;
use App\Enums\TicketStatus;
use Illuminate\Support\Str;
use App\Mail\TicketApprovalMail;
use App\Mail\SuperAdminTicketMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupportStaffAssignedMail;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$tickets = Ticket::all();
        // $tickets = Ticket::paginate(10); // Paginate tickets, 10 per page
       
        $tickets = Ticket::with('department') // Eager load the department relationship
                     ->where('approval_status', 'approved') // Filter for approved tickets
                     ->orderByRaw("FIELD(priority, 'urgent', 'high', 'low')")
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);

        $supportStaffUsers = User::role('support_staff')->get();              
       return view('ticket.index',compact('tickets','supportStaffUsers'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all(); // Assuming you have a Department model
        //return view('ticket.create'); 
        return view('ticket.create', compact('departments')); // Pass the departments to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {

         $user = Auth::user();
         $departmentId = $user->department_id;
         $ticket = Ticket::create([

    

            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
            // 'department_id' => $request->dept_select,
            'department_id' => $departmentId,
            'priority' => $request->priority, // priority level
            'required_date' => $request->required_date,
            'required_time' => $request->required_time
            

         ]);

        if ($request->file('attachment')) {
             // Handle attachment if it exists
            $this->storeAttachment($request, $ticket);
        }

         // Get the head of the department
        //  $department = Department::find($request->dept_select);
        $department = Department::find($departmentId);
        $headOfDepartment = $department->headOfDepartment;

        // Send email to the head of department
         Mail::to($headOfDepartment->email)->send(new TicketApprovalMail($ticket));

        return redirect(route('ticket.myTicketsView'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)

    {
        
       return view('ticket.edit',compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // Update title and description
        $ticket->update([
            'title' => $request->title, 
            'description' => $request->description,
            'priority' => $request->priority, // priority level 
            
            ]);

        // If there's a new attachment, replace the old one
        if ($request->file('attachment')) {
            // Check if the ticket already has an attachment and delete it if it exists
            if($ticket->attachment){
                Storage::disk('public')->delete($ticket->attachment);
            }
           
            // Store the new attachment
            $this->storeAttachment($request, $ticket);

            // $ext      = $request->file('attachment')->extension();
            // $contents = file_get_contents($request->file('attachment'));
            // $filename = Str::random(25);
            // $path     = "attachments/$filename.$ext";
            // Storage::disk('public')->put($path, $contents);
            // $ticket->update(['attachment' => $path]);
        }
        


        return redirect(route('ticket.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'));
    }

    protected function storeAttachment($request, $ticket){
            $ext      = $request->file('attachment')->extension();
            $contents = file_get_contents($request->file('attachment'));
            $filename = Str::random(25);
            $path     = "attachments/$filename.$ext";
            // dd($path);
            Storage::disk('public')->put($path, $contents);
            $ticket->update(['attachment' => $path]);
    }

    public function approve(Ticket $ticket)
    {
         $ticket->update(['approval_status' => 'approved']);

         $superAdmin = User::role('super_admin')->first(); // Fetch the first super admin user

        // Check if the super admin exists
        if ($superAdmin) {
            // Send email to super admin after approval
            Mail::to($superAdmin->email)->send(new SuperAdminTicketMail($ticket));
        } else {
            // Handle the case when no super admin is found (optional)
            // For example, you can log this event or show a message
        }
         return redirect()->route('ticket.approvedTicketsView')->with('message', 'Ticket approved successfully.');
    }

    public function reject(Ticket $ticket)
    {
        $ticket->update([
            'approval_status' => 'rejected',
            'status' => TicketStatus::CLOSED->value,
        ]);
        return redirect(route('ticket.index'))->with('message', 'Ticket rejected.');
    }

    public function myTicketsView()
    {
        $tickets = Ticket::where('user_id', auth()->id())
                    
                    ->with('department') // Eager load the department relationship
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); // Paginate the tickets

         return view('ticket.myTicketsView', compact('tickets'));
    }

    public function approvedTicketsView()
    {
    $tickets = Ticket::where('approval_status', 'approved')
        ->whereHas('department', function($query) {
            $query->where('head_of_department_id', auth()->id());
        })
        ->with('department') // Eager load the department relationship
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Paginate the tickets

    return view('ticket.approvedTicketsView', compact('tickets'));
    }

   public function assignToSupportStaff(Request $request, Ticket $ticket)
    {
    // Ensure only super admin can access this
    if (Auth::user()->hasRole('super_admin')) {
        // Use the injected Request object to get the input
        $supportStaffId = $request->input('support_staff_id');
        $supportStaff = User::find($supportStaffId);

        // Check if the support staff exists
        if ($supportStaff) {
            // Assign the ticket to support staff
            $ticket->support_staff_id = $supportStaff->id; // Add 'support_staff_id' to tickets table
            // $ticket->status = 'assigned'; // Optional: update status
            $ticket->save();

            // Send notification email to support staff
            Mail::to($supportStaff->email)->send(new SupportStaffAssignedMail($ticket, $supportStaff));

            return back()->with('success', 'Ticket successfully assigned to support staff.');
        } else {
            return back()->with('error', 'Support staff not found.');
        }
    } else {
        abort(403, 'Unauthorized action.');
    }
    }

    public function assignedTicketsView()
{
    // Fetch tickets assigned to the logged-in support staff
    $tickets = Ticket::where('support_staff_id', auth()->id())
                    ->with('department') // Eager load the department relationship
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); // Paginate the tickets

    return view('ticket.assignedTicketsView', compact('tickets'));
}



    



}
