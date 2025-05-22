<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>TicketSewa - Complete Your Booking</title>
    <style>
        /* Custom styles for select dropdowns */
        .select-trigger {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: #ffffff;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-gray-50">
    @if(!session('is_logged_in'))
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endif

    @include('partials.header')
    <div class="pt-24 pb-12">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl md:text-3xl font-bold mb-2 z-0 relative">Complete Your Booking</h1>
            <p class="text-gray-600 mb-8 z-0 relative">
                Express Deluxe • New York to Chicago • April 28, 2025
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Journey Details -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="border-b border-gray-100 px-6 py-4">
                            <h2 class="text-xl font-semibold">Journey Details</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <h3 class="font-semibold text-lg">Bus Staff</h3>
                                    <div class="space-y-3">
                                        <div class="flex items-center gap-3">
                                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <div>
                                                <p class="font-medium">Driver</p>
                                                <p class="text-gray-600">John Smith</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <div>
                                                <p class="font-medium">Co-Driver</p>
                                                <p class="text-gray-600">Jane Doe</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <h3 class="font-semibold text-lg">Journey Stops</h3>
                                    <div class="space-y-3">
                                        <div class="flex items-center gap-3">
                                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>
                                                <p class="font-medium">Albany</p>
                                                <p class="text-gray-600">Stop Time: 10:30 AM (15 min rest)</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                            </svg>
                                            <div>
                                                <p class="font-medium">Syracuse</p>
                                                <p class="text-gray-600">Stop Time: 11:45 AM (30 min meal)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Passenger Details -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="border-b border-gray-100 px-6 py-4">
                            <h2 class="text-xl font-semibold">Passenger Details</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <!-- Passenger 1 -->
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="font-semibold">Passenger 1</h3>
                                        <span class="bg-gray-100 px-2 py-1 rounded text-sm">Seat 1A</span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="space-y-2">
                                            <label for="name-0" class="text-sm font-medium">Full Name</label>
                                            <input id="name-0" name="passengers[0][name]" class="w-full border border-gray-300 rounded-md p-2" placeholder="John Doe" required />
                                        </div>
                                        <div class="space-y-2">
                                            <label for="age-0" class="text-sm font-medium">Age</label>
                                            <input id="age-0" name="passengers[0][age]" type="number" min="1" max="120" class="w-full border border-gray-300 rounded-md p-2" placeholder="25" required />
                                        </div>
                                        <div class="space-y-2">
                                            <label for="gender-0" class="text-sm font-medium">Gender</label>
                                            <select id="gender-0" name="passengers[0][gender]" class="select-trigger" required>
                                                <option value="">Select gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Passenger 2 -->
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="font-semibold">Passenger 2</h3>
                                        <span class="bg-gray-100 px-2 py-1 rounded text-sm">Seat 3C</span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="space-y-2">
                                            <label for="name-1" class="text-sm font-medium">Full Name</label>
                                            <input id="name-1" name="passengers[1][name]" class="w-full border border-gray-300 rounded-md p-2" placeholder="Jane Doe" required />
                                        </div>
                                        <div class="space-y-2">
                                            <label for="age-1" class="text-sm font-medium">Age</label>
                                            <input id="age-1" name="passengers[1][age]" type="number" min="1" max="120" class="w-full border border-gray-300 rounded-md p-2" placeholder="30" required />
                                        </div>
                                        <div class="space-y-2">
                                            <label for="gender-1" class="text-sm font-medium">Gender</label>
                                            <select id="gender-1" name="passengers[1][gender]" class="select-trigger" required>
                                                <option value="">Select gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="border-b border-gray-100 px-6 py-4">
                            <h2 class="text-xl font-semibold">Contact Information</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="email" class="text-sm font-medium">Email Address</label>
                                    <input id="email" name="contact[email]" type="email" class="w-full border border-gray-300 rounded-md p-2" placeholder="you@example.com" required />
                                    <p class="text-xs text-gray-500">Your ticket will be sent to this email address</p>
                                </div>
                                <div class="space-y-2">
                                    <label for="phone" class="text-sm font-medium">Phone Number</label>
                                    <input id="phone" name="contact[phone]" type="tel" class="w-full border border-gray-300 rounded-md p-2" placeholder="+977 123 456 7890" required />
                                    <p class="text-xs text-gray-500">For important updates about your journey</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method (eSewa Only) -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="border-b border-gray-100 px-6 py-4">
                            <h2 class="text-xl font-semibold">Payment Method</h2>
                        </div>
                        <div class="ml-2 mb-8">
                            <div >
                                <div class="ml-2 mb-8">
                                    <img src="https://imgs.search.brave.com/-oPmBwEYEGgS3GJQ9RNqD7M1sOMDo6dor2oDnZe38rg/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9lc2V3/YW1vbmV5dHJhbnNm/ZXIuY29tL2Fzc2V0/cy9sb2dvLTAyLnBu/Zw" alt="eSewa Logo" class="h-20 mb-20">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Summary (Sticky) -->
                <div>
                    <div class="bg-white rounded-lg shadow-md sticky top-24">
                        <div class="border-b border-gray-100 px-6 py-4">
                            <h2 class="text-xl font-semibold">Booking Summary</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <h3 class="font-semibold text-lg mb-2">Express Deluxe</h3>
                                    <p class="text-gray-600">AC • Star Travel Co.</p>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <p class="font-semibold">08:00 AM</p>
                                        <p class="text-sm text-gray-600">New York</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold">01:30 PM</p>
                                        <p class="text-sm text-gray-600">Chicago</p>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <p class="text-sm font-medium">Journey Date</p>
                                    <p class="text-gray-800">2025-04-28</p>
                                </div>
                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <p class="font-medium mb-2">Selected Seats ({{ count($selectedSeats) }})</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($selectedSeats as $seat)
                                            <div class="bg-gray-100 px-2 py-1 rounded-md text-sm">{{ $seat }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <p class="font-medium mb-2">Price Details</p>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <p>Base Fare</p>
                                            <p>$81.00</p>
                                        </div>
                                        <div class="flex justify-between">
                                            <p>Taxes & Fees</p>
                                            <p>$9.00</p>
                                        </div>
                                        <div class="flex justify-between font-semibold pt-2">
                                            <p>Total Amount</p>
                                            <p>$90.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-6 border-t border-gray-200">
                            <button type="submit" class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition-colors">
                              <a href="/"></a>  Confirm Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>
</html>
