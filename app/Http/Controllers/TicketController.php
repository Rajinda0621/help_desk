<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Department;
use Illuminate\Support\Str;
use App\Mail\TicketApprovalMail;
use Illuminate\Support\Facades\Mail;
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
        // Order tickets by priority and creation time
        $tickets = Ticket::with('department') // Eager load the department relationship
                     ->where('approval_status', 'approved') // Filter for approved tickets
                     ->orderByRaw("FIELD(priority, 'urgent', 'high', 'low')")
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);
       return view('ticket.index',compact('tickets'));
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
         $ticket = Ticket::create([

    

            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'department_id' => $request->dept_select, // Save the selected department ID
            'priority' => $request->priority, // priority level
            

         ]);

        if ($request->file('attachment')) {
             // Handle attachment if it exists
            $this->storeAttachment($request, $ticket);
        }

         // Get the head of the department
         $department = Department::find($request->dept_select);
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
    
    

    return redirect()->route('ticket.approvedTicketsView')->with('message', 'Ticket approved successfully.');
    }

    public function reject(Ticket $ticket)
    {
    $ticket->update(['approval_status' => 'rejected']);

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


    



}
