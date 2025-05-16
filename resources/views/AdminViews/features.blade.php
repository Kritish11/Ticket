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
                                <button class="text-blue-600 hover:text-blue-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6v-6H3v6z" />
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-800">
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
                                <button class="text-blue-600 hover:text-blue-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6v-6H3v6z" />
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-800">
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
                        <input type="text" x-model="newFeature.name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <input type="text" x-model="newFeature.description" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showFeatureModal = false" class="px-4 py-2 border rounded">Cancel</button>
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
    </div>

</div>

<script>
function featuresManager() {
    return {
        showFeatureModal: false,
        showStandardModal: false,
        newFeature: { name: '', description: '' },
        newStandard: { name: '', description: '' },
        features: [
            { id: 1, name: 'WiFi', description: 'High-speed internet connection' },
            { id: 2, name: 'Power Outlets', description: 'AC & USB charging points' },
            { id: 3, name: 'Entertainment', description: 'Individual LED screens' }
        ],
        standards: [
            { id: 1, name: 'Luxury Sleeper', description: 'Full reclining seats with extra legroom' },
            { id: 2, name: 'Semi Sleeper', description: 'Partially reclining seats' },
            { id: 3, name: 'Seater', description: 'Standard comfortable seats' }
        ],
        addFeature() {
            this.features.push({
                id: this.features.length + 1,
                ...this.newFeature
            });
            this.newFeature = { name: '', description: '' };
            this.showFeatureModal = false;
        },
        addStandard() {
            this.standards.push({
                id: this.standards.length + 1,
                ...this.newStandard
            });
            this.newStandard = { name: '', description: '' };
            this.showStandardModal = false;
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
