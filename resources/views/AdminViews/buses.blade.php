<div x-data="busModal()" x-init="init()" class="p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="text-2xl font-bold">Bus Fleet</div>
        <button @click="openAddModal()" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
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
                    <th class="text-left px-4 py-2">Features</th>
                    <th class="text-left px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($buses as $bus)
                <tr class="border-b hover:bg-gray-50">
                    <td class="font-bold px-4 py-2">{{ $bus->name }}</td>
                    <td class="px-4 py-2">{{ $bus->standard->name }}</td>
                    <td class="px-4 py-2">{{ $bus->seats }}</td>
                    <td class="px-4 py-2">{{ $bus->number_plate }}</td>
                    <td class="px-4 py-2">{{ $bus->driver_name }}</td>
                    <td class="px-4 py-2">
                        @if(is_array($bus->features))
                            @foreach($bus->features as $featureId)
                                @php
                                    $feature = $features->firstWhere('id', $featureId);
                                @endphp
                                @if($feature)
                                    <span class="inline-block px-2 py-1 text-xs bg-gray-100 border border-gray-300 rounded-full mr-1 mb-1">
                                        {{ $feature->name }}
                                    </span>
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <button @click="openEditModal({{ $bus }})" class="border px-2 py-1 rounded hover:bg-gray-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6v-6H3v6z" />
                            </svg>
                        </button>
                        <button @click="deleteBus({{ $bus->id }})" class="border px-2 py-1 rounded text-red-500 hover:bg-red-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                        No buses found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div x-show="showAddModal" 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" 
         style="display: none;">
        <div @click.away="showAddModal = false"
             class="bg-white rounded-lg shadow-lg w-full max-w-lg relative flex flex-col max-h-[90vh]">
            <button @click="showAddModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
            <div class="text-xl font-bold mb-4 px-6 pt-6">Add New Bus</div>
            <form @submit.prevent="submitForm" class="flex-1 flex flex-col overflow-y-auto px-6 pb-2">
                <!-- Existing form fields -->
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Bus Name</label>
                    <input type="text" x-model="formData.name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Standard</label>
                    <select x-model="formData.standard_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Standard</option>
                        <template x-for="standard in standards" :key="standard.id">
                            <option :value="standard.id" x-text="standard.name"></option>
                        </template>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Number Plate</label>
                    <input type="text" x-model="formData.number_plate" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Interior & Exterior Images (6 PNGs minimum)</label>
                    <div>
                        <template x-if="images.length < 6">
                            <label :class="images.length ? 'w-24 h-24 p-2' : 'w-full p-4' + ' flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-black transition mb-2'">
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
                    <input type="text" x-model="formData.driver_name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">No of Seats</label>
                    <input type="number" x-model="formData.seats" class="w-full border rounded px-3 py-2" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver License</label>
                    <input type="file" accept=".pdf,.jpg,.jpeg,.png" @change="handleLicense" class="w-full" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver Bill Book</label>
                    <input type="file" accept=".pdf,.jpg,.jpeg,.png" @change="handleBillBook" class="w-full" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Bus Features</label>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="feature in features" :key="feature.id">
                            <button type="button"
                                @click="toggleFeature(feature)"
                                :class="selectedFeatures.includes(feature.id) ? 'bg-black text-white' : 'bg-gray-100 text-gray-700'"
                                class="px-3 py-1 rounded-full border border-gray-300 hover:bg-black hover:text-white transition text-sm focus:outline-none">
                                <span x-text="feature.name"></span>
                            </button>
                        </template>
                    </div>
                </div>
                <div class="h-4"></div>
            </form>
            <div class="sticky bottom-0 bg-white px-6 py-4 flex justify-end gap-2 border-t">
                <button type="button" @click="showAddModal = false" class="px-4 py-2 rounded border">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 rounded bg-black text-white"
                    @click="submitForm"
                    :disabled="images.length < 6"
                    :class="images.length < 6 ? 'opacity-50 cursor-not-allowed' : ''"
                >Add Bus</button>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="showEditModal" 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" 
         style="display: none;">
        <div @click.away="showEditModal = false"
             class="bg-white rounded-lg shadow-lg w-full max-w-lg relative flex flex-col max-h-[90vh]">
            <button @click="showEditModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
            <div class="text-xl font-bold mb-4 px-6 pt-6">Edit Bus</div>
            <form @submit.prevent="updateForm" class="flex-1 flex flex-col overflow-y-auto px-6 pb-2">
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Bus Name</label>
                    <input type="text" x-model="formDataEdit.name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Standard</label>
                    <select x-model="formDataEdit.standard_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Standard</option>
                        <template x-for="standard in standards" :key="standard.id">
                            <option :value="standard.id" x-text="standard.name"></option>
                        </template>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Number Plate</label>
                    <input type="text" x-model="formDataEdit.number_plate" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver Name</label>
                    <input type="text" x-model="formDataEdit.driver_name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">No of Seats</label>
                    <input type="number" x-model="formDataEdit.seats" class="w-full border rounded px-3 py-2" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver License</label>
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 border rounded overflow-hidden">
                            <img :src="licensePreview" class="w-full h-full object-cover" />
                        </div>
                        <div class="flex-1">
                            <input type="file" accept=".pdf,.jpg,.jpeg,.png" @change="handleLicense" class="w-full">
                            <p class="text-xs text-gray-500 mt-1">Current file: <span x-text="formData.driver_license"></span></p>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver Bill Book</label>
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 border rounded overflow-hidden">
                            <img :src="billBookPreview" class="w-full h-full object-cover" />
                        </div>
                        <div class="flex-1">
                            <input type="file" accept=".pdf,.jpg,.jpeg,.png" @change="handleBillBook" class="w-full">
                            <p class="text-xs text-gray-500 mt-1">Current file: <span x-text="formData.driver_bill_book"></span></p>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Bus Features</label>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="feature in features" :key="feature.id">
                            <button type="button"
                                @click="toggleFeature(feature)"
                                :class="selectedFeatures.includes(feature.id) ? 'bg-black text-white' : 'bg-gray-100 text-gray-700'"
                                class="px-3 py-1 rounded-full border border-gray-300 hover:bg-black hover:text-white transition text-sm focus:outline-none">
                                <span x-text="feature.name"></span>
                            </button>
                        </template>
                    </div>
                </div>
                <div class="h-4"></div>
            </form>
            <div class="sticky bottom-0 bg-white px-6 py-4 flex justify-end gap-2 border-t">
                <button type="button" @click="showEditModal = false" class="px-4 py-2 rounded border">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 rounded bg-black text-white"
                    @click="updateForm"
                >Update Bus</button>
            </div>
        </div>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
