<nav id="nav-section" class="bg-white shadow fixed top-0 w-full z-10">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center text-[18px]">
        <div class="flex items-center">
            <h1 class="text-3xl font-bold text-gray-800 ml-8">
                <a href="/" class="{{ request()->is('/') ? 'underline-active' : '' }}">TicketSewa</a>
            </h1>
        </div>

        <div class="lg:hidden flex items-center mr-4">
            <div class="burger cursor-pointer space-y-2" onclick="toggleMenu()">
                <span class="block w-8 h-1 bg-gray-800"></span>
                <span class="block w-8 h-1 bg-gray-800"></span>
                <span class="block w-8 h-1 bg-gray-800"></span>
            </div>
        </div>

        <div class="nav-links hidden lg:flex lg:space-x-6 flex-col lg:flex-row absolute lg:static top-16 left-0 w-full lg:w-auto bg-white lg:bg-transparent shadow-md lg:shadow-none p-4 lg:p-0">
            <a href="/" class="relative text-gray-800 hover:text-gray-600 before:content-[''] before:absolute before:bottom-0 before:left-0 before:w-full before:h-[2px] before:bg-black before:origin-center before:transition-transform before:duration-300 px-2 py-2 lg:px-0
                {{ request()->is('/') ? 'before:scale-x-100' : 'before:scale-x-0' }}">
                Home
            </a>

            <a href="/search" class="relative text-gray-800 hover:text-gray-600 before:content-[''] before:absolute before:bottom-0 before:left-0 before:w-full before:h-[2px] before:bg-black before:origin-center before:transition-transform before:duration-300 px-2 py-2 lg:px-0
                {{ request()->is('search') ? 'before:scale-x-100' : 'before:scale-x-0' }}">
                Search
            </a>

            <a href="/mybooking" class="relative text-gray-800 hover:text-gray-600 before:content-[''] before:absolute before:bottom-0 before:left-0 before:w-full before:h-[2px] before:bg-black before:origin-center before:transition-transform before:duration-300 px-2 py-2 lg:px-0
                {{ request()->is('mybooking') ? 'before:scale-x-100' : 'before:scale-x-0' }}">
                My Booking
            </a>

            <a href="/contact" class="relative text-gray-800 hover:text-gray-600 before:content-[''] before:absolute before:bottom-0 before:left-0 before:w-full before:h-[2px] before:bg-black before:origin-center before:transition-transform before:duration-300 px-2 py-2 lg:px-0
                {{ request()->is('contact') ? 'before:scale-x-100' : 'before:scale-x-0' }}">
                Support
            </a>

            <a href="/aboutus" class="relative text-gray-800 hover:text-gray-600 before:content-[''] before:absolute before:bottom-0 before:left-0 before:w-full before:h-[2px] before:bg-black before:origin-center before:transition-transform before:duration-300 px-2 py-2 lg:px-0
                {{ request()->is('aboutus') ? 'before:scale-x-100' : 'before:scale-x-0' }}">
                About Us
            </a>

            <div class="flex flex-row space-x-2 lg:hidden mt-4">
                <a href="#" class="px-3 py-2 bg-white text-black rounded hover:bg-gray-200 border border-black">Login</a>
                <a href="#" class="px-3 py-2 bg-black text-white rounded-lg hover:bg-gray-800 border border-black">Sign Up</a>
            </div>
        </div>

        <div class="hidden lg:flex items-center space-x-2 mr-8 py-2">
            @if(session('is_logged_in'))
                <span class="text-gray-800 font-medium">{{ session('user_name') }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline-block ml-4">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-6 py-2 bg-white text-black rounded hover:bg-gray-200 border border-black text-[16px]">Login</a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-black text-white rounded hover:bg-gray-800 border text-[16px]">Sign Up</a>
            @endif
        </div>
    </div>
</nav>

<style>
@media (min-width: 1025px) {
    .nav-links {
        display: flex !important;
    }
    .burger {
        display: none !important;
    }
}
.burger.active span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}
.burger.active span:nth-child(2) {
    opacity: 0;
}
.burger.active span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -7px);
}
.nav-links {
    transition: all 0.3s ease-in-out;
}
</style>

<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        const burger = document.querySelector('.burger');
        navLinks.classList.toggle('hidden');
        burger.classList.toggle('active');
    }
</script>
