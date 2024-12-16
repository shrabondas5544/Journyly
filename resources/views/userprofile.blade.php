<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
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
        <div class="mb-2 p-4">
            <!-- Logo and Text Container -->
            <div class="flex items-center gap-3">
                <!-- Logo Image -->
                <img src="{{ asset('images/journylyLOGO.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                
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
    <div><!--flight history--></div>
    <!--bus history-->
    <div id="busHistorySection" class="min-h-screen p-4 flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 lg:p-8 shadow-lg w-full max-w-4xl mx-auto">
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
    const sidebar = document.getElementById('sidebar');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebarButtons = document.querySelectorAll('[role="button"]');
    const profileSection = document.getElementById('profileSection');
    
    // Mobile menu toggle
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 1024) {  // lg breakpoint
            if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                sidebar.classList.add('hidden');
            }
        }
    });

    // Show profile section by default
    profileSection.classList.remove('hidden');

    // Handle sidebar button clicks
    sidebarButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active state from all buttons
            sidebarButtons.forEach(btn => {
                btn.classList.remove('bg-blue-100');
            });

            // Add active state to clicked button
            this.classList.add('bg-blue-100');

            // Hide all sections first
            document.getElementById('profileSection').classList.add('hidden');
            document.getElementById('busHistorySection').classList.add('hidden');
            // Add other sections here when you create them...

            // Show the clicked section
            const buttonText = this.textContent.trim().toLowerCase();
            if (buttonText === 'user info') {
                document.getElementById('profileSection').classList.remove('hidden');
            } else if (buttonText === 'bus history') {
                document.getElementById('busHistorySection').classList.remove('hidden');
            }
            // Add other conditions for other sections...

            // Close sidebar on mobile after clicking
            if (window.innerWidth < 1024) {
                sidebar.classList.add('hidden');
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {  // lg breakpoint
            sidebar.classList.remove('hidden');
        } else {
            sidebar.classList.add('hidden');
        }
    });
});
</script>

</body>
</html>