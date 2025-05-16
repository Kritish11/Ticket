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

    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12 bg-gray-50">
        <div class="w-full max-w-md">
            <div class="shadow-lg bg-white rounded-lg">
                <div class="p-6 space-y-1 text-center">
                    <div class="flex justify-center mb-4">
                        <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold">Verify Your Email</h3>
                    <p class="text-gray-500">
                        We've sent a verification code to your email. Enter the code below to verify your email address.
                    </p>
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex justify-center py-4 gap-3">
                        <input
                            type="text"
                            maxlength="1"
                            id="otp1"
                            class="h-12 w-12 text-lg text-center border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            oninput="if(this.value.length === 1) document.getElementById('otp2').focus()"
                            onkeydown="if(event.key === 'Backspace' && this.value.length === 0) document.getElementById('otp1').focus()"
                        />
                        <input
                            type="text"
                            maxlength="1"
                            id="otp2"
                            class="h-12 w-12 text-lg text-center border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            oninput="if(this.value.length === 1) document.getElementById('otp3').focus()"
                            onkeydown="if(event.key === 'Backspace' && this.value.length === 0) document.getElementById('otp1').focus()"
                        />
                        <input
                            type="text"
                            maxlength="1"
                            id="otp3"
                            class="h-12 w-12 text-lg text-center border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            oninput="if(this.value.length === 1) document.getElementById('otp4').focus()"
                            onkeydown="if(event.key === 'Backspace' && this.value.length === 0) document.getElementById('otp2').focus()"
                        />
                        <input
                            type="text"
                            maxlength="1"
                            id="otp4"
                            class="h-12 w-12 text-lg text-center border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            oninput="if(this.value.length === 1) document.getElementById('otp5').focus()"
                            onkeydown="if(event.key === 'Backspace' && this.value.length === 0) document.getElementById('otp3').focus()"
                        />
                        <input
                            type="text"
                            maxlength="1"
                            id="otp5"
                            class="h-12 w-12 text-lg text-center border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            oninput="if(this.value.length === 1) document.getElementById('otp6').focus()"
                            onkeydown="if(event.key === 'Backspace' && this.value.length === 0) document.getElementById('otp4').focus()"
                        />
                        <input
                            type="text"
                            maxlength="1"
                            id="otp6"
                            class="h-12 w-12 text-lg text-center border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onkeydown="if(event.key === 'Backspace' && this.value.length === 0) document.getElementById('otp5').focus()"
                        />
                    </div>

                    <div class="text-center text-sm text-gray-500">
                        Didn't receive a code?
                        <a href="#" class="text-blue-600 hover:underline font-medium">Resend Code</a>
                    </div>
                </div>

                <div class="p-6 flex flex-col gap-2">
                    <button class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition-colors">
                        Verify Email
                    </button>
                    <a href="/signup" class="w-full flex items-center justify-center gap-2 border border-gray-300 text-gray-700 py-2 rounded-md hover:bg-gray-100 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Sign Up
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
