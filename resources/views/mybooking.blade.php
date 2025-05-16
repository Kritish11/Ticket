<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>TicketSewa - My Bookings</title>
    <style>
        /* Custom styles for tabs and animations */
        .tabs-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.5rem;
            background-color: #f3f4f6;
            padding: 0.25rem;
            border-radius: 0.375rem;
        }
        .tabs-trigger {
            padding: 0.5rem 1rem;
            text-align: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .tabs-trigger.active {
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .tabs-trigger:hover:not(.active) {
            background-color: #e5e7eb;
        }
        .tabs-content {
            display: none;
        }
        .tabs-content.active {
            display: block;
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
@include('partials.header')

<body class="bg-gray-50">
    <div class="min-h-screen py-28">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl md:text-3xl font-bold mb-8">My Bookings</h1>

            <!-- Tabs -->
            <div class="w-full">
                <div class="tabs-list mb-8" id="tabs-list">
                    <div class="tabs-trigger active" data-tab="all">All Bookings (3)</div>
                    <div class="tabs-trigger" data-tab="confirmed">Upcoming (1)</div>
                    <div class="tabs-trigger" data-tab="completed">Completed (1)</div>
                    <div class="tabs-trigger" data-tab="cancelled">Cancelled (1)</div>
                </div>

                <!-- Tabs Content -->
                <div id="tabs-content">
                    <div class="tabs-content active" data-tab="all"></div>
                    <div class="tabs-content" data-tab="confirmed"></div>
                    <div class="tabs-content" data-tab="completed"></div>
                    <div class="tabs-content" data-tab="cancelled"></div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
    <script>
        // Dummy data
        const bookings = [
            {
                id: 'BK12345',
                busName: 'Express Deluxe',
                departureDate: '2025-04-28',
                departureTime: '08:00 AM',
                arrivalTime: '01:30 PM',
                from: 'New York',
                to: 'Chicago',
                pnr: 'PNR67890',
                seats: ['1A', '3C'],
                passengers: [{ name: 'John Doe' }, { name: 'Jane Doe' }],
                totalAmount: 90.00,
                status: 'confirmed'
            },
            {
                id: 'BK54321',
                busName: 'Super Comfort',
                departureDate: '2025-05-01',
                departureTime: '09:00 AM',
                arrivalTime: '03:00 PM',
                from: 'Boston',
                to: 'Washington',
                pnr: 'PNR09876',
                seats: ['2B'],
                passengers: [{ name: 'Alice Smith' }],
                totalAmount: 50.00,
                status: 'cancelled'
            },
            {
                id: 'BK98765',
                busName: 'Luxury Liner',
                departureDate: '2025-04-20',
                departureTime: '07:00 AM',
                arrivalTime: '09:30 AM',
                from: 'Philadelphia',
                to: 'New York',
                pnr: 'PNR54321',
                seats: ['4D'],
                passengers: [{ name: 'Bob Johnson' }],
                totalAmount: 30.00,
                status: 'completed'
            }
        ];

        // Function to render a booking card
        function renderBookingCard(booking) {
            const statusClasses = {
                confirmed: 'bg-green-100 text-green-800',
                cancelled: 'bg-red-100 text-red-800',
                completed: 'bg-blue-100 text-blue-800'
            };
            const statusClass = statusClasses[booking.status] || 'bg-blue-100 text-blue-800';
            const cancelButton = booking.status === 'confirmed' ? `
                <button class="w-full border border-red-200 text-red-600 py-2 px-4 rounded-md hover:text-red-700 hover:bg-red-50 transition-colors text-sm">
                    Cancel
                </button>
            ` : '';

            return `
                <div class="bg-white rounded-lg mb-4 hover:shadow-md transition-shadow animate-fade-in">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between">
                            <div>
                                <h3 class="font-semibold text-lg mb-1">${booking.busName}</h3>
                                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mb-3">
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        ${booking.departureDate}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        ${booking.departureTime} - ${booking.arrivalTime}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        ${booking.from} to ${booking.to}
                                    </div>
                                </div>
                                <div class="space-y-1 mb-4">
                                    <p class="text-sm">
                                        <span class="text-gray-600">Booking ID:</span> ${booking.id}
                                    </p>
                                    <p class="text-sm">
                                        <span class="text-gray-600">PNR:</span> ${booking.pnr}
                                    </p>
                                    <p class="text-sm">
                                        <span class="text-gray-600">Seats:</span> ${booking.seats.join(', ')}
                                    </p>
                                    <p class="text-sm">
                                        <span class="text-gray-600">Passengers:</span> ${booking.passengers.map(p => p.name).join(', ')}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-row md:flex-col items-center justify-between md:items-end">
                                <div class="text-right mb-4">
                                    <p class="font-bold text-xl">$${booking.totalAmount.toFixed(2)}</p>
                                    <p class="${statusClass} text-sm px-2 py-0.5 rounded-full inline-block">
                                        ${booking.status.charAt(0).toUpperCase() + booking.status.slice(1)}
                                    </p>
                                </div>
                                <div class="space-y-2">
                                    <button class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition-colors text-sm">
                                        View Ticket
                                    </button>
                                    ${cancelButton}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Function to update tab counts and content
        function updateTabs() {
            const tabs = {
                all: bookings,
                confirmed: bookings.filter(b => b.status === 'confirmed'),
                completed: bookings.filter(b => b.status === 'completed'),
                cancelled: bookings.filter(b => b.status === 'cancelled')
            };

            // Update tab counts
            document.querySelectorAll('.tabs-trigger').forEach(tab => {
                const tabId = tab.getAttribute('data-tab');
                const count = tabs[tabId].length;
                tab.textContent = `${tabId === 'all' ? 'All Bookings' : tabId.charAt(0).toUpperCase() + tabId.slice(1)} (${count})`;
            });

            // Render content for each tab
            document.querySelectorAll('.tabs-content').forEach(content => {
                const tabId = content.getAttribute('data-tab');
                content.innerHTML = tabs[tabId].length > 0
                    ? tabs[tabId].map(booking => renderBookingCard(booking)).join('')
                    : `
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">
                                ${tabId === 'all' ? "You don't have any bookings yet." :
                                  tabId === 'confirmed' ? "You don't have any upcoming bookings." :
                                  tabId === 'completed' ? "No completed journeys found." :
                                  "No cancelled bookings found."}
                            </p>
                            ${tabId === 'all' || tabId === 'confirmed' ? `
                                <a href="/search" class="bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition-colors">
                                    Book a Bus
                                </a>
                            ` : ''}
                        </div>
                    `;
            });
        }

        // Initialize tabs
        updateTabs();

        // Tab switching logic
        document.querySelectorAll('.tabs-trigger').forEach(trigger => {
            trigger.addEventListener('click', () => {
                // Update active tab
                document.querySelectorAll('.tabs-trigger').forEach(t => t.classList.remove('active'));
                trigger.classList.add('active');

                // Update active content
                document.querySelectorAll('.tabs-content').forEach(c => c.classList.remove('active'));
                document.querySelector(`.tabs-content[data-tab="${trigger.getAttribute('data-tab')}"]`).classList.add('active');
            });
        });
    </script>
</body>
</html>
