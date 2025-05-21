<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Ticketsewa Admin</title>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50">
    <div x-data="{
            activeSection: 'dashboard',
            setActiveSection(section) {
                this.activeSection = section;
            }
        }"
         x-cloak
         class="min-h-screen">
        @include('AdminViews.sidebar.sidebar')
        <div class="flex-1 pl-64 min-h-screen">
            <div x-show="activeSection === 'dashboard'">
                @include('AdminViews.dashboard')
            </div>
            <div x-show="activeSection === 'buses'">
                @php
                    $buses = \App\Models\Bus::with(['standard'])->get();
                    $features = \App\Models\BusFeature::all();
                @endphp
                @include('AdminViews.buses', ['buses' => $buses, 'features' => $features])
            </div>
            <div x-show="activeSection === 'routes'">
                @include('AdminViews.routes', ['routes' => $routes ?? collect([])])
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
                @php
                    $activeAuthors = \App\Models\author::where('status', 1)
                        ->select('id', 'name', 'image')
                        ->get();
                @endphp
                @include('AdminViews.blog', ['activeAuthors' => $activeAuthors])
            </div>
            <div x-show="activeSection === 'settings'" class="p-8">
                @include('AdminViews.settings')
            </div>
        </div>
    </div>
</body>
</html>
