<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email</title>
</head>
<body>
<h2>Contact Information</h2>

<p><strong>Name:</strong> {{ $user['name'] }}</p>
<p><strong>Email:</strong> {{ $user['email'] }}</p>
<p><strong>Subject:</strong> {{ $user['subject'] }}</p>
<p><strong>Message:</strong> {{ $user['message'] }}</p>
</body>
</html>
