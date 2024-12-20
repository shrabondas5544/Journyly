<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Flight Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">

<!-- Mobile Menu Button -->
<div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="mobileMenuBtn" class="p-2 bg-white rounded-lg shadow-lg">
        <i class="fa-solid fa-bars text-xl"></i>
    </button>
</div>

<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Sidebar -->
    <div id="sidebar" class="fixed lg:relative hidden lg:flex flex-col bg-blue-50 text-gray-700 h-screen w-full lg:w-64 p-4 shadow-xl z-40 lg:z-0">
        <div>            
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('images/journylyLOGO.png') }}" alt="Logo" class="w-64 h-32 object-contain">
                </a>       
            </div>
        </div>
        <nav class="flex flex-col gap-1 min-w-[240px] p-2 font-sans text-base font-normal text-gray-700">
            <div role="button" data-section="flightList" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200">
                <div class="grid place-items-center mr-4">
                    <i class="fa-solid fa-plane"></i>
                </div>Flight List
            </div>
            <div role="button" data-section="bookingHistory" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200">
                <div class="grid place-items-center mr-4">
                    <i class="fa-solid fa-table-list"></i>
                </div>Booking History
            </div>
            <div role="button" data-section="statistics" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200">
                <div class="grid place-items-center mr-4">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>Statistics
            </div>
            <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                    <div class="grid place-items-center mr-4">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                    Log Out
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 min-h-screen">
        <!-- Flight List Section -->
        <div id="flightListSection" class="min-h-screen p-4 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 lg:p-8 shadow-lg w-full max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <i class="fa-solid fa-plane text-3xl text-blue-500 mr-4"></i>
                        <h2 class="text-2xl font-semibold text-blue-900">Flight List</h2>
                    </div>
                    <a href="{{ route('admin.add-flight') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        <i class="fa-solid fa-plus mr-2"></i>Add New Flight
                    </a>
                </div>

                @if($flights->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-plane text-4xl mb-4"></i>
                        <p>No flights found</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th class="py-3 px-4 text-left">Airline</th>
                                    <th class="py-3 px-4 text-left">From</th>
                                    <th class="py-3 px-4 text-left">To</th>
                                    <th class="py-3 px-4 text-left">Flight Number</th>
                                    <th class="py-3 px-4 text-left">Departure</th>
                                    <th class="py-3 px-4 text-left">Arrival</th>
                                    <th class="py-3 px-4 text-left">Date</th>
                                    <th class="py-3 px-4 text-left">Original Price</th>
                                    <th class="py-3 px-4 text-left">Discount Price</th>
                                    <th class="py-3 px-4 text-left">Available Seats</th>
                                    <th class="py-3 px-4 text-left">Class</th>
                                    <th class="py-3 px-4 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($flights as $flight)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $flight->airline_name }}</td>
                                    <td class="py-3 px-4">{{ $flight->from_location }}</td>
                                    <td class="py-3 px-4">{{ $flight->to_location }}</td>
                                    <td class="py-3 px-4">{{ $flight->flight_number }}</td>
                                    <td class="py-3 px-4">{{ $flight->getReadableDepartureTime() }}</td>
                                    <td class="py-3 px-4">{{ $flight->getReadableArrivalTime() }}</td>
                                    <td class="py-3 px-4">{{ $flight->departure_date ? date('d M Y', strtotime($flight->departure_date)) : 'N/A' }}</td>
                                    <td class="py-3 px-4">BDT {{ number_format($flight->original_price, 2) }}৳</td>
                                    <td class="py-3 px-4">BDT {{ number_format($flight->discounted_price, 2) }}৳</td>
                                    <td class="py-3 px-4">{{ $flight->available_seats }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            {{ $flight->flight_class === 'Business' ? 'bg-blue-100 text-blue-800' : 
                                               ($flight->flight_class === 'First' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $flight->flight_class }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <form action="{{ route('admin.delete-flight', $flight->id) }}" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to delete this flight?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Flight Bookings Section -->
        <div id="bookingHistorySection" class="min-h-screen p-4 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 lg:p-8 shadow-lg w-full max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <i class="fa-solid fa-plane text-3xl text-blue-500 mr-4"></i>
                        <h2 class="text-2xl font-semibold text-blue-900">Flight Booking History</h2>
                    </div>
                </div>

                @if($bookings->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-ticket-simple text-4xl mb-4"></i>
                        <p>No flight bookings found</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th class="py-3 px-4 text-left">Booking Date</th>
                                    <th class="py-3 px-4 text-left">Username</th>
                                    <th class="py-3 px-4 text-left">Email</th>
                                    <th class="py-3 px-4 text-left">Phone</th>
                                    <th class="py-3 px-4 text-left">From</th>
                                    <th class="py-3 px-4 text-left">To</th>
                                    <th class="py-3 px-4 text-left">Flight Class</th>
                                    <th class="py-3 px-4 text-left">Airline</th>
                                    <th class="py-3 px-4 text-left">Flight No.</th>
                                    <th class="py-3 px-4 text-left">Journey Date</th>
                                    <th class="py-3 px-4 text-left">Passengers</th>
                                    <th class="py-3 px-4 text-left">Total</th>
                                    <th class="py-3 px-4 text-left">Status</th>
                                    <th class="py-3 px-4 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($bookings as $booking)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $booking->booking_date }}</td>
                                    <td class="py-3 px-4">{{ $booking->user_name }}</td>
                                    <td class="py-3 px-4">{{ $booking->user->email }}</td>
                                    <td class="py-3 px-4">{{ $booking->user->phone }}</td>
                                    <td class="py-3 px-4">{{ $booking->from_location }}</td>
                                    <td class="py-3 px-4">{{ $booking->to_location }}</td>
                                    <td class="py-3 px-4">{{ $booking->flight_class }}</td>
                                    <td class="py-3 px-4">{{ $booking->airline_name }}</td>
                                    <td class="py-3 px-4">{{ $booking->flight_number }}</td>
                                    <td class="py-3 px-4">{{ $booking->departure_date }}</td>
                                    <td class="py-3 px-4">{{ $booking->number_of_passengers }}</td>
                                    <td class="py-3 px-4">BDT {{ number_format($booking->total, 2) }}৳</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            {{ $booking->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($booking->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($booking->payment_status === 'pending')
                                            <form action="{{ route('admin.update-flight-booking-status', $booking) }}" method="POST" 
                                                class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-blue-500 hover:text-blue-700 mr-2" title="Mark as Paid">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Statistics Section -->
        <div id="statisticsSection" class="min-h-screen p-4 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 lg:p-8 shadow-lg w-full max-w-7xl mx-auto">
                <div class="flex items-center mb-6">
                    <i class="fa-solid fa-chart-pie text-3xl text-blue-500 mr-4"></i>
                    <h2 class="text-2xl font-semibold text-blue-900">Flight Statistics</h2>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 p-6 rounded-xl shadow hover:text-blue-100 transition-scale duration-300 ease-in-out hover:scale-95 ">
                        <h3 class="text-lg font-medium text-gray-700 mb-2 ">Total Flights</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $stats['total_flights'] }}</p>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-xl shadow hover:text-blue-100 transition-scale duration-300 ease-in-out hover:scale-95">
                        <h3 class="text-lg font-medium text-gray-700 mb-2">Total Bookings</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $stats['total_bookings'] }}</p>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-xl shadow hover:text-blue-100 transition-scale duration-300 ease-in-out hover:scale-95">
                        <h3 class="text-lg font-medium text-gray-700 mb-2">Total Revenue</h3>
                        <p class="text-3xl font-bold text-blue-600">BDT {{ number_format($stats['total_revenue'], 2) }}৳</p>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Payment Status Chart -->
                    <div class="flex flex-col items-center">
                        <h3 class="text-xl font-medium text-gray-700 mb-4">Payment Status Distribution</h3>
                        <div class="w-full h-64">
                            <canvas id="bookingsPieChart"></canvas>
                        </div>
                    </div>

                    <!-- Flight Class Distribution Chart -->
                    <div class="flex flex-col items-center">
                        <h3 class="text-xl font-medium text-gray-700 mb-4">Flight Class Distribution</h3>
                        <div class="w-full h-64">
                            <canvas id="flightClassPieChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Airline Distribution Chart -->
                <div class="mt-8">
                    <h3 class="text-xl font-medium text-gray-700 mb-4 text-center">Airline Distribution</h3>
                    <div class="w-full h-80">
                        <canvas id="airlineBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const bookingHistorySection = document.getElementById('bookingHistorySection');
    const statisticsSection = document.getElementById('statisticsSection');
    const flightListSection = document.getElementById('flightListSection');

    // Section switching functionality
    const flightListBtn = document.querySelector('[data-section="flightList"]');
    const bookingHistoryBtn = document.querySelector('[data-section="bookingHistory"]');
    const statisticsBtn = document.querySelector('[data-section="statistics"]');

    function showSection(sectionName) {
        // Hide all sections
        bookingHistorySection.classList.add('hidden');
        statisticsSection.classList.add('hidden');
        flightListSection.classList.add('hidden');

        // Remove active class from all buttons
        flightListBtn.classList.remove('bg-blue-100');
        bookingHistoryBtn.classList.remove('bg-blue-100');
        statisticsBtn.classList.remove('bg-blue-100');

        // Show selected section and activate corresponding button
        if (sectionName === 'bookingHistory') {
            bookingHistorySection.classList.remove('hidden');
            bookingHistoryBtn.classList.add('bg-blue-100');
        } else if (sectionName === 'statistics') {
            statisticsSection.classList.remove('hidden');
            statisticsBtn.classList.add('bg-blue-100');
            initializeAllCharts();
        } else if (sectionName === 'flightList') {
            flightListSection.classList.remove('hidden');
            flightListBtn.classList.add('bg-blue-100');
        }
    }

    // Add click handlers
    flightListBtn.addEventListener('click', () => showSection('flightList'));
    bookingHistoryBtn.addEventListener('click', () => showSection('bookingHistory'));
    statisticsBtn.addEventListener('click', () => showSection('statistics'));

    // Mobile menu handling
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 1024) {
            if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                sidebar.classList.add('hidden');
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('hidden');
        } else {
            sidebar.classList.add('hidden');
        }
    });

    function initializeAllCharts() {
        // Payment Status Chart
        const bookingsCanvas = document.getElementById('bookingsPieChart');
        if (window.bookingsChart) {
            window.bookingsChart.destroy();
        }

        const paidBookings = {{ $stats['paid_bookings'] }};
        const pendingBookings = {{ $stats['pending_bookings'] }};

        window.bookingsChart = new Chart(bookingsCanvas, {
            type: 'pie',
            data: {
                labels: ['Paid Bookings', 'Pending Bookings'],
                datasets: [{
                    data: [paidBookings, pendingBookings],
                    backgroundColor: ['#22c55e', '#eab308'],
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = paidBookings + pendingBookings;
                                const percentage = Math.round((value * 100) / total);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Flight Class Distribution Chart
        const flightClassCanvas = document.getElementById('flightClassPieChart');
        if (window.flightClassChart) {
            window.flightClassChart.destroy();
        }

        const flightClassData = @json($stats['flight_class_distribution']);
        window.flightClassChart = new Chart(flightClassCanvas, {
            type: 'pie',
            data: {
                labels: Object.keys(flightClassData),
                datasets: [{
                    data: Object.values(flightClassData),
                    backgroundColor: ['#3b82f6', '#8b5cf6', '#6b7280'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = Object.values(flightClassData).reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value * 100) / total);
                                return `${label}: ${value} flights (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Airline Distribution Chart
        const airlineCanvas = document.getElementById('airlineBarChart');
        if (window.airlineChart) {
            window.airlineChart.destroy();
        }

        const airlineData = @json($stats['airline_distribution']);
        window.airlineChart = new Chart(airlineCanvas, {
            type: 'bar',
            data: {
                labels: Object.keys(airlineData),
                datasets: [{
                    label: 'Number of Flights',
                    data: Object.values(airlineData),
                    backgroundColor: '#3b82f6',
                    borderColor: '#2563eb',
                    borderWidth: 1,
                    borderRadius: 5,
                    maxBarThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        title: {
                            display: true,
                            text: 'Number of Flights'
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        },
                        title: {
                            display: true,
                            text: 'Airlines'
                        }
                    }
                }
            }
        });
    }

    // Show flight list by default
    showSection('flightList');
});
</script>

</body>
</html>