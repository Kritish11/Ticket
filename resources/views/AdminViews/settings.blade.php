<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 max-w-5xl">
        <div x-data="{ activeTab: 'general' }" class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Settings</h1>
                <div class="flex gap-3">
                    <button class="px-4 py-2 border rounded hover:bg-gray-50">Reset</button>
                    <button class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800">Save Changes</button>
                </div>
            </div>

            <!-- Settings Navigation -->
            <div class="bg-gray-100 p-1 rounded-lg mb-6">
                <nav class="grid grid-cols-3 gap-2">
                    <button @click="activeTab = 'general'"
                        :class="{'bg-white shadow': activeTab === 'general'}"
                        class="py-2 rounded-md text-sm font-medium">
                        General
                    </button>
                    <button @click="activeTab = 'company'"
                        :class="{'bg-white shadow': activeTab === 'company'}"
                        class="py-2 rounded-md text-sm font-medium">
                        Company Info
                    </button>
                    <button @click="activeTab = 'notifications'"
                        :class="{'bg-white shadow': activeTab === 'notifications'}"
                        class="py-2 rounded-md text-sm font-medium">
                        Notifications
                    </button>
                </nav>
            </div>

            <!-- General Settings -->
            <div x-show="activeTab === 'general'" class="bg-white rounded-lg shadow">
                <div class="p-6 space-y-6">
                    <div class="grid gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Site Name</label>
                            <input type="text" class="w-full border rounded-lg px-4 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Site Description</label>
                            <textarea class="w-full border rounded-lg px-4 py-2" rows="3"></textarea>
                        </div>

                        <!-- Settings Toggles -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-medium">Maintenance Mode</h3>
                                    <p class="text-sm text-gray-500">Put your site into maintenance mode</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600"></div>
                                </label>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-medium">Auto-approve Bookings</h3>
                                    <p class="text-sm text-gray-500">Automatically approve new bookings</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600"></div>
                                </label>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Cancellation Window (hours)</label>
                                <input type="number" class="w-1/4 border rounded-lg px-4 py-2" min="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Info -->
            <div x-show="activeTab === 'company'" class="bg-white rounded-lg shadow">
                <div class="p-6 space-y-6">
                    <div class="grid gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Company Name</label>
                            <input type="text" class="w-full border rounded-lg px-4 py-2">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" class="w-full border rounded-lg px-4 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Phone</label>
                                <input type="tel" class="w-full border rounded-lg px-4 py-2">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Address</label>
                            <textarea class="w-full border rounded-lg px-4 py-2" rows="3"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Company Logo</label>
                            <div class="flex items-center gap-4">
                                <div class="h-20 w-20 border-2 border-dashed rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400">Upload</span>
                                </div>
                                <button class="px-4 py-2 border rounded hover:bg-gray-50">Choose File</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div x-show="activeTab === 'notifications'" class="bg-white rounded-lg shadow">
                <div class="p-6 space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-medium">Email Notifications</h3>
                                <p class="text-sm text-gray-500">Receive email notifications</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-medium">SMS Notifications</h3>
                                <p class="text-sm text-gray-500">Receive SMS alerts</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600"></div>
                            </label>
                        </div>

                        <div class="border-t pt-4">
                            <h3 class="font-medium mb-4">Notification Events</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm">New Booking</span>
                                    <input type="checkbox" class="rounded text-blue-600">
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm">Booking Cancellation</span>
                                    <input type="checkbox" class="rounded text-blue-600">
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm">Payment Received</span>
                                    <input type="checkbox" class="rounded text-blue-600">
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm">Low Seat Inventory</span>
                                    <input type="checkbox" class="rounded text-blue-600">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
