<!-- resources/views/emails/sales-email.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report - {{ $monthYear }}</title>
</head>

<body>
    <div style="background-color: #f4f4f4; padding: 20px; font-family: Arial, sans-serif;">
        <h3 style="color: #333;">Sales Report - {{ $monthYear }}</h3>

        <p>Dear valued user,</p>

        <p>Attached is the monthly sales report for {{ $monthYear }}.</p>

        <p>
            Saraneo Resources Web Application
            <h6>This is auto-generated email. Please Do not reply to this message. For more information or assistance, please contact 0129327645</h6>
        </p>
    </div>
</body>

</html>
