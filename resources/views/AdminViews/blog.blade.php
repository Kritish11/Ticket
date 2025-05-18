<div x-data="blogManager()" class="p-6">
    <!-- Header with Author Management -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Blogs</h1>
        <div class="flex gap-3">
            <button @click="toggleAuthorsList" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded flex items-center gap-2">
                <span>View Authors</span>
            </button>
            <button @click="showAuthorModal = true" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded flex items-center gap-2">
                <span class="text-xl">+</span> Add Author
            </button>
            <button @click="clearForm" class="bg-black text-white px-4 py-2 rounded flex items-center gap-2">
                <span class="text-xl">+</span> Add Article
            </button>
        </div>
    </div>

    <!-- Authors List Modal -->
    <div x-show="showAuthorsList"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div @click.away="toggleAuthorsList"
            class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 max-h-[80vh] flex flex-col">
           <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-bold">Authors</h2>
              <button @click="toggleAuthorsList" class="text-gray-500 hover:text-gray-700">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                 </svg>
              </button>
           </div>

           <div class="overflow-y-auto flex-1">
              <template x-if="authors.length > 0">
                 <div class="grid grid-cols-2 gap-4">
                    <template x-for="author in authors" :key="author.id">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                           <div class="flex items-center gap-3">
                              <img :src="author.image" class="w-12 h-12 rounded-full object-cover">
                              <span x-text="author.name" class="font-medium"></span>
                           </div>
                           <button @click="deleteAuthor(author.id)"
                                 class="text-red-600 hover:text-red-800 p-2">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path d="M6 18L18 6M6 6l12 12"/>
                              </svg>
                           </button>
                        </div>
                    </template>
                 </div>
              </template>
              <template x-if="authors.length === 0">
                 <div class="text-center text-gray-500">
                    <p>No authors found.</p>
                 </div>
              </template>
           </div>
        </div>
    </div>

    <!-- Delete Author Confirmation Modal -->
    <div x-show="showDeleteAuthorModal"
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-[60]">
        <div @click.away="cancelDelete"
             class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 transform transition-all"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Delete Author</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this author? This action cannot be undone.</p>
            </div>
            <div class="flex justify-end gap-3">
                <button @click="cancelDelete"
                        class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button @click="confirmDeleteAuthor"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Delete Author
                </button>
            </div>
        </div>
    </div>

    <!-- Add Blog Delete Confirmation Modal -->
    <div x-show="showDeleteBlogModal"
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-[60]">
        <div @click.away="cancelBlogDelete"
             class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 transform transition-all">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Delete Blog</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this blog? This action cannot be undone.</p>
            </div>
            <div class="flex justify-end gap-3">
                <button @click="cancelBlogDelete"
                        class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button @click="confirmDeleteBlog"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Delete Blog
                </button>
            </div>
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
                            <p class="text-sm text-gray-500" x-text="article.subtitle.length > 50 ? article.subtitle.substring(0, 50) + '...' : article.subtitle"></p>
                        </div>
                        <span :class="article.status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'"
                            class="text-xs px-2 py-1 rounded-full" x-text="article.status"></span>
                    </div>
                    <div class="text-sm text-gray-600 line-clamp-3 mb-4" x-text="article.excerpt.length > 50 ? article.excerpt.substring(0, 50) + '...' : article.excerpt"></div>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
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

                @csrf
                <form @submit.prevent="saveArticle" class="space-y-6" action="{{ route('blog.save') }}" method="POST" enctype="multipart/form-data">
                    <!-- Title -->
                    <div>
                        <textarea
                            x-model="articleForm.title"
                            class="w-full px-6 py-4 text-3xl font-bold focus:outline-none resize-none overflow-hidden"
                            placeholder="Enter article title"
                            name="title"
                            rows="2"
                            required
                            @input="event.target.style.height = 'auto'; event.target.style.height = event.target.scrollHeight + 'px';"></textarea>
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <textarea
                            x-model="articleForm.subtitle"
                           class="w-full px-6 py-1 text-2xl focus:outline-none break-words break-all resize-none"
                            placeholder="Enter article subtitle"
                            name="subtitle"
                            required
                            rows="2"
                            @input="event.target.style.height = 'auto'; event.target.style.height = event.target.scrollHeight + 'px';"></textarea>
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
                                        <input type="file" class="sr-only" name="featured_image" accept="image/*" @change="handleFeaturedImage">
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
                        <textarea
                            x-model="articleForm.content"
                            rows="15"
                            class="w-full px-6 py-1 text-1xl focus:outline-none break-words break-all resize-none"
                            placeholder="Write your article content here..."
                            name="content"
                            required
                            @input="event.target.style.height = 'auto'; event.target.style.height = event.target.scrollHeight + 'px';"></textarea>
                    </div>

                    <!-- Author Selection -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Select Author</label>
                        <div class="relative">
                            <select name="author_id"
                                    x-model="articleForm.author_id"
                                    class="w-full border rounded-lg px-4 py-2"
                                    required>
                                <option value="">Select an author</option>
                                @foreach($activeAuthors as $author)
                                    <option value="{{ $author->id }}"
                                            data-name="{{ $author->name }}"
                                            data-image="{{ $author->image }}">
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t bg-white">
                <div class="flex justify-between items-center">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="status" x-model="articleForm.status" class="rounded border-gray-300">
                        <span class="text-sm">Publish immediately</span>
                    </label>
                    <div class="flex gap-3">
                        <button type="button" @click="showArticleModal = false"
                            class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</button>
                        <button type="submit" @click="saveArticle"
                            class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800" name="submit">Save Article</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Author Modal -->
    <div x-show="showAuthorModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
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
                            <!-- Upload Area -->
                            <div @click="$refs.authorImage.click()"
                                 x-show="!authorForm.image"
                                 class="w-32 h-32 rounded-full bg-gray-100 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center cursor-pointer hover:border-indigo-500 transition-colors">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <span class="mt-2 text-sm text-gray-500">Upload Photo</span>
                            </div>

                            <!-- Preview Area -->
                            <div x-show="authorForm.image" class="relative">
                                <img :src="authorForm.image" class="w-32 h-32 rounded-full object-cover">
                                <button type="button"
                                        @click="authorForm.image = null; $refs.authorImage.value = ''"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Hidden File Input -->
                            <input type="file"
                                   class="hidden"
                                   accept="image/*"
                                   @change="handleAuthorImage($event)"
                                   x-ref="authorImage">
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 text-center">Only one image allowed</p>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" @click="showAuthorModal = false"
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

