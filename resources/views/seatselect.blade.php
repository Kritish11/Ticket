<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>TicketSewa - Book Your Journey</title>
    <style>
        .bus-seat {
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
        }
        .bus-seat-available {
            background-color: #e5e7eb;
            color: #374151;
        }
        .bus-seat-available:hover {
            background-color: #d1d5db;
        }
        .bus-seat-selected {
            background-color: #2563eb;
            color: #ffffff;
        }
        .bus-seat-booked {
            background-color: #9ca3af;
            color: #ffffff;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    @if(!session('is_logged_in'))
        <div class="fixed top-20 right-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded shadow-lg z-50">
            Please <a href="{{ route('login') }}" class="underline font-medium">login</a> to book tickets.
        </div>
    @endif

    @include('partials.header')
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Select Your Seats</h1>
            <p class="text-gray-600 mb-8">
                Express Deluxe • New York to Chicago • April 28, 2025
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Bus Details Section -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Placeholder for BusGallery -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Bus Gallery</h2>
                        <div class="flex space-x-4 overflow-x-auto">
                            <img src="https://imgs.search.brave.com/UQdINo_nVnOCSUeJKCCf6zBLdemnynx0hh6U6pMl6wQ/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvNDY0/Nzg5NTk0L3Bob3Rv/L2ludGVyaW9yLW9m/LWFuLWludGVydXJi/YW4tY29hY2guanBn/P3M9NjEyeDYxMiZ3/PTAmaz0yMCZjPW4w/SHF1WDA4U2dOeXV2/YllmbWRabFk5UzA3/RWRkbGUtd3ZNSXZm/SG1US0k9" alt="Bus Image 1" class="h-48 rounded-md">
                            <img src="https://imgs.search.brave.com/-Fj8rSk6jjOGPAzBcNztv3BDiKFH-xNlpRv3eSE62go/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvODg5/NDQ2NzUwL3Bob3Rv/L2ludGVyaW9yLW9m/LXRoZS1idXMuanBn/P3M9NjEyeDYxMiZ3/PTAmaz0yMCZjPVRB/MWZ2VVpCaFUtX29r/cVpBZmV3YjZIb3V6/UFpqclVCWEVyaXVt/cHBuUlk9" alt="Bus Image 2" class="h-48 rounded-md">
                            <img src="https://imgs.search.brave.com/U171QdZhEetBmLX1o-daKLV2MEfT2IKdNgzdk9wQE7I/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvNDgy/NzEyMTM1L3Bob3Rv/L3Bhc3Nlbmdlci1z/ZWF0cy5qcGc_cz02/MTJ4NjEyJnc9MCZr/PTIwJmM9M0NCMlF4/U2ViYUtLMV9fT3BB/Ql9XNzlYekc0RFlS/dWZMWkZQYjkyWGl5/Yz0" alt="Bus Image 3" class="h-48 rounded-md">
                            <img src="https://imgs.search.brave.com/U171QdZhEetBmLX1o-daKLV2MEfT2IKdNgzdk9wQE7I/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvNDgy/NzEyMTM1L3Bob3Rv/L3Bhc3Nlbmdlci1z/ZWF0cy5qcGc_cz02/MTJ4NjEyJnc9MCZr/PTIwJmM9M0NCMlF4/U2ViYUtLMV9fT3BB/Ql9XNzlYekc0RFlS/dWZMWkZQYjkyWGl5/Yz0" alt="Bus Image 4" class="h-48 rounded-md">
                        </div>
                    </div>

                    <!-- Placeholder for JourneyDetails -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Journey Details</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="font-medium">Driver: John Smith</p>
                                <p class="font-medium">Co-Driver: Jane Doe</p>
                            </div>
                            <div>
                                <p class="font-medium">Stops:</p>
                                <ul class="list-disc list-inside text-gray-600">
                                    <li>Albany - 10:30 AM (15 min rest)</li>
                                    <li>Syracuse - 11:45 AM (30 min meal)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Seat Map Section -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="border-b border-gray-100 px-6 py-4">
                            <h2 class="text-xl font-semibold">Seat Layout</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <div class="flex items-center space-x-8">
                                    <div class="flex items-center">
                                        <div class="bus-seat bus-seat-available mr-2 w-8 h-8"></div>
                                        <span class="text-sm">Available</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="bus-seat bus-seat-selected mr-2 w-8 h-8"></div>
                                        <span class="text-sm">Selected</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="bus-seat bus-seat-booked mr-2 w-8 h-8"></div>
                                        <span class="text-sm">Booked</span>
                                    </div>
                                </div>
                            </div>

                            <div class="relative bg-gray-100 p-6 rounded-lg">
                                <!-- Bus Front (Driver's Seat) -->
                                <div class="flex items-center justify-between mb-8">
                                    <div class="w-20 h-16 bg-gray-200 border border-gray-300 rounded-md flex items-center justify-center">
                                        <span class="text-sm text-gray-600">Driver</span>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium">Front</p>
                                        <div class="w-8 h-8 bg-gray-700 rounded-md ml-auto"></div>
                                    </div>
                                </div>

                                <!-- Bus Seats -->
                                <div class="space-y-3">
                                    <!-- Row 1 -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="1A">1A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="1B">1B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="1C">1C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="1D">1D</button>
                                        </div>
                                    </div>
                                    <!-- Row 2 -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="2A">2A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="2B">2B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="2C">2C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="2D">2D</button>
                                        </div>
                                    </div>
                                    <!-- Row 3 -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="3A">3A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="3B">3B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="3C">3C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="3D">3D</button>
                                        </div>
                                    </div>
                                    <!-- Row 4 -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="4A">4A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="4B">4B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="4C">4C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="4D">4D</button>
                                        </div>
                                    </div>
                                    <!-- Row 5 -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="5A">5A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="5B">5B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="5C">5C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="5D">5D</button>
                                        </div>
                                    </div>
                                    <!-- Row 6 -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="6A">6A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="6B">6B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="6C">6C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="6D">6D</button>
                                        </div>
                                    </div>
                                    <!-- Row 7 -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="7A">7A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="7B">7B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="7C">7C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="7D">7D</button>
                                        </div>
                                    </div>
                                    <!-- Row 8 -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="8A">8A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="8B">8B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="8C">8C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="8D">8D</button>
                                        </div>
                                    </div>
                                    <!-- Row 9 -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="9A">9A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="9B">9B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="9C">9C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="9D">9D</button>
                                        </div>
                                    </div>
                                    <!-- Row 10 (Five Seats) -->
                                    <div class="flex justify-between">
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="10A">10A</button>
                                            <button class="bus-seat bus-seat-available" data-seat="10B">10B</button>
                                        </div>
                                        <div class="w-6"></div>
                                        <div class="flex space-x-1">
                                            <button class="bus-seat bus-seat-available" data-seat="10C">10C</button>
                                            <button class="bus-seat bus-seat-available" data-seat="10D">10D</button>
                                            <button class="bus-seat bus-seat-available" data-seat="10E">10E</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Summary Section -->
                <div>
                    <div class="bg-white rounded-lg shadow-md">
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
                                    <p class="font-medium mb-2" id="selected-seats-count">Selected Seats (0)</p>
                                    <div id="selected-seats-list" class="flex flex-wrap gap-2">
                                        <p class="text-gray-500 text-sm italic">No seats selected</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-6 border-t border-gray-200">
                            <div class="w-full">
                                <div class="flex justify-between mb-4">
                                    <p class="font-medium">Total Amount:</p>
                                    <p class="font-bold text-xl" id="total-amount">$0.00</p>
                                </div>
                                <button id="proceed-button" class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition-colors opacity-50 cursor-not-allowed" disabled>
                                    <a href="/reservation"> Proceed to Booking</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize selected seats array
        let selectedSeats = [];

        // Ticket price per seat
        const ticketPrice = 45.00;

        // Get DOM elements
        const seats = document.querySelectorAll('.bus-seat');
        const selectedSeatsCount = document.getElementById('selected-seats-count');
        const selectedSeatsList = document.getElementById('selected-seats-list');
        const totalAmount = document.getElementById('total-amount');
        const proceedButton = document.getElementById('proceed-button');

        // Add click event listener to each seat
        seats.forEach(seat => {
            seat.addEventListener('click', () => {
                const seatNumber = seat.dataset.seat;

                // Toggle seat selection
                if (selectedSeats.includes(seatNumber)) {
                    // Deselect seat
                    selectedSeats = selectedSeats.filter(s => s !== seatNumber);
                    seat.classList.remove('bus-seat-selected');
                    seat.classList.add('bus-seat-available');
                } else {
                    // Select seat
                    selectedSeats.push(seatNumber);
                    seat.classList.remove('bus-seat-available');
                    seat.classList.add('bus-seat-selected');
                }

                // Update booking summary
                updateBookingSummary();
            });
        });

        // Function to update booking summary
        function updateBookingSummary() {
            // Update selected seats count
            selectedSeatsCount.textContent = `Selected Seats (${selectedSeats.length})`;

            // Update selected seats list
            selectedSeatsList.innerHTML = '';
            if (selectedSeats.length > 0) {
                selectedSeats.forEach(seat => {
                    const seatDiv = document.createElement('div');
                    seatDiv.className = 'bg-gray-100 px-2 py-1 rounded-md text-sm';
                    seatDiv.textContent = seat;
                    selectedSeatsList.appendChild(seatDiv);
                });
            } else {
                selectedSeatsList.innerHTML = '<p class="text-gray-500 text-sm italic">No seats selected</p>';
            }

            // Update total amount
            const total = (selectedSeats.length * ticketPrice).toFixed(2);
            totalAmount.textContent = `$${total}`;

            // Update proceed button state
            if (selectedSeats.length > 0) {
                proceedButton.disabled = false;
                proceedButton.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                proceedButton.disabled = true;
                proceedButton.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Add form submission logic
        document.getElementById('proceed-button').addEventListener('click', function(e) {
            e.preventDefault();

            if (!selectedSeats.length) {
                alert('Please select at least one seat');
                return;
            }

            // If user is not logged in, redirect to login
            @if(!session('is_logged_in'))
                window.location.href = "{{ route('login') }}";
                return;
            @endif

            // Send selected seats to server
            fetch("{{ route('booking.store-seats', $schedule->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    seats: selectedSeats
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to process seat selection');
            });
        });
    </script>
    @include('partials.footer')
</body>
</html>
