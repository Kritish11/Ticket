<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TicketSewa - Book Your Journey</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* Apply Inter font to the entire project */
        .font-inter {
            font-family: 'Inter', sans-serif;
        }
        /* Custom dropdown styling */
        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7' /%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
        }
        /* Style for the placeholder option in select */
        .custom-select option[disabled][selected] {
            color: #9ca3af; /* Tailwind's gray-400 equivalent */
        }
        /* Burger menu styles */
        .burger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: black;
            margin: 5px 0;
            transition: all 0.3s ease-in-out;
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
    </style>
</head>
<body class="font-inter bg-white">
    <!-- Navigation Section -->
    @include('partials.header')

    <!-- Hero Section -->
    <section id="hero-section" class="bg-cover bg-center h-[550px]" style="background-image: url('{{ asset('storage/frontend_image/bus.png') }}')">
        <div class="bg-black bg-opacity-50 h-full flex items-center justify-center">
            <div class="text-center text-white">
                <h2 class="text-4xl md:text-6xl font-bold mb-4">Journey with Comfort and Reliability</h2>
                <p class="text-lg md:text-[19px] mb-6">Book your bus tickets instantly online and travel with confidence. Thousands of<br>routes available nationwide.</p>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section id="search-section" class="container px-4 py-8 w-[70%] mx-auto mt-[-100px]">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h3 class="text-[18px] font-bold mb-6 text-start">Find Your Perfect Journey</h3>
            <form action="#" method="GET" class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                <div class="w-full">
                    <label for="from" class="block text-sm font-medium text-gray-700 mb-1">From</label>
                    <select id="from" name="from" class="custom-select w-full p-2 pr-10 border border-gray-300 rounded text-gray-400">
                        <option value="" disabled selected>Select City</option>
                        <option value="kathmandu">Kathmandu</option>
                        <option value="chitwan">Chitwan</option>
                        <option value="pokhara">Pokhara</option>
                    </select>
                </div>
                <div class="w-full">
                    <label for="to" class="block text-sm font-medium text-gray-700 mb-1">To</label>
                    <select id="to" name="to" class="custom-select w-full p-2 pr-10 border border-gray-300 rounded text-gray-400">
                        <option value="" disabled selected>Select City</option>
                        <option value="kathmandu">Kathmandu</option>
                        <option value="chitwan">Chitwan</option>
                        <option value="pokhara">Pokhara</option>
                    </select>
                </div>
                <div class="w-full">
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Travelling Date</label>
                    <input type="date" id="date" name="date" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="w-full flex items-end">
                    <button type="submit" class="w-full p-2 bg-black text-white rounded hover:bg-gray-800">Search</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Popular Routes Section -->
    <section id="popular-routes-section" class="container mx-auto px-4 py-8 ">
        <h3 class="text-[48px] font-bold mb-6 text-center">Popular Routes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white shadow-lg rounded-lg">
                <div>
                    <img src="{{ asset('storage/frontend_image/bus.png') }}" alt="Bus" class="w-100 h-[200px] object-cover rounded-t-lg w-full">
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-[18px] font-bold">Kathmandu to Pokhara</h4>
                        <p class="text-[16px] font-extrabold">Rs. 1,900</p>
                    </div>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-[14px] text-gray-600">76 K.M</p>
                        <p class="text-[14px] text-gray-600">4h 30 min</p>
                    </div>
                    <button class="mt-6 px-4 py-2 bg-white text-black rounded hover:bg-gray-50 w-full border border-black">View Buses</button>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg">
                <div>
                    <img src="{{ asset('storage/frontend_image/bus.png') }}" alt="Bus" class="w-100 h-[200px] object-cover rounded-t-lg w-full">
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-[18px] font-bold">Kathmandu to Pokhara</h4>
                        <p class="text-[16px] font-extrabold">Rs. 1,900</p>
                    </div>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-[14px] text-gray-600">76 K.M</p>
                        <p class="text-[14px] text-gray-600">4h 30 min</p>
                    </div>
                    <button class="mt-6 px-4 py-2 bg-white text-black rounded hover:bg-gray-50 w-full border border-black">View Buses</button>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg">
                <div>
                    <img src="{{ asset('storage/frontend_image/bus.png') }}" alt="Bus" class="w-100 h-[200px] object-cover rounded-t-lg w-full">
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-[18px] font-bold">Kathmandu to Pokhara</h4>
                        <p class="text-[16px] font-extrabold">Rs. 1,900</p>
                    </div>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-[14px] text-gray-600">76 K.M</p>
                        <p class="text-[14px] text-gray-600">4h 30 min</p>
                    </div>
                    <button class="mt-6 px-4 py-2 bg-white text-black rounded hover:bg-gray-50 w-full border border-black">View Buses</button>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg">
                <div>
                    <img src="{{ asset('storage/frontend_image/bus.png') }}" alt="Bus" class="w-100 h-[200px] object-cover rounded-t-lg w-full">
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-[18px] font-bold">Kathmandu to Pokhara</h4>
                        <p class="text-[16px] font-extrabold">Rs. 1,900</p>
                    </div>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-[14px] text-gray-600">76 K.M</p>
                        <p class="text-[14px] text-gray-600">4h 30 min</p>
                    </div>
                    <button class="mt-6 px-4 py-2 bg-white text-black rounded hover:bg-gray-50 w-full border border-black">View Buses</button>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg">
                <div>
                    <img src="{{ asset('storage/frontend_image/bus.png') }}" alt="Bus" class="w-100 h-[200px] object-cover rounded-t-lg w-full">
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-[18px] font-bold">Kathmandu to Pokhara</h4>
                        <p class="text-[16px] font-extrabold">Rs. 1,900</p>
                    </div>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-[14px] text-gray-600">76 K.M</p>
                        <p class="text-[14px] text-gray-600">4h 30 min</p>
                    </div>
                    <button class="mt-6 px-4 py-2 bg-white text-black rounded hover:bg-gray-50 w-full border border-black">View Buses</button>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg">
                <div>
                    <img src="{{ asset('storage/frontend_image/bus.png') }}" alt="Bus" class="w-100 h-[200px] object-cover rounded-t-lg w-full">
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-[18px] font-bold">Kathmandu to Pokhara</h4>
                        <p class="text-[16px] font-extrabold">Rs. 1,900</p>
                    </div>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-[14px] text-gray-600">76 K.M</p>
                        <p class="text-[14px] text-gray-600">4h 30 min</p>
                    </div>
                    <button class="mt-6 px-4 py-2 bg-white text-black rounded hover:bg-gray-50 w-full border border-black">View Buses</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Advertisement Section -->
    <section id="advertisement-section" class="container mx-auto px-4 py-8 mt-6">
        <img src="{{ asset('storage/frontend_image/banner.png') }}" alt="bannerads" class="block w-[1000px] h-[150px] object-cover rounded-lg mx-auto">
    </section>

    <!-- What Our Travelers Say Section -->
    <section id="reviews-section" class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-[48px] font-bold mb-6 text-center">What Our Travelers Say</h2>
            <div class="grid grid-cols-2 md:grid-cols-2 gap-6 max-w-6xl mx-auto flex flex-wrap">
                <!-- Review 1 -->

                <div class="bg-white border shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-start gap-4">
                            <img
                                src="{{ asset('storage/frontend_image/bus.png') }}"
                                alt="Jane Smith"
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <h3 class="font-semibold">Krishna Hari</h3>
                                    <span class="text-sm text-gray-500">April 25, 2025</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-1">Pokhara to Chitwan</p>
                                <div class="flex items-center mb-3">
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-white-500">★</span>
                                </div>
                                <p class="text-gray-700">"Amazing experience! The bus was on time and the staff were very friendly."</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-start gap-4">
                            <img
                                src="{{ asset('storage/frontend_image/bus.png') }}"
                                alt="Jane Smith"
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <h3 class="font-semibold">Ravi Lamichannee</h3>
                                    <span class="text-sm text-gray-500">April 25, 2025</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-1">Pokhara to Chitwan</p>
                                <div class="flex items-center mb-3">
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                </div>
                                <p class="text-gray-700">"Amazing experience! The bus was on time and the staff were very friendly."</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-start gap-4">
                            <img
                                src="{{ asset('storage/frontend_image/bus.png') }}"
                                alt="Jane Smith"
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <h3 class="font-semibold">Kp Oli</h3>
                                    <span class="text-sm text-gray-500">April 25, 2025</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-1">Pokhara to Chitwan</p>
                                <div class="flex items-center mb-3">
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                </div>
                                <p class="text-gray-700">"Amazing experience! The bus was on time and the staff were very friendly."</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-start gap-4">
                            <img
                                src="{{ asset('storage/frontend_image/bus.png') }}"
                                alt="Jane Smith"
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <h3 class="font-semibold">Sher Bahadur</h3>
                                    <span class="text-sm text-gray-500">April 25, 2025</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-1">Pokhara to Chitwan</p>
                                <div class="flex items-center mb-3">
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                    <span class="h-4 w-4 text-yellow-500">★</span>
                                </div>
                                <p class="text-gray-700">"Amazing experience! The bus was on time and the staff were very friendly."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-black flex items-center justify-center text-center">
        <div class="container mx-auto mb-16">
            <h2 class="text-white text-[48px] font-bold mb-4 mt-12">Ready to Start Your Journey?</h2>
            <p class="text-white text-lg mb-12">Thousands of destinations await. Book your tickets in minutes and enjoy a <br> hassle-free travel experience.</p>
            <a href="#" class="bg-white text-black px-6 py-3 rounded hover:bg-gray-200 mb-4">Plan Your Journey Now</a>
        </div>
    </section>

    <section id="why-choose-section" class="mt-20 mb-16">
        <div class="container max-w-9xl mx-auto px-4">
            <h2 class="text-[48px] font-extrabold mb-6 text-center">Why Choose TicketSewa?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Item 1 -->
                <div class="flex flex-col items-center">
                    <img src="{{ asset('storage/frontend_image/clock.png') }}" alt="fast" class="w-16 h-16">
                    <h3 class="text-[20px] font-medium mt-4">Convenient Booking</h3>
                    <p class="text-center text-gray-600 mt-1">Book your bus tickets in just a few clicks. Our intuitive platform makes ticket booking quick and hassle-free.</p>
                </div>
                <!-- Item 2 -->
                <div class="flex flex-col items-center">
                    <img src="{{ asset('storage/frontend_image/security.png') }}" alt="security" class="w-16 h-16">
                    <h3 class="text-[20px] font-medium mt-4">Secure Transactions</h3>
                    <p class="text-center text-gray-600 mt-1">Your payments are safe with our secure payment gateway. We ensure complete protection of your personal information.</p>
                </div>
                <!-- Item 3 -->
                <div class="flex flex-col items-center">
                    <img src="{{ asset('storage/frontend_image/call.png') }}" alt="support" class="w-16 h-16">
                    <h3 class="text-[20px] font-medium mt-4">24/7 Support</h3>
                    <p class="text-center text-gray-600 mt-1">Our customer support team is available round the clock to assist you with any queries or concerns.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer Section -->
    @include('partials.footer')

</body>
</html>
