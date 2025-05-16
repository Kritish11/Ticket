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
                                <button class="text-blue-600 hover:text-blue-800"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                                  </svg>
                                  </button>
                                <button class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg></button>
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
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full" x-text="graphic.status"></span>
                            </div>
                            <div class="flex gap-2">
                                <button class="text-blue-600 hover:text-blue-800"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                                  </svg>
                                  </button>
                                <button class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg></button>
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
                    <label class="block text-sm font-medium mb-1">Banner Image (21:9)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <input type="file" accept="image/*" @change="handleBannerImage" class="hidden" id="bannerImage">
                        <label for="bannerImage" class="cursor-pointer">
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="mt-2 text-sm text-gray-500">Click to upload banner image</span>
                            </div>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Display Location</label>
                    <select x-model="newBanner.location" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Location</option>
                        <option value="homepage">Homepage</option>
                        <option value="search">Search Results</option>
                        <option value="booking">Booking Page</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="showBannerModal = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded">Add Banner</button>
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
                    <label class="block text-sm font-medium mb-1">Graphic Image (1:1)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <input type="file" accept="image/*" @change="handleGraphicImage" class="hidden" id="graphicImage">
                        <label for="graphicImage" class="cursor-pointer">
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="mt-2 text-sm text-gray-500">Click to upload graphic</span>
                            </div>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Display Location</label>
                    <select x-model="newGraphic.location" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Location</option>
                        <option value="sidebar">Sidebar</option>
                        <option value="footer">Footer</option>
                        <option value="popup">Popup</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="showGraphicModal = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded">Add Graphic</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function adsManager() {
    return {
        showBannerModal: false,
        showGraphicModal: false,
        bannerAds: [
            { id: 1, title: 'Summer Sale', image: 'https://via.placeholder.com/800x400', location: 'Homepage', status: 'Active' },
            { id: 2, title: 'Special Offer', image: 'https://via.placeholder.com/800x400', location: 'Search Results', status: 'Active' }
        ],
        graphicAds: [
            { id: 1, title: 'Side Promo', image: 'https://via.placeholder.com/400x400', dimensions: '400x400px', status: 'Active' },
            { id: 2, title: 'Footer Ad', image: 'https://via.placeholder.com/400x400', dimensions: '400x400px', status: 'Inactive' }
        ],
        newBanner: { title: '', location: '' },
        newGraphic: { title: '', location: '' },
        // Add your methods here for handling form submissions and image uploads
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
