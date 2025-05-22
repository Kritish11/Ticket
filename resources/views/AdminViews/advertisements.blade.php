<div x-data="adsManager()" class="p-6">
    <div class="text-2xl font-bold mb-4">Advertisements </div>
    <div class="grid grid-cols-2 gap-6">
        <!-- Banner Ads Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold">Banner Advertisements</h2>
                <button @click="showBannerModal = true" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
                    <span class="text-xl">+</span> Add Banner
                </button>
            </div>

            <!-- Banner Ads List -->
            <div class="space-y-4 h-[500px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                <template x-for="banner in bannerAds" :key="banner.id">
                    <div class="border rounded-lg p-4">
                        <div class="aspect-[21/9] rounded-lg overflow-hidden mb-3">
                            <img :src="banner.image" class="w-full h-full object-cover">
                        </div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium" x-text="banner.title"></h3>
                                <p class="text-sm text-gray-500" x-text="banner.location"></p>
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full" x-text="banner.status"></span>
                            </div>
                            <div class="flex gap-2">
                                <button @click="editBanner(banner)" class="text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button @click="deleteBanner(banner.id)" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Normal Ads Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold">Graphics Advertisements</h2>
                <button @click="showGraphicModal = true" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
                    <span class="text-xl">+</span> Add Graphic
                </button>
            </div>

            <!-- Graphics Ads List -->
            <div class="grid grid-cols-2 gap-4 h-[500px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                <template x-for="graphic in graphicAds" :key="graphic.id">
                    <div class="border rounded-lg p-3">
                        <div class="aspect-square rounded-lg overflow-hidden mb-3">
                            <img :src="graphic.image" class="w-full h-full object-cover">
                        </div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium" x-text="graphic.title"></h3>
                                <p class="text-sm text-gray-500" x-text="graphic.dimensions"></p>
                                <span class="text-xs"
                                    :class="graphic.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                    x-text="graphic.status"></span>
                            </div>
                            <div class="flex gap-2">
                                <button @click="editGraphic(graphic)" class="text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button @click="deleteGraphic(graphic.id)" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Banner Ad Modal -->
    <div x-show="showBannerModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showBannerModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6">
            <h3 class="text-lg font-bold mb-4">Add Banner Advertisement</h3>
            <form @submit.prevent="addBanner" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" x-model="newBanner.title" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select x-model="newBanner.status" class="w-full border rounded px-3 py-2" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Banner Image (21:9)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <!-- Image Preview -->
                        <template x-if="newBanner.imagePreview">
                            <div class="mb-4">
                                <img :src="newBanner.imagePreview" class="max-h-48 mx-auto rounded-lg">
                                <button type="button" @click="removeImage" class="text-red-500 text-sm mt-2">Remove Image</button>
                            </div>
                        </template>

                        <!-- Upload Input -->
                        <template x-if="!newBanner.imagePreview">
                            <label for="bannerImage" class="cursor-pointer">
                                <input type="file" accept="image/*" @change="handleBannerImage" class="hidden" id="bannerImage">
                                <div class="flex flex-col items-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="mt-2 text-sm text-gray-500">Click to upload banner image</span>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="showBannerModal = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded">Add Banner</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Banner Modal -->
    <div x-show="showEditModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showEditModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6">
            <h3 class="text-lg font-bold mb-4">Edit Banner Advertisement</h3>
            <form @submit.prevent="updateBanner" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" x-model="editingBanner.title" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select x-model="editingBanner.status" class="w-full border rounded px-3 py-2" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Banner Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <!-- Current/Preview Image -->
                        <div class="mb-4">
                            <img :src="editingBanner.imagePreview || editingBanner.image" class="max-h-48 mx-auto rounded-lg">
                        </div>
                        <!-- Upload New Image -->
                        <label for="editBannerImage" class="cursor-pointer">
                            <input type="file" accept="image/*" @change="handleEditImage" class="hidden" id="editBannerImage">
                            <div class="flex flex-col items-center">
                                <span class="mt-2 text-sm text-gray-500">Click to update image</span>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="showEditModal = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded">Update Banner</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Graphic Ad Modal -->
    <div x-show="showGraphicModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showGraphicModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6">
            <h3 class="text-lg font-bold mb-4">Add Graphic Advertisement</h3>
            <form @submit.prevent="addGraphic" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" x-model="newGraphic.title" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select x-model="newGraphic.status" class="w-full border rounded px-3 py-2" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Graphic Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <!-- Image Preview -->
                        <template x-if="newGraphic.imagePreview">
                            <div class="mb-4">
                                <img :src="newGraphic.imagePreview" class="max-h-48 mx-auto rounded-lg">
                                <button type="button" @click="removeGraphicImage" class="text-red-500 text-sm mt-2">Remove Image</button>
                            </div>
                        </template>

                        <!-- Upload Input -->
                        <template x-if="!newGraphic.imagePreview">
                            <label for="graphicImage" class="cursor-pointer">
                                <input type="file" accept="image/*" @change="handleGraphicImage" class="hidden" id="graphicImage">
                                <div class="flex flex-col items-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="mt-2 text-sm text-gray-500">Click to upload image</span>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="showGraphicModal = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded">Add Graphic</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Graphic Modal -->
    <div x-show="showEditGraphicModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showEditGraphicModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6">
            <h3 class="text-lg font-bold mb-4">Edit Graphic Advertisement</h3>
            <form @submit.prevent="updateGraphic" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" x-model="editingGraphic.title" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select x-model="editingGraphic.status" class="w-full border rounded px-3 py-2" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Graphic Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <!-- Current/Preview Image -->
                        <div class="mb-4">
                            <img :src="editingGraphic.imagePreview || editingGraphic.image" class="max-h-48 mx-auto rounded-lg">
                        </div>
                        <!-- Upload New Image -->
                        <label for="editGraphicImage" class="cursor-pointer">
                            <input type="file" accept="image/*" @change="handleEditGraphicImage" class="hidden" id="editGraphicImage">
                            <div class="flex flex-col items-center">
                                <span class="mt-2 text-sm text-gray-500">Click to update image</span>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="showEditGraphicModal = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded">Update Graphic</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteGraphicModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="showDeleteGraphicModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h3 class="text-lg font-bold mb-4">Delete Graphic Advertisement</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this graphic advertisement? This action cannot be undone.</p>
            <div class="flex justify-end gap-2">
                <button @click="showDeleteGraphicModal = false" class="px-4 py-2 border rounded">Cancel</button>
                <button @click="confirmDeleteGraphic" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
