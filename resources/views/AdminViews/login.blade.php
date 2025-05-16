<!-- filepath: c:\Users\mightymouse\OneDrive - oxfordcollege.edu.np\Desktop\My web\busTicket\resources\views\AdminViews\login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col justify-center items-center px-4 py-12 bg-gray-50">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="p-6 space-y-1">
                <h2 class="text-2xl font-bold text-center">Admin Login</h2>
                <p class="text-gray-500 text-center">Enter your admin credentials to access the dashboard</p>
            </div>
            <div class="p-6">
                <form method="POST" class="space-y-4 mt-[-12px] mb-6">
                    @csrf
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="relative">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                placeholder="name@example.com"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                                required
                            />
                            <!-- Mail Icon -->
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="space-y-2 mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="••••••••"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required
                            />
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm6-9h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8.9 6c0-1.71 1.39-3.1 3.1-3.1s3.1 1.39 3.1 3.1v2H8.9V6z"/>
                            </svg>
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="w-full bg-black text-white py-2 px-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2"
                    >
                        Sign In to Admin Panel
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
