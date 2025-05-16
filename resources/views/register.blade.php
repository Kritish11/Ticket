<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>TicketSewa - Book Your Journey</title>
</head>
<body>
    @include('partials.header')

    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12 bg-gray-50 mt-12">
        <div class="w-full max-w-md">
            <!-- Card Container -->
            <div class="bg-white shadow-lg rounded-lg p-6 animate-fade-in">
                <!-- Card Header -->
                <div class="space-y-1 text-center">
                    <h2 class="text-2xl font-bold">Create an Account</h2>
                    <p class="text-gray-600">Enter your details to create your account</p>
                </div>

                <!-- Card Content -->
                <div class="mt-6">
                    <form action="#" method="POST" class="space-y-4">
                        <!-- Full Name Field -->
                        <div class="space-y-2">
                            <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <div class="relative">
                                <input
                                    id="fullName"
                                    type="text"
                                    name="fullName"
                                    placeholder="John Doe"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                                    required
                                />
                                <!-- User Icon -->
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Email Field -->
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

                        <!-- Phone Number Field -->
                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <div class="relative">
                                <input
                                    id="phone"
                                    type="tel"
                                    name="phone"
                                    placeholder="+977 123-456-7890"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                                    required
                                />
                                <!-- Phone Icon -->
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.24 1.02l-2.2 2.2z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder="••••••••"
                                    class="w-full pl-10 pr-12 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                                    required
                                />
                                <!-- Lock Icon -->
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm6-9h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8.9 6c0-1.71 1.39-3.1 3.1-3.1s3.1 1.39 3.1 3.1v2H8.9V6z"/>
                                </svg>
                                <!-- Toggle Password Visibility -->
                                <button
                                    type="button"
                                    onclick="togglePasswordVisibility()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                >
                                    <svg id="eye-icon" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                    </svg>
                                    <svg id="eye-off-icon" class="h-5 w-5 hidden" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.83 9L15 12.16V12c0-1.66-1.34-3-3-3h-.17zM9 12.17L12.17 9H12c-1.66 0-3 1.34-3 3v.17zM1.39 4.22l2.27 2.27C2.47 7.91 1.67 9.64 1 12c1.73 4.39 6 7.5 11 7.5 1.52 0 2.97-.3 4.31-.82l2.28 2.28 1.41-1.41L2.81 2.81 1.39 4.22zM12 17c-2.76 0-5-2.24-5-5 0-.77.16-1.5.42-2.18l2.48 2.48c-.15.46-.4.87-.71 1.21-.81.94-2.05 1.49-3.39 1.49-2.76 0-5-2.24-5-5 0-1.34.55-2.58 1.49-3.39.34-.31.75-.56 1.21-.71L6.82 8.1c-.68.26-1.41.42-2.18.42-2.76 0-5-2.24-5-5 0-.77.16-1.5.42-2.18L5.1 6.38 7.62 8.9c-.94.81-1.49 2.05-1.49 3.39 0 2.76 2.24 5 5 5 .77 0 1.5-.16 2.18-.42l2.52 2.52c-.68.26-1.41.42-2.18.42zm7.38-5.62c-.81-.94-2.05-1.49-3.39-1.49-.77 0-1.5.16-2.18.42L16.1 13.62c.26-.68.42-1.41.42-2.18 0-2.76-2.24-5-5-5-.77 0-1.5.16-2.18.42L11.62 9.38c.68-.26 1.41-.42 2.18-.42 2.76 0 5 2.24 5 5 0 .77-.16 1.5-.42 2.18l2.52-2.52c.26-.68.42-1.41.42-2.18z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="space-y-2">
                            <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <div class="relative">
                                <input
                                    id="confirmPassword"
                                    type="password"
                                    name="confirmPassword"
                                    placeholder="••••••••"
                                    class="w-full pl-10 pr-12 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                                    required
                                />
                                <!-- Lock Icon -->
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm6-9h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8.9 6c0-1.71 1.39-3.1 3.1-3.1s3.1 1.39 3.1 3.1v2H8.9V6z"/>
                                </svg>
                                <!-- Toggle Confirm Password Visibility -->
                                <button
                                    type="button"
                                    onclick="toggleConfirmPasswordVisibility()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                >
                                    <svg id="confirm-eye-icon" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                    </svg>
                                    <svg id="confirm-eye-off-icon" class="h-5 w-5 hidden" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.83 9L15 12.16V12c0-1.66-1.34-3-3-3h-.17zM9 12.17L12.17 9H12c-1.66 0-3 1.34-3 3v.17zM1.39 4.22l2.27 2.27C2.47 7.91 1.67 9.64 1 12c1.73 4.39 6 7.5 11 7.5 1.52 0 2.97-.3 4.31-.82l2.28 2.28 1.41-1.41L2.81 2.81 1.39 4.22zM12 17c-2.76 0-5-2.24-5-5 0-.77.16-1.5.42-2.18l2.48 2.48c-.15.46-.4.87-.71 1.21-.81.94-2.05 1.49-3.39 1.49-2.76 0-5-2.24-5-5 0-1.34.55-2.58 1.49-3.39.34-.31.75-.56 1.21-.71L6.82 8.1c-.68.26-1.41.42-2.18.42-2.76 0-5-2.24-5-5 0-.77.16-1.5.42-2.18L5.1 6.38 7.62 8.9c-.94.81-1.49 2.05-1.49 3.39 0 2.76 2.24 5 5 5 .77 0 1.5-.16 2.18-.42l2.52 2.52c-.68.26-1.41.42-2.18.42zm7.38-5.62c-.81-.94-2.05-1.49-3.39-1.49-.77 0-1.5.16-2.18.42L16.1 13.62c.26-.68.42-1.41.42-2.18 0-2.76-2.24-5-5-5-.77 0-1.5.16-2.18.42L11.62 9.38c.68-.26 1.41-.42 2.18-.42 2.76 0 5 2.24 5 5 0 .77-.16 1.5-.42 2.18l2.52-2.52c.26-.68.42-1.41.42-2.18z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors"
                        >
                            Create Account
                        </button>
                    </form>
                </div>

                <!-- Card Footer -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="#" class="font-semibold text-black hover:underline">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')

    <!-- JavaScript for Password and Confirm Password Toggle -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }

        function toggleConfirmPasswordVisibility() {
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const confirmEyeIcon = document.getElementById('confirm-eye-icon');
            const confirmEyeOffIcon = document.getElementById('confirm-eye-off-icon');

            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                confirmEyeIcon.classList.add('hidden');
                confirmEyeOffIcon.classList.remove('hidden');
            } else {
                confirmPasswordInput.type = 'password';
                confirmEyeIcon.classList.remove('hidden');
                confirmEyeOffIcon.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
