<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- favicon -->
     <link rel="shortcut icon" href="images/topicon.png" />
    <title>Login Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

<div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Login</h2>
    <span class="border-spacing-10 bg-red-100 text-red-700">@error('fail') {{ $message }} @enderror</span>
    <form action="{{ route('admin.login.submit') }}" method="post">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium mb-2" for="username">Username</label>
            <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter your username" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium mb-2" for="password">Password</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 rounded-lg transition duration-300">Login</button>
    </form>
</div>
</body>
</html>
