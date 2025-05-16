<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>TicketSewa - Customer Support</title>
</head>
<body class="bg-gray-50">
    @include('partials.header')
    <div class="min-h-screen py-28">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl md:text-3xl font-bold text-center mb-4">Customer Support</h1>
            <p class="text-gray-600 text-center max-w-2xl mx-auto mb-12">
                We're here to help with any questions or concerns you may have about your bus journey.
            </p>

            <!-- Contact Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
                <!-- Call Us -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="p-6 flex flex-col items-center text-center">
                        <div class="h-12 w-12 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                            <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold mb-2">Call Us</h2>
                        <p class="text-gray-600 mb-4">
                            Our support team is available 24/7 to assist you.
                        </p>
                        <p class="font-medium">+977 1-1234567</p>
                        <p class="text-sm text-gray-500">Available in Nepal</p>
                    </div>
                </div>

                <!-- Email Us -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="p-6 flex flex-col items-center text-center">
                        <div class="h-12 w-12 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                            <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8v8h18V8H3zm9 6H6m6 0h6m-6 0v-4"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold mb-2">Email Us</h2>
                        <p class="text-gray-600 mb-4">
                            Send us an email and we'll get back to you within 24 hours.
                        </p>
                        <p class="font-medium">support@ticketssewa.com</p>
                        <p class="text-sm text-gray-500">For all inquiries</p>
                    </div>
                </div>

                <!-- Live Chat -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="p-6 flex flex-col items-center text-center">
                        <div class="h-12 w-12 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                            <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5v-2a2 2 0 012-2h10a2 2 0 012 2v2h-4m-6 0h.01M12 16h.01"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold mb-2">Bot Chat</h2>
                        <p class="text-gray-600 mb-4">
                            Get instant support through our live AI-chat service.
                        </p>
                        <button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors" disabled>
                            (Coming Soon)
                        </button>
                        <p class="text-sm text-gray-500 mt-2">Available 8 AM - 10 PM NPT</p>
                    </div>
                </div>
            </div>

            <!-- FAQs Section -->
            <div class="max-w-3xl mx-auto mb-16">
                <h2 class="text-2xl font-bold text-center mb-8">Frequently Asked Questions</h2>
                <div class="w-full">
                    <details class="border-b border-gray-200 py-2">
                        <summary class="text-left font-medium cursor-pointer">How do I book a ticket on TicketSewa?</summary>
                        <p class="text-gray-600 mt-2">
                            Visit our website or app, select your route, date, and seats, then pay via eSewa to confirm your booking.
                        </p>
                    </details>
                    <details class="border-b border-gray-200 py-2">
                        <summary class="text-left font-medium cursor-pointer">What is the cancellation policy?</summary>
                        <p class="text-gray-600 mt-2">
                            Cancellations more than 48 hours before departure get a 90% refund to your eSewa account; 24-48 hours get 75%; 12-24 hours get 50%; less than 12 hours get no refund.
                        </p>
                    </details>
                    <details class="border-b border-gray-200 py-2">
                        <summary class="text-left font-medium cursor-pointer">Can I change my travel date?</summary>
                        <p class="text-gray-600 mt-2">
                            Date changes depend on the bus operator’s policy and seat availability. Contact support at least 24 hours before departure.
                        </p>
                    </details>
                    <details class="border-b border-gray-200 py-2">
                        <summary class="text-left font-medium cursor-pointer">What ID do I need to board the bus?</summary>
                        <p class="text-gray-600 mt-2">
                            Carry a valid citizenship card or passport matching the details provided during booking.
                        </p>
                    </details>
                    <details class="border-b border-gray-200 py-2">
                        <summary class="text-left font-medium cursor-pointer">How do I contact the bus operator?</summary>
                        <p class="text-gray-600 mt-2">
                            Operator details are included in your ticket. You can also contact our support team for assistance.
                        </p>
                    </details>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg">
                    <div class="p-6 text-center">
                        <h2 class="text-2xl font-semibold">Send Us a Message</h2>
                    </div>
                    <div class="p-6">
                        <form action="#" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                                    <input id="name" name="name" type="text" placeholder="John Doe" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address *</label>
                                    <input id="email" name="email" type="email" placeholder="you@example.com" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                                <input id="subject" name="subject" type="text" placeholder="How can we help you?" class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div class="space-y-2">
                                <label for="message" class="block text-sm font-medium text-gray-700">Message *</label>
                                <textarea id="message" name="message" placeholder="Please describe your issue or question in detail..." required class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 h-32"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Send Message</button>
                            <p class="text-sm text-gray-500 text-center mt-2">Note: This will Send Message through your own email.</p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">Our Location</h2>
                <div class="w-full h-96 rounded-lg overflow-hidden">
                    <iframe
                        class="w-full h-full"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.241263857735!2d84.41894812474345!3d27.702416670403032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjcLNzA3JzEwLjAiUyA4NC4zNzUuMTIgZDg4!5e0!3m2!1sen!2sus!4v1698765432109!5m2!1sen!2sus"
                        frameborder="0"
                        style="border:0;"
                        allowfullscreen=""
                        aria-hidden="false"
                        tabindex="0"
                    ></iframe>
                </div>

            </div>
        </div>
    </div>
    @include('partials.footer')
</body>
</html>
