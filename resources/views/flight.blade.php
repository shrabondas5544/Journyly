<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search Page</title>
    <link href="./output.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">
    <nav class="p-3 my-5 flex justify-between items-center">
        <a href="home.html" id="brand" >
          <img class="object-cover max-w-30 max-h-20 ml-10" src="./assets/journylyLOGO.png" alt="" >
        </a>
        <div id="nav-menu" class="hidden md:flex gap-10">
            <a href="{{ route('account.dashboard') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">home</a>
            <a href="hotelbook.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Hotel</a>
            <a href="airlineTticket.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Flight</a>
            <a href="{{ route('account.bus.search') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Bus</a>
            <a href="trainticket.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Train</a>
        </div>

        <div class="mr-12 hidden md:block relative" x-data="{ open: false }">
            @auth
                <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500">
                <i class="fa-duotone fa-solid fa-user" style="--fa-primary-color: #0080ff; --fa-secondary-color: #0080ff;"></i>
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                    <i class="fa-solid fa-caret-down" style="--fa-primary-color: #0080ff;"></i>
                </button>
        
                <!-- Dropdown menu -->
                <div x-show="open" 
                    @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                    <a href="{{ route('account.userprofile') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 transition-colors duration-300 ease-in-out rounded-lg ">
                        Profile
                    </a>
                    <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('account.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-50">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('account.login') }}">
                    <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Login
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </a>
            @endauth
        </div>

        </a>
        <button class="p-6 md:hidden" onclick="handleMenu()">
          <i class="fa-solid fa-bars"></i>
        </button>
         
        <div id="nav-dialog" class="fixed z-10 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent md:hidden inset-0 p-3">
          <div id="nav-bar" class="flex justify-between">
            <a href="#" id="brand" >
              <img class="object-cover max-w-30 max-h-20 ml-10" src="./assets/journylyLOGO.png" alt="" >
            </a>
            <button class="p-6 md:hidden" onclick="handleMenu()">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div> 
          <div class="mt-6">
            <a href="{{ route('account.dashboard') }}" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block ">home</a>
            <a href="hotelbook.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Hotel</a>
            <a href="airlineTticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Flight</a>
            <a href="busticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Bus</a>
            <a href="trainticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Train</a>
          </div> 
          <div class="h-[1px] bg-gray-300"></div>
          <a href="login.html">
          <button type="button" class=" mr-12 mt-6 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
            Login
            <i class="fa-solid fa-arrow-right"></i>
          </button>
          </a>    
        </div>
    </nav>
      <!--main-->
    <div class="container mx-auto p-4 bg-white rounded-lg">
        <!-- Search Bar -->
        <div class="flex flex-wrap items-center gap-4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md mb-4">
            <input type="text" id="fromInput" name="from" placeholder="From" class="flex-1 border rounded-md p-2 border-blue-300">
            <input type="text" id="toInput" name="to" placeholder="To" class="flex-1 border rounded-md p-2 border-blue-300">
            <!-- Replace the date inputs in flight.blade.php -->
            <input type="date" id="departureDate" name="departure_date" class="flex-1 border rounded-md p-2 border-blue-300" required />
            <input type="date" id="returnDate" name="return_date" class="flex-1 border rounded-md p-2 border-blue-300" />
        </div>

        <!-- 
        <div class="my-4 bg-sky-100 p-2 rounded-md shadow-md flex justify-around text-blue-400 font-semibold">
            <span class="px-4 py-2 cursor-pointer hover: transition-scale duration-300 ease-in-out hover:scale-110">Choose Departing Ticket</span>
            <span class="px-4 py-2 cursor-pointer hover: transition-scale duration-300 ease-in-out hover:scale-110">Passenger Details</span>
            <span class="px-4 py-2 cursor-pointer hover: transition-scale duration-300 ease-in-out hover:scale-110">Review & Pay</span>
        </div>
        -->
        <!-- Main Content - Use flex-col for mobile and flex-row for larger screens -->
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Filter Section -->
              <div class="w-full lg:w-1/4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md">
                <h2 class="text-lg font-semibold mb-2">Filters</h2>
                <button class="reset-btn w-full bg-blue-500 text-white py-2 rounded mb-4 hover:transition-scale duration-300 ease-in-out hover:scale-95">R E S E T</button>

                <!-- price Range-->
                <div>
                    <h3 class="font-semibold text-gray-700 mb-3">Range Slide</h3>
                    <div class="mb-4">  
                        <input type="range" 
                            id="price-range" 
                            class="w-full accent-blue-500" 
                            min="0" 
                            max="30000" 
                            value="30000" 
                            oninput="updatePrice(this.value)">
                    </div>
                    <div class="flex justify-between text-gray-500">
                        <span id="minPrice">৳0</span>
                        <span id="maxPrice">৳30000</span>
                    </div>
                </div>
                <script>
                function updatePrice(value) {
                    // Keep minPrice fixed and update maxPrice
                    document.getElementById("maxPrice").textContent = "৳" + value;
                }
                </script>
                <div class="h-[1px] bg-gray-300 my-4"></div>

                <!-- class Type Filter -->
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700 mb-3">Booking Class</h3>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="flight_class[]" value="Economy" class="mr-2 my-2"> Economy
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="flight_class[]" value="Business" class="mr-2 my-2"> Business
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="flight_class[]" value="First" class="mr-2 my-2"> First Class
                    </label>
                </div>
                <div class="h-[1px] bg-gray-300 my-4"></div>

                <!-- Airlines Filter -->
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700 mb-3">Airlines</h3>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="Us Bangla Airlines" class="mr-2 my-2"> Us Bangla Airlines
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="Biman Bangladesh Airlines" class="mr-2 my-2"> Biman Bangladesh Airlines
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="Batik Air" class="mr-2 my-2"> Batik Air
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="Jazeera Airways" class="mr-2 my-2"> Jazeera Airways
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="China Eastern Airlines" class="mr-2 my-2"> China Eastern Airlines
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="Air India" class="mr-2 my-2"> Air India
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="Emirates" class="mr-2 my-2"> Emirates
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="Qatar Airways" class="mr-2 my-2"> Qatar Airways
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="Indigo Air" class="mr-2 my-2"> Indigo Air
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="airlines[]" value="Singapore Airlines" class="mr-2 my-2"> Singapore Airlines
                    </label>
                </div>

                <div class="h-[1px] bg-gray-300 my-4"></div>

                <!-- Boarding Point Filter -->
                  <div class="mb-4">
                    <h3 class="font-semibold text-blue-800 mb-3">Check in Baggage Allowance</h3>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="baggage_allowance[]" value="40" class="mr-2 my-2"> 40 KG
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="baggage_allowance[]" value="35" class="mr-2 my-2"> 35 KG
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="baggage_allowance[]" value="30" class="mr-2 my-2"> 30 KG
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="baggage_allowance[]" value="25" class="mr-2 my-2"> 25 KG
                    </label>
                    <label class="block text-sm font-medium">
                        <input type="checkbox" name="baggage_allowance[]" value="20" class="mr-2 my-2"> 20 KG
                    </label>
                </div>

                  <div class="h-[1px] bg-gray-300 my-4"></div>

                      <!-- Departure Filter -->
                  <div class="bg-white p-4 shadow rounded-lg">
                      <h2 class="font-semibold mb-2">Departure time</h2>
                      <div class="grid grid-cols-2 gap-2">
                          <button name="departure_time_slots[]" value="12am_6am" class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">12am - 6am</button>
                          <button name="departure_time_slots[]" value="6am_12pm" class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">6am - 12pm</button>
                          <button name="departure_time_slots[]" value="12pm_6pm" class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">12pm - 6pm</button>
                          <button name="departure_time_slots[]" value="6pm_12am" class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">6pm - 12am</button>
                      <!-- Add more time slots as needed -->
                      </div>
                  </div>
                      <!-- Arrival Filter -->
                  <div class="bg-white p-4 shadow rounded-lg mb-3">
                      <h2 class="font-semibold mb-2">Arrival time</h2>
                      <div class="grid grid-cols-2 gap-2">
                          <button name="arrival_time_slots[]" value="12am_6am" class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded ">12am - 6am</button>
                          <button name="arrival_time_slots[]" value="6am_12pm" class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">6am - 12pm</button>
                          <button name="arrival_time_slots[]" value="12pm_6pm" class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">12pm - 6pm</button>
                          <button name="arrival_time_slots[]" value="6pm_12am" class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">6pm - 12am</button>
                      <!-- Add more time slots as needed -->
                      </div>  
                  </div>
                  
      
              </div>

            <!-- Flight Listing Section -->
            <div class="w-full lg:w-3/4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md">
                <!-- Sort Options -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Available Flights</h2>
                    <div>
                        <button class="px-4 py-2 text-sm bg-blue-300 rounded-l-md my-2 sort-btn" data-sort="low_to_high">Low to High</button>
                        <button class="px-4 py-2 text-sm bg-blue-300 rounded-r-md my-2 sort-btn" data-sort="high_to_low">High to Low</button>
                    </div>
                </div>
            <div class="border rounded-md p-4 mb-4 shadow-md bg-white hover:transition-scale duration-300 ease-in-out ">
            <div id="flight-listings"></div>
                <script>
                    $(document).ready(function() {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Check if user is authenticated
    const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};

    let currentSort = '';
    let selectedDepartureSlots = [];
    let selectedArrivalSlots = [];

    // Function to show loading state
    function showLoading() {
        $('#flight-listings').html(`
            <div class="text-center py-8">
                <p class="text-gray-500">Loading flights...</p>
            </div>
        `);
    }

    // Handle time slot button clicks for departure
    $('button[name="departure_time_slots[]"]').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('bg-blue-400');
        const value = $(this).val();
        const index = selectedDepartureSlots.indexOf(value);
        if (index === -1) {
            selectedDepartureSlots.push(value);
        } else {
            selectedDepartureSlots.splice(index, 1);
        }
        searchFlights();
    });

    // Handle time slot button clicks for arrival
    $('button[name="arrival_time_slots[]"]').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('bg-blue-400');
        const value = $(this).val();
        const index = selectedArrivalSlots.indexOf(value);
        if (index === -1) {
            selectedArrivalSlots.push(value);
        } else {
            selectedArrivalSlots.splice(index, 1);
        }
        searchFlights();
    });

    // Main search function
    function searchFlights() {
        showLoading();

        // Collect all search parameters
        const searchData = {
            from: $('#fromInput').val(),
            to: $('#toInput').val(),
            departure_date: $('#departureDate').val(),
            return_date: $('#returnDate').val(),
            
            // Get selected flight classes
            flight_class: $('input[name="flight_class[]"]:checked').map(function() {
                return $(this).val();
            }).get(),
            
            // Get selected airlines
            airlines: $('input[name="airlines[]"]:checked').map(function() {
                return $(this).val();
            }).get(),
            
            // Get selected baggage allowances
            baggage_allowance: $('input[name="baggage_allowance[]"]:checked').map(function() {
                return parseInt($(this).val());
            }).get(),
            
            // Time slots
            departure_time_slots: selectedDepartureSlots,
            arrival_time_slots: selectedArrivalSlots,
            
            // Price range
            max_price: $('#price-range').val(),
            
            // Sorting
            sort: currentSort
        };

        // Log search parameters for debugging
        console.log('Search parameters:', searchData);

        $.ajax({
            url: "{{ route('account.flight.search') }}",
            type: "GET",
            data: searchData,
            success: function(response) {
                console.log('Search response:', response);
                
                if (!response || response.length === 0) {
                    $('#flight-listings').html(`
                        <div class="text-center py-8">
                            <p class="text-gray-500">No flights found matching your criteria</p>
                        </div>
                    `);
                    return;
                }

                const html = response.map(flight => generateFlightCard(flight)).join('');
                $('#flight-listings').html(html);
                
                // Update flight count
                $('.flight-count').text(`${response.length} Available Flights`);
            },
            error: function(xhr, status, error) {
                console.error('Search error:', {xhr, status, error});
                $('#flight-listings').html(`
                    <div class="text-center py-8">
                        <p class="text-red-500 mb-2">Unable to load flight data</p>
                        <p class="text-sm text-gray-500 mb-2">${error}</p>
                        <button onclick="searchFlights()" class="text-blue-500 hover:underline">
                            Try Again
                        </button>
                    </div>
                `);
            }
        });
    }

    // Generate HTML for a flight card
    function generateFlightCard(flight) {
        // Format the time slots for display
        const departureTime = flight.getReadableDepartureTime || formatTimeSlot(flight.departure_time_slot);
        const arrivalTime = flight.getReadableArrivalTime || formatTimeSlot(flight.arrival_time_slot);

        // Generate the booking URL using the route helper
        const bookingUrl = `{{ route('flight.book', '') }}/${flight.id}`;

        return `
            <div class="flight-card border rounded-md p-4 mb-4 shadow-md bg-gradient-to-br from-blue-200 via-blue-50 to-transparent hover:scale-x-95 transition-all duration-300">
                <div class="flex flex-wrap md:flex-nowrap items-center gap-4">
                    <img src="${flight.airline_logo || '/default-airline-logo.png'}" alt="${flight.airline_name}" 
                        class="w-12 h-12 object-contain">
            
                    <div class="flex-1">
                        <h3 class="font-semibold">${flight.airline_name}</h3>
                        <p class="text-sm text-gray-500">Flight: ${flight.flight_number}</p>
                        <p class="text-sm text-gray-500">Class: ${flight.flight_class}</p>
                        <p class="text-sm text-gray-500">Baggage: ${flight.baggage_allowance}kg</p>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-800 font-semibold">${departureTime}</p>
                        <p class="text-sm text-gray-500">${flight.from_location}</p>
                    </div>

                    <div class="text-center px-4">
                        <i class="fas fa-plane text-gray-400"></i>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-800 font-semibold">${arrivalTime}</p>
                        <p class="text-sm text-gray-500">${flight.to_location}</p>
                    </div>

                    <div class="text-right">
                        ${parseFloat(flight.original_price) > parseFloat(flight.discounted_price) ? 
                            `<p class="text-gray-500 line-through">BDT ${flight.original_price}৳</p>` : ''}
                        <p class="text-lg text-red-500 font-semibold">BDT ${flight.discounted_price}৳</p>
                        <p class="text-sm ${flight.available_seats < 5 ? 'text-red-500' : 'text-gray-500'}">
                            ${flight.available_seats} Seats Available
                        </p>

                        ${flight.available_seats > 0 ? 
                            isAuthenticated ?
                                `<form action="${bookingUrl}" method="GET">
                                    <input type="hidden" name="flight_price" value="${flight.discounted_price}">
                                    <input type="hidden" name="departure_date" value="${flight.departure_date}">
                                    <input type="hidden" name="return_date" value="${flight.return_date || ''}">
                                    <button type="submit" 
                                            class="mt-2 bg-sky-500 text-white px-4 py-1 rounded-md hover:bg-sky-600 hover:scale-105 transition-all duration-300 w-full">
                                        Book Ticket
                                    </button>
                                </form>`
                                :
                                `<a href="{{ route('account.login') }}" class="block">
                                    <button class="mt-2 bg-sky-500 text-white px-4 py-1 rounded-md hover:bg-sky-600 hover:scale-105 transition-all duration-300 w-full">
                                        Book Ticket
                                    </button>
                                </a>`
                            : 
                            `<button disabled 
                                    class="mt-2 bg-gray-400 text-white px-4 py-1 rounded-md w-full cursor-not-allowed">
                                Sold Out
                            </button>`
                        }
                    </div>
                </div>
            </div>
        `;
    }

    // Helper function to format time slots
    function formatTimeSlot(slot) {
        const slots = {
            '12am_6am': '12am - 6am',
            '6am_12pm': '6am - 12pm',
            '12pm_6pm': '12pm - 6pm',
            '6pm_12am': '6pm - 12am'
        };
        return slots[slot] || slot;
    }

    // Event Listeners
    $('#searchBtn').click(function(e) {
        e.preventDefault();
        searchFlights();
    });

    $('.sort-btn').click(function() {
        const sortType = $(this).data('sort');
        currentSort = sortType;
        $('.sort-btn').removeClass('bg-blue-500 text-white').addClass('bg-blue-300');
        $(this).removeClass('bg-blue-300').addClass('bg-blue-500 text-white');
        searchFlights();
    });

    // Reset functionality
    $('.reset-btn').click(function() {
        // Reset form inputs
        $('input[type="checkbox"]').prop('checked', false);
        $('#fromInput, #toInput').val('');
        $('#departureDate, #returnDate').val('');
        $('#price-range').val(500000);
        updatePrice(500000);
        
        // Reset time slots
        selectedDepartureSlots = [];
        selectedArrivalSlots = [];
        $('button[name="departure_time_slots[]"], button[name="arrival_time_slots[]"]')
            .removeClass('bg-blue-400');
        
        // Reset sort
        currentSort = '';
        $('.sort-btn').removeClass('bg-blue-500 text-white').addClass('bg-blue-300');
        
        // Trigger search
        searchFlights();
    });

    // Watch for changes on all filter inputs
    $('input[type="checkbox"], #price-range').on('change', searchFlights);
    $('#fromInput, #toInput').on('keyup', debounce(searchFlights, 500));
    $('#departureDate, #returnDate').on('change', searchFlights);

    // Debounce function to limit API calls
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initial search
    searchFlights();
});
                </script>

            </div>   
        </div>
    </div>
</body>
<script src="script.js"></script>
</html>
