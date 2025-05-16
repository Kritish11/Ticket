<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>TicketSewa - Ticket Details</title>
    <style>
        /* Custom styles for animations */
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('partials.header')


    <!-- Main Content -->
    <div class="min-h-screen py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <!-- Back to Bookings Link -->
                <a href="/bookings" class="inline-flex items-center text-sm text-gray-600 hover:text-black mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Bookings
                </a>

                <!-- Ticket Card -->
                <div class="bg-white rounded-lg shadow-lg animate-fade-in print:shadow-none">
                    <!-- Card Header -->
                    <div class="border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center p-6">
                        <div>
                            <h2 class="text-2xl font-semibold flex items-center">
                                Ticket Details
                                <span class="ml-2 text-sm px-3 py-1 rounded-full bg-green-100 text-green-800 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="capitalize">Confirmed</span>
                                </span>
                            </h2>
                            <p class="text-gray-500 mt-1">PNR: PNR67890</p>
                        </div>
                        <div class="mt-4 sm:mt-0 flex space-x-2">
                            <button class="border border-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-100 transition-colors text-sm flex items-center">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </button>
                            <button class="border border-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-100 transition-colors text-sm flex items-center">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8v8h18V8H3zm9 6H6m6 0h6m-6 0v-4"></path>
                                </svg>
                                Email
                            </button>
                            <button class="border border-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-100 transition-colors text-sm flex items-center print:hidden">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2z"></path>
                                </svg>
                                Print
                            </button>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6">
                        <div class="space-y-6">
                            <!-- Journey Details -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="font-semibold text-lg mb-4">Journey Details</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex items-start space-x-3">
                                        <svg class="h-5 w-5 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">Bus</p>
                                            <p class="font-medium">Express Deluxe</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <svg class="h-5 w-5 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">Travel Date</p>
                                            <p class="font-medium">2025-04-28</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <svg class="h-5 w-5 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">From - To</p>
                                            <p class="font-medium">New York - Chicago</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <svg class="h-5 w-5 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500">Departure - Arrival</p>
                                            <p class="font-medium">08:00 AM - 01:30 PM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Journey Stops -->
                            <div>
                                <h3 class="font-semibold text-lg mb-3">Journey Stops</h3>
                                <div class="bg-gray-50 rounded-lg divide-y divide-gray-200">
                                    <div class="p-4 flex items-start space-x-3">
                                        <svg class="h-5 w-5 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <p class="font-medium">Albany</p>
                                            <p class="text-sm text-gray-600">10:30 AM (15 min rest)</p>
                                        </div>
                                    </div>
                                    <div class="p-4 flex items-start space-x-3">
                                        <svg class="h-5 w-5 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5v-2a2 2 0 012-2h10a2 2 0 012 2v2h-4m-6 0h.01M12 16h.01"></path>
                                        </svg>
                                        <div>
                                            <p class="font-medium">Syracuse</p>
                                            <p class="text-sm text-gray-600">11:45 AM (30 min meal)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Seat Information -->
                            <div>
                                <h3 class="font-semibold text-lg mb-3">Seat Information</h3>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        <div class="bg-gray-200 px-3 py-1 rounded text-sm font-medium">1A</div>
                                        <div class="bg-gray-200 px-3 py-1 rounded text-sm font-medium">3C</div>
                                    </div>
                                    <p class="text-sm text-gray-500">Total Seats: 2</p>
                                </div>
                            </div>

                            <!-- Passenger Details -->
                            <div>
                                <h3 class="font-semibold text-lg mb-3">Passenger Details</h3>
                                <div class="bg-gray-50 rounded-lg divide-y divide-gray-200">
                                    <div class="p-4 flex items-start space-x-3">
                                        <svg class="h-5 w-5 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <div class="flex justify-between">
                                                <p class="font-medium">John Doe</p>
                                                <p class="text-sm text-gray-500">Seat: 1A</p>
                                            </div>
                                            <div class="flex space-x-4 text-sm text-gray-500 mt-1">
                                                <p>Age: 25</p>
                                                <p>Gender: Male</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 flex items-start space-x-3">
                                        <svg class="h-5 w-5 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <div class="flex justify-between">
                                                <p class="font-medium">Jane Doe</p>
                                                <p class="text-sm text-gray-500">Seat: 3C</p>
                                            </div>
                                            <div class="flex space-x-4 text-sm text-gray-500 mt-1">
                                                <p>Age: 30</p>
                                                <p>Gender: Female</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Details -->
                            <div>
                                <h3 class="font-semibold text-lg mb-3">Payment Details</h3>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex justify-between mb-2">
                                        <p class="text-gray-600">Ticket Fare</p>
                                        <p>$90.00</p>
                                    </div>
                                    <div class="flex justify-between mb-2">
                                        <p class="text-gray-600">Service Fee</p>
                                        <p>$0.00</p>
                                    </div>
                                    <hr class="my-2 border-gray-200">
                                    <div class="flex justify-between font-semibold">
                                        <p>Total Amount</p>
                                        <p>$90.00</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Information -->
                            <div>
                                <h3 class="font-semibold text-lg mb-3">Booking Information</h3>
                                <div class="bg-gray-50 rounded-lg p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Booking ID</p>
                                        <p class="font-medium">BK12345</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Booking Date</p>
                                        <p class="font-medium">2025-04-20</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">PNR Number</p>
                                        <p class="font-medium">PNR67890</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Status</p>
                                        <p class="font-medium capitalize">Confirmed</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="text-sm text-gray-500 mt-4">
                                <h4 class="font-medium text-gray-700 mb-2">Important Information:</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Please arrive at the boarding point 30 minutes before departure.</li>
                                    <li>Carry a printed copy or show the e-ticket on your mobile device.</li>
                                    <li>All passengers must have valid ID proof matching the details provided.</li>
                                    <li>Cancellation policies apply as per the Terms and Conditions.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="border-t border-gray-100 p-6">
                        <div class="w-full flex flex-col sm:flex-row justify-between items-center gap-4">
                            <p class="text-sm text-gray-500">
                                For any assistance, please contact our support team at support@voyageticket.com or call +97701-1234567.
                            </p>
                            <button class="bg-red-600 text-white py-2 px-4 mb-3 rounded-md hover:bg-red-700 transition-colors text-sm">
                                Cancel
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
