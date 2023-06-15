<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Include any necessary CSS or JavaScript files -->
</head>
<body>
    <nav>
        <!-- Add your navigation bar code here -->
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <!-- Add your footer code here -->
    </footer>
</body>
</html>
