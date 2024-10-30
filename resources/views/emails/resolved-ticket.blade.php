<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Resolution Notification</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #ffffff; color: #333333; }
        .header { background-color: #4CAF50; color: white; padding: 15px; text-align: center; border-radius: 5px; }
        .content { padding: 20px; border: 1px solid #4CAF50; border-radius: 5px; background-color: #f9f9f9; margin-top: 20px; }
        .footer { margin-top: 20px; font-size: 0.9em; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Your Ticket Has Been Resolved</h2>
    </div>
    <div class="content">
        <p>Dear {{ $ticket->user->name }},</p>
        <p>We are pleased to inform you that your ticket has been resolved.</p>
        <p><strong>Title:</strong> {{ $ticket->title }}</p>
        <p><strong>Description:</strong> {{ $ticket->description }}</p>
        <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
        <p><strong>Resolved Date:</strong> {{ now()->toFormattedDateString() }}</p>
        <p>Resolved by: {{ $ticket->supportStaff->name ?? 'Support Team' }}</p>
        <p>If you have further questions or require additional assistance, please feel free to reach out.</p>
    </div>
    <div class="footer">
        <p>Helpdesk System - Raigam IT Department</p>
    </div>
</body>
</html>
