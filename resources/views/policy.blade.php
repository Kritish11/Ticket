<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>TicketSewa - Terms and Conditions</title>
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <div class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-center mb-8">Terms and Conditions</h1>

        <!-- Acceptance of Terms -->
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="p-6">
                <h2 class="text-xl font-semibold">Acceptance of Terms</h2>
            </div>
            <div class="p-6">
                <p>
                    By accessing or using TicketSewa's website, mobile application, or any of our services, you agree to be bound by these Terms and Conditions. If you do not agree to all the terms and conditions, you may not access or use our services.
                </p>
            </div>
        </div>

        <!-- Booking and Ticketing -->
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="p-6">
                <h2 class="text-xl font-semibold">Booking and Ticketing</h2>
            </div>
            <div class="p-6 space-y-4">
                <p>When making a booking through our platform:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>You must provide accurate and complete information for all passengers.</li>
                    <li>Tickets are valid only for the specified date, time, and bus service.</li>
                    <li>You are responsible for arriving at the boarding point in sufficient time before departure.</li>
                    <li>All passengers must carry valid identification (e.g., citizenship card or passport) that matches the details provided during booking.</li>
                    <li>TicketSewa serves as an intermediary between you and Nepali bus operators. The transportation service is provided by the bus operator, who maintains their own terms and conditions.</li>
                </ul>
            </div>
        </div>

        <!-- Cancellations and Refunds -->
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="p-6">
                <h2 class="text-xl font-semibold">Cancellations and Refunds</h2>
            </div>
            <div class="p-6 space-y-4">
                <p>Our cancellation and refund policy for payments made via eSewa is as follows:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Cancellations more than 48 hours before departure: 90% refund to your eSewa account.</li>
                    <li>Cancellations between 24-48 hours before departure: 75% refund to your eSewa account.</li>
                    <li>Cancellations between 12-24 hours before departure: 50% refund to your eSewa account.</li>
                    <li>Cancellations less than 12 hours before departure: No refund.</li>
                    <li>Refunds will be processed to your eSewa account within 5-7 business days.</li>
                    <li>In case of cancellation by the bus operator, a full refund will be provided to your eSewa account.</li>
                </ul>
                <p class="mt-4">
                    Please note that specific Nepali bus operators may have different cancellation policies, which will be communicated during the booking process.
                </p>
            </div>
        </div>

        <!-- User Accounts -->
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="p-6">
                <h2 class="text-xl font-semibold">User Accounts</h2>
            </div>
            <div class="p-6 space-y-4">
                <p>When creating and using an account on our platform:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
                    <li>You agree to notify us immediately of any unauthorized use of your account.</li>
                    <li>We reserve the right to suspend or terminate accounts that violate our terms or engage in fraudulent activity.</li>
                </ul>
            </div>
        </div>

        <!-- Prohibited Activities -->
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="p-6">
                <h2 class="text-xl font-semibold">Prohibited Activities</h2>
            </div>
            <div class="p-6 space-y-4">
                <p>You agree not to:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Use our services for any illegal purpose.</li>
                    <li>Interfere with or disrupt our services or servers.</li>
                    <li>Attempt to gain unauthorized access to any part of our platform.</li>
                    <li>Use automated systems or software to extract data from our website.</li>
                    <li>Impersonate any person or entity.</li>
                    <li>Submit false or misleading information.</li>
                </ul>
            </div>
        </div>

        <!-- Limitation of Liability -->
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="p-6">
                <h2 class="text-xl font-semibold">Limitation of Liability</h2>
            </div>
            <div class="p-6">
                <p>
                    TicketSewa will not be liable for any indirect, incidental, special, consequential, or punitive damages, including loss of profits, data, or goodwill, resulting from your access to or use of our services. In no event shall our total liability exceed the amount paid by you via eSewa for the service in question.
                </p>
            </div>
        </div>

        <!-- Modifications to Terms -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6">
                <h2 class="text-xl font-semibold">Modifications to Terms</h2>
            </div>
            <div class="p-6">
                <p>
                    We reserve the right to modify these Terms and Conditions at any time. Changes will be effective immediately upon posting on our website. Your continued use of our services after any changes indicates your acceptance of the modified terms.
                </p>
                <p class="mt-4">
                    Last Updated: April 29, 2025
                </p>
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>
</html>
