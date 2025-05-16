<div x-data="blogManager()" class="p-6">
    <!-- Header with Author Management -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Blogs</h1>
        <div class="flex gap-3">
            <button @click="showAuthorModal = true" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded flex items-center gap-2">
                <span class="text-xl">+</span> Add Author
            </button>
            <button @click="showArticleModal = true" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
                <span class="text-xl">+</span> Add Article
            </button>
        </div>
    </div>

    <!-- Search and View Toggle -->
    <div class="flex justify-between items-center mb-6">
        <input type="text"
            placeholder="Search articles..."
            class="w-1/3 border rounded px-3 py-2"
            x-model="searchTerm">
        <div class="flex gap-2">
            <button @click="viewMode = 'grid'" :class="{'bg-black text-white': viewMode === 'grid'}" class="p-2 rounded border">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
            </button>
            <button @click="viewMode = 'list'" :class="{'bg-black text-white': viewMode === 'list'}" class="p-2 rounded border">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Grid View -->
    <div x-show="viewMode === 'grid'" class="grid grid-cols-3 gap-6">
        <template x-for="article in filteredArticles" :key="article.id">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img :src="article.image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="font-bold text-lg" x-text="article.title"></h3>
                            <p class="text-sm text-gray-500" x-text="article.subtitle"></p>
                        </div>
                        <span :class="article.status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'"
                            class="text-xs px-2 py-1 rounded-full" x-text="article.status"></span>
                    </div>
                    <div class="text-sm text-gray-600 line-clamp-3 mb-4" x-text="article.excerpt"></div>
                    <div class="flex justify-between items-center border-t pt-4">
                        <div class="flex items-center gap-2">
                            <img :src="article.authorImage" class="w-8 h-8 rounded-full object-cover">
                            <div class="text-sm">
                                <div x-text="article.author"></div>
                                <div class="text-gray-500" x-text="article.date"></div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button @click="editArticle(article)" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6v-6H3v6z"/>
                                </svg>
                            </button>
                            <button @click="deleteArticle(article.id)" class="text-red-600 hover:text-red-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- List View -->
    <div x-show="viewMode === 'list'" class="bg-white rounded-lg shadow">
        <div class="divide-y divide-gray-200">
            <template x-for="article in filteredArticles" :key="article.id">
                <div class="p-4 flex gap-4">
                    <img :src="article.image" class="w-48 h-32 object-cover rounded-lg">
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-bold text-lg" x-text="article.title"></h3>
                                <p class="text-sm text-gray-500" x-text="article.subtitle"></p>
                            </div>
                            <span :class="article.status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'"
                                class="text-xs px-2 py-1 rounded-full" x-text="article.status"></span>
                        </div>
                        <p class="text-sm text-gray-600 line-clamp-2" x-text="article.excerpt"></p>
                        <div class="flex justify-between items-center mt-4">
                            <div class="flex items-center gap-2">
                                <img :src="article.authorImage" class="w-8 h-8 rounded-full object-cover">
                                <div class="text-sm">
                                    <div x-text="article.author"></div>
                                    <div class="text-gray-500" x-text="article.date"></div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button @click="editArticle(article)" class="text-blue-600 hover:text-blue-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6v-6H3v6z"/>
                                    </svg>
                                </button>
                                <button @click="deleteArticle(article.id)" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Article Modal -->
    <div x-show="showArticleModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100">
        <div @click.away="showArticleModal = false"
            class="bg-white rounded-lg shadow-lg w-full transition-all duration-300"
            :class="isMaximized ? 'h-screen m-0' : 'max-w-4xl h-[90vh] m-4'">

            <!-- Modal Header -->
            <div class="p-6 border-b flex justify-between items-center">
                <h3 class="text-lg font-bold" x-text="editingArticle ? 'Edit Article' : 'Add New Article'"></h3>
                <div class="flex items-center gap-2">
                    <button @click="toggleMaximize" class="text-gray-400 hover:text-gray-600">
                        <svg x-show="!isMaximized" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"/>
                        </svg>
                        <svg x-show="isMaximized" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v16H4z"/>
                        </svg>
                    </button>
                    <button @click="showArticleModal = false" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
            </div>

            <!-- Form Content -->
            <div class="flex-1 overflow-y-auto p-6" :class="isMaximized ? 'h-[calc(100vh-130px)]' : 'h-[calc(90vh-130px)]'">
                <form @submit.prevent="saveArticle" class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Title</label>
                        <input type="text"
                            x-model="articleForm.title"
                            class="w-full border rounded-lg px-4 py-2"
                            placeholder="Enter article title"
                            required>
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Subtitle</label>
                        <input type="text"
                            x-model="articleForm.subtitle"
                            class="w-full border rounded-lg px-4 py-2"
                            placeholder="Enter article subtitle"
                            required>
                    </div>

                    <!-- Featured Image -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Featured Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg"
                             x-show="!articleForm.featuredImage">
                            <div class="space-y-2 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div class="text-sm text-gray-600">
                                    <label class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        <span>Upload Featured Image</span>
                                        <input type="file" class="sr-only" accept="image/*" @change="handleFeaturedImage">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                        <div class="relative" x-show="articleForm.featuredImage">
                            <img :src="articleForm.featuredImage" class="w-full h-64 object-cover rounded-lg">
                            <button type="button"
                                @click="articleForm.featuredImage = null"
                                class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Content -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Content</label>
                        <textarea
                            x-model="articleForm.content"
                            rows="15"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Write your article content here..."
                            required></textarea>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t bg-white">
                <div class="flex justify-between items-center">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" x-model="articleForm.status" class="rounded border-gray-300">
                        <span class="text-sm">Publish immediately</span>
                    </label>
                    <div class="flex gap-3">
                        <button type="button" @click="showArticleModal = false"
                            class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</button>
                        <button type="submit" @click="saveArticle"
                            class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800">Save Article</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Author Modal -->
    <div x-show="showAuthorModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100">
        <div @click.away="showAuthorModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold">Add New Author</h3>
                <button @click="showAuthorModal = false" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <form @submit.prevent="saveAuthor" class="space-y-6">
                <!-- Author Name -->
                <div>
                    <label class="block text-sm font-medium mb-2">Author Name</label>
                    <input type="text"
                        x-model="authorForm.name"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Enter author's name"
                        required>
                </div>

                <!-- Author Image -->
                <div>
                    <label class="block text-sm font-medium mb-2">Profile Picture</label>
                    <div class="flex items-center justify-center">
                        <div class="relative group">
                            <div x-show="!authorForm.image" class="w-32 h-32 rounded-full bg-gray-100 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center cursor-pointer hover:border-indigo-500 transition-colors">
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <span class="mt-2 text-sm text-gray-500">Upload Photo</span>
                            </div>
                            <img x-show="authorForm.image" :src="authorForm.image" class="w-32 h-32 rounded-full object-cover">
                            <input type="file" class="hidden" accept="image/*" @change="handleAuthorImage" x-ref="authorImage">

                            <!-- Remove Image Button -->
                            <button type="button"
                                x-show="authorForm.image"
                                @click="authorForm.image = null"
                                class="absolute -top-2 -right-2 bg-white rounded-full p-1 shadow-lg hover:bg-gray-100">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button"
                        @click="showAuthorModal = false"
                        class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Save Author
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function blogManager() {
    return {
        viewMode: 'grid',
        showArticleModal: false,
        showAuthorModal: false,
        searchTerm: '',
        categoryFilter: '',
        editingArticle: null,
        articleForm: {
            title: '',
            subtitle: '',
            featuredImage: null,
            content: '',
            status: false
        },
        authorForm: {
            name: '',
            image: null
        },
        articles: [
            {
                id: 1,
                title: 'Essential Tips for Long Bus Journeys',
                subtitle: 'Make your travel more comfortable and enjoyable',
                image: 'https://imgs.search.brave.com/4V0q87FE1K3EaD4RcsH0wBv7WRyCmT6_xQizTvutkeo/rs:fit:860:0:0/g:ce/aHR0cHM6Ly93d3cu/cmV1dGVycy5jb20v/cmVzaXplci92Mi81/QU5KVzZNMlFSTjdQ/T0ZaQUVOVlFGNUNK/VS5qcGc',
                excerpt: 'Discover the secrets to comfortable long-distance bus travel...',
                author: 'John Smith',
                authorImage: 'https://i.pravatar.cc/150?img=1',
                date: '2024-02-15',
                status: 'published'
            }
        ],
        isMaximized: false,

        init() {
            this.$watch('showArticleModal', value => {
                if (value) {
                    this.$nextTick(() => {
                        this.$refs.editor.focus();
                    });
                }
            });
        },

        toggleMaximize() {
            this.isMaximized = !this.isMaximized;
        },

        handleFeaturedImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => this.articleForm.featuredImage = e.target.result;
                reader.readAsDataURL(file);
            }
        },

        handleAuthorImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => this.authorForm.image = e.target.result;
                reader.readAsDataURL(file);
            }
        },

        get filteredArticles() {
            return this.articles.filter(article => {
                const matchesSearch = !this.searchTerm ||
                    article.title.toLowerCase().includes(this.searchTerm.toLowerCase());
                const matchesCategory = !this.categoryFilter ||
                    article.category === this.categoryFilter;
                return matchesSearch && matchesCategory;
            });
        },

        saveArticle() {
            console.log('Saving:', this.articleForm);
            this.showArticleModal = false;
        },

        saveAuthor() {
            console.log('Saving author:', this.authorForm);
            this.showAuthorModal = false;
        }
    }
}
</script>
