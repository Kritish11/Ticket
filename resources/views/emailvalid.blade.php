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
                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('verify.otp') }}" method="POST" class="space-y-4">
                        @csrf
                        <!-- Single hidden input to store combined OTP -->
                        <input type="hidden" name="otp" id="combinedOtp">

                        <div class="flex justify-center py-4 gap-3">
                            @for ($i = 1; $i <= 6; $i++)
                                <input
                                    type="text"
                                    maxlength="1"
                                    id="otp{{ $i }}"
                                    class="h-12 w-12 text-lg text-center border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    oninput="moveToNext(this, {{ $i }})"
                                    onkeydown="handleBackspace(this, event, {{ $i }})"
                                    required
                                />
                            @endfor
                        </div>
                        <button type="submit" class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition-colors">
                            Verify Email
                        </button>
                    </form>

                    <form action="{{ route('resend.otp') }}" method="POST" class="text-center text-sm text-gray-500">
                        @csrf
                        <span>Didn't receive a code?</span>
                        <button type="submit" class="text-blue-600 hover:underline font-medium">Resend Code</button>
                    </form>
                </div>

                <div class="p-6 flex flex-col gap-2">
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

    <script>
        function moveToNext(current, index) {
            if (current.value.length === 1 && index < 6) {
                document.getElementById('otp' + (index + 1)).focus();
            }
            combineOtp();
        }

        function handleBackspace(current, event, index) {
            if (event.key === 'Backspace' && current.value.length === 0 && index > 1) {
                document.getElementById('otp' + (index - 1)).focus();
            }
            combineOtp();
        }

        function combineOtp() {
            let otp = '';
            for (let i = 1; i <= 6; i++) {
                otp += document.getElementById('otp' + i).value;
            }
            document.getElementById('combinedOtp').value = otp;
        }
    </script>

    @include('partials.footer')
</body>
</html>
