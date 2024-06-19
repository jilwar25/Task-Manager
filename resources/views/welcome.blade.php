<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Task Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Task Manager</h1>
        <p>This is a practice project to show off my skills!</p>
        <div class="button-container">
            @if (Route::has('login'))
                <nav class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="button">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="button">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="button">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </div>
</body>
</html>