<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>TicketSewa - Book Your Journey</title>
</head>
<body>
    <header>
        @include('partials.header')
    </header>
    <div class="min-h-screen bg-gray-50 py-12 pt-24">
        <div class="container mx-auto px-4">
            <!-- Hero Section -->
            <section class="mb-16 text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">About TicketSewa</h1>
                <p class="text-gray-600 max-w-3xl mx-auto text-lg">
                    We're on a mission to make bus travel easy, reliable, and enjoyable for everyone.
                </p>
            </section>

            <!-- Our Story Section -->
            <section class="mb-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Our Story</h2>
                        <div class="space-y-4 text-gray-700">
                            <p>
                                TicketSewa was founded in 2020 with a simple idea: make bus ticket booking as seamless as possible.
                                We noticed that while other forms of transportation had embraced digital transformation, bus travel
                                bookings were often still complicated and inefficient.
                            </p>
                            <p>
                                Starting with just a handful of routes and operators, we've grown to become one of the leading bus
                                ticket booking platforms in the country. Today, we connect thousands of travelers with hundreds of
                                bus operators across numerous routes.
                            </p>
                            <p>
                                Our platform has evolved based on user feedback and technological advancements, but our core mission
                                remains the same - to provide a hassle-free booking experience and make bus travel accessible to all.
                            </p>
                        </div>
                    </div>
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <img
                            src="{{ asset('storage/frontend_image/bus.png') }}"
                            alt="Bus journey"
                            class="w-full h-full object-cover"
                        />
                    </div>
                </div>
            </section>

            <!-- Our Values Section -->
            <section class="mb-16">
                <h2 class="text-2xl font-bold mb-8 text-center">Our Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow animate-fade-in" style="animation-delay: 0s;">
                        <h3 class="text-xl font-semibold mb-3">Customer First</h3>
                        <p class="text-gray-600">We prioritize our customers' needs in every decision we make. From easy booking to responsive support, your journey is our priority.</p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow animate-fade-in" style="animation-delay: 0.1s;">
                        <h3 class="text-xl font-semibold mb-3">Reliability</h3>
                        <p class="text-gray-600">We believe in building trust through consistent service. Our platform is designed to be dependable and our information accurate.</p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow animate-fade-in" style="animation-delay: 0.2s;">
                        <h3 class="text-xl font-semibold mb-3">Innovation</h3>
                        <p class="text-gray-600">We continuously improve our technology and services to make bus travel booking more convenient, efficient, and enjoyable.</p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow animate-fade-in" style="animation-delay: 0.3s;">
                        <h3 class="text-xl font-semibold mb-3">Transparency</h3>
                        <p class="text-gray-600">DWe're committed to clear communication about pricing, policies, and services so you can make informed travel decisions.</p>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="mb-16 bg-black text-white py-12 px-4 md:px-8 rounded-xl">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                    <div class="space-y-2">
                        <p class="text-4xl font-bold">5M+</p>
                        <p class="text-gray-300">Happy Customers</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-4xl font-bold">200+</p>
                        <p class="text-gray-300">Bus Operators</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-4xl font-bold">3,000+</p>
                        <p class="text-gray-300">Routes Covered</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-4xl font-bold">98%</p>
                        <p class="text-gray-300">Customer Satisfaction</p>
                    </div>
                </div>
            </section>

            <!-- Meet Our Team Section -->
            <section class="mb-16">
                <h2 class="text-2xl font-bold mb-8 text-center">Meet Our Team</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="flex flex-col items-center text-center space-y-3 animate-fade-in" style="animation-delay: 0s;">
                        <div class="h-32 w-32 rounded-full border-4 border-white shadow-lg overflow-hidden">
                            <img src="https://imgs.search.brave.com/C61sbFRuuQ0NT-ALW43Xw6T9Ip0dlPrnid-EN0d8A24/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9lbmNk/bi5yYXRvcGF0aS5j/b20vbWVkaWEvbmV3/cy9ZdWJyYWotU2Fm/YWxfaXFVeEJLbFYx/NS5qcGc" alt="Team Member 1" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Kritish Devkota</h3>
                            <p class="text-gray-500">CEO & Founder</p>
                        </div>
                        <p class="text-gray-600 text-sm">Kritish founded TicketSewa with a vision to transform bus travel booking. With over 1 years in the transportation industry, she leads our company's strategic growth.</p>
                    </div>
                    <div class="flex flex-col items-center text-center space-y-3 animate-fade-in" style="animation-delay: 0.15s;">
                        <div class="h-32 w-32 rounded-full border-4 border-white shadow-lg overflow-hidden">
                            <img src="https://imgs.search.brave.com/wOrFroJEh63ZYfq3EVyyEwdo3ZglSqcTZuXFK-R5zAo/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/YWxqYXplZXJhLmNv/bS93cC1jb250ZW50/L3VwbG9hZHMvMjAx/OS8wMy9lZjhkOGM1/MzI1ODU0ZmJlYjVi/ZTVkNTBjNTM0Yzhj/MV8xOC5qcGVnP3Jl/c2l6ZT03NzAsNTEz/JnF1YWxpdHk9ODA" alt="Team Member 2" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Saroj Dhungana</h3>
                            <p class="text-gray-500">CTO</p>
                        </div>
                        <p class="text-gray-600 text-sm">Saroj oversees all technical aspects of TicketSewa. His expertise in building scalable platforms ensures our booking system is reliable and user-friendly.</p>
                    </div>
                    <div class="flex flex-col items-center text-center space-y-3 animate-fade-in" style="animation-delay: 0.3s;">
                        <div class="h-32 w-32 rounded-full border-4 border-white shadow-lg overflow-hidden">
                            <img src="https://imgs.search.brave.com/zw7ytDuiP1UcYXL2tSkbbiZpEeQkTqjKNvU498Fa8lk/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy9i/L2I5L0JQX0tvaXJh/bGEuanBn" alt="Team Member 3" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Biplov Bartaula</h3>
                            <p class="text-gray-500">COO</p>
                        </div>
                        <p class="text-gray-600 text-sm">Biplov manages day-to-day operations, working closely with bus operators to ensure quality service and expand our network of routes across the Cities.</p>
                    </div>
                    <div class="flex flex-col items-center text-center space-y-3 animate-fade-in" style="animation-delay: 0.45s;">
                        <div class="h-32 w-32 rounded-full border-4 border-white shadow-lg overflow-hidden">
                            <img src="https://imgs.search.brave.com/hu03MYWCcC0YTx2WAvg954ZaFnhg7CsuO7pNbJMDpp8/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9uZXBh/bG5ld3MuY29tL3dw/LWNvbnRlbnQvdXBs/b2Fkcy8yMDI1LzAx/L3JhYmktbGFtaWNo/ZS5qcGc" alt="Team Member 4" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Ravi Lamichanne</h3>
                            <p class="text-gray-500">Head of Customer Experience</p>
                        </div>
                        <p class="text-gray-600 text-sm">Ravi is dedicated to creating exceptional customer journeys. He leads our support team and constantly works to improve the booking experience.</p>
                    </div>
                </div>
            </section>

            <!-- Call to Action -->
            <section class="max-w-3xl mx-auto text-center">
                <h2 class="text-2xl font-bold mb-4">Ready to Experience Better Bus Travel?</h2>
                <p class="text-gray-600 mb-8">
                    Join millions of travelers who have discovered the convenience of booking bus tickets online with TicketSewa.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="/" class="bg-black text-white px-6 py-3 rounded-md font-medium hover:bg-gray-800 transition-colors">
                        Book a Ticket
                    </a>
                    <a href="/contact" class="bg-white text-black border border-black px-6 py-3 rounded-md font-medium hover:bg-gray-100 transition-colors">
                        Contact Us
                    </a>
                </div>
            </section>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
