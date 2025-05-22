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
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
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
                <!-- Basic Info -->
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

                <!-- Images Section -->
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Interior & Exterior Images</label>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <template x-for="(img, idx) in imagePreview" :key="idx">
                            <div class="relative">
                                <img :src="img" class="w-full h-32 object-cover rounded border">
                                <button type="button" @click="removeImage(idx)"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                                    ×
                                </button>
                            </div>
                        </template>
                    </div>
                    <template x-if="imagePreview.length < 6">
                        <div>
                            <input type="file"
                                   @change="handleFiles($event)"
                                   accept="image/png"
                                   multiple
                                   class="w-full border rounded p-2">
                            <p class="text-sm text-gray-500 mt-1" x-text="`${imagePreview.length}/6 images selected`"></p>
                        </div>
                    </template>
                </div>

                <!-- Driver Details -->
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver Name</label>
                    <input type="text" x-model="formData.driver_name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">No of Seats</label>
                    <input type="number" x-model="formData.seats" class="w-full border rounded px-3 py-2" min="1" required>
                </div>

                <!-- License Section -->
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver License</label>
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 border rounded overflow-hidden">
                            <img :src="licensePreview || 'https://via.placeholder.com/96?text=License'" class="w-full h-full object-cover" />
                            <template x-if="licensePreview">
                                <button @click="removeLicense()"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">×</button>
                            </template>
                        </div>
                        <div class="flex-1">
                            <input type="file" accept=".pdf,.jpg,.jpeg,.png" @change="handleLicense" class="w-full" required>
                        </div>
                    </div>
                </div>

                <!-- Bill Book Section -->
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver Bill Book</label>
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 border rounded overflow-hidden">
                            <img :src="billBookPreview || 'https://via.placeholder.com/96?text=Bill+Book'" class="w-full h-full object-cover" />
                            <template x-if="billBookPreview">
                                <button @click="removeBillBook()"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">×</button>
                            </template>
                        </div>
                        <div class="flex-1">
                            <input type="file" accept=".pdf,.jpg,.jpeg,.png" @change="handleBillBook" class="w-full" required>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
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
                    :disabled="imagePreview.length === 0"
                    :class="imagePreview.length === 0 ? 'opacity-50 cursor-not-allowed' : ''">
                    Add Bus
                </button>
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
                    <label class="block font-semibold mb-1">Interior & Exterior Images</label>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <template x-for="(img, idx) in imagePreview" :key="idx">
                            <div class="relative">
                                <img :src="img" class="w-full h-32 object-cover rounded border">
                                <button type="button" @click="removeImage(idx)"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                                    ×
                                </button>
                            </div>
                        </template>
                    </div>
                    <template x-if="imagePreview.length < 6">
                        <div>
                            <input type="file"
                                   @change="handleFiles($event)"
                                   accept="image/png"
                                   multiple
                                   class="w-full border rounded p-2">
                            <p class="text-sm text-gray-500 mt-1" x-text="`${imagePreview.length}/6 images selected`"></p>
                        </div>
                    </template>
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
                        <div class="w-24 h-24 border rounded overflow-hidden relative">
                            <img :src="licensePreview" class="w-full h-full object-cover" />
                            <template x-if="licensePreview">
                                <button @click="removeLicense()"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">×</button>
                            </template>
                        </div>
                        <div class="flex-1">
                            <input type="file" accept=".pdf,.jpg,.jpeg,.png" @change="handleLicense" class="w-full">
                            <p class="text-xs text-gray-500 mt-1">Current file: <span x-text="formDataEdit.driver_license"></span></p>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold mb-1">Driver Bill Book</label>
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 border rounded overflow-hidden relative">
                            <img :src="billBookPreview" class="w-full h-full object-cover" />
                            <template x-if="billBookPreview">
                                <button @click="removeBillBook()"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">×</button>
                            </template>
                        </div>
                        <div class="flex-1">
                            <input type="file" accept=".pdf,.jpg,.jpeg,.png" @change="handleBillBook" class="w-full">
                            <p class="text-xs text-gray-500 mt-1">Current file: <span x-text="formDataEdit.driver_bill_book"></span></p>
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
        imagePreview: [],
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
                .filter(f => f.type === 'image/png');

            const totalImages = this.imagePreview.length + files.length;
            if (totalImages > 6) {
                alert('Maximum 6 images allowed. You can add ' + (6 - this.imagePreview.length) + ' more image(s)');
                event.target.value = '';
                return;
            }

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    this.images.push(file);
                    this.imagePreview.push(e.target.result);
                };
                reader.readAsDataURL(file);
            });

            this.formData.images = this.images;
        },
        removeImage(idx) {
            this.images.splice(idx, 1);
            this.imagePreview.splice(idx, 1);
            this.formData.images = this.images;
            this.formDataEdit.images = this.images;
        },
        handleImageUpload(event) {
            const files = event.target.files;
            if (files) {
                const remainingSlots = 6 - this.imagePreview.length;
                const filesToAdd = Array.from(files).slice(0, remainingSlots);

                filesToAdd.forEach(file => {
                    if (file.type === 'image/png') {
                        const reader = new FileReader();
                        reader.onload = e => {
                            this.imagePreview.push(e.target.result);
                            this.formData.images.push(file);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        },
        toggleFeature(feature) {
            if (this.selectedFeatures.includes(feature.id)) {
                this.selectedFeatures = this.selectedFeatures.filter(id => id !== feature.id);
            } else {
                this.selectedFeatures.push(feature.id);
            }
            this.formData.features = this.selectedFeatures;
        },
        handleLicense(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    this.licensePreview = e.target.result;
                    if (this.isEditing) {
                        this.formDataEdit.driver_license = file;
                    } else {
                        this.formData.driver_license = file;
                    }
                };
                reader.readAsDataURL(file);
            }
        },
        handleBillBook(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    this.billBookPreview = e.target.result;
                    if (this.isEditing) {
                        this.formDataEdit.driver_bill_book = file;
                    } else {
                        this.formData.driver_bill_book = file;
                    }
                };
                reader.readAsDataURL(file);
            }
        },
        removeLicense() {
            this.licensePreview = '';
            this[this.isEditing ? 'formDataEdit' : 'formData'].driver_license = null;
            const licenseInput = document.querySelector('input[accept=".pdf,.jpg,.jpeg,.png"]');
            if (licenseInput) licenseInput.value = '';
        },
        removeBillBook() {
            this.billBookPreview = '';
            this[this.isEditing ? 'formDataEdit' : 'formData'].driver_bill_book = null;
            const billBookInput = document.querySelectorAll('input[accept=".pdf,.jpg,.jpeg,.png"]')[1];
            if (billBookInput) billBookInput.value = '';
        },
        async submitForm() {
            if (this.formData.images.length === 0) {
                alert('Please select at least 1 image');
                return;
            }

            if (this.formData.images.length > 6) {
                alert('Maximum 6 images are allowed');
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

            // Handle files properly
            if (this.formData.driver_license) {
                formData.append('driver_license', this.formData.driver_license);
            }
            if (this.formData.driver_bill_book) {
                formData.append('driver_bill_book', this.formData.driver_bill_book);
            }

            // Handle images
            if (this.images.length > 0) {
                this.images.forEach((file, index) => {
                    formData.append(`images[${index}]`, file);
                });
            }

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

            // Handle files properly
            if (this.formDataEdit.driver_license instanceof File) {
                formDataEdit.append('driver_license', this.formDataEdit.driver_license);
            }
            if (this.formDataEdit.driver_bill_book instanceof File) {
                formDataEdit.append('driver_bill_book', this.formDataEdit.driver_bill_book);
            }

            // Handle images
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
            this.imagePreview = [];
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
            this.isEditing = true; // Set editing mode
            this.formDataEdit = {
                name: bus.name,
                standard_id: bus.standard_id.toString(),
                number_plate: bus.number_plate,
                seats: bus.seats,
                driver_name: bus.driver_name,
                driver_license: bus.driver_license,
                driver_bill_book: bus.driver_bill_book,
                images: bus.images || [],
                features: bus.features || []
            };

            // Set selected features from bus data
            this.selectedFeatures = Array.isArray(bus.features) ? bus.features : [];

            // Setup image previews
            if (Array.isArray(bus.images)) {
                this.imagePreview = bus.images.map(img => `/storage/${img}`);
                this.images = bus.images;
            }

            this.licensePreview = `/storage/${bus.driver_license}`;
            this.billBookPreview = `/storage/${bus.driver_bill_book}`;
            this.editId = bus.id;
            this.showEditModal = true;
        },
        openAddModal() {
            this.resetForm();
            this.isEditing = false; // Set adding mode
            this.showAddModal = true;
        }
    }
}
</script>
