<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">

<!-- Navigation -->
<nav class="p-3 flex mt-2 justify-between items-center">
    <a href="{{ route('admin.dashboard') }}" id="brand">
        <img class="object-cover max-w-30 max-h-20 ml-10" src="{{ asset('images/journylyLOGO.png') }}" alt="">
    </a>
    <div id="nav-menu" class="hidden md:flex gap-10">
        <a href="{{ route('admin.dashboard') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Dashboard</a>
        <a href="{{ route('admin.feedbacks') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Feedbacks</a>
        <a href="" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Hotel Panel</a>
        <a href="{{ route('admin.flightpanel') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Flight Panel</a>
        <a href="{{ route('admin.buspanel') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Bus Panel</a>
        <a href="" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Train Panel</a>
    </div>

    <div class="mr-12 hidden md:block relative" x-data="{ open: false }">
        @auth
            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500">
                <i class="fa-solid fa-user"></i>
                <span class="font-medium">{{ Auth::user()->name }}</span>
                <i class="fa-solid fa-caret-down"></i>
            </button>
            
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-400 transition-colors duration-300 ease-in-out rounded-lg">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-400 transition-colors duration-300 ease-in-out rounded-lg">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</nav>

<!-- Dashboard Content -->
<div class="p-6 max-w-7xl mx-auto">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Total Users</p>
                    <h3 class="text-2xl font-bold">{{ $stats['total_users'] }}</h3>
                </div>
                <div class="p-3 bg-blue-500 rounded-full">
                    <i class="fa-solid fa-users text-white text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Total Bookings</p>
                    <h3 class="text-2xl font-bold">{{ $stats['total_bookings'] }}</h3>
                </div>
                <div class="p-3 bg-green-500 rounded-full">
                    <i class="fa-solid fa-ticket text-white text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Total Revenue</p>
                    <h3 class="text-2xl font-bold">৳{{ number_format($stats['total_revenue']) }}</h3>
                </div>
                <div class="p-3 bg-purple-500 rounded-full">
                    <i class="fa-solid fa-money-bill text-white text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Recent Feedbacks -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Recent Feedbacks</p>
                    <h3 class="text-2xl font-bold">{{ $stats['recent_feedbacks'] }}</h3>
                </div>
                <div class="p-3 bg-orange-500 rounded-full">
                    <i class="fa-solid fa-comments text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold">Recent Bookings</h2>
            <a href="{{ route('admin.buspanel') }}" class="text-blue-500 hover:text-blue-700">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">From</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">To</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentBookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->from_location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->to_location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">৳{{ number_format($booking->amount) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $booking->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.add-bus') }}" class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fa-solid fa-bus text-blue-500"></i>
                </div>
                <div>
                    <h3 class="font-semibold">Add New Bus</h3>
                    <p class="text-sm text-gray-500">Create new bus schedule</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.add-flight') }}" class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="fa-solid fa-plane text-purple-500"></i>
                </div>
                <div>
                    <h3 class="font-semibold">Add New Flight</h3>
                    <p class="text-sm text-gray-500">Create new flight schedule</p>
                </div>
            </div>
        </a>

        <a href="" class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fa-solid fa-hotel text-green-500"></i>
                </div>
                <div>
                    <h3 class="font-semibold">Add New Hotel</h3>
                    <p class="text-sm text-gray-500">Create new Hotel schedule</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.add-flight') }}" class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-red-100 rounded-full">
                    <i class="fa-solid fa-train text-red-500"></i>
                </div>
                <div>
                    <h3 class="font-semibold">Add New Train</h3>
                    <p class="text-sm text-gray-500">Create new Train schedule</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.feedbacks') }}" class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-yellow-100 rounded-full">
                    <i class="fa-solid fa-comments text-yellow-500"></i>
                </div>
                <div>
                    <h3 class="font-semibold">View Feedbacks</h3>
                    <p class="text-sm text-gray-500">Check customer feedback</p>
                </div>
            </div>
        </a>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg mb-8 mt-10">
    <h2 class="text-xl font-semibold mb-4">Booking Distribution</h2>
    <canvas id="bookingTypeChart" class="w-full h-64"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('bookingTypeChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys({!! json_encode($bookingStats) !!}),
            datasets: [{
                label: 'Total Bookings',
                data: Object.values({!! json_encode($bookingStats) !!}),
                backgroundColor: [
                    'rgba(59, 130, 246, 0.5)',  // Bus
                    'rgba(16, 185, 129, 0.5)',  // Flight 
                    'rgba(249, 115, 22, 0.5)',  // Train
                    'rgba(139, 92, 246, 0.5)'   // Hotel
                ],
                borderColor: [
                    'rgb(59, 130, 246)',
                    'rgb(16, 185, 129)',
                    'rgb(249, 115, 22)', 
                    'rgb(139, 92, 246)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>