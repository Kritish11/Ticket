<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Ticketsewa Admin</title>
    <style>
        [x-cloak] { display: none !important; }

        .splash-screen {
            position: fixed;
            inset: 0;
            background: white;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .splash-content {
            text-align: center;
            transform: translateY(0);
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-out {
            opacity: 0;
            transform: scale(1.1);
        }

        .fade-out .splash-content {
            transform: translateY(-20px);
        }

        .loading-dots {
            display: inline-flex;
            gap: 8px;
            margin-top: 16px;
        }

        .loading-dots div {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #000;
            animation: bounce 0.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        .loading-dots div:nth-child(2) {
            animation-delay: 0.1s;
        }

        .loading-dots div:nth-child(3) {
            animation-delay: 0.2s;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); opacity: 0.5; }
            50% { transform: translateY(-10px); opacity: 1; }
        }

        .content-wrapper {
            opacity: 0;
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .content-wrapper.show {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Modern Splash Screen -->
    <div id="splash" class="splash-screen">
        <div class="splash-content">
            <div class="mb-6">
                <!-- Logo/Brand Icon -->
                <svg class="w-24 h-24 mx-auto" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="black" stroke-width="2"/>
                    <path d="M30 50 L70 50" stroke="black" stroke-width="2" stroke-linecap="round">
                        <animate attributeName="d"
                            dur="1.5s"
                            repeatCount="indefinite"
                            values="M30 50 L70 50;
                                    M30 50 C50 20, 50 80, 70 50;
                                    M30 50 L70 50"/>
                    </path>
                </svg>
            </div>
            <div class="font-bold text-3xl mb-2">TicketSewa</div>
            <div class="text-gray-500 mb-4">Administration Panel</div>
            <!-- Modern Loading Dots -->
            <div class="loading-dots">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div x-data="{ activeSection: 'dashboard' }"
         x-cloak
         class="content-wrapper"
         id="mainContent">
        <!-- Sidebar -->
        @include('AdminViews.sidebar.sidebar')
        <!-- Main Content with left padding to account for fixed sidebar -->
        <div class="flex-1 pl-64 min-h-screen">
            <div x-show="activeSection === 'dashboard'">
                @include('AdminViews.dashboard')
            </div>
            <div x-show="activeSection === 'buses'">
                @include('AdminViews.buses')
            </div>
            <div x-show="activeSection === 'routes'">
                @include('AdminViews.routes')
            </div>
            <div x-show="activeSection === 'bookings'">
                @include('AdminViews.bookings')
            </div>
            <div x-show="activeSection === 'schedule'">
                @include('AdminViews.schedule')
            </div>
            <div x-show="activeSection === 'features'" class="p-8">
                @include('AdminViews.features')
            </div>
            <div x-show="activeSection === 'reports'">
                @include('AdminViews.advertisements')
            </div>
            <div x-show="activeSection === 'blogs'">
                @include('AdminViews.blog')
            </div>
            <div x-show="activeSection === 'settings'" class="p-8">
                @include('AdminViews.settings')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const splash = document.getElementById('splash');
            const mainContent = document.getElementById('mainContent');

            // Show splash screen for 2 seconds
            setTimeout(() => {
                splash.classList.add('fade-out');
                setTimeout(() => {
                    splash.style.display = 'none';
                    mainContent.classList.add('show');
                }, 300);
            }, 2000);
        });
    </script>
</body>
</html>
