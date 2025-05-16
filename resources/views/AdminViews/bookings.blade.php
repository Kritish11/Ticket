<div x-data="bookingsManager()" class="p-6">
    <!-- Header with Search and Filters -->
    <div class="mb-6 space-y-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Bookings</h1>
            <div class="flex gap-4">
                <!-- Date Range Picker -->
                <div class="flex items-center gap-2">
                    <input type="date" x-model="dateFrom" class="border rounded px-3 py-2" @change="filterBookings()">
                    <span>to</span>
                    <input type="date" x-model="dateTo" class="border rounded px-3 py-2" @change="filterBookings()">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-2">
                <input type="text"
                    placeholder="Search by name, ticket ID, or phone..."
                    class="w-full border rounded px-3 py-2"
                    x-model="searchTerm"
                    @input="filterBookings()">
            </div>
            <select class="border rounded px-3 py-2" x-model="statusFilter" @change="filterBookings()">
                <option value="">All Status</option>
                <option value="confirmed">Confirmed</option>
                <option value="pending">Pending</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <select class="border rounded px-3 py-2" x-model="routeFilter" @change="filterBookings()">
                <option value="">All Routes</option>
                <template x-for="route in routes" :key="route">
                    <option x-text="route"></option>
                </template>
            </select>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ticket ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Passenger</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Route</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Seats</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <template x-for="booking in filteredBookings" :key="booking.id">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="booking.ticketId"></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900" x-text="booking.name"></div>
                                <div class="text-sm text-gray-500" x-text="booking.phone"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="booking.route"></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900" x-text="booking.date"></div>
                                <div class="text-sm text-gray-500" x-text="booking.time"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="booking.seats.join(', ')"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="'₹' + booking.amount"></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="{
                                        'bg-green-100 text-green-800': booking.status === 'confirmed',
                                        'bg-yellow-100 text-yellow-800': booking.status === 'pending',
                                        'bg-red-100 text-red-800': booking.status === 'cancelled'
                                    }"
                                    x-text="booking.status">
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-3">
                                    <button @click="openBookingDetails(booking)" class="text-blue-600 hover:text-blue-900">
                                        View
                                    </button>
                                    <button x-show="booking.status !== 'cancelled'"
                                        @click="updateStatus(booking.id, 'cancelled')"
                                        class="text-red-600 hover:text-red-900">
                                        Cancel
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Booking Details Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Booking Details</h3>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <template x-if="selectedBooking">
                <div class="space-y-4">
                    <!-- Passenger Details -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Passenger Information</h4>
                            <p class="font-medium" x-text="selectedBooking.name"></p>
                            <p class="text-sm text-gray-500" x-text="selectedBooking.phone"></p>
                            <p class="text-sm text-gray-500" x-text="selectedBooking.email"></p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Ticket Details</h4>
                            <p class="font-medium" x-text="'Ticket ID: ' + selectedBooking.ticketId"></p>
                            <p class="text-sm text-gray-500" x-text="'Booking Date: ' + selectedBooking.bookingDate"></p>
                        </div>
                    </div>

                    <!-- Journey Details -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Journey Details</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Route</p>
                                    <p class="font-medium" x-text="selectedBooking.route"></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Travel Date</p>
                                    <p class="font-medium" x-text="selectedBooking.date + ' ' + selectedBooking.time"></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Seat Numbers</p>
                                    <p class="font-medium" x-text="selectedBooking.seats.join(', ')"></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Amount Paid</p>
                                    <p class="font-medium" x-text="'₹' + selectedBooking.amount"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Update -->
                    <div class="flex justify-between items-center pt-4 border-t">
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-500">Current Status:</span>
                            <select x-model="selectedBooking.status"
                                class="border rounded px-3 py-1 text-sm"
                                @change="updateStatus(selectedBooking.id, $event.target.value)">
                                <option value="confirmed">Confirmed</option>
                                <option value="pending">Pending</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                            @click="printTicket(selectedBooking)">
                            Print Ticket
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
function bookingsManager() {
    return {
        searchTerm: '',
        statusFilter: '',
        routeFilter: '',
        dateFrom: '',
        dateTo: '',
        showModal: false,
        selectedBooking: null,
        routes: ['Kathmandu → Pokhara', 'Kathmandu → Chitwan', 'Pokhara → Kathmandu'],
        bookings: [
            {
                id: 1,
                ticketId: 'TK001',
                name: 'John Doe',
                phone: '+977 9876543210',
                email: 'john@example.com',
                route: 'Kathmandu → Pokhara',
                date: '2024-02-15',
                time: '10:00 AM',
                seats: ['A1', 'A2'],
                amount: 1200,
                status: 'confirmed',
                bookingDate: '2024-02-10'
            },
            // Add more sample bookings here
        ],
        get filteredBookings() {
            return this.bookings.filter(booking => {
                const matchesSearch = this.searchTerm === '' ||
                    booking.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    booking.ticketId.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    booking.phone.includes(this.searchTerm);

                const matchesStatus = this.statusFilter === '' || booking.status === this.statusFilter;
                const matchesRoute = this.routeFilter === '' || booking.route === this.routeFilter;

                // Date filtering
                let matchesDate = true;
                if (this.dateFrom && this.dateTo) {
                    const bookingDate = new Date(booking.date);
                    const from = new Date(this.dateFrom);
                    const to = new Date(this.dateTo);
                    matchesDate = bookingDate >= from && bookingDate <= to;
                }

                return matchesSearch && matchesStatus && matchesRoute && matchesDate;
            });
        },
        openBookingDetails(booking) {
            this.selectedBooking = booking;
            this.showModal = true;
        },
        updateStatus(bookingId, newStatus) {
            // Here you would typically make an API call
            const booking = this.bookings.find(b => b.id === bookingId);
            if (booking) {
                booking.status = newStatus;
            }
        },
        printTicket(booking) {
            // Implement ticket printing logic
            console.log('Printing ticket:', booking.ticketId);
        },
        filterBookings() {
            // The filtering is handled by the computed property filteredBookings
        }
    }
}
</script>