<script>
function blogManager() {
    return {
        viewMode: 'grid',
        showArticleModal: false,
        showAuthorModal: false,
        showAuthorsList: false,
        showDeleteAuthorModal: false,
        showDeleteBlogModal: false,
        authorToDelete: null,
        blogToDelete: null,
        searchTerm: '',
        categoryFilter: '',
        editingArticle: null,
        articleForm: {
            title: '',
            subtitle: '',
            featuredImage: null,
            content: '',
            author_id: '',
            status: false
        },
        authorForm: {
            name: '',
            image: null
        },
        authors: [],
        availableAuthors: [],
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
        notification: {
            show: false,
            message: '',
            type: 'success',
            timeout: null
        },

        init() {
            this.loadActiveAuthors();
            this.loadBlogs();
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
                reader.onload = e => {
                    this.authorForm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            }
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

        toggleAuthorsList() {
            this.showAuthorsList = !this.showAuthorsList;
            if (this.showAuthorsList) {
                this.loadAuthors();
            }
        },

        loadAuthors() {
            fetch('/authors')
                .then(response => response.json())
                .then(data => {
                    this.authors = data.authors;
                })
                .catch(error => {
                    console.error('Error loading authors:', error);
                    this.showNotification('Error loading authors', 'error');
                });
        },

        loadActiveAuthors() {
            fetch('/active-authors')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.availableAuthors = data.authors;
                        console.log('Loaded authors:', this.availableAuthors); // Debug log
                    }
                })
                .catch(error => {
                    console.error('Error loading authors:', error);
                    this.showNotification('Error loading authors', 'error');
                });
        },

        loadBlogs() {
            fetch('/blogs')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.articles = data.blogs.map(blog => ({
                            id: blog.id,
                            title: blog.title,
                            subtitle: blog.subtitle,
                            image: blog.featured_image,
                            content: blog.content,  // Make sure to include content
                            excerpt: blog.content.substring(0, 150) + '...',
                            author: blog.author_name,
                            author_id: blog.author_id,  // Make sure to include author_id
                            authorImage: blog.author_image,
                            date: new Date(blog.created_at).toLocaleDateString(),
                            status: blog.status ? 'published' : 'draft'
                        }));
                    }
                })
                .catch(error => {
                    console.error('Error loading blogs:', error);
                    this.showNotification('Error loading blogs', 'error');
                });
        },

        editArticle(article) {
            console.log('Editing article:', article); // Debug log
            this.editingArticle = article;
            this.articleForm = {
                title: article.title,
                subtitle: article.subtitle,
                featuredImage: article.image,
                content: article.content,
                author_id: article.author_id.toString(),
                status: article.status === 'published'
            };
            this.showArticleModal = true;
        },

        saveArticle() {
            const data = {
                title: this.articleForm.title,
                subtitle: this.articleForm.subtitle,
                featured_image: this.articleForm.featuredImage,
                content: this.articleForm.content,
                author_id: parseInt(this.articleForm.author_id),
                status: this.articleForm.status
            };

            const url = this.editingArticle
                ? `/blog/${this.editingArticle.id}`
                : '/blog/add';

            fetch(url, {
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
                    this.loadBlogs();
                    this.showNotification(
                        this.editingArticle ? 'Blog updated successfully' : 'Blog added successfully',
                        'success'
                    );
                    this.resetForm();
                } else {
                    this.showNotification(result.error || 'Error saving blog', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showNotification('Error saving blog', 'error');
            });
        },

        deleteArticle(id) {
            this.blogToDelete = id;
            this.showDeleteBlogModal = true;
        },

        confirmDeleteBlog() {
            const id = this.blogToDelete;
            fetch(`/blog/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    this.loadBlogs();
                    this.showNotification('Blog deleted successfully', 'success');
                } else {
                    this.showNotification(result.error || 'Error deleting blog', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showNotification('Error deleting blog', 'error');
            })
            .finally(() => {
                this.showDeleteBlogModal = false;
                this.blogToDelete = null;
            });
        },

        resetForm() {
            this.articleForm = {
                title: '',
                subtitle: '',
                featuredImage: null,
                content: '',
                author_id: '',
                status: false
            };
            this.editingArticle = null;
            this.showArticleModal = false;
        },

        deleteAuthor(id) {
            this.authorToDelete = id;
            this.showDeleteAuthorModal = true;
        },

        confirmDeleteAuthor() {
            const id = this.authorToDelete;
            fetch(`/author/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    this.authors = this.authors.filter(a => a.id !== id);
                    this.showNotification('Author deleted successfully', 'success');
                } else {
                    this.showNotification(result.message || 'Error deleting author', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showNotification('Error deleting author', 'error');
            })
            .finally(() => {
                this.showDeleteAuthorModal = false;
                this.authorToDelete = null;
            });
        },

        cancelDelete() {
            this.showDeleteAuthorModal = false;
            this.authorToDelete = null;
        },

        cancelBlogDelete() {
            this.showDeleteBlogModal = false;
            this.blogToDelete = null;
        },

        saveAuthor() {
            if (!this.authorForm.name || !this.authorForm.image) {
                this.showNotification('Please fill in all fields', 'error');
                return;
            }

            fetch('/author/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(this.authorForm)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    this.loadAuthors(); // Refresh the authors list
                    this.showNotification('Author added successfully', 'success');
                    this.authorForm = { name: '', image: null };
                    this.showAuthorModal = false;
                } else {
                    this.showNotification(result.message || 'Error adding author', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showNotification('Error adding author', 'error');
            });
        },

        clearForm() {
            this.editingArticle = null;
            this.articleForm = {
                title: '',
                subtitle: '',
                featuredImage: null,
                content: '',
                author_id: '',
                status: false
            };
            this.showArticleModal = true;
        }
    }
}
</script>
