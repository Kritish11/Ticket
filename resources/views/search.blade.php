<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TicketSewa - Book Your Journey</title>
</head>
<body>
    @include('partials.header')

    <div class="min-h-screen bg-gray-50 pb-12 pt-24">
        <!-- Search Bar Section -->
        <section class="bg-black py-10">
            <div class="container mx-auto px-4">
                <form class="bg-white rounded-lg shadow-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="space-y-2">
                            <label for="from" class="block text-sm font-medium text-gray-700">From</label>
                            <select id="from" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Select city</option>
                                <option value="New York">New York</option>
                                <option value="Los Angeles">Los Angeles</option>
                                <option value="Chicago">Chicago</option>
                                <option value="Boston">Boston</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="to" class="block text-sm font-medium text-gray-700">To</label>
                            <select id="to" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Select city</option>
                                <option value="New York">New York</option>
                                <option value="Los Angeles">Los Angeles</option>
                                <option value="Chicago">Chicago</option>
                                <option value="Boston">Boston</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="date" class="block text-sm font-medium text-gray-700">Travel Date</label>
                            <button type="button" class="w-full flex items-center px-3 py-2 border border-gray-300 rounded-md text-left text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Select date
                            </button>
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition-colors">
                                Search Buses
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <div class="container mx-auto px-4 pt-8">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Filters Section -->
                <div class="md:w-64 flex-shrink-0">
                    <div class="hidden md:block bg-white rounded-lg shadow-md p-6 sticky top-24">
                        <h3 class="font-semibold text-lg mb-4">Filters</h3>

                        <div class="space-y-6">
                            <div>
                                <h4 class="font-medium mb-3">Price Range</h4>
                                <div class="space-y-4">
                                    <input type="range" min="0" max="100" value="0" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer" />
                                    <div class="flex justify-between text-sm">
                                        <span>$0</span>
                                        <span>$100</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-medium mb-3">Bus Type</h4>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="any">Any Bus Type</option>
                                    <option value="AC">AC</option>
                                    <option value="Non-AC">Non-AC</option>
                                    <option value="Sleeper">Sleeper</option>
                                    <option value="Semi-Sleeper">Semi-Sleeper</option>
                                    <option value="Seater">Seater</option>
                                </select>
                            </div>

                            <div>
                                <h4 class="font-medium mb-3">Departure Time</h4>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="any">Any Time</option>
                                    <option value="morning">Morning (6 AM - 12 PM)</option>
                                    <option value="afternoon">Afternoon (12 PM - 6 PM)</option>
                                    <option value="evening">Evening (6 PM - 10 PM)</option>
                                    <option value="night">Night (10 PM - 6 AM)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Filters -->
                    <div class="md:hidden">
                        <button type="button" class="flex items-center w-full mb-4 border border-gray-300 text-gray-700 py-2 rounded-md hover:bg-gray-100 transition-colors">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1m-17 4h14m-7 4h7m-14 4h14"></path>
                            </svg>
                            Show Filters
                        </button>
                    </div>
                </div>

                <!-- Results Section -->
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">4 Buses Available</h2>

                        <div class="w-48 ml-4">
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Sort by</option>
                                <option value="price_low">Price: Low to High</option>
                                <option value="price_high">Price: High to Low</option>
                                <option value="departure_early">Departure: Earliest</option>
                                <option value="departure_late">Departure: Latest</option>
                                <option value="duration">Duration: Shortest</option>
                                <option value="rating">Rating: Highest</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Sample Bus 1 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
                                    <div class="flex flex-col">
                                        <div class="flex items-center mb-2">
                                            <h3 class="text-lg font-semibold truncate">Express Deluxe</h3>
                                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded ml-2">AC</span>
                                        </div>
                                        <p class="text-gray-600 truncate">Star Travel Co.</p>
                                        <div class="flex items-center mt-1">
                                            <svg class="fill-yellow-400 stroke-yellow-400 h-4 w-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                            </svg>
                                            <span class="text-sm ml-1">4.5</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-8">
                                        <div class="text-center">
                                            <p class="font-semibold">08:00 AM</p>
                                            <p class="text-sm text-gray-600 truncate">New York</p>
                                        </div>

                                        <div class="hidden md:block">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                                <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                                <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                            </div>
                                            <p class="text-xs text-center text-gray-500 mt-1">5h 30m</p>
                                        </div>

                                        <div class="text-center">
                                            <p class="font-semibold">01:30 PM</p>
                                            <p class="text-sm text-gray-600 truncate">Chicago</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-center md:items-end mt-4 md:mt-0">
                                        <p class="text-xl font-bold mb-2">$45</p>
                                        <p class="text-sm text-gray-600 mb-2">12 seats left</p>
                                        <button class="w-full md:w-32 bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition-colors">
                                           <a href="/seatselect">Select Bus</a>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Hover Section without Animation -->
                            <div class="bg-gray-50 p-6 border-t border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Break Time</h4>
                                        <p class="text-sm text-gray-600">10:30 AM - 15 min rest stop at Albany</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Eating Break</h4>
                                        <p class="text-sm text-gray-600">11:45 AM - 30 min meal stop at Syracuse</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Amenities</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 9.143m-2 10l-1.143-3.429L15 14.571m-3-9.143V21"></path>
                                                </svg>
                                                WiFi
                                            </div>
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                Charging
                                            </div>
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                AC
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sample Bus 2 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
                                    <div class="flex flex-col">
                                        <div class="flex items-center mb-2">
                                            <h3 class="text-lg font-semibold truncate">Comfort Sleeper</h3>
                                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded ml-2">Sleeper</span>
                                        </div>
                                        <p class="text-gray-600 truncate">Night Star Buses</p>
                                        <div class="flex items-center mt-1">
                                            <svg class="fill-yellow-400 stroke-yellow-400 h-4 w-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                            </svg>
                                            <span class="text-sm ml-1">4.2</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-8">
                                        <div class="text-center">
                                            <p class="font-semibold">10:00 PM</p>
                                            <p class="text-sm text-gray-600 truncate">Los Angeles</p>
                                        </div>

                                        <div class="hidden md:block">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                                <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                                <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                            </div>
                                            <p class="text-xs text-center text-gray-500 mt-1">8h 15m</p>
                                        </div>

                                        <div class="text-center">
                                            <p class="font-semibold">06:15 AM</p>
                                            <p class="text-sm text-gray-600 truncate">Chicago</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-center md:items-end mt-4 md:mt-0">
                                        <p class="text-xl font-bold mb-2">$60</p>
                                        <p class="text-sm text-gray-600 mb-2">8 seats left</p>
                                        <button class="w-full md:w-32 bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition-colors">
                                            Select Bus
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Hover Section without Animation -->
                            <div class="bg-gray-50 p-6 border-t border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Break Time</h4>
                                        <p class="text-sm text-gray-600">01:00 AM - 20 min rest stop at Las Vegas</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Eating Break</h4>
                                        <p class="text-sm text-gray-600">03:30 AM - 30 min meal stop at Denver</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Amenities</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 9.143m-2 10l-1.143-3.429L15 14.571m-3-9.143V21"></path>
                                                </svg>
                                                WiFi
                                            </div>
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                Charging
                                            </div>
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-5v-5m-7 5H4"></path>
                                                </svg>
                                                Blanket
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sample Bus 3 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
                                    <div class="flex flex-col">
                                        <div class="flex items-center mb-2">
                                            <h3 class="text-lg font-semibold truncate">City Seater</h3>
                                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded ml-2">Seater</span>
                                        </div>
                                        <p class="text-gray-600 truncate">Metro Lines</p>
                                        <div class="flex items-center mt-1">
                                            <svg class="fill-yellow-400 stroke-yellow-400 h-4 w-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                            </svg>
                                            <span class="text-sm ml-1">4.0</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-8">
                                        <div class="text-center">
                                            <p class="font-semibold">02:00 PM</p>
                                            <p class="text-sm text-gray-600 truncate">Boston</p>
                                        </div>

                                        <div class="hidden md:block">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                                <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                                <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                            </div>
                                            <p class="text-xs text-center text-gray-500 mt-1">3h 45m</p>
                                        </div>

                                        <div class="text-center">
                                            <p class="font-semibold">05:45 PM</p>
                                            <p class="text-sm text-gray-600 truncate">New York</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-center md:items-end mt-4 md:mt-0">
                                        <p class="text-xl font-bold mb-2">$30</p>
                                        <p class="text-sm text-gray-600 mb-2">15 seats left</p>
                                        <button class="w-full md:w-32 bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition-colors">
                                            Select Bus
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Hover Section without Animation -->
                            <div class="bg-gray-50 p-6 border-t border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Break Time</h4>
                                        <p class="text-sm text-gray-600">03:30 PM - 10 min rest stop at Providence</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Eating Break</h4>
                                        <p class="text-sm text-gray-600">04:00 PM - 20 min meal stop at Hartford</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Amenities</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <div class="flex items-center bg-white py-1 px-2 roundedSLOT text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 9.143m-2 10l-1.143-3.429L15 14.571m-3-9.143V21"></path>
                                                </svg>
                                                WiFi
                                            </div>
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                AC
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sample Bus 4 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
                                    <div class="flex flex-col">
                                        <div class="flex items-center mb-2">
                                            <h3 class="text-lg font-semibold truncate">Luxury Non-AC</h3>
                                            <span

     class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded ml-2">Non-AC</span>
                                        </div>
                                        <p class="text-gray-600 truncate">Eco Travel</p>
                                        <div class="flex items-center mt-1">
                                            <svg class="fill-yellow-400 stroke-yellow-400 h-4 w-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                            </svg>
                                            <span class="text-sm ml-1">3.8</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-8">
                                        <div class="text-center">
                                            <p class="font-semibold">06:00 AM</p>
                                            <p class="text-sm text-gray-600 truncate">Chicago</p>
                                        </div>

                                        <div class="hidden md:block">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                                <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                                <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                            </div>
                                            <p class="text-xs text-center text-gray-500 mt-1">6h 00m</p>
                                        </div>

                                        <div class="text-center">
                                            <p class="font-semibold">12:00 PM</p>
                                            <p class="text-sm text-gray-600 truncate">Boston</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-center md:items-end mt-4 md:mt-0">
                                        <p class="text-xl font-bold mb-2">$35</p>
                                        <p class="text-sm text-gray-600 mb-2">20 seats left</p>
                                        <button class="w-full md:w-32 bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition-colors">
                                            Select Bus
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Hover Section without Animation -->
                            <div class="щество

     bg-gray-50 p-6 border-t border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Break Time</h4>
                                        <p class="text-sm text-gray-600">08:15 AM - 15 min rest stop at Cleveland</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Eating Break</h4>
                                        <p class="text-sm text-gray-600">09:30 AM - 25 min meal stop at Pittsburgh</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-sm mb-2">Amenities</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 9.143m-2 10l-1.143-3.429L15 14.571m-3-9.143V21"></path>
                                                </svg>
                                                WiFi
                                            </div>
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                Charging
                                            </div>
                                            <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                                </svg>
                                                Water
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>
</html>
