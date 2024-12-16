<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus search Page</title>
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
            <a href="{{ route('account.flight.search') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Flight</a>
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
        <input type="text" id="fromInput" placeholder="From" class="flex-1 border rounded-md p-2  border-blue-300" oninput="filterBuses()">
        <input type="text" id="toInput" placeholder="To" class="flex-1 border rounded-md p-2 border-blue-300" oninput="filterBuses()">
        <label>Departure </label>
        <input type="date" name="departure" class="flex-1 border rounded-md p-2 border-blue-300">
        <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:transition-scale duration-300 ease-in-out hover:scale-110">Search</button>
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
                <button class="w-full bg-blue-500 text-white py-2 rounded mb-4 hover:transition-scale duration-300 ease-in-out hover:scale-95 reset-btn">R E S E T</button>

                <!-- Bus Type Filter -->
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700 mb-3">Bus Type</h3>
                    <label class="block text-sm font-medium"><input type="checkbox" name="bus_type" value="AC" class="mr-2 my-2"> AC</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="bus_type" value="Non AC" class="mr-2 my-2"> Non AC</label>
                </div>
                <div class="h-[1px] bg-gray-300 my-4"></div>

                <!-- Operator Filter -->
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700 mb-3">Operator</h3>
                    <label class="block text-sm font-medium"><input type="checkbox" name="operator" value="Akota Transport" class="mr-2 my-2"> Akota Transport</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="operator" value="Hanif Enterprise" class="mr-2 my-2"> Hanif Enterprise</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="operator" value="KTC Hanif" class="mr-2 my-2"> KTC Hanif</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="operator" value="Rohonpur Travels" class="mr-2 my-2"> Rohonpur Travels</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="operator" value="Green Line" class="mr-2 my-2"> Green Line</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="operator" value="Shohag" class="mr-2 my-2"> Shohag </label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="operator" value="Shamoli" class="mr-2 my-2"> Shamoli</label>
                </div>
                <div class="h-[1px] bg-gray-300 my-4"></div>

                <!-- Boarding Point Filter --> 
                <div>
                    <h3 class="font-semibold text-blue-800 mb-3">Boarding Point</h3>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Mohakhali Bus Point" class="mr-2 my-2"> Mohakhali Bus Point</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Abdullahpur Bus Point" class="mr-2 my-2"> Abdullahpur Bus Point</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Kallyanpur VIP Bus Point_NS" class="mr-2 my-2"> Kallyanpur VIP Bus Point_NS</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Mazar Road Bus Point" class="mr-2 my-2"> Mazar Road Bus Point </label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Gabtoli Terminal 2" class="mr-2 my-2"> Gabtoli Terminal 2</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Savar Bus Point" class="mr-2 my-2"> Savar Bus Point</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Chandra bus point 2" class="mr-2 my-2"> Chandra bus point 2</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Bijoynagar Bus Point" class="mr-2 my-2"> Bijoynagar Bus Point</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Sayedabad Bus Point" class="mr-2 my-2"> Sayedabad Bus Point</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Abdullahpur" class="mr-2 my-2"> Abdullahpur</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Azampur Bus Point" class="mr-2 my-2"> Azampur Bus Point</label>
                    <label class="block text-sm font-medium"><input type="checkbox" name="boarding_point" value="Technical Bus Point" class="mr-2 my-2"> Technical Bus Point</label>
                </div>
                <div class="h-[1px] bg-gray-300 my-4"></div>
     
            </div>

            <!-- Bus Listing Section -->
            <div class="w-full lg:w-3/4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md">
                <!-- Sort Options -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold"> 7 Available Buses</h2>
                    <div>
                        <button class="px-4 py-2 text-sm bg-blue-300 rounded-l-md my-2 sort-btn" data-sort="low_to_high">Low to High</button>
                        <button class="px-4 py-2 text-sm bg-blue-300 rounded-r-md my-2 sort-btn" data-sort="high_to_low">High to Low</button>
                    </div>
                </div>

                <!-- Bus Card -->
                <div class="border rounded-md p-4 mb-4 shadow-md bg-white hover:transition-scale duration-300 ease-in-out ">

                <div id="bus-listings"></div> 
        
                <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                </script>
                <script>
                    
                    $(document).ready(function() {
                        let currentSort = ''; // Track current sort state
                        function showLoading() {
                            $('#bus-listings').html(`
                                <div class="text-center py-8">
                                    <p class="text-gray-500">Loading flights...</p>
                                </div>
                            `);
                        }

                        function searchBuses() {
                            // Get selected bus types
                            const busTypes = [];
                            $('input[name="bus_type"]:checked').each(function() {
                                busTypes.push($(this).val());
                            });

                            // Get selected operators
                            const operators = [];
                            $('input[name="operator"]:checked').each(function() {
                                operators.push($(this).val());
                            });

                            // Get selected boarding points
                            const boardingPoints = [];
                            $('input[name="boarding_point"]:checked').each(function() {
                                boardingPoints.push($(this).val());
                            });

                            // Define isAuthenticated at the top level
                            const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};

                            $.ajax({
                                url: "{{ route('account.bus.search') }}",
                                type: "GET",
                                data: {
                                    from: $('#fromInput').val(),
                                    to: $('#toInput').val(),
                                    departure_date: $('input[name="departure"]').val(),
                                    bus_type: busTypes,
                                    operators: operators,
                                    boarding_points: boardingPoints,
                                    sort: currentSort // Add sort parameter
                                },
                                beforeSend: function(xhr) {
                                    console.log('Sending request with sort:', currentSort); // Debug log
                                },
                                success: function(response) {
                                    console.log('Received response:', response); // Debug log
                
                                    if (response.length === 0) {
                                        $('#bus-listings').html(`
                                            <div class="text-center py-8">
                                                <p class="text-gray-500">No buses found matching your criteria</p>
                                            </div>
                                        `);
                                    return;
                                    }

                                    // Sort the response array if needed
                                    if (currentSort === 'low_to_high') {
                                        response.sort((a, b) => parseFloat(a.discounted_price) - parseFloat(b.discounted_price));
                                    } else if (currentSort === 'high_to_low') {
                                        response.sort((a, b) => parseFloat(b.discounted_price) - parseFloat(a.discounted_price));
                                    }

                                    let html = '';
                                    response.forEach(bus => {
                                        html += `
                                            <div class="bus-card border rounded-md p-4 mb-4 shadow-md bg-gradient-to-br from-blue-200 via-blue-50 to-transparent hover:transition-scale duration-300 ease-in-out hover:scale-x-95">
                                                <div class="flex flex-wrap md:flex-nowrap items-center gap-4">
                                                    <img src="${bus.operator_logo || '/default-logo.png'}" alt="${bus.operator_name}" class="w-12 h-12 object-contain">
                
                                                    <div class="flex-1">
                                                        <h3 class="font-semibold">${bus.operator_name}</h3>
                                                        <p class="text-sm text-gray-500">Route: ${bus.from_location} - ${bus.to_location}</p>
                                                        <p class="text-sm text-gray-500">${bus.journey_date}</p>
                                                        <p class="text-sm text-gray-500">Type: ${bus.bus_type}</p>
                                                    </div>

                                                    <div class="text-center">
                                                        <p class="text-gray-800 font-semibold">${bus.departure_time}</p>
                                                        <p class="text-sm text-gray-500">${bus.from_location}</p>
                                                        <p class="text-sm text-gray-500">${bus.boarding_point}</p>
                                                    </div>

                                                    <div class="text-center px-4">
                                                        <i class="fas fa-arrow-right text-gray-400"></i>
                                                    </div>

                                                    <div class="text-center">
                                                        <p class="text-gray-800 font-semibold">${bus.arrival_time}</p>
                                                        <p class="text-sm text-gray-500">${bus.to_location}</p>
                                                    </div>

                                                    <div class="text-right">
                                                        ${parseFloat(bus.original_price) > parseFloat(bus.discounted_price) ? 
                                                            `<p class="text-gray-500 line-through">BDT ${bus.original_price}৳</p>` : ''
                                                        }
                                                        <p class="text-lg text-red-500 font-semibold">BDT ${bus.discounted_price}৳</p>
                                                        <p class="text-sm ${bus.available_seats < 5 ? 'text-red-500' : 'text-gray-500'}">
                                                            ${bus.available_seats} Seats Available
                                                        </p>
                    
                                                        ${isAuthenticated ? 
                                                            `<a href="/bus/book/${bus.id}" class="block">
                                                                <button class="mt-2 bg-sky-500 text-white px-4 py-1 rounded-md hover:bg-sky-600 hover:scale-105 transition-all duration-300 w-full">
                                                                    Book Ticket
                                                                </button>
                                                            </a>` : 
                                                            `<a href="/account/login" class="block">
                                                                <button class="mt-2 bg-sky-500 text-white px-4 py-1 rounded-md hover:bg-sky-600 hover:scale-105 transition-all duration-300 w-full">
                                                                    Book Ticket
                                                                </button>
                                                            </a>`
                                                        }
                                                    </div>
                                                </div>
                                            </div>
                                        `;
                                    });
                                    $('#bus-listings').html(html);
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                    $('#bus-listings').html(`
                                        <div class="text-center py-8">
                                            <p class="text-red-500 mb-2">Unable to load bus data</p>
                                            <button onclick="searchBuses()" class="text-blue-500 hover:underline">
                                                Try Again
                                            </button>
                                        </div>
                                    `);
                                }
                            });
                        }

                        // Add name attributes to your checkboxes
                        $('.block input[type="checkbox"]').each(function() {
                            const text = $(this).parent().text().trim();
                            if ($(this).closest('.mb-4').find('h3').text().includes('Bus Type')) {
                                $(this).attr('name', 'bus_type').val(text);
                            } else if ($(this).closest('.mb-4').find('h3').text().includes('Operator')) {
                                $(this).attr('name', 'operator').val(text);
                            } else {
                                $(this).attr('name', 'boarding_point').val(text);
                            }
                        });

                        // Updated sort button click handler
                        $('.sort-btn').click(function() {
                            const sortType = $(this).data('sort');
                            currentSort = sortType;
        
                            // Update button styles
                            $('.sort-btn').removeClass('bg-blue-500 text-white').addClass('bg-blue-300');
                            $(this).removeClass('bg-blue-300').addClass('bg-blue-500 text-white');
        
                            console.log('Sort clicked:', sortType); // Debug log
                            searchBuses();
                        });

                        // Trigger search on checkbox changes
                        $('input[type="checkbox"],#fromInput, #toInput, input[name="departure"]').on('change', searchBuses);

                        // Add reset functionality
                        $('.reset-btn').click(function() {
                            $('input[type="checkbox"]').prop('checked', false);
                            $('#fromInput, #toInput').val('');
                            $('input[name="departure"]').val('');
                            currentSort = ''; // Reset sort state
                            $('.sort-btn').removeClass('bg-blue-500 text-white').addClass('bg-blue-300');
                            searchBuses();
                        });

                        // Initial search on page load
                        searchBuses();
                    });
                </script>
        
        </div>
            
        </div>
    </div>
</body>
<script src="script.js"></script>
</html>
