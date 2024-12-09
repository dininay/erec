<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: #4CAF50;">Thank You for Your Submission</h2>
        <p>Dear {{ $name }},</p>
        <p>We have successfully received your application with the following details:</p>
        <ul>
            <li><strong>Name:</strong> {{ $name }}</li>
            <li><strong>Email:</strong> {{ $email }}</li>
            <li><strong>Application ID:</strong> {{ $apply_id }}</li>
        </ul>
        <p>We will review your application and get back to you soon.</p>
        <p>Best regards,</p>
        <p><strong>PT. Pesta Pora Abadi</strong></p>
    </div>
</body>
</html>
