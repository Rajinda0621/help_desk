{{-- <p>Dear {{ optional($ticket->department->headOfDepartment)->name }},</p>

<p>A new ticket has been created by {{ optional($ticket->user)->name }} and requires your approval.</p>

<p><strong>Title:</strong> {{ $ticket->title }}</p>
<p><strong>Description:</strong> {{ $ticket->description }}</p>
<p><strong>Priority:</strong> {{ $ticket->priority }}</p>

<p>Please click the link below to approve or reject the ticket:</p>

<p>
    <a href="{{ route('ticket.approve', $ticket->id) }}">Approve</a> | 
    <a href="{{ route('ticket.reject', $ticket->id) }}">Reject</a>
</p> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Approval Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #333333;
            margin: 0;
            padding: 20px;
        }
        .header {
            background-color: #f44336; /* Red color */
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
            border: 1px solid #f44336;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px 5px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        .approve {
            background-color: #4CAF50; /* Green for approve */
        }
        .reject {
            background-color: #f44336; /* Red for reject */
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Ticket Approval Required</h2>
    </div>
    <div class="content">
        <p>Dear {{ optional($ticket->department->headOfDepartment)->name }},</p>

        <p>A new ticket has been created by {{ optional($ticket->user)->name }} and requires your approval.</p>

        <p><strong>Title:</strong> {{ $ticket->title }}</p>
        <p><strong>Description:</strong> {{ $ticket->description }}</p>
        <p><strong>Priority:</strong> {{ $ticket->priority }}</p>

        <p>Please click the buttons below to approve or reject the ticket:</p>

        <a href="{{ route('ticket.approve', $ticket->id) }}" class="button approve">Approve</a>
        <a href="{{ route('ticket.reject', $ticket->id) }}" class="button reject">Reject</a>
    </div>
    <div class="footer">
        <p>Thank you for your attention!</p>
        <p>Helpdesk System - Raigam IT Department</p>
    </div>
</body>
</html>

