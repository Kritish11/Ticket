<div class="text-2xl font-bold mb-4">Features </div>
<div class="bg-white p-6 rounded shadow">

    <div x-data="featuresManager()" class="p-6">
        <div class="grid grid-cols-2 gap-6">
            <!-- Bus Features Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Bus Features</h2>
                    <button @click="showFeatureModal = true" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
                        <span class="text-xl">+</span> Add Feature
                    </button>
                </div>

                <!-- Features List with fixed height and scrolling -->
                <div class="space-y-4 h-[400px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                    <template x-for="feature in features" :key="feature.id">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <span class="text-lg" x-text="feature.name"></span>
                                <span class="text-sm text-gray-500" x-text="feature.description"></span>
                            </div>
                            <div class="flex gap-2">
                                <button @click="deleteItem(feature.id, 'feature')" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Bus Standards Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Bus Standards</h2>
                    <button @click="showStandardModal = true" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
                        <span class="text-xl">+</span> Add Standard
                    </button>
                </div>

                <!-- Standards List with fixed height and scrolling -->
                <div class="space-y-4 h-[400px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                    <template x-for="standard in standards" :key="standard.id">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex flex-col">
                                <span class="font-medium" x-text="standard.name"></span>
                                <span class="text-sm text-gray-500" x-text="standard.description"></span>
                            </div>
                            <div class="flex gap-2">
                                <button @click="deleteItem(standard.id, 'standard')" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Feature Modal -->
        <div x-show="showFeatureModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div @click.away="showFeatureModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-bold mb-4">Add New Feature</h3>
                <form @submit.prevent="addFeature">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Feature Name</label>
                        <input type="text"
                               x-model="newFeature.name"
                               class="w-full border rounded px-3 py-2"
                               required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea
                               x-model="newFeature.description"
                               class="w-full border rounded px-3 py-2"
                               required></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeFeatureModal" class="px-4 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-black text-white rounded">Add Feature</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Standard Modal -->
        <div x-show="showStandardModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div @click.away="showStandardModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-bold mb-4">Add New Standard</h3>
                <form @submit.prevent="addStandard">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Standard Name</label>
                        <input type="text" x-model="newStandard.name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea x-model="newStandard.description" class="w-full border rounded px-3 py-2" rows="3" required></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showStandardModal = false" class="px-4 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-black text-white rounded">Add Standard</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div @click.away="showDeleteModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-bold mb-4">Confirm Delete</h3>
                <p class="mb-6 text-gray-600">Are you sure you want to delete this feature? This action cannot be undone.</p>
                <div class="flex justify-end gap-2">
                    <button @click="showDeleteModal = false" class="px-4 py-2 border rounded hover:bg-gray-100">Cancel</button>
                    <button @click="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>

        <!-- Add Notification Component -->
        <div x-show="notification.show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             class="fixed bottom-4 right-4 px-4 py-2 rounded-lg shadow-lg"
             :class="notification.type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'"
             style="z-index: 9999;">
            <p x-text="notification.message"></p>
        </div>

    </div>
</div>

<script>
function featuresManager() {
    return {
        showFeatureModal: false,
        showStandardModal: false,
        showDeleteModal: false,
        itemToDelete: null,
        itemTypeToDelete: null,
        newFeature: { name: '', description: '' },
        newStandard: { name: '', description: '' },
        features: [],
        standards: [],
        featureError: null,
        notification: {
            show: false,
            message: '',
            type: 'success',
            timeout: null
        },

        init() {
            this.loadFeatures();
            this.loadStandards();
        },

        loadFeatures() {
            fetch('/admin/features')
                .then(response => response.json())
                .then(data => {
                    this.features = data.features || [];
                })
                .catch(error => {
                    console.error('Error loading features:', error);
                    this.showNotification('Error loading features', 'error');
                });
        },

        loadStandards() {
            fetch('/admin/standards')
                .then(response => response.json())
                .then(data => {
                    this.standards = data.standards || [];
                })
                .catch(error => {
                    console.error('Error loading standards:', error);
                    this.showNotification('Error loading standards', 'error');
                });
        },

        addFeature() {
            const data = {
                name: this.newFeature.name,
                description: this.newFeature.description
            };

            fetch('/feature_add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    this.features.push(result.data);
                    this.newFeature = { name: '', description: '' };
                    this.showFeatureModal = false;
                    this.featureError = null;
                } else {
                    this.featureError = result.message;
                }
            })
            .catch(error => {
                this.featureError = 'Error adding feature. Please try again.';
                console.error('Error:', error);
            });
        },

        addStandard() {
            const data = {
                name: this.newStandard.name,
                description: this.newStandard.description
            };

            fetch('/standard_add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    this.standards.push(result.data);
                    this.newStandard = { name: '', description: '' };
                    this.showStandardModal = false;
                    this.showNotification('Standard added successfully', 'success');
                } else {
                    this.showNotification(result.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showNotification('Error adding standard', 'error');
            });
        },

        deleteItem(id, type) {
            this.itemToDelete = id;
            this.itemTypeToDelete = type;
            this.showDeleteModal = true;
        },

        confirmDelete() {
            const id = this.itemToDelete;
            const type = this.itemTypeToDelete;
            const endpoint = type === 'feature' ? `/feature/${id}` : `/standard/${id}`;

            fetch(endpoint, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (type === 'feature') {
                        this.features = this.features.filter(f => f.id !== id);
                    } else {
                        this.standards = this.standards.filter(s => s.id !== id);
                    }
                    this.showNotification(`${type} deleted successfully`, 'success');
                } else {
                    this.showNotification(`Failed to delete ${type}`, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showNotification(`Error deleting ${type}`, 'error');
            })
            .finally(() => {
                this.showDeleteModal = false;
                this.itemToDelete = null;
                this.itemTypeToDelete = null;
            });
        },

        closeFeatureModal() {
            this.showFeatureModal = false;
            this.newFeature = { name: '', description: '' };
            this.featureError = null;
        },

        closeStandardModal() {
            this.showStandardModal = false;
            this.newStandard = { name: '', description: '' };
        },

        showNotification(message, type = 'success') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;

            if (this.notification.timeout) {
                clearTimeout(this.notification.timeout);
            }

            this.notification.timeout = setTimeout(() => {
                this.notification.show = false;
            }, 3000);
        }
    }
}
</script>

<style>
    /* Custom Scrollbar Styles */
    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
    }
    .scrollbar-thin::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
