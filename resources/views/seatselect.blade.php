<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select Seats - TicketSewa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <div class="min-h-screen pt-24">
        <div class="container mx-auto px-4">
            <!-- Bus Details Header -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Bus Info -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-bold mb-1">{{ $schedule->bus->name }}</h2>
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="bg-black text-white px-2 py-0.5 rounded">{{ $schedule->bus->standard->name }}</span>
                                    <span class="text-gray-600">{{ $schedule->bus->number_plate }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Staff Info -->
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Driver</p>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">{{ $schedule->bus->driver_name }}</p>
                                    <p class="text-xs text-gray-500">Primary Driver</p>
                                </div>
                            </div>
                        </div>

                        <!-- Features -->
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-2">Bus Features</p>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $featureIds = is_array($schedule->bus->features)
                                        ? $schedule->bus->features
                                        : json_decode($schedule->bus->features ?? '[]', true);
                                @endphp
                                @foreach($featureIds as $featureId)
                                    @php
                                        $feature = \App\Models\BusFeature::find($featureId);
                                    @endphp
                                    @if($feature)
                                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ $feature->name }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Journey Details -->
                    <div class="flex flex-col">
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="font-bold text-lg">{{ date('h:i A', strtotime($schedule->departure_time)) }}</p>
                                <p class="text-gray-600">{{ $schedule->route->from }}</p>
                            </div>
                            <div class="flex-1 border-t border-gray-300 relative">
                                <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-2 text-sm text-gray-500">
                                    {{ $schedule->duration }} hrs
                                </span>
                            </div>
                            <div>
                                <p class="font-bold text-lg">{{ date('h:i A', strtotime($schedule->arrival_time)) }}</p>
                                <p class="text-gray-600">{{ $schedule->route->to }}</p>
                            </div>
                        </div>
                        <p class="mt-2 text-gray-600">{{ date('D, M d, Y', strtotime($schedule->departure_date)) }}</p>
                    </div>

                    <!-- Price Info -->
                    <div class="text-right">
                        <p class="text-2xl font-bold">Rs.{{ $schedule->price }}</p>
                        <p class="text-gray-600">per seat</p>
                    </div>
                </div>
            </div>

            <!-- Main Content Area with Side Booking -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column: Images and Seat Selection -->
                <div class="col-span-2 space-y-6">
                    <!-- Bus Images Slider -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div x-data="imageSlider()" class="w-full">
                            <!-- Main Image Container with reduced height -->
                            <div class="relative w-full" style="padding-bottom: 40%;">
                                <template x-for="(image, index) in images" :key="index">
                                    <div x-show="currentIndex === index"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform scale-95"
                                        x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 transform scale-100"
                                        x-transition:leave-end="opacity-0 transform scale-95"
                                        class="absolute inset-0 rounded-lg overflow-hidden bg-gray-100">
                                        <img :src="'/storage/' + image"
                                            class="w-full h-full object-contain"
                                            :alt="'Bus Image ' + (index + 1)">
                                    </div>
                                </template>

                                <!-- Navigation Arrows -->
                                <button @click="prev()"
                                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white w-6 h-6 rounded-full flex items-center justify-center transition-all"
                                        x-show="images.length > 1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </button>
                                <button @click="next()"
                                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white w-6 h-6 rounded-full flex items-center justify-center transition-all"
                                        x-show="images.length > 1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Thumbnails -->
                            <div class="mt-2 flex justify-center gap-1">
                                <template x-for="(image, index) in images" :key="index">
                                    <button @click="currentIndex = index"
                                            class="relative flex-shrink-0 w-12 h-12 rounded-md overflow-hidden transition-all"
                                            :class="currentIndex === index ? 'ring-2 ring-black' : 'opacity-70 hover:opacity-100'">
                                        <img :src="'/storage/' + image"
                                            class="w-full h-full object-cover">
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Seat Selection Area -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold mb-4">Select Seats</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="space-y-8" x-data="seatSelection">
                                <!-- Driver Section -->
                                <div class="flex justify-end mb-8">
                                    <div class="bg-gray-300 p-2 rounded w-16 text-center text-sm">
                                        Driver
                                    </div>
                                </div>

                                <!-- Regular Seats (4 seats per row with aisle) -->
                                <div class="grid gap-y-4">
                                    @php
                                        $totalSeats = $schedule->bus->seats;
                                        $regularRows = floor(($totalSeats - 5) / 4);
                                        $currentSeat = 1;
                                    @endphp

                                    <!-- Regular rows with 4 seats -->
                                    @for ($row = 1; $row <= $regularRows; $row++)
                                        <div class="flex justify-between">
                                            <!-- Left pair -->
                                            <div class="flex gap-2">
                                                @for ($i = 1; $i <= 2; $i++)
                                                    <button
                                                        class="w-14 h-12 rounded-lg text-center transition-colors text-sm"
                                                        :class="{
                                                            'bg-gray-200 hover:bg-gray-300': !selectedSeats.includes({{ $currentSeat }}),
                                                            'bg-black text-white': selectedSeats.includes({{ $currentSeat }})
                                                        }"
                                                        @click="toggleSeat({{ $currentSeat }})">
                                                        {{ $currentSeat++ }}
                                                    </button>
                                                @endfor
                                            </div>

                                            <!-- Aisle -->
                                            <div class="w-16"></div>

                                            <!-- Right pair -->
                                            <div class="flex gap-2">
                                                @for ($i = 1; $i <= 2; $i++)
                                                    <button
                                                        class="w-14 h-12 rounded-lg text-center transition-colors text-sm"
                                                        :class="{
                                                            'bg-gray-200 hover:bg-gray-300': !selectedSeats.includes({{ $currentSeat }}),
                                                            'bg-black text-white': selectedSeats.includes({{ $currentSeat }})
                                                        }"
                                                        @click="toggleSeat({{ $currentSeat }})">
                                                        {{ $currentSeat++ }}
                                                    </button>
                                                @endfor
                                            </div>
                                        </div>
                                    @endfor

                                    <!-- Last row with 5 seats -->
                                    <div class="flex justify-between mt-4">
                                        <!-- Left pair -->
                                        <div class="flex gap-2">
                                            @for ($i = 1; $i <= 2; $i++)
                                                <button
                                                    class="w-14 h-12 rounded-lg text-center transition-colors text-sm"
                                                    :class="{
                                                        'bg-gray-200 hover:bg-gray-300': !selectedSeats.includes({{ $currentSeat }}),
                                                        'bg-black text-white': selectedSeats.includes({{ $currentSeat }})
                                                    }"
                                                    @click="toggleSeat({{ $currentSeat }})">
                                                    {{ $currentSeat++ }}
                                                </button>
                                            @endfor
                                        </div>

                                        <!-- Middle seat -->
                                        <button
                                            class="w-14 h-12 rounded-lg text-center transition-colors text-sm"
                                            :class="{
                                                'bg-gray-200 hover:bg-gray-300': !selectedSeats.includes({{ $currentSeat }}),
                                                'bg-black text-white': selectedSeats.includes({{ $currentSeat }})
                                            }"
                                            @click="toggleSeat({{ $currentSeat }})">
                                            {{ $currentSeat++ }}
                                        </button>

                                        <!-- Right pair -->
                                        <div class="flex gap-2">
                                            @for ($i = 1; $i <= 2; $i++)
                                                <button
                                                    class="w-14 h-12 rounded-lg text-center transition-colors text-sm"
                                                    :class="{
                                                        'bg-gray-200 hover:bg-gray-300': !selectedSeats.includes({{ $currentSeat }}),
                                                        'bg-black text-white': selectedSeats.includes({{ $currentSeat }})
                                                    }"
                                                    @click="toggleSeat({{ $currentSeat }})">
                                                    {{ $currentSeat++ }}
                                                </button>
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <!-- Seat Legend -->
                                <div class="mt-8 flex justify-center gap-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-gray-200 rounded"></div>
                                        <span>Available</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-black rounded"></div>
                                        <span>Selected</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Booking Summary -->
                <div class="md:col-span-1">
                    <div class="bg-white p-6 rounded-lg shadow-md sticky top-24">
                        <h4 class="font-bold mb-4">Booking Summary</h4>
                        <div x-data="seatSelection">
                            <div class="space-y-4">
                                <!-- Selected Seats -->
                                <div>
                                    <p class="text-gray-600 mb-1">Selected Seats</p>
                                    <p class="font-bold" x-text="selectedSeats.join(', ') || 'None'"></p>
                                </div>

                                <!-- Price Details -->
                                <div class="border-t pt-4 space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Price per seat</span>
                                        <span>₹{{ $schedule->price }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Number of seats</span>
                                        <span x-text="selectedSeats.length"></span>
                                    </div>
                                    <div class="flex justify-between font-medium border-t pt-2">
                                        <span>Total Amount</span>
                                        <span class="text-2xl font-bold" x-text="'₹' + total"></span>
                                    </div>
                                </div>

                                <button
                                    @click="proceedToBooking()"
                                    class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors disabled:opacity-50"
                                    :disabled="selectedSeats.length === 0">
                                    Continue Booking
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageSlider', () => ({
                currentIndex: 0,
                images: @json(is_array($schedule->bus->images) ? $schedule->bus->images : json_decode($schedule->bus->images ?? '[]', true)),
                prev() {
                    this.currentIndex = this.currentIndex === 0 ? this.images.length - 1 : this.currentIndex - 1;
                },
                next() {
                    this.currentIndex = this.currentIndex === this.images.length - 1 ? 0 : this.currentIndex + 1;
                }
            }));

            Alpine.data('seatSelection', () => ({
                selectedSeats: [],
                price: {{ $schedule->price }},
                get total() {
                    return this.selectedSeats.length * this.price;
                },
                toggleSeat(seatNumber) {
                    const index = this.selectedSeats.indexOf(seatNumber);
                    if (index === -1) {
                        this.selectedSeats.push(seatNumber);
                    } else {
                        this.selectedSeats.splice(index, 1);
                    }
                },
                proceedToBooking() {
                    if (this.selectedSeats.length > 0) {
                        window.location.href = `{{ route('booking.reservation', ['id' => $schedule->id]) }}?seats=${this.selectedSeats.join(',')}`;
                    }
                }
            }));
        });
    </script>
</body>
</html>