function busModal() {
    return {
        showAddModal: false,
        showEditModal: false,
        isEditing: false,
        editId: null,
        standards: [],
        features: [],
        formData: {
            name: '',
            standard_id: '',
            number_plate: '',
            seats: '',
            driver_name: '',
            driver_license: null,
            driver_bill_book: null,
            images: [],
            features: []
        },
        formDataEdit: {
            name: '',
            standard_id: '',
            number_plate: '',
            seats: '',
            driver_name: '',
            driver_license: null,
            driver_bill_book: null,
            images: [],
            features: []
        },
        images: [],
        selectedFeatures: [],
        licensePreview: '',
        billBookPreview: '',
        async init() {
            try {
                const standardsResponse = await fetch('/admin/bus-standards');
                const standardsData = await standardsResponse.json();
                if (standardsData.success) {
                    this.standards = standardsData.standards;
                }

                const featuresResponse = await fetch('/admin/bus-features');
                const featuresData = await featuresResponse.json();
                this.features = featuresData.features;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        },
        handleFiles(event) {
            const files = Array.from(event.target.files)
                .filter(f => f.type === 'image/png')
                .slice(0, 6 - this.images.length);

            if (files.length) {
                this.images = [...this.images, ...files];
                this.formData.images = this.images;
            }
        },
        removeImage(idx) {
            this.images.splice(idx, 1);
        },
        toggleFeature(feature) {
            if (this.selectedFeatures.includes(feature.id)) {
                this.selectedFeatures = this.selectedFeatures.filter(id => id !== feature.id);
            } else {
                this.selectedFeatures.push(feature.id);
            }
            this.formData.features = this.selectedFeatures;
        },
        async submitForm() {
            if (this.images.length < 6) {
                alert('Please select at least 6 PNG images.');
                return;
            }

            const formData = new FormData();
            // Basic fields
            formData.append('name', this.formData.name);
            formData.append('standard_id', this.formData.standard_id);
            formData.append('number_plate', this.formData.number_plate);
            formData.append('seats', this.formData.seats);
            formData.append('driver_name', this.formData.driver_name);
            formData.append('features', JSON.stringify(this.selectedFeatures));

            // Handle files explicitly
            const licenseFile = document.querySelector('input[type="file"][accept=".pdf,.jpg,.jpeg,.png"]').files[0];
            const billBookFile = document.querySelectorAll('input[type="file"][accept=".pdf,.jpg,.jpeg,.png"]')[1].files[0];

            formData.append('driver_license', licenseFile);
            formData.append('driver_bill_book', billBookFile);

            // Handle images
            this.images.forEach((file, index) => {
                if (file instanceof File) {
                    formData.append(`images[${index}]`, file);
                }
            });

            try {
                const response = await fetch('/admin/buses', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    this.showAddModal = false;
                    this.resetForm();
                    alert(result.message);
                    location.reload();
                } else {
                    alert(result.message || 'Failed to save bus');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to save bus');
            }
        },
        async updateForm() {
            const formDataEdit = new FormData();

            // Log the data being sent
            console.log('Edit Data:', {
                name: this.formDataEdit.name,
                standard_id: this.formDataEdit.standard_id,
                number_plate: this.formDataEdit.number_plate,
                seats: this.formDataEdit.seats,
                driver_name: this.formDataEdit.driver_name,
                features: this.selectedFeatures
            });

            formDataEdit.append('_method', 'PUT');
            formDataEdit.append('name', this.formDataEdit.name);
            formDataEdit.append('standard_id', this.formDataEdit.standard_id);
            formDataEdit.append('number_plate', this.formDataEdit.number_plate);
            formDataEdit.append('seats', this.formDataEdit.seats);
            formDataEdit.append('driver_name', this.formDataEdit.driver_name);
            formDataEdit.append('features', JSON.stringify(this.selectedFeatures));

            // Handle file uploads only if new files are selected
            const licenseFile = document.querySelector('input[type="file"][accept=".pdf,.jpg,.jpeg,.png"]').files[0];
            const billBookFile = document.querySelectorAll('input[type="file"][accept=".pdf,.jpg,.jpeg,.png"]')[1].files[0];

            if (licenseFile) {
                formDataEdit.append('driver_license', licenseFile);
            }
            if (billBookFile) {
                formDataEdit.append('driver_bill_book', billBookFile);
            }

            // Handle images only if new ones are selected
            if (this.images.some(img => img instanceof File)) {
                this.images.forEach((file, index) => {
                    if (file instanceof File) {
                        formDataEdit.append(`images[${index}]`, file);
                    }
                });
            }

            const url = `/admin/buses/${this.editId}`;

            try {
                const response = await fetch(url, {
                    method: 'POST', // Changed to POST because we're using _method: PUT
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formDataEdit
                });

                const result = await response.json();
                console.log('Update Response:', result);

                if (result.success) {
                    this.showEditModal = false;
                    this.resetForm();
                    alert(result.message);
                    location.reload();
                } else {
                    alert(result.message || 'Failed to update bus');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to update bus');
            }
        },
        resetForm() {
            this.formDataEdit = {
                name: '',
                standard_id: '',
                number_plate: '',
                seats: '',
                driver_name: '',
                driver_license: null,
                driver_bill_book: null,
                images: [],
                features: []
            };
            this.images = [];
            this.selectedFeatures = [];
            this.isEditing = false;
            this.editId = null;
        },
        async deleteBus(id) {
            if (!confirm('Are you sure you want to delete this bus?')) {
                return;
            }

            try {
                const response = await fetch(`/admin/buses/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert(result.message || 'Failed to delete bus');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to delete bus');
            }
        },
        openEditModal(bus) {
            this.resetForm();
            this.formDataEdit = {
                name: bus.name,
                standard_id: bus.standard_id.toString(),
                number_plate: bus.number_plate,
                seats: bus.seats,
                driver_name: bus.driver_name,
                driver_license: bus.driver_license,
                driver_bill_book: bus.driver_bill_book,
                images: bus.images,
                features: bus.features
            };
            this.selectedFeatures = bus.features;
            this.images = bus.images.map(img => `/storage/${img}`);
            this.licensePreview = `/storage/${bus.driver_license}`;
            this.billBookPreview = `/storage/${bus.driver_bill_book}`;
            this.editId = bus.id;
            this.showEditModal = true;
        },
        openAddModal() {
            this.resetForm();
            this.showAddModal = true;
        }
    }
}
</script>
