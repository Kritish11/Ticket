<div x-data="routesManager()" class="p-6">
    <!-- Success/Error Notification -->
    <div x-show="notification.show"
         x-transition
         :class="notification.type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
         class="fixed top-4 right-4 p-4 rounded-lg shadow-lg flex items-center justify-between max-w-sm"
         @click.away="notification.show = false">
        <p x-text="notification.message"></p>
        <button @click="notification.show = false" class="ml-4 text-sm font-medium hover:text-gray-600">✕</button>
    </div>

    <!-- Stats Card -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Total Routes</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-3xl font-bold" x-text="routes.length"></span>
                    <span class="text-sm text-gray-500">routes registered</span>
                </div>
            </div>
            <div class="flex gap-4 text-sm">
                <div>
                    <div class="text-gray-500">Active</div>
                    <div class="font-semibold" x-text="routes.filter(r => r.status === 'active').length"></div>
                </div>
                <div>
                    <div class="text-gray-500">Inactive</div>
                    <div class="font-semibold" x-text="routes.filter(r => r.status === 'inactive').length"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header with Search and Filter -->
    <div class="flex flex-col gap-4 mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Routes Management</h1>
            <button @click="showModal = true" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
                <span class="text-xl font-bold">+</span> Add Route
            </button>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <input type="text"
                    placeholder="Search routes..."
                    class="w-full border rounded px-3 py-2"
                    x-model="searchTerm"
                    @input="filterRoutes()">
            </div>
            <select class="border rounded px-3 py-2" x-model="filterStatus" @change="filterRoutes()">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

    <!-- Routes List -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">From</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">To</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Distance</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <template x-for="route in filteredRoutes" :key="route.id">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4" x-text="route.from"></td>
                        <td class="px-6 py-4" x-text="route.to"></td>
                        <td class="px-6 py-4" x-text="route.distance + ' km'"></td>
                        <td class="px-6 py-4" x-text="route.duration"></td>
                        <td class="px-6 py-4">
                            <span :class="route.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                class="px-2 py-1 rounded-full text-xs font-medium"
                                x-text="route.status">
                            </span>
                        </td>
                        <td class="px-8 py-4">
                            <div class="flex gap-2">
                                <button @click="editRoute(route)" class="text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                                      </svg>
                                </button>
                                <button @click="deleteRoute(route.id)" class="text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                      </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Add/Edit Route Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold" x-text="editingRoute ? 'Edit Route' : 'Add New Route'"></h3>
                <button @click="showModal = false; resetForm()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <form @submit.prevent="submitForm"
                  method="post"
                  enctype="multipart/form-data"
                  class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">From</label>
                        <input type="text"
                               name="from"
                               x-model="routeForm.from"
                               class="w-full border rounded px-3 py-2 @error('from') border-red-500 @enderror"
                               required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">To</label>
                        <input type="text"
                               name="to"
                               x-model="routeForm.to"
                               class="w-full border rounded px-3 py-2 @error('to') border-red-500 @enderror"
                               required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Distance (km)</label>
                        <input type="number"
                               name="distance"
                               x-model="routeForm.distance"
                               class="w-full border rounded px-3 py-2 @error('distance') border-red-500 @enderror"
                               required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Duration</label>
                        <input type="text"
                               name="duration"
                               x-model="routeForm.duration"
                               placeholder="e.g. 8 hours"
                               class="w-full border rounded px-3 py-2 @error('duration') border-red-500 @enderror"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Route Image (Optional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg" x-show="!routeForm.image">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Upload a file</span>
                                    <input type="file" name="routeImage" class="sr-only" accept="image/*" @change="handleImage">
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('routeImage')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="relative" x-show="routeForm.image">
                        <img :src="routeForm.image" class="w-full h-48 object-cover rounded-lg">
                        <button type="button" @click="routeForm.image = null" class="absolute top-2 right-2 bg-white rounded-full p-1 shadow-md">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status"
                            x-model="routeForm.status"
                            class="w-full border rounded px-3 py-2 @error('status') border-red-500 @enderror">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="showModal = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded">Save Route</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="deleteModal.show"
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="deleteModal.show = false"
             class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <div class="text-lg font-bold mb-4">Confirm Delete</div>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this route? This action cannot be undone.</p>
            <div class="flex justify-end gap-3">
                <button @click="deleteModal.show = false"
                        class="px-4 py-2 border rounded hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="confirmDelete()"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function routesManager() {
    return {
        showModal: false,
        searchTerm: '',
        filterStatus: '',
        editingRoute: null,
        routes: [],
        debug: true, // Enable debug output
        routeForm: {
            from: '',
            to: '',
            distance: '',
            duration: '',
            status: 'active',
            image: null
        },
        notification: {
            show: false,
            type: 'success',
            message: ''
        },
        deleteModal: {
            show: false,
            routeId: null
        },
        async init() {
            try {
                const response = await fetch('/admin/routes');
                const data = await response.json();
                if (data.success) {
                    this.routes = data.routes;
                } else {
                    console.error('Failed to fetch routes:', data.message);
                }
            } catch (error) {
                console.error('Error fetching routes:', error);
            }
        },
        get filteredRoutes() {
            console.log('Filtering routes:', this.routes); // Debug log
            return this.routes.filter(route => {
                const matchesSearch = this.searchTerm === '' ||
                    route.from.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                    route.to.toLowerCase().includes(this.searchTerm.toLowerCase());
                const matchesStatus = this.filterStatus === '' || route.status === this.filterStatus;
                return matchesSearch && matchesStatus;
            });
        },
        handleImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    this.routeForm.image = e.target.result;
                };
                reader.readAsDataURL(file);

                // Store the file itself
                this.routeForm.imageFile = file;
            }
        },
        editRoute(route) {
            this.editingRoute = route;
            this.routeForm = {
                from: route.from,
                to: route.to,
                distance: route.distance,
                duration: route.duration,
                status: route.status === 'active' ? '1' : '0',
                image: route.image ? `/storage/${route.image}` : null
            };
            this.showModal = true;
        },
        submitForm(e) {
            e.preventDefault();
            const formData = new FormData();

            // Append form data
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            formData.append('from', this.routeForm.from);
            formData.append('to', this.routeForm.to);
            formData.append('distance', this.routeForm.distance);
            formData.append('duration', this.routeForm.duration);
            formData.append('status', this.routeForm.status);

            // Handle file input
            const fileInput = e.target.querySelector('input[type="file"]');
            if (fileInput && fileInput.files[0]) {
                formData.append('routeImage', fileInput.files[0]);
            }

            const url = this.editingRoute
                ? `/route/${this.editingRoute.id}`
                : '{{ route('route.save') }}';

            fetch(url, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Error saving route');
                return data;
            })
            .then(data => {
                if(data.success) {
                    const newRoute = {
                        ...data.route,
                        status: data.route.status ? 'active' : 'inactive',
                        image: data.route.routeImage
                    };
                    if (this.editingRoute) {
                        const index = this.routes.findIndex(r => r.id === this.editingRoute.id);
                        if (index !== -1) {
                            this.routes[index] = newRoute;
                        }
                    } else {
                        this.routes.push(newRoute);
                    }
                    this.showModal = false;
                    this.resetForm();
                    this.notification = {
                        show: true,
                        type: 'success',
                        message: `Route ${this.editingRoute ? 'updated' : 'added'} successfully`
                    };
                    setTimeout(() => this.notification.show = false, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.notification = {
                    show: true,
                    type: 'error',
                    message: error.message || 'Error saving route'
                };
            });
        },
        deleteRoute(routeId) {
            this.deleteModal.routeId = routeId;
            this.deleteModal.show = true;
        },
        confirmDelete() {
            const routeId = this.deleteModal.routeId;
            fetch(`/route/${routeId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.routes = this.routes.filter(route => route.id !== routeId);
                    this.deleteModal.show = false;
                    this.notification = {
                        show: true,
                        type: 'success',
                        message: 'Route deleted successfully'
                    };
                    setTimeout(() => this.notification.show = false, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.notification = {
                    show: true,
                    type: 'error',
                    message: 'Error deleting route'
                };
            });
        },
        resetForm() {
            this.routeForm = {
                from: '',
                to: '',
                distance: '',
                duration: '',
                status: '1',
                image: null
            };
            this.editingRoute = null;
        }
    }
}
</script>
