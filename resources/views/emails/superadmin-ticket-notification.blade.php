<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Approved Ticket Notification</title>
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
        .approve {
            background-color: #4CAF50;
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
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Ticket Notification</h2>
    </div>
    <div class="content">
        <p>Dear Super Admin,</p>

        <p>A ticket has been approved by the Head of Department of {{$ticket->department->name }}.</p>

        <p><strong>Title:</strong> {{ $ticket->title }}</p>
        <p><strong>Description:</strong> {{ $ticket->description }}</p>
        <p><strong>Department:</strong> {{ $ticket->department->name }}</p>
        <p><strong>Priority:</strong> {{ $ticket->priority }}</p>
        <p><strong>Required Date:</strong> {{ $ticket->required_date }}</p>
        <p><strong>Required Time:</strong> {{ $ticket->required_time }}</p>
        <p><strong>Created By:</strong> {{ optional($ticket->user)->name }}</p>

        <a href="{{ route('ticket.index', $ticket->id) }}" class="button approve">Assign Staff</a>

        <p>Thank you for your attention!</p>
    </div>
    <div class="footer">
        <p>Helpdesk System - Raigam IT Department</p>
    </div>
</body>
</html>
