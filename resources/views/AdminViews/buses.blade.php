<div x-data="busModal()" class="p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="text-2xl font-bold">Bus Fleet</div>
        <button @click="showModal = true" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
            <span class="text-xl font-bold">+</span> Add New Bus
        </button>
    </div>
    <div class="mb-4">
        <input type="text" placeholder="Search buses..." class="w-full border rounded px-3 py-2" />
    </div>
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left px-4 py-2">Name</th>
                    <th class="text-left px-4 py-2">Standard</th>
                    <th class="text-left px-4 py-2">Seats</th>
                    <th class="text-left px-4 py-2">Number Plate</th>
                    <th class="text-left px-4 py-2">Driver</th>
                    <th class="text-left px-4 py-2">Co-driver</th>
                    <th class="text-left px-4 py-2">Features</th>
                    <th class="text-left px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Example row, replace with @foreach --}}
                <tr class="border-b">
                    <td class="font-bold px-4 py-2">Express Voyager</td>
                    <td class="px-4 py-2">Luxury Sleeper</td>
                    <td class="px-4 py-2">36</td>
                    <td class="px-4 py-2">NY-1234</td>
                    <td class="px-4 py-2">John Doe</td>
                    <td class="px-4 py-2">Jane Smith</td>
                    <td class="px-4 py-2">WiFi, Power Outlets</td>
                    <td class="px-4 py-2 flex gap-2">
                        <button class="border px-2 py-1 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6v-6H3v6z" /></svg></button>
                        <button class="border px-2 py-1 rounded text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </td>
                </tr>
                {{-- ...existing code for more rows... --}}
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" style="display: none;">
        <div @click.away="showModal = false"
             class="bg-white rounded-lg shadow-lg w-full max-w-lg relative flex flex-col max-h-[90vh]">
            <button @click="showModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
            <div class="text-xl font-bold mb-4 px-6 pt-6">Add New Bus</div>
            <form @submit.prevent class="flex-1 flex flex-col overflow-y-auto px-6 pb-2">
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Bus Name</label>
                    <input type="text" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Standard</label>
                    <select class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Standard</option>
                        <option>Luxury Sleeper</option>
                        <option>Semi Sleeper</option>
                        <option>Seater</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Number Plate</label>
                    <input type="text" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Interior & Exterior Images (6 PNGs minimum)</label>
                    <div>
                        <template x-if="images.length < 6">
                            <label :class="{{ images.length ? 'w-24 h-24 p-2' : 'w-full p-4'}} flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-black transition mb-2">
                                <span class="text-gray-600 mb-2">
                                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-4 4h-4a1 1 0 01-1-1v-1h10v1a1 1 0 01-1 1h-4z" />
                                    </svg>
                                </span>
                                <span class="text-xs text-gray-700 font-medium">Choose PNG Images</span>
                                <input type="file" class="hidden" accept="image/png" multiple
                                    @change="handleFiles($event)">
                            </label>
                        </template>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <template x-for="(img, idx) in images" :key="idx">
                                <div class="relative w-14 h-14">
                                    <img :src="img" class="object-cover w-14 h-14 rounded border" />
                                    <button type="button" @click="removeImage(idx)"
                                        class="absolute -top-2 -right-2 bg-white border border-gray-300 rounded-full text-xs px-1 hover:bg-red-500 hover:text-white transition">&times;</button>
                                </div>
                            </template>
                            <!-- For static preview, show placeholder PNGs if images are empty -->
                            <template x-if="!images.length">
                                <template x-for="n in 3" :key="n">
                                    <div class="w-14 h-14 rounded border bg-gray-100 flex items-center justify-center">
                                        <img src="https://via.placeholder.com/40x40.png?text=PNG" class="w-10 h-10" />
                                    </div>
                                </template>
                            </template>
                        </div>
                        <div class="text-xs text-gray-500 mt-1" x-text="images.length + ' selected (max 6, PNG only)'"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver Name</label>
                    <input type="text" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Co-driver Name</label>
                    <input type="text" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">No of Seats</label>
                    <input type="number" class="w-full border rounded px-3 py-2" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Bus Features</label>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="(feature, idx) in featuresList" :key="feature">
                            <button type="button"
                                @click="toggleFeature(feature)"
                                :class="selectedFeatures.includes(feature) ? 'bg-black text-white' : 'bg-gray-100 text-gray-700'"
                                class="px-3 py-1 rounded-full border border-gray-300 hover:bg-black hover:text-white transition text-sm focus:outline-none">
                                <span x-text="feature"></span>
                            </button>
                        </template>
                    </div>
                </div>
                <div class="h-4"></div>
            </form>
            <div class="sticky bottom-0 bg-white px-6 py-4 flex justify-end gap-2 border-t">
                <button type="button" @click="showModal = false" class="px-4 py-2 rounded border">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 rounded bg-black text-white"
                    @click="submitForm"
                    :disabled="images.length < 6"
                    :class="images.length < 6 ? 'opacity-50 cursor-not-allowed' : ''"
                >Add Bus</button>
            </div>
        </div>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
function busModal() {
    return {
        showModal: false,
        images: [],
        featuresList: [
            'WiFi', 'Power Outlets', 'Snacks', 'Entertainment', 'Premium Seats', 'Attendant Service'
        ],
        selectedFeatures: [],
        handleFiles(event) {
            const files = Array.from(event.target.files)
                .filter(f => f.type === 'image/png')
                .slice(0, 6 - this.images.length);
            // For static preview, use placeholder PNGs instead of actual files
            if (files.length) {
                this.images = [];
                for (let i = 0; i < files.length; i++) {
                    // Use a static PNG for preview
                    this.images.push('https://via.placeholder.com/56x56.png?text=PNG');
                }
            }
        },
        removeImage(idx) {
            this.images.splice(idx, 1);
        },
        toggleFeature(feature) {
            if (this.selectedFeatures.includes(feature)) {
                this.selectedFeatures = this.selectedFeatures.filter(f => f !== feature);
            } else {
                this.selectedFeatures.push(feature);
            }
        },
        submitForm() {
            if (this.images.length < 6) {
                alert('Please select at least 6 PNG images.');
                return;
            }
            // ...submit logic here...
            this.showModal = false;
        }
    }
}
</script>
