<div x-data="scheduleManager()" x-init="init()" class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Schedule Management</h1>
        <button @click="showModal = true" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
            <span class="text-xl">+</span> Add Schedule
        </button>
    </div>

    <!-- Filters with visible dropdown arrows -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <input type="text"
            placeholder="Search schedules..."
            class="border rounded px-3 py-2"
            x-model="searchTerm">
        <div class="relative">
            <select class="w-full appearance-none border rounded px-3 py-2 pr-8" x-model="routeFilter">
                <option value="">All Routes</option>
                <template x-for="route in routes" :key="route.id">
                    <option :value="route.id" x-text="`${route.from} → ${route.to}`"></option>
                </template>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
        <div class="relative">
            <select class="w-full appearance-none border rounded px-3 py-2 pr-8" x-model="busFilter">
                <option value="">All Buses</option>
                <template x-for="bus in buses" :key="bus.id">
                    <option :value="bus.id" x-text="bus.name"></option>
                </template>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
        <div class="relative">
            <select class="w-full appearance-none border rounded px-3 py-2 pr-8" x-model="statusFilter">
                <option value="">All Status</option>
                <option value="upcoming">Upcoming</option>
                <option value="delayed">Delayed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Status Quick Actions -->
    <div class="mb-6 flex gap-4">
        <div class="flex-1 bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-medium">Upcoming Departures</h3>
                <span class="text-sm text-gray-500" x-text="upcomingCount + ' buses'"></span>
            </div>
            <div class="flex items-center gap-2">
                <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-green-500" :style="{ width: (upcomingCount/totalBuses * 100) + '%' }"></div>
                </div>
                <span class="text-sm text-gray-600" x-text="Math.round(upcomingCount/totalBuses * 100) + '%'"></span>
            </div>
        </div>
        <div class="flex-1 bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-medium">Delayed</h3>
                <span class="text-sm text-gray-500" x-text="delayedCount + ' buses'"></span>
            </div>
            <div class="flex items-center gap-2">
                <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-500" :style="{ width: (delayedCount/totalBuses * 100) + '%' }"></div>
                </div>
                <span class="text-sm text-gray-600" x-text="Math.round(delayedCount/totalBuses * 100) + '%'"></span>
            </div>
        </div>
        <div class="flex-1 bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-medium">Cancelled</h3>
                <span class="text-sm text-gray-500" x-text="cancelledCount + ' buses'"></span>
            </div>
            <div class="flex items-center gap-2">
                <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-red-500" :style="{ width: (cancelledCount/totalBuses * 100) + '%' }"></div>
                </div>
                <span class="text-sm text-gray-600" x-text="Math.round(cancelledCount/totalBuses * 100) + '%'"></span>
            </div>
        </div>
    </div>

    <!-- Schedule Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Route</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bus</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Departure</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Delay</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <template x-for="schedule in filteredSchedules" :key="schedule.id">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium" x-text="schedule.route"></div>
                            <div class="text-sm text-gray-500" x-text="schedule.boardingPoint"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div x-text="schedule.busName"></div>
                            <div class="text-sm text-gray-500" x-text="schedule.busType"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div x-text="schedule.departureTime"></div>
                            <div class="text-sm text-gray-500" x-text="schedule.departureDate"></div>
                        </td>
                        <td class="px-6 py-4" x-text="schedule.duration"></td>
                        <td class="px-6 py-4" x-text="'₹' + schedule.price"></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-1 text-xs rounded-full whitespace-nowrap"
                                    :class="{
                                        'bg-green-100 text-green-800': schedule.status === 'upcoming',
                                        'bg-yellow-100 text-yellow-800': schedule.status === 'delayed',
                                        'bg-red-100 text-red-800': schedule.status === 'cancelled'
                                    }">
                                    <span x-text="schedule.status"></span>
                                    <template x-if="schedule.status === 'delayed'">
                                        <span x-text="' (' + schedule.delay + ' min)'"></span>
                                    </template>
                                </span>
                                <template x-if="schedule.reason">
                                    <span class="text-xs text-gray-500" x-text="schedule.reason"></span>
                                </template>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span x-show="schedule.status === 'delayed'"
                                class="text-sm text-yellow-600"
                                x-text="schedule.delay + ' minutes'"></span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <button @click="updateStatus(schedule)"
                                    class="text-sm px-4 py-1.5 border rounded hover:bg-gray-50 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Update</span>
                                </button>
                                <button @click="editSchedule(schedule)"
                                    class="text-sm px-4 py-1.5 border rounded hover:bg-gray-50 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                                      </svg>
                                    <span>Edit</span>
                                </button>
                                <button @click="confirmDelete(schedule)"
                                    class="text-sm px-4 py-1.5 border rounded hover:bg-red-50 text-red-600 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Add/Edit Schedule Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold" x-text="editingSchedule ? 'Edit Schedule' : 'Add New Schedule'"></h3>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <form @submit.prevent="editingSchedule ? updateForm() : saveSchedule()" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Route Selection -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Route</label>
                        <select x-model="scheduleForm.routeId" class="w-full border rounded px-3 py-2" required>
                            <option value="">Select Route</option>
                            <template x-for="route in routes" :key="route.id">
                                <option :value="route.id" x-text="`${route.from} → ${route.to}`"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Bus Selection -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Bus</label>
                        <select x-model="scheduleForm.busId" class="w-full border rounded px-3 py-2" required>
                            <option value="">Select Bus</option>
                            <template x-for="bus in buses" :key="bus.id">
                                <option :value="bus.id" x-text="bus.name"></option>
                            </template>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Departure Date -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Departure Date</label>
                        <input type="date" x-model="scheduleForm.departureDate" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <!-- Departure Time -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Departure Time</label>
                        <input type="time" x-model="scheduleForm.departureTime" class="w-full border rounded px-3 py-2" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Duration (hours)</label>
                        <input type="number" x-model="scheduleForm.duration" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Price (₹)</label>
                        <input type="number" x-model="scheduleForm.price" class="w-full border rounded px-3 py-2" required>
                    </div>
                </div>

                <!-- Food Break Details -->
                <div class="space-y-4 border-t pt-4">
                    <div class="flex justify-between items-center">
                        <label class="block text-sm font-medium">Food Break</label>
                    </div>

                    <div class="grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <label class="block text-sm font-medium mb-1">Location</label>
                            <input type="text"
                                x-model="scheduleForm.foodBreak.location"
                                class="w-full border rounded px-3 py-2"
                                placeholder="Break location"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Time</label>
                            <input type="time"
                                x-model="scheduleForm.foodBreak.time"
                                class="w-full border rounded px-3 py-2"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Duration (minutes)</label>
                            <input type="number"
                                x-model="scheduleForm.foodBreak.duration"
                                class="w-full border rounded px-3 py-2"
                                min="1"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Boarding Points -->
                <div>
                    <label class="block text-sm font-medium mb-1">Boarding Point</label>
                    <input type="text" x-model="scheduleForm.boardingPoint" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="showModal = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded" x-text="editingSchedule ? 'Update Schedule' : 'Add Schedule'"></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Status Update Modal -->
    <div x-show="showStatusModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showStatusModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Update Bus Status</h3>
                <button @click="showStatusModal = false" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <form @submit.prevent="saveStatus" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Current Status</label>
                    <select x-model="statusForm.status" class="w-full border rounded px-3 py-2">
                        <option value="upcoming">On Time</option>
                        <option value="delayed">Delayed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div x-show="statusForm.status === 'delayed'">
                    <label class="block text-sm font-medium mb-2">Delay Duration (minutes)</label>
                    <input type="number" x-model="statusForm.delay" class="w-full border rounded px-3 py-2" min="1">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Reason <span class="text-gray-500">(optional)</span>
                    </label>
                    <textarea
                        x-model="statusForm.reason"
                        rows="3"
                        class="w-full border rounded px-3 py-2"
                        placeholder="Enter reason (optional)"></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="showStatusModal = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded">Update Status</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showDeleteModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <div class="text-lg font-bold mb-4">Confirm Delete</div>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this schedule? This action cannot be undone.</p>
            <div class="flex justify-end gap-3">
                <button @click="showDeleteModal = false"
                    class="px-4 py-2 border rounded hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="deleteSchedule"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function scheduleManager() {
    return {
        showModal: false,
        showStatusModal: false,
        showDeleteModal: false,
        searchTerm: '',
        routeFilter: '',
        busFilter: '',
        statusFilter: '',
        editingSchedule: null,
        selectedSchedule: null,
        scheduleToDelete: null,
        scheduleForm: {
            routeId: '',
            busId: '',
            departureDate: '',
            departureTime: '',
            duration: '',
            price: '',
            boardingPoint: '',
            foodBreak: {
                location: '',
                time: '',
                duration: 30
            }
        },
        statusForm: {
            status: 'upcoming',
            delay: 0,
            reason: ''
        },
        routes: [],
        buses: [],
        schedules: [],
        async init() {
            try {
                // Load all data first
                await this.loadAllData();

                // Setup auto-refresh every 30 seconds
                setInterval(() => this.loadAllData(), 30000);
            } catch (error) {
                console.error('Error in init:', error);
            }
        },
        async loadAllData() {
            try {
                // Fetch routes
                const routesResponse = await fetch('/admin/routes');
                const routesData = await routesResponse.json();
                if (routesData.success) {
                    this.routes = routesData.routes.map(route => ({
                        id: route.id,
                        from: route.from,
                        to: route.to
                    }));
                }

                // Fetch buses
                const busesResponse = await fetch('/admin/buses');
                const busesData = await busesResponse.json();
                if (busesData.success) {
                    this.buses = busesData.buses.map(bus => ({
                        id: bus.id,
                        name: bus.name,
                        type: bus.standard.name
                    }));
                    console.log("this is test ", this.buses);
                }

                // Fetch existing schedules
                const schedulesResponse = await fetch('/admin/schedules');
                const schedulesData = await schedulesResponse.json();
                if (schedulesData.success) {
                    this.schedules = schedulesData.schedules;
                }
            } catch (error) {
                console.error('Error loading data:', error);
            }
        },
        get filteredSchedules() {
            return this.schedules.filter(schedule => {
                const matchesSearch = !this.searchTerm ||
                    schedule.route.toLowerCase().includes(this.searchTerm.toLowerCase());
                const matchesRoute = !this.routeFilter || schedule.routeId === this.routeFilter;
                const matchesBus = !this.busFilter || schedule.busId === this.busFilter;
                const matchesStatus = !this.statusFilter || schedule.status === this.statusFilter;
                return matchesSearch && matchesRoute && matchesBus && matchesStatus;
            });
        },
        get availableBuses() {
            return this.buses;
        },
        get upcomingCount() {
            return this.schedules.filter(s => s.status === 'upcoming').length;
        },
        get delayedCount() {
            return this.schedules.filter(s => s.status === 'delayed').length;
        },
        get cancelledCount() {
            return this.schedules.filter(s => s.status === 'cancelled').length;
        },
        get totalBuses() {
            return this.schedules.length;
        },
        editSchedule(schedule) {
            this.editingSchedule = schedule;
            this.scheduleForm = {
                routeId: schedule.route_id,
                busId: schedule.bus_id,
                departureDate: schedule.departureDate,
                departureTime: schedule.departureTime,
                duration: parseInt(schedule.duration),
                price: schedule.price,
                boardingPoint: schedule.boardingPoint,
                foodBreak: schedule.foodBreak || {
                    location: '',
                    time: '',
                    duration: 30
                }
            };
            console.log('Edit form data:', this.scheduleForm); // Debug log
            this.showModal = true;
        },
        async updateForm() {
            const formData = {
                route_id: this.scheduleForm.routeId,
                bus_id: this.scheduleForm.busId,
                departure_date: this.scheduleForm.departureDate,
                departure_time: this.scheduleForm.departureTime,
                duration: this.scheduleForm.duration,
                price: this.scheduleForm.price,
                boarding_point: this.scheduleForm.boardingPoint,
                food_break: this.scheduleForm.foodBreak
            };

            try {
                const response = await fetch(`/admin/schedules/${this.editingSchedule.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();
                if (data.success) {
                    await this.loadAllData(); // Refresh the data
                    this.showModal = false;
                    this.resetForm();
                    alert('Schedule updated successfully');
                } else {
                    alert(data.message || 'Failed to update schedule');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to update schedule');
            }
        },
        saveSchedule() {
            const formData = {
                route_id: this.scheduleForm.routeId,
                bus_id: this.scheduleForm.busId,
                departure_date: this.scheduleForm.departureDate,
                departure_time: this.scheduleForm.departureTime,
                duration: this.scheduleForm.duration,
                price: this.scheduleForm.price,
                boarding_point: this.scheduleForm.boardingPoint,
                food_break: this.scheduleForm.foodBreak
            };

            fetch('/admin/schedules', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.showModal = false;
                    this.resetForm();
                    this.loadAllData(); // Refresh the schedules
                    alert('Schedule created successfully');
                } else {
                    alert(data.message || 'Failed to create schedule');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to create schedule');
            });
        },
        resetForm() {
            this.scheduleForm = {
                routeId: '',
                busId: '',
                departureDate: '',
                departureTime: '',
                duration: '',
                price: '',
                boardingPoint: '',
                foodBreak: {
                    location: '',
                    time: '',
                    duration: 30
                }
            };
            this.editingSchedule = null;
        },
        updateStatus(schedule) {
            this.selectedSchedule = schedule;
            this.statusForm = {
                status: schedule.status || 'upcoming',
                delay: schedule.delay || 0,
                reason: schedule.reason || ''
            };
            console.log('Current status form:', this.statusForm); // Debug log
            this.showStatusModal = true;
        },
        saveStatus() {
            if (this.selectedSchedule) {
                const statusData = {
                    status: this.statusForm.status,
                    delay_minutes: this.statusForm.status === 'delayed' ? this.statusForm.delay : 0,
                    status_reason: this.statusForm.reason || null // Allow null for empty reason
                };

                fetch(`/admin/schedules/${this.selectedSchedule.id}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(statusData)
                })
                .then(response => response.json())
                .then(async data => {
                    if (data.success) {
                        await this.loadAllData();
                        this.showStatusModal = false;
                        this.selectedSchedule = null;
                        alert('Status updated successfully');
                    } else {
                        alert(data.message || 'Failed to update status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update status');
                });
            }
        },
        confirmDelete(schedule) {
            this.scheduleToDelete = schedule;
            this.showDeleteModal = true;
        },
        deleteSchedule() {
            if (this.scheduleToDelete) {
                fetch(`/admin/schedules/${this.scheduleToDelete.id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove from local array
                        this.schedules = this.schedules.filter(s => s.id !== this.scheduleToDelete.id);
                        this.showDeleteModal = false;
                        this.scheduleToDelete = null;
                        alert('Schedule deleted successfully');
                    } else {
                        alert(data.message || 'Failed to delete schedule');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete schedule');
                });
            }
        },
        toggleStatus(scheduleId) {
            // Implementation for toggling schedule status
        }
    }
}
</script>
