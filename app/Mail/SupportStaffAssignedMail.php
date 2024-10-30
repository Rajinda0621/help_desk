<?php

namespace App\Mail;
use App\Models\User;
use App\Models\Ticket;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportStaffAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $supportStaff;

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket, User $supportStaff)
    {
        $this->ticket = $ticket;
        $this->supportStaff = $supportStaff;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Support Staff Assigned Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->view('emails.supportStaffAssigned')
                    ->subject('New Ticket Assigned')
                    ->with([
                        'ticketTitle' => $this->ticket->title,
                        'ticketDescription' => $this->ticket->description,
                        'priority' => $this->ticket->priority,
                        'requiredDate' => $this->ticket->required_date,
                        'requiredTime' => $this->ticket->required_time,
                        'assignedBy' => Auth::user()->name
                    ]);
    }
}
