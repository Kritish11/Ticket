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
                    @if(isset($schedules))
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold">{{ count($schedules) }} Buses Available</h2>
                        </div>

                        @forelse($schedules as $schedule)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden group mb-4">
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
                                        <!-- Bus Info -->
                                        <div class="flex flex-col">
                                            <div class="flex items-center mb-2">
                                                <h3 class="text-lg font-semibold truncate">{{ $schedule['bus'] }}</h3>
                                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded ml-2">{{ $schedule['bus_type'] }}</span>
                                            </div>
                                        </div>

                                        <!-- Time and Route -->
                                        <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-8">
                                            <div class="text-center">
                                                <p class="font-semibold">{{ $schedule['departure_time'] }}</p>
                                                <p class="text-sm text-gray-600 truncate">{{ explode(' → ', $schedule['route'])[0] }}</p>
                                            </div>

                                            <div class="hidden md:block">
                                                <div class="flex items-center">
                                                    <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                                    <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                    </svg>
                                                    <div class="w-20 h-0.5 bg-gray-300 mx-1"></div>
                                                    <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                                </div>
                                                <p class="text-xs text-center text-gray-500 mt-1">{{ $schedule['duration'] }}h</p>
                                            </div>

                                            <div class="text-center">
                                                <p class="font-semibold">Arrival</p>
                                                <p class="text-sm text-gray-600 truncate">{{ explode(' → ', $schedule['route'])[1] }}</p>
                                            </div>
                                        </div>

                                        <!-- Price and Booking -->
                                        <div class="flex flex-col items-center md:items-end mt-4 md:mt-0">
                                            <p class="text-xl font-bold mb-2">₹{{ $schedule['price'] }}</p>
                                            <p class="text-sm text-gray-600 mb-2">{{ $schedule['seats_available'] }} seats left</p>
                                            <a href="#" 
                                               class="w-full md:w-32 bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 text-center">
                                                Select Bus
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Features Section -->
                                <div class="bg-gray-50 p-6 border-t border-gray-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Break Time -->
                                        @if(isset($schedule['food_break']))
                                            <div>
                                                <h4 class="font-medium text-sm mb-2">Break Time</h4>
                                                <p class="text-sm text-gray-600">
                                                    {{ $schedule['food_break']['time'] }} - {{ $schedule['food_break']['duration'] }} min at {{ $schedule['food_break']['location'] }}
                                                </p>
                                            </div>
                                        @endif

                                        <!-- Features -->
                                        <div>
                                            <h4 class="font-medium text-sm mb-2">Features</h4>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($schedule['features'] as $feature)
                                                    <div class="flex items-center bg-white py-1 px-2 rounded text-xs">
                                                        <svg class="h-4 w-4 mr-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        {{ $feature }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                                <p class="text-gray-600 mb-4">No buses available for the selected criteria.</p>
                                <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">
                                    Try different dates or routes
                                </a>
                            </div>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>
</html>
