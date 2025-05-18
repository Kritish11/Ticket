<div x-data="dashboard()" class="p-6">
    <!-- Time Period Filter -->

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex justify-between items-center" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <p>{{ session('success') }}</p>
            <button type="button" @click="show = false" class="text-green-700 hover:text-green-900">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- Error Notification --}}
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg flex justify-between items-center" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <p>{{ session('error') }}</p>
            <button type="button" @click="show = false" class="text-red-700 hover:text-red-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <select x-model="selectedPeriod" @change="filterByPeriod()"
            class="border rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black">
            <option value="today">Today</option>
            <option value="yesterday">Yesterday</option>
            <option value="last7">Last 7 Days</option>
            <option value="last30">Last 30 Days</option>
            <option value="last90">Last 90 Days</option>
            <option value="thisYear">This Year</option>
            <option value="lifetime">Lifetime</option>
        </select>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm font-medium text-gray-500">Total Bookings</div>
                <div class="bg-blue-100 p-2 rounded">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold">2,451</div>
            <div class="text-sm text-green-600 mt-2">+12.5% from last month</div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm font-medium text-gray-500">Active Buses</div>
                <div class="bg-green-100 p-2 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                      </svg>

                </div>
            </div>
            <div class="text-3xl font-bold">48</div>
            <div class="text-sm text-green-600 mt-2">All buses operational</div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm font-medium text-gray-500">Total Revenue</div>
                <div class="bg-yellow-100 p-2 rounded">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold">₹1.2M</div>
            <div class="text-sm text-green-600 mt-2">+8.2% from last month</div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm font-medium text-gray-500">Total Users</div>
                <div class="bg-purple-100 p-2 rounded">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold">15,234</div>
            <div class="text-sm text-green-600 mt-2">+22.3% from last month</div>
        </div>
    </div>

    <!-- Trips Section -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Trip Status Tabs -->
        <div class="col-span-2 bg-white rounded-lg shadow">
            <div class="border-b px-6 py-4">
                <div class="flex gap-4">
                    <template x-for="tab in ['Upcoming', 'Delayed', 'Cancelled']" :key="tab">
                        <button @click="activeTab = tab"
                            :class="{'border-b-2 border-black': activeTab === tab}"
                            class="px-4 py-2 font-medium hover:text-black text-gray-600"
                            x-text="tab"></button>
                    </template>
                </div>
            </div>

            <div class="p-6">
                <div x-show="activeTab === 'Upcoming'" class="space-y-4">
                    <template x-for="trip in upcomingTrips" :key="trip.id">
                        <div class="flex items-center justify-between p-4 border rounded-lg">
                            <div>
                                <div class="font-medium" x-text="trip.route"></div>
                                <div class="text-sm text-gray-500" x-text="trip.datetime"></div>
                            </div>
                            <div class="text-sm bg-green-100 text-green-800 px-3 py-1 rounded-full">On Time</div>
                        </div>
                    </template>
                </div>

                <div x-show="activeTab === 'Delayed'" class="space-y-4">
                    <!-- Similar structure for delayed trips -->
                </div>

                <div x-show="activeTab === 'Cancelled'" class="space-y-4">
                    <!-- Similar structure for cancelled trips -->
                </div>
            </div>
        </div>

        <!-- Recent Bookings -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b px-6 py-4">
                <h2 class="font-bold">Recent Bookings</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <template x-for="booking in recentBookings" :key="booking.id">
                        <div class="flex items-center justify-between p-4 border rounded-lg">
                            <div>
                                <div class="font-medium" x-text="booking.name"></div>
                                <div class="text-xs text-gray-500" x-text="'Ticket: ' + booking.ticketId"></div>
                            </div>
                            <div x-text="booking.status"
                                :class="{
                                    'bg-green-100 text-green-800': booking.status === 'Confirmed',
                                    'bg-yellow-100 text-yellow-800': booking.status === 'Pending',
                                    'bg-red-100 text-red-800': booking.status === 'Cancelled'
                                }"
                                class="text-xs px-2 py-1 rounded-full"></div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Routes and Recent Blog Posts Section -->
    <div class="mt-8 grid grid-cols-2 gap-6">
        <!-- Popular Routes -->
        <div>
            <h2 class="text-xl font-bold mb-4">Popular Routes</h2>
            <div class="bg-white rounded-lg shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Route</th>
                                <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Total Bookings</th>
                                <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Revenue</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <template x-for="route in popularRoutes" :key="route.id">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="font-medium" x-text="route.name"></div>
                                        <div class="text-sm text-gray-500" x-text="route.distance"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium" x-text="route.bookings"></div>
                                        <div class="text-sm text-gray-500">This month</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium" x-text="'₹' + route.revenue"></div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Blog Posts -->
        <div>
            <h2 class="text-xl font-bold mb-4">Recent Blog Posts</h2>
            <div class="bg-white rounded-lg shadow">
                <div class="divide-y divide-gray-200">
                    <template x-for="post in recentBlogPosts" :key="post.id">
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex gap-4">
                                <img :src="post.image" class="w-20 h-20 object-cover rounded">
                                <div class="flex-1">
                                    <h3 class="font-medium" x-text="post.title"></h3>
                                    <p class="text-sm text-gray-500 line-clamp-2" x-text="post.excerpt"></p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <img :src="post.authorImage" class="w-6 h-6 rounded-full">
                                        <span class="text-sm text-gray-600" x-text="post.author"></span>
                                        <span class="text-sm text-gray-400" x-text="post.date"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function dashboard() {
    return {
        selectedPeriod: 'last30',
        activeTab: 'Upcoming',
        upcomingTrips: [
            { id: 1, route: 'Kathmandu → Pokhara', datetime: 'Today, 10:00 AM', status: 'On Time' },
            { id: 2, route: 'Kathmandu → Chitwan', datetime: 'Today, 11:30 AM', status: 'On Time' },
            { id: 3, route: 'Pokhara → Kathmandu', datetime: 'Today, 2:00 PM', status: 'On Time' }
        ],
        recentBookings: [
            { id: 1, name: 'John Doe', ticketId: 'TK-001', status: 'Confirmed' },
            { id: 2, name: 'Jane Smith', ticketId: 'TK-002', status: 'Pending' },
            { id: 3, name: 'Mike Johnson', ticketId: 'TK-003', status: 'Cancelled' }
        ],
        popularRoutes: [
            {
                id: 1,
                name: 'Kathmandu → Pokhara',
                distance: '200 km | 6-7 hours',
                bookings: '1,234',
                revenue: '1.5M',
                occupancy: 85,
                growth: 12.5
            },
            {
                id: 2,
                name: 'Kathmandu → Chitwan',
                distance: '150 km | 4-5 hours',
                bookings: '986',
                revenue: '890K',
                occupancy: 72,
                growth: 8.3
            },
            {
                id: 3,
                name: 'Pokhara → Lumbini',
                distance: '180 km | 5-6 hours',
                bookings: '756',
                revenue: '720K',
                occupancy: 65,
                growth: -3.2
            },
            {
                id: 4,
                name: 'Kathmandu → Butwal',
                distance: '280 km | 7-8 hours',
                bookings: '654',
                revenue: '580K',
                occupancy: 58,
                growth: 5.7
            }
        ],
        recentBlogPosts: [
            {
                id: 1,
                title: 'Top 10 Tourist Destinations by Bus',
                excerpt: 'Discover the most scenic routes and destinations accessible by bus travel...',
                image: 'https://imgs.search.brave.com/wPh9NwQp_TE_1LgGUL_xf7oJQS820tnFkZG4bEQhQ1E/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTMx/MDU4MDY4Ny9waG90/by9idXMtdHJhdmVs/LmpwZz9zPTYxMng2/MTImdz0wJms9MjAm/Yz13VktYZ2RxWTVv/V2JzUzRsT3M5RVVB/QWlLRFc5elpWV3g5/c3ZpNFhvcjFrPQ',
                author: 'Jane Smith',
                authorImage: 'https://i.pravatar.cc/150?img=2',
                date: '2 hours ago'
            },
            {
                id: 2,
                title: 'Essential Tips for Night Bus Travel',
                excerpt: 'Make your overnight journey comfortable and enjoyable with these tips...',
                image: 'https://imgs.search.brave.com/sKY_2qnHpC8JBv_pn3G8HM8-mX_h5RoQsQANZ6UtLX8/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvMTQ0/MTAxNTE5L3Bob3Rv/L21vZGVybi1sdXh1/cnktdG91cmlzdC1i/dXMtaW50ZXJpb3Iu/anBnP3M9NjEyeDYx/MiZ3PTAmaz0yMCZj/PXFRVVNnWnR1SEJj/WkYxeGNqb2lEVTNZ/TV9DT3pua2ZlNGlk/YTBMWEkydUU9',
                author: 'Mike Johnson',
                authorImage: 'https://i.pravatar.cc/150?img=3',
                date: '1 day ago'
            },
            {
                id: 3,
                title: 'Bus Travel Safety Guidelines',
                excerpt: 'Stay safe during your bus journey with these important guidelines...',
                image: 'https://imgs.search.brave.com/4V0q87FE1K3EaD4RcsH0wBv7WRyCmT6_xQizTvutkeo/rs:fit:860:0:0/g:ce/aHR0cHM6Ly93d3cu/cmV1dGVycy5jb20v/cmVzaXplci92Mi81/QU5KVzZNMlFSTjdQ/T0ZaQUVOVlFGNUNK/VS5qcGc',
                author: 'Sarah Wilson',
                authorImage: 'https://i.pravatar.cc/150?img=4',
                date: '2 days ago'
            }
        ],

        filterByPeriod() {
            // Example filtering logic
            const stats = {
                today: { bookings: 156, revenue: '₹82K', users: 234 },
                yesterday: { bookings: 142, revenue: '₹78K', users: 198 },
                last7: { bookings: 876, revenue: '₹456K', users: 1234 },
                last30: { bookings: 2451, revenue: '₹1.2M', users: 15234 },
                last90: { bookings: 6420, revenue: '₹3.4M', users: 45670 },
                thisYear: { bookings: 24891, revenue: '₹12.4M', users: 156780 },
                lifetime: { bookings: 45670, revenue: '₹23.8M', users: 289450 }
            };

            // Update stats based on selected period
            const periodStats = stats[this.selectedPeriod];
            // Here you would typically make an API call to get the actual data
            // This is just for demonstration

            // Update UI with new stats
            // You would implement this based on your actual data structure
        },
    }
}
</script>