function adsManager() {
    return {
        showBannerModal: false,
        showGraphicModal: false,
        showEditModal: false,
        showEditGraphicModal: false,
        showDeleteGraphicModal: false,
        graphicToDelete: null,
        bannerAds: [],
        graphicAds: [],
        newBanner: {
            title: '',
            status: 'active',
            image: null,
            imagePreview: null
        },
        editingBanner: {
            id: null,
            title: '',
            status: 'active',
            image: null,
            imagePreview: null
        },
        newGraphic: {
            title: '',
            status: 1,
            image: null,
            imagePreview: null
        },
        editingGraphic: {
            id: null,
            title: '',
            status: 1,
            image: null,
            imagePreview: null,
            newImage: null
        },

        async init() {
            await this.loadBanners();
            await this.loadGraphics();
        },

        async loadBanners() {
            try {
                const response = await fetch('/admin/banners');
                const data = await response.json();
                if (data.success) {
                    this.bannerAds = data.banners.map(banner => ({
                        ...banner,
                        image: '/storage/' + banner.image
                    }));
                }
            } catch (error) {
                console.error('Error loading banners:', error);
            }
        },

        async loadGraphics() {
            try {
                const response = await fetch('/admin/graphics');
                const data = await response.json();
                if (data.success) {
                    this.graphicAds = data.graphics.map(graphic => ({
                        ...graphic,
                        image: '/storage/' + graphic.image
                    }));
                }
            } catch (error) {
                console.error('Error loading graphics:', error);
            }
        },

        handleBannerImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.newBanner.image = file;
                const reader = new FileReader();
                reader.onload = e => {
                    this.newBanner.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        handleGraphicImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.newGraphic.image = file;
                const reader = new FileReader();
                reader.onload = e => {
                    this.newGraphic.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        removeImage() {
            this.newBanner.image = null;
            this.newBanner.imagePreview = null;
            document.getElementById('bannerImage').value = '';
        },

        removeGraphicImage() {
            this.newGraphic.image = null;
            this.newGraphic.imagePreview = null;
            document.getElementById('graphicImage').value = '';
        },

        async addBanner() {
            if (!this.newBanner.image) {
                alert('Please select an image');
                return;
            }

            const formData = new FormData();
            formData.append('title', this.newBanner.title);
            formData.append('image', this.newBanner.image);
            formData.append('status', this.newBanner.status);

            try {
                const response = await fetch('/admin/banners', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    this.bannerAds.unshift({
                        id: data.banner.id,
                        title: data.banner.title,
                        image: '/storage/' + data.banner.image,
                        status: data.banner.status // Use the returned status
                    });

                    // Reset form with default status
                    this.newBanner = {
                        title: '',
                        status: 'active', // Reset to default status
                        image: null,
                        imagePreview: null
                    };
                    this.showBannerModal = false;
                    alert('Banner added successfully');
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to add banner: ' + error.message);
            }
        },

        async addGraphic() {
            if (!this.newGraphic.image) {
                alert('Please select an image');
                return;
            }

            const formData = new FormData();
            formData.append('title', this.newGraphic.title);
            formData.append('image', this.newGraphic.image);
            formData.append('status', this.newGraphic.status);

            try {
                const response = await fetch('/admin/graphics', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    await this.loadGraphics();
                    this.showGraphicModal = false;
                    this.resetGraphicForm();
                    alert('Graphic added successfully');
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to add graphic: ' + error.message);
            }
        },

        editBanner(banner) {
            this.editingBanner = {
                id: banner.id,
                title: banner.title,
                status: banner.status,
                image: banner.image,
                imagePreview: null
            };
            this.showEditModal = true;
        },

        editGraphic(graphic) {
            this.editingGraphic = {
                id: graphic.id,
                title: graphic.title,
                status: graphic.status ? 1 : 0,
                image: graphic.image,
                imagePreview: null,
                newImage: null
            };
            this.showEditGraphicModal = true;
        },

        handleEditImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    this.editingBanner.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
                this.editingBanner.newImage = file;
            }
        },

        handleEditGraphicImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    this.editingGraphic.imagePreview = e.target.result;
                    this.editingGraphic.newImage = file;
                };
                reader.readAsDataURL(file);
            }
        },

        async updateBanner() {
            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('title', this.editingBanner.title);
            formData.append('status', this.editingBanner.status);

            if (this.editingBanner.newImage) {
                formData.append('image', this.editingBanner.newImage);
            }

            try {
                const response = await fetch(`/admin/banners/${this.editingBanner.id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    await this.loadBanners();
                    this.showEditModal = false;
                    alert('Banner updated successfully');
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to update banner: ' + error.message);
            }
        },

        async updateGraphic() {
            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('title', this.editingGraphic.title);
            formData.append('status', this.editingGraphic.status);

            if (this.editingGraphic.newImage) {
                formData.append('image', this.editingGraphic.newImage);
            }

            try {
                const response = await fetch(`/admin/graphics/${this.editingGraphic.id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    await this.loadGraphics();
                    this.showEditGraphicModal = false;
                    alert('Graphic updated successfully');
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to update graphic: ' + error.message);
            }
        },

        async deleteBanner(id) {
            if (!confirm('Are you sure you want to delete this banner?')) return;

            try {
                const response = await fetch(`/admin/banners/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    this.bannerAds = this.bannerAds.filter(banner => banner.id !== id);
                    alert('Banner deleted successfully');
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to delete banner: ' + error.message);
            }
        },

        async deleteGraphic(id) {
            if (confirm('Are you sure you want to delete this graphic?')) {
                try {
                    const response = await fetch(`/admin/graphics/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();
                    if (data.success) {
                        this.graphicAds = this.graphicAds.filter(graphic => graphic.id !== id);
                        alert('Graphic deleted successfully');
                        await this.loadGraphics();
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Failed to delete graphic: ' + error.message);
                }
            }
        },

        deleteGraphic(graphic) {
            this.graphicToDelete = graphic;
            this.showDeleteGraphicModal = true;
        },

        async confirmDeleteGraphic() {
            try {
                const response = await fetch(`/admin/graphics/${this.graphicToDelete.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                if (data.success) {
                    this.graphicAds = this.graphicAds.filter(g => g.id !== this.graphicToDelete.id);
                    this.showDeleteGraphicModal = false;
                    this.graphicToDelete = null;
                    alert('Graphic deleted successfully');
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to delete graphic: ' + error.message);
            }
        },

        resetGraphicForm() {
            this.newGraphic = {
                title: '',
                status: 1,
                image: null,
                imagePreview: null
            };
        }
    }
}
</script>

<style>
/* Custom Scrollbar */
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
