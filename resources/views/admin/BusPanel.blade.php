<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bus Panel</title>
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
            
            
            
        <div role="button" data-section="busList" class="flex items-center w-full p-3 rounded-lg...">
            <div class="grid place-items-center mr-4">
                <i class="fa-solid fa-bus"></i>
            </div>Bus List
        </div>
        <div role="button" data-section="bookingHistory" class="flex items-center w-full p-3 bg-blue-100 rounded-lg...">
            <div class="grid place-items-center mr-4">
                <i class="fa-solid fa-rectangle-history-circle-user"></i>
            </div>Booking History
        </div>
        <div role="button" data-section="statistics" class="flex items-center w-full p-3 rounded-lg...">
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
        <!-- Buslist Section -->
        <div id="busListSection" class="min-h-screen p-4 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 lg:p-8 shadow-lg w-full max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <i class="fa-solid fa-bus text-3xl text-blue-500 mr-4"></i>
                        <h2 class="text-2xl font-semibold text-blue-900">Bus List</h2>
                    </div>
                    <a href="{{ route('admin.add-bus') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        <i class="fa-solid fa-plus mr-2"></i>Add New Bus
                    </a>
                </div>

                @if($buses->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-bus text-4xl mb-4"></i>
                        <p>No buses found</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th class="py-3 px-4 text-left">Operator Name</th>
                                    <th class="py-3 px-4 text-left">From</th>
                                    <th class="py-3 px-4 text-left">To</th>
                                    <th class="py-3 px-4 text-left">Departure Time</th>
                                    <th class="py-3 px-4 text-left">Arrival Time</th>
                                    <th class="py-3 px-4 text-left">Journey Date</th>
                                    <th class="py-3 px-4 text-left">Original Price</th>
                                    <th class="py-3 px-4 text-left">Discount Price</th>
                                    <th class="py-3 px-4 text-left">Available Seats</th>
                                    <th class="py-3 px-4 text-left">Bus Type</th>
                                    <th class="py-3 px-4 text-left">Boarding Point</th>
                                    <th class="py-3 px-4 text-left">Created At</th>
                                    <th class="py-3 px-4 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($buses as $bus)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $bus->operator_name }}</td>
                                    <td class="py-3 px-4">{{ $bus->from_location }}</td>
                                    <td class="py-3 px-4">{{ $bus->to_location }}</td>
                                    <td class="py-3 px-4">{{ $bus->departure_time ? date('h:i A', strtotime($bus->departure_time)) : 'N/A' }}</td>
                                    <td class="py-3 px-4">{{ $bus->arrival_time ? date('h:i A', strtotime($bus->arrival_time)) : 'N/A' }}</td>
                                    <td class="py-3 px-4">{{ $bus->journey_date ? date('d M Y', strtotime($bus->journey_date)) : 'N/A' }}</td>
                                    <td class="py-3 px-4">BDT {{ number_format($bus->original_price, 2) }}৳</td>
                                    <td class="py-3 px-4">BDT {{ number_format($bus->discounted_price, 2) }}৳</td>
                                    <td class="py-3 px-4">{{ $bus->available_seats }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 rounded-full text-xs 
                                        {{ $bus->bus_type === 'AC' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $bus->bus_type }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">{{ $bus->boarding_point ?? 'N/A' }}</td>
                                    <td class="py-3 px-4">{{ $bus->created_at ? $bus->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                    <td class="py-3 px-4">
                                        <form action="{{ route('admin.delete-bus', $bus->id) }}" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to delete this bus?');"
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
        <!-- Bus Bookings Section -->
        <div id="busBookingsSection" class="min-h-screen p-4 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 lg:p-8 shadow-lg w-full max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <i class="fa-solid fa-bus text-3xl text-blue-500 mr-4"></i>
                        <h2 class="text-2xl font-semibold text-blue-900">Bus Booking History</h2>
                    </div>  
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($bookings->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-ticket-simple text-4xl mb-4"></i>
                        <p>No bus bookings found</p>
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
                                    <th class="py-3 px-4 text-left">Bus Type</th>
                                    <th class="py-3 px-4 text-left">Operator</th>
                                    <th class="py-3 px-4 text-left">Boarding Point</th>
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
                                    <td class="py-3 px-4">{{ $booking->bus_type }}</td>
                                    <td class="py-3 px-4">{{ $booking->operator_name }}</td>
                                    <td class="py-3 px-4">{{ $booking->boarding_point }}</td>
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
                                            <form action="{{ route('admin.update-booking-status', $booking) }}" method="POST" 
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
            <h2 class="text-2xl font-semibold text-blue-900">Bus Statistics</h2>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Your existing cards... -->
        </div>

        <!-- Top Pie Charts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Payment Status Chart -->
            <div class="flex flex-col items-center">
                <h3 class="text-xl font-medium text-gray-700 mb-4">Payment Status Distribution</h3>
                <div class="w-full h-64">
                    <canvas id="bookingsPieChart"></canvas>
                </div>
            </div>

            <!-- Bus Type Distribution Chart -->
            <div class="flex flex-col items-center">
                <h3 class="text-xl font-medium text-gray-700 mb-4">Bus Type Distribution</h3>
                <div class="w-full h-64">
                    <canvas id="busTypePieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bottom Bar Chart -->
        <div class="mt-8">
            <h3 class="text-xl font-medium text-gray-700 mb-4 text-center">Operator Distribution</h3>
            <div class="w-full h-80">
                <canvas id="operatorBarChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const bookingHistorySection = document.getElementById('busBookingsSection');
    const statisticsSection = document.getElementById('statisticsSection');
    const busListSection = document.getElementById('busListSection');

    // Section switching functionality
    const busListBtn = document.querySelector('[data-section="busList"]'); 
    const bookingHistoryBtn = document.querySelector('[data-section="bookingHistory"]');
    const statisticsBtn = document.querySelector('[data-section="statistics"]');

    function showSection(sectionName) {
        // Hide all sections
        bookingHistorySection.classList.add('hidden');
        statisticsSection.classList.add('hidden');
        busListSection.classList.add('hidden');

        // Remove active class from all buttons
        bookingHistoryBtn.classList.remove('bg-blue-100');
        statisticsBtn.classList.remove('bg-blue-100');
        busListBtn.classList.remove('bg-blue-100');

        // Show selected section and activate corresponding button
        if (sectionName === 'bookingHistory') {
            bookingHistorySection.classList.remove('hidden');
            bookingHistoryBtn.classList.add('bg-blue-100');
        } else if (sectionName === 'statistics') {
            statisticsSection.classList.remove('hidden');
            statisticsBtn.classList.add('bg-blue-100');
            initializeAllCharts();
        } else if (sectionName === 'busList') {
            busListSection.classList.remove('hidden');
            busListBtn.classList.add('bg-blue-100');
        }
    }

    // Add click handlers
    bookingHistoryBtn.addEventListener('click', () => showSection('bookingHistory'));
    statisticsBtn.addEventListener('click', () => showSection('statistics'));
    busListBtn.addEventListener('click', () => showSection('busList'));

    // Mobile menu handling
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        if (window.innerWidth < 1024) {
            if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                sidebar.classList.add('hidden');
            }
        }
    });

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

        const paidBookings = {{ $stats['paid'] }};
        const pendingBookings = {{ $stats['pending'] }};

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

        // Operator Distribution Bar Chart
        const operatorCanvas = document.getElementById('operatorBarChart');
        if (window.operatorChart) {
            window.operatorChart.destroy();
        }

        const operatorData = @json($operatorStats);
        const operators = Object.keys(operatorData);
        const operatorCounts = Object.values(operatorData);

        window.operatorChart = new Chart(operatorCanvas, {
            type: 'bar',
            data: {
                labels: operators,
                datasets: [{
                    label: 'Number of Buses',
                    data: operatorCounts,
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
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw || 0;
                                const total = operatorCounts.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value * 100) / total);
                                return `${value} buses (${percentage}%)`;
                            }
                        }
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
                            text: 'Number of Buses'
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        },
                        title: {
                            display: true,
                            text: 'Operators'
                        }
                    }
                }
            }
        });

        // Bus Type Distribution Chart
        const busTypeCanvas = document.getElementById('busTypePieChart');
        if (window.busTypeChart) {
            window.busTypeChart.destroy();
        }

        const busTypeData = @json($busTypeStats);
        window.busTypeChart = new Chart(busTypeCanvas, {
            type: 'pie',
            data: {
                labels: Object.keys(busTypeData),
                datasets: [{
                    data: Object.values(busTypeData),
                    backgroundColor: ['#3b82f6', '#6b7280'],
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
                                const total = Object.values(busTypeData).reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value * 100) / total);
                                return `${label}: ${value} buses (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Show bus list by default
    showSection('busList');
});
</script>

</body>
</html>