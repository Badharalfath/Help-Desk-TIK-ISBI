<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Complaint</title>
</head>
<body>
    <h1>New Complaint Submitted</h1>
    <p><strong>Name:</strong> {{ $complaint['name'] }}</p>
    <p><strong>Email:</strong> {{ $complaint['email'] }}</p>
    <p><strong>Judul Keluhan:</strong> {{ $complaint['judul'] }}</p>
    <p><strong>Keluhan:</strong> {{ $complaint['keluhan'] }}</p>
</body>
</html>