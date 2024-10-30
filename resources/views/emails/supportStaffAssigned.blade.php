<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Assignment Notification</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #ffffff; color: #333333; }
        .header { background-color: #f44336; color: white; padding: 15px; text-align: center; border-radius: 5px; }
        .content { padding: 20px; border: 1px solid #f44336; border-radius: 5px; background-color: #f9f9f9; }
        .footer { margin-top: 20px; font-size: 0.9em; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Ticket Assigned to You</h2>
    </div>
    <div class="content">
        <p>Dear {{ $supportStaff->name }},</p>
        <p>A new ticket has been assigned to you.</p>
        <p><strong>Title:</strong> {{ $ticketTitle }}</p>
        <p><strong>Description:</strong> {{ $ticketDescription }}</p>
        <p><strong>Priority:</strong> {{ ucfirst($priority) }}</p>
        <p><strong>Required Date:</strong> {{ $requiredDate }}</p>
        <p><strong>Required Time:</strong> {{ $requiredTime }}</p>
        <p>Assigned by: {{ $assignedBy }}</p>
        <p>Please review and take necessary action on the ticket.</p>
    </div>
    <div class="footer">
        <p>Helpdesk System - Raigam IT Department</p>
    </div>
</body>
</html>
