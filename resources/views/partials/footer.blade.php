<!-- resources/views/partials/footer.blade.php -->

<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 pt-16 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- About Us Section -->
            <div>
                <h3 class="text-lg font-semibold mb-4">About TicketSewa</h3>
                <p class="text-gray-300 mb-4">
                    TicketSewa provides simple, fast, and reliable bus booking services across Nepal.
                    We partner with trusted bus operators to ensure a comfortable journey.
                </p>
                <div class="flex space-x-4">
                    <a href="#" aria-label="Facebook" class="hover:text-gray-400 transition-colors">
                        <!-- Placeholder for Facebook Icon -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.563V12h2.773l-.443 2.892h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Twitter" class="hover:text-gray-400 transition-colors">
                        <!-- Placeholder for Twitter Icon -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="hover:text-gray-400 transition-colors">
                        <!-- Placeholder for Instagram Icon -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.332.014 7.052.072 3.668.227 1.981 1.97 1.826 5.354.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.155 3.384 1.898 5.071 5.282 5.226C8.332 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 3.384-.155 5.071-1.898 5.226-5.282C23.986 15.668 24 15.259 24 12c0-3.259-.014-3.668-.072-4.948-.155-3.384-1.898-5.071-5.282-5.226C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="/" class="text-gray-300 hover:text-white transition-colors">Home</a></li>
                    <li><a href="/search" class="text-gray-300 hover:text-white transition-colors">Search</a></li>
                    <li><a href="/mybooking" class="text-gray-300 hover:text-white transition-colors">My Bookings</a></li>
                    <li><a href="/contact" class="text-gray-300 hover:text-white transition-colors">Support</a></li>
                    <li><a href="/aboutus" class="text-gray-300 hover:text-white transition-colors">About Us</a></li>
                </ul>
            </div>

            <!-- Popular Routes -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Popular Routes</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Kathmandu to Pokhara</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Kathmandu to Chitwan</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Pokhara to Chitwan</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Kathmandu to Biratnagar</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Pokhara to Lumbini</a></li>
                </ul>
            </div>

            <!-- Contact Info & Legal -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact & Legal</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <!-- Placeholder for Mail Icon -->
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        <span class="text-gray-300">support@ticketsewa.com</span>
                    </div>
                    <div class="flex items-start">
                        <!-- Placeholder for Phone Icon -->
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.24 1.02l-2.2 2.2z"/>
                        </svg>
                        <span class="text-gray-300">+977 123-456-7890</span>
                    </div>
                    <ul class="space-y-2 pt-2">
                        <li><a href="/policy" class="text-gray-300 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="/terms" class="text-gray-300 hover:text-white transition-colors">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 mt-8">
            <div class="text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} TicketSewa. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
