<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">

<!-- Mobile Menu Button (visible only on mobile) -->
<div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="mobileMenuBtn" class="p-2 bg-white rounded-lg shadow-lg">
        <i class="fa-solid fa-bars text-xl"></i>
    </button>
</div>

<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Sidebar - hidden by default on mobile -->
    <div id="sidebar" class="fixed lg:relative hidden lg:flex flex-col bg-blue-50 text-gray-700 h-screen w-full lg:w-64 p-4 shadow-xl z-40 lg:z-0">
        <div>            
            <!-- Logo and Text Container -->
            <div class="flex items-center gap-3">
                <!-- Logo Image -->
                <a href="{{ route('account.dashboard') }}">
                    <img src="{{ asset('images/journylyLOGO.png') }}" alt="Logo" class="w-64 h-32 object-contain">
                </a>       
            </div>
        </div>
        <nav class="flex flex-col gap-1 min-w-[240px] p-2 font-sans text-base font-normal text-gray-700">
            <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                <div class="grid place-items-center mr-4">
                    <i class="fa-solid fa-user"></i>
                </div>User info
            </div>
            <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                <div class="grid place-items-center mr-4">
                    <i class="fa-solid fa-inbox"></i>
                </div>inbox    
            </div>
            <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
              <div class="grid place-items-center mr-4">
              <i class="fa-solid fa-hotel"></i>
              </div>Hotel history 
            </div>
            <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
              <div class="grid place-items-center mr-4">
              <i class="fa-solid fa-plane"></i>
              </div>Flight history 
            </div>
            <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
              <div class="grid place-items-center mr-4">
              <i class="fa-solid fa-bus"></i> 
              </div>Bus history 
            </div>
            <div role="button" tabindex="0" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
              <div class="grid place-items-center mr-4">
              <i class="fa-solid fa-train"></i>
              </div>Train history 
            </div>
            <form id="logoutForm" action="{{ route('account.logout') }}" method="POST" class="w-full">
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

    <!-- User info Area -->
    <div class="flex-1 min-h-screen">
    <div id="profileSection" class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl p-6 lg:p-8 shadow-lg w-full max-w-2xl mx-auto absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 lg:left-[calc(50%+32px)]">
            <!-- Success Message -->
            @if(session('success') || $errors->any())
                <div id="alert-messages">
                    @if(session('success'))
                        <div class="alert-animation mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert-animation mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endif

            <div class="flex flex-col items-left mb-8">
                <div class="w-24 h-24 bg-blue-200 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-user text-4xl text-blue-500"></i>
                </div>
                <div class="text-left">
                    <h2 class="text-2xl lg:text-3xl font-semibold text-blue-900">Profile Information</h2>
                </div>
            </div>

            <!-- View Mode -->
            <div id="viewMode" class="space-y-6">
                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Name</div>
                    </div>
                    <div class="lg:w-2/3">
                        <input type="text" value="{{ Auth::user()->name }}" class="w-full p-2 border rounded-lg" readonly>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Email</div>
                    </div>
                    <div class="lg:w-2/3">
                        <input type="email" value="{{ Auth::user()->email }}" class="w-full p-2 border rounded-lg" readonly>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Phone</div>
                    </div>
                    <div class="lg:w-2/3">
                        <input type="tel" value="{{ Auth::user()->phone }}" class="w-full p-2 border rounded-lg" readonly>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Address</div>
                    </div>
                    <div class="lg:w-2/3">
                        <textarea class="w-full p-2 border rounded-lg" readonly>{{ Auth::user()->address ?? 'Not provided' }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Sex</div>
                    </div>
                    <div class="lg:w-2/3">
                        <input type="text" value="{{ ucfirst(Auth::user()->sex ?? 'Not provided') }}" class="w-full p-2 border rounded-lg" readonly>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button onclick="toggleEditMode()" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors duration-200">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>
                        Edit Profile
                    </button>
                </div>
            </div>

            <!-- Edit Mode -->
            <form id="profileForm" action="{{ route('account.update-profile') }}" method="POST" class="space-y-6 hidden">
                @csrf
                @method('PUT')
                
                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Name</div>
                    </div>
                    <div class="lg:w-2/3">
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Email</div>
                    </div>
                    <div class="lg:w-2/3">
                        <input type="email" value="{{ Auth::user()->email }}" class="w-full p-2 border rounded-lg bg-gray-50" readonly>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Phone</div>
                    </div>
                    <div class="lg:w-2/3">
                        <input type="tel" name="phone" value="{{ Auth::user()->phone }}" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Address</div>
                    </div>
                    <div class="lg:w-2/3">
                        <textarea name="address" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ Auth::user()->address }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center border-b border-gray-200 pb-4 gap-2">
                    <div class="lg:w-1/3">
                        <div class="text-gray-600">Sex</div>
                    </div>
                    <div class="lg:w-2/3">
                        <select name="sex" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Select gender</option>
                            <option value="male" {{ Auth::user()->sex == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ Auth::user()->sex == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="toggleEditMode()" class="px-4 py-2 border  bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div><!--inbox--><div>
    <div><!--hotel history--></div>
    <!--flight history-->
    <div id="flightHistorySection" class="min-h-screen p-4 flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 lg:p-8 shadow-lg w-full max-w-7xl mx-auto">
            <div class="flex items-center mb-6">
                <i class="fa-solid fa-plane text-3xl text-blue-500 mr-4"></i>
                <h2 class="text-2xl font-semibold text-blue-900">Flight Booking History</h2>
            </div>

            @if($flightBookings->isEmpty())
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
                                <th class="py-3 px-4 text-left">From</th>
                                <th class="py-3 px-4 text-left">To</th>
                                <th class="py-3 px-4 text-left">Airline</th>
                                <th class="py-3 px-4 text-left">Class</th>
                                <th class="py-3 px-4 text-left">Flight No.</th>
                                <th class="py-3 px-4 text-left">Departure</th>
                                <th class="py-3 px-4 text-left">Return</th>
                                <th class="py-3 px-4 text-left">Passengers</th>
                                <th class="py-3 px-4 text-left">Total</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Download</th>
                                <th class="py-3 px-4 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($flightBookings as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $booking->booking_date }}</td>
                                <td class="py-3 px-4">{{ $booking->from_location }}</td>
                                <td class="py-3 px-4">{{ $booking->to_location }}</td>
                                <td class="py-3 px-4">{{ $booking->airline_name }}</td>
                                <td class="py-3 px-4">{{ $booking->flight_class }}</td>
                                <td class="py-3 px-4">{{ $booking->flight_number }}</td>
                                <td class="py-3 px-4">{{ $booking->departure_date }}</td>
                                <td class="py-3 px-4">{{ $booking->return_date ?? 'N/A' }}</td>
                                <td class="py-3 px-4">{{ $booking->number_of_passengers }}</td>
                                <td class="py-3 px-4">BDT {{ number_format($booking->total, 2) }}৳</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 rounded-full text-xs
                                        {{ $booking->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <button onclick="downloadFlightInvoice({
                                        invoiceNo: '{{ $booking->id }}',
                                        date: '{{ $booking->booking_date }}',
                                        passengerName: '{{ Auth::user()->name }}',
                                        phone: '{{ Auth::user()->phone }}',
                                        email: '{{ Auth::user()->email }}',
                                        from: '{{ $booking->from_location }}',
                                        to: '{{ $booking->to_location }}',
                                        total: '{{ $booking->total }}',
                                        airline: '{{ $booking->airline_name }}',
                                        flightClass: '{{ $booking->flight_class }}',
                                        flightNumber: '{{ $booking->flight_number }}',
                                        passengers: '{{ $booking->number_of_passengers }}',
                                        departureDate: '{{ $booking->departure_date }}',
                                        returnDate: '{{ $booking->return_date ?? 'N/A' }}'
                                    })" 
                                    class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                        <i class="fa-solid fa-print fa-fade mr-2"></i>
                                        print
                                    </button>
                                </td>
                                <td class="py-3 px-4">
                                    <form action="{{ route('account.delete-flight-booking', $booking->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this booking?');">
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
    <!--bus history-->
    <div id="busHistorySection" class="min-h-screen p-4 flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 lg:p-8 shadow-lg w-full max-w-7xl mx-auto">
            <div class="flex items-center mb-6">
                <i class="fa-solid fa-bus text-3xl text-blue-500 mr-4"></i>
                <h2 class="text-2xl font-semibold text-blue-900">Bus Booking History</h2>
            </div>

            @if($busBookings->isEmpty())
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
                                <th class="py-3 px-4 text-left">From</th>
                                <th class="py-3 px-4 text-left">To</th>
                                <th class="py-3 px-4 text-left">Bus Type</th>
                                <th class="py-3 px-4 text-left">Operator</th>
                                <th class="py-3 px-4 text-left">Passengers</th>
                                <th class="py-3 px-4 text-left">Total</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Download</th>
                                <th class="py-3 px-4 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($busBookings as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $booking->booking_date }}</td>
                                <td class="py-3 px-4">{{ $booking->from_location }}</td>
                                <td class="py-3 px-4">{{ $booking->to_location }}</td>
                                <td class="py-3 px-4">{{ $booking->bus_type }}</td>
                                <td class="py-3 px-4">{{ $booking->operator_name }}</td>
                                <td class="py-3 px-4">{{ $booking->number_of_passengers }}</td>
                                <td class="py-3 px-4">BDT {{ number_format($booking->total, 2) }}৳</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 rounded-full text-xs 
                                        {{ $booking->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <button onclick="downloadInvoice({
                                        invoiceNo: '{{ $booking->id }}',
                                        date: '{{ $booking->booking_date }}',
                                        passengerName: '{{ Auth::user()->name }}',
                                        phone: '{{ Auth::user()->phone }}',
                                        email: '{{ Auth::user()->email }}',
                                        from: '{{ $booking->from_location }}',
                                        to: '{{ $booking->to_location }}',
                                        total: '{{ $booking->total }}',
                                        operator: '{{ $booking->operator_name }}',
                                        busType: '{{ $booking->bus_type }}',
                                        passengers: '{{ $booking->number_of_passengers }}',
                                        journeyDate: '{{ $booking->journey_date }}',
                                        departureTime: '{{ $booking->departure_time }}',
                                        reportingTime: '{{ $booking->reporting_time }}',
                                        boardingPoint: '{{ $booking->boarding_point }}'
                                    })" 
                                    class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                        <i class="fa-solid fa-print fa-fade mr-2"></i>
                                        Print
                                    </button>
                                </td>
                                <td class="py-3 px-4">
                                    <form action="{{ route('account.delete-bus-booking', $booking->id) }}" method="POST" 
                                        onsubmit="return confirm('Are you sure you want to delete this booking?');">
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
    <div><!--train history--></div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const alertContainer = document.getElementById('alert-messages');
    if (alertContainer) {
        const alerts = alertContainer.querySelectorAll('.alert-animation');
        
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('fade-out');
                setTimeout(() => {
                    alert.remove();
                    // Remove the container if no alerts left
                    if (alertContainer.children.length === 0) {
                        alertContainer.remove();
                    }
                }, 500);
            }, 3000);
        });
    }
});
function toggleEditMode() {
    const viewMode = document.getElementById('viewMode');
    const profileForm = document.getElementById('profileForm');
    
    if (viewMode.style.display === 'none') {
        viewMode.style.display = 'block';
        profileForm.style.display = 'none';
    } else {
        viewMode.style.display = 'none';
        profileForm.style.display = 'block';
    }
}
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Element selectors
    const sidebar = document.getElementById('sidebar');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebarButtons = document.querySelectorAll('[role="button"]');
    const sections = {
        profile: document.getElementById('profileSection'),
        bus: document.getElementById('busHistorySection'),
        flight: document.getElementById('flightHistorySection'),
        inbox: document.getElementById('inboxSection'),
        hotel: document.getElementById('hotelHistorySection'),
        train: document.getElementById('trainHistorySection')
    };

    // Initial setup
    initializePage();

    // Mobile menu toggle
    mobileMenuBtn.addEventListener('click', toggleMobileMenu);

    // Outside click handler for mobile
    document.addEventListener('click', handleOutsideClick);

    // Sidebar navigation
    sidebarButtons.forEach(button => {
        button.addEventListener('click', handleNavigation);
    });

    // Window resize handler
    window.addEventListener('resize', handleResize);

    // Initialize page state
    function initializePage() {
        hideAllSections();
        sections.profile.classList.remove('hidden');
        setActiveButton('user info');
    }

    // Toggle mobile menu
    function toggleMobileMenu() {
        sidebar.classList.toggle('hidden');
    }

    // Handle clicks outside sidebar on mobile
    function handleOutsideClick(event) {
        if (isMobileView() && !sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
            sidebar.classList.add('hidden');
        }
    }

    // Handle sidebar navigation
    function handleNavigation() {
        const buttonText = this.textContent.trim().toLowerCase();
        
        // Update button states
        updateButtonStates(this);
        
        // Update visible section
        hideAllSections();
        showSection(buttonText);
        
        // Handle mobile view
        if (isMobileView()) {
            sidebar.classList.add('hidden');
        }
    }

    // Handle window resize
    function handleResize() {
        if (isMobileView()) {
            sidebar.classList.add('hidden');
        } else {
            sidebar.classList.remove('hidden');
        }
    }

    // Helper functions
    function hideAllSections() {
        Object.values(sections).forEach(section => {
            if (section) {
                section.classList.add('hidden');
            }
        });
    }

    function showSection(buttonText) {
        const sectionMap = {
            'user info': sections.profile,
            'inbox': sections.inbox,
            'hotel history': sections.hotel,
            'flight history': sections.flight,
            'bus history': sections.bus,
            'train history': sections.train
        };

        const section = sectionMap[buttonText];
        if (section) {
            section.classList.remove('hidden');
        }
    }

    function updateButtonStates(activeButton) {
        sidebarButtons.forEach(btn => {
            btn.classList.remove('bg-blue-100');
        });
        activeButton.classList.add('bg-blue-100');
    }

    function setActiveButton(buttonText) {
        sidebarButtons.forEach(btn => {
            if (btn.textContent.trim().toLowerCase() === buttonText) {
                btn.classList.add('bg-blue-100');
            }
        });
    }

    function isMobileView() {
        return window.innerWidth < 1024;
    }
});
</script>
<!--print script-->
<script>
//bus print
function downloadInvoice(bookingData) {
    console.log('Download invoice called with data:', bookingData);
    
    const invoiceContent = `
        <div style="padding: 20px; font-family: Arial, sans-serif;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
                <div>
                    <img src="{{ asset('images/journylyLOGO.png') }}" alt="Journyly Logo" style="margin: 0; max-width: 200px;">
                </div>
                <div style="text-align: right;">
                    <h2 style="margin: 0; color: #333;">Bus Invoice</h2>
                    <p style="margin: 5px 0;">Invoice #: ${bookingData.invoiceNo}</p>
                    <p style="margin: 5px 0;">Booking Date: ${bookingData.date}</p>
                </div>
            </div>

            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; color: #333;">Passenger Information</h3>
                <p style="margin: 5px 0;"><strong>Name:</strong> ${bookingData.passengerName}</p>
                <p style="margin: 5px 0;"><strong>Phone:</strong> ${bookingData.phone || 'N/A'}</p>
                <p style="margin: 5px 0;"><strong>Email:</strong> ${bookingData.email || 'N/A'}</p>
            </div>

            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; color: #333;">Journey Details</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <p style="margin: 5px 0;"><strong>From:</strong> ${bookingData.from}</p>
                        <p style="margin: 5px 0;"><strong>To:</strong> ${bookingData.to}</p>
                        <p style="margin: 5px 0;"><strong>Bus Type:</strong> ${bookingData.busType}</p>
                        <p style="margin: 5px 0;"><strong>Operator:</strong> ${bookingData.operator}</p>
                    </div>
                    <div>
                        <p style="margin: 5px 0;"><strong>Journey Date:</strong> ${bookingData.journeyDate || bookingData.date}</p>
                        <p style="margin: 5px 0;"><strong>Departure Time:</strong> ${bookingData.departureTime || 'N/A'}</p>
                        <p style="margin: 5px 0;"><strong>Reporting Time:</strong> ${bookingData.reportingTime || 'N/A'}</p>
                        <p style="margin: 5px 0;"><strong>Boarding Point:</strong> ${bookingData.boardingPoint || 'N/A'}</p>
                    </div>
                </div>
            </div>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Description</th>
                        <th style="padding: 12px; text-align: center; border-bottom: 1px solid #ddd;">Passengers</th>
                        <th style="padding: 12px; text-align: right; border-bottom: 1px solid #ddd;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                            <p style="margin: 0;">Bus Ticket</p>
                            <p style="margin: 3px 0; color: #666; font-size: 0.9em;">${bookingData.from} to ${bookingData.to}</p>
                            <p style="margin: 3px 0; color: #666; font-size: 0.9em;">${bookingData.busType} - ${bookingData.operator}</p>
                        </td>
                        <td style="padding: 12px; text-align: center; border-bottom: 1px solid #ddd;">${bookingData.passengers}</td>
                        <td style="padding: 12px; text-align: right; border-bottom: 1px solid #ddd;">BDT ${parseFloat(bookingData.total).toLocaleString()}৳</td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right; font-size: 1.2em; font-weight: bold; background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                Total Amount: BDT ${parseFloat(bookingData.total).toLocaleString()}৳
            </div>

            <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; font-size: 0.5em; color: #666;">
                <p style="margin: 5px 0;"><strong>Note:</strong></p>
                <ul style="margin: 5px 0; padding-left: 20px;">
                    <li>Please arrive at the boarding point 15 minutes before departure time</li>
                    <li>Carry a valid ID proof during the journey.No refund on confirmed tickets</li>
                </ul>
            </div>
        </div>
    `;

    const element = document.createElement('div');
    element.innerHTML = invoiceContent;

    const opt = {
        margin: [0.5, 0.5],
        filename: `bus-ticket-${bookingData.invoiceNo}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { 
            scale: 2,
            useCORS: true,
            logging: true
        },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    // Generate and download PDF
    html2pdf().set(opt).from(element).save().then(() => {
        console.log('PDF generated successfully');
    }).catch((error) => {
        console.error('Error generating PDF:', error);
        alert('Error generating PDF. Please try again.');
    });
}

// Verify html2pdf is loaded
document.addEventListener('DOMContentLoaded', function() {
    if (typeof html2pdf === 'undefined') {
        console.error('html2pdf is not loaded');
    } else {
        console.log('html2pdf is loaded successfully');
    }
});

//flightprint
function downloadFlightInvoice(bookingData) {
    console.log('Download flight invoice called with data:', bookingData);
    
    const invoiceContent = `
        <div style="padding: 20px; font-family: Arial, sans-serif;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
                <div>
                    <img src="{{ asset('images/journylyLOGO.png') }}" alt="Journyly Logo" style="max-width: 200px;">
                </div>
                <div style="text-align: right;">
                    <h2 style="margin: 0; color: #333;">Flight Invoice</h2>
                    <p style="margin: 5px 0;">Invoice #: ${bookingData.invoiceNo}</p>
                    <p style="margin: 5px 0;">Booking Date: ${bookingData.date}</p>
                </div>
            </div>

            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; color: #333;">Passenger Information</h3>
                <p style="margin: 5px 0;"><strong>Name:</strong> ${bookingData.passengerName}</p>
                <p style="margin: 5px 0;"><strong>Phone:</strong> ${bookingData.phone || 'N/A'}</p>
                <p style="margin: 5px 0;"><strong>Email:</strong> ${bookingData.email || 'N/A'}</p>
            </div>

            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; color: #333;">Flight Details</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <p style="margin: 5px 0;"><strong>Airline:</strong> ${bookingData.airline}</p>
                        <p style="margin: 5px 0;"><strong>Flight Number:</strong> ${bookingData.flightNumber}</p>
                        <p style="margin: 5px 0;"><strong>Class:</strong> ${bookingData.flightClass}</p>
                        <p style="margin: 5px 0;"><strong>From:</strong> ${bookingData.from}</p>
                        <p style="margin: 5px 0;"><strong>To:</strong> ${bookingData.to}</p>
                    </div>
                    <div>
                        <p style="margin: 5px 0;"><strong>Departure Date:</strong> ${bookingData.departureDate}</p>
                        <p style="margin: 5px 0;"><strong>Return Date:</strong> ${bookingData.returnDate}</p>
                        <p style="margin: 5px 0;"><strong>Number of Passengers:</strong> ${bookingData.passengers}</p>
                    </div>
                </div>
            </div>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Description</th>
                        <th style="padding: 12px; text-align: center; border-bottom: 1px solid #ddd;">Passengers</th>
                        <th style="padding: 12px; text-align: right; border-bottom: 1px solid #ddd;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                            <p style="margin: 0;">Flight Ticket</p>
                            <p style="margin: 3px 0; color: #666; font-size: 0.9em;">${bookingData.from} to ${bookingData.to}</p>
                            <p style="margin: 3px 0; color: #666; font-size: 0.9em;">${bookingData.airline} - ${bookingData.flightNumber}</p>
                            <p style="margin: 3px 0; color: #666; font-size: 0.9em;">Class: ${bookingData.flightClass}</p>
                        </td>
                        <td style="padding: 12px; text-align: center; border-bottom: 1px solid #ddd;">${bookingData.passengers}</td>
                        <td style="padding: 12px; text-align: right; border-bottom: 1px solid #ddd;">BDT ${parseFloat(bookingData.total).toLocaleString()}৳</td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right; font-size: 1.2em; font-weight: bold; background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                Total Amount: BDT ${parseFloat(bookingData.total).toLocaleString()}৳
            </div>

            <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; font-size: 0.5em; color: #666;">
                <p style="margin: 5px 0;"><strong>Note:</strong></p>
                <ul style="margin: 5px 0; padding-left: 20px;">
                    <li>Please arrive at the airport at least 3 hours before departure time.Baggage allowance as per airline policy</li>
                    <li>Carry a valid ID proof and passport during the journey.No refund on confirmed tickets as per airline policy</li>
                </ul>
            </div>
        </div>
    `;

    const element = document.createElement('div');
    element.innerHTML = invoiceContent;

    const opt = {
        margin: [0.5, 0.5],
        filename: `flight-ticket-${bookingData.invoiceNo}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { 
            scale: 2,
            useCORS: true,
            logging: true
        },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    // Generate and download PDF
    html2pdf().set(opt).from(element).save().then(() => {
        console.log('Flight PDF generated successfully');
    }).catch((error) => {
        console.error('Error generating flight PDF:', error);
        alert('Error generating PDF. Please try again.');
    });
}
</script>

</body>
</html>