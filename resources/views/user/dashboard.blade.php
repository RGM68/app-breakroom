<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <h1 class="text-4xl font-bold">Welcome to Your Dashboard!</h1>
        <p class="mt-4">You are successfully logged in.</p>
        <a href="{{ route('logout') }}" 
           class="mt-6 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
            Logout
        </a>
    </div>
</body>
</html>
