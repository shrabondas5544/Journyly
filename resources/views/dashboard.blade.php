<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
  <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> 
  @vite('resources/css/app.css')
</head>
<body class=" min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent" x-data="{ showSuccess: {{ Session::has('success') ? 'true' : 'false' }} }" x-init="setTimeout(() => { showSuccess = false }, 5000)">
<!-- Success Alert -->
  <div x-show="showSuccess"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0 transform -translate-y-2"
       x-transition:enter-end="opacity-100 transform translate-y-0"
       x-transition:leave="transition ease-in duration-300"
       x-transition:leave-start="opacity-100 transform translate-y-0"
       x-transition:leave-end="opacity-0 transform -translate-y-2"
       class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-auto max-w-md">
    <div class="flex items-center p-3 bg-green-100 rounded-lg shadow-lg">
      <svg class="flex-shrink-0 w-6 h-6 text-green-700" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
      </svg>
      <div class="ml-3 text-base font-medium text-green-700">
        {{ Session::get('success') }}
      </div>
    </div>
  </div>

  <nav class="p-3 flex mt-2 justify-between items-center">
    <a href="dashboard" id="brand" >
      <img class="object-cover max-w-40 max-h-30 ml-10" src="{{ asset('images/journylyLOGO.png') }}" alt="" >
    </a>
    <div id="nav-menu" class="hidden md:flex gap-10">
      <a href="{{ route('account.dashboard') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">home</a>
      <a href="" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Hotel</a>
      <a href="{{ route('account.flight.search') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Flight</a>
      <a href="{{ route('account.bus.search') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Bus</a>
      <a href="" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Train</a>
    </div>

    <div class="mr-12 hidden md:block relative" x-data="{ open: false }">
        @auth
            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">
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
                <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 transition-colors duration-300 ease-in-out rounded-lg ">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('account.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-50 transition-colors duration-300 ease-in-out rounded-lg ">
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
          <img class="object-cover max-w-30 max-h-20 ml-10" src="{{ asset('images/journylyLOGO.png') }}" alt="" >
        </a>
        <button class="p-6 md:hidden" onclick="handleMenu()">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div> 
      <div class="mt-6">
        <a href="home.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block ">home</a>
        <a href="hotelbook.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Hotel</a>
        <a href="airlineTticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Flight</a>
        <a href="busticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Bus</a>
        <a href="trainticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Train</a>
      </div> 
      <div class="h-[1px] bg-gray-300"></div>
      <a href="welcome">
      <button type="button" class=" mr-12 mt-6 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        Login
        <i class="fa-solid fa-arrow-right"></i>
      </button>
      </a>    
    </div>
  </nav>
  <main>
    <section class="hero  py-12 md:pt-12 md:pb-10 overflow-hidden">
      <div class="container mx-auto h-full">
        <!--text&img-->
        <div class="flex flex-col md:flex-row items-center justify-between h-full">
          <!--text-->
          <div class="hero__text md:w-[48%] text-center md:text-left">
            <!-- Badge -->
              <div class="flex items-center gap-2 bg-white py-[5px] px-[20px] w-max rounded-full mb-2 md:auto xl:mx-0 transition-shadows duration-300 ease-in-out shadow-md hover:shadow-lg md:justify-start">
                <i class="fa-solid fa-earth-americas fa-fade" style="color:rgb(14 165 233)"></i>
              <div class="uppercase text-base font-medium text-sky-500 tracking-[2.24px]">live your life</div>
          </div>
           
            <!--title-->
            <h1 class="text-3xl font-bold text-gray-900 m-0 mb-6">Wander, Explore, Experience</h1>
            <p class="mb-[42px] md:max-w-xl">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam consequatur 
              sint excepturi asperiores eum voluptatem placeat amet magni nobis doloremque.</p>
              
              <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-black focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800 shadow-md  hover:shadow-lg">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75  dark:bg-white rounded-md group-hover:bg-opacity-0">
                Contuct Us
                </span>
              </button>
              <a href="hotelbook.html">
              <button type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-3 text-center me-2 mb-2 shadow-md hover:shadow-lg">book hotel</button>
              </a>
          </div>
          <div class="hero__img hidden md:flex max-w-[814px] drop-shadow-2xl ">
            <img src="{{ asset('images/heroimg.png') }}" alt="">
          </div>
          
        </div>
      </div>
    </section>
  </main>
  <!--stats-->
    
  <div class="container flex flex-col mx-auto bg-transparent my-10">
    <div class="w-full draggable flex flex-col">
        <!-- Section Title 
        <div class="container mx-auto my-5 px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 text-left">
                Our service Statistics
            </h2>
        </div>-->
        
        <!-- Horizontal Stats -->
        <div class="container flex flex-wrap justify-between items-center gap- mx-auto px-14">
            <!-- Successful Projects -->
            <div class="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-900 hover:transition-scale duration-300 ease-in-out hover:scale-110 p-3">
              <div class="px-4 py-5 sm:p-16 ">
                  <dl>
                      <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">Total free
                          servers</dt>
                          <h3 class="text-4xl md:text-5xl font-extrabold leading-tight text-center text-blue-500">
                            <span id="countto1" countTo="20"></span>k+
                        </h3>
                  </dl>
              </div>
            </div>
            <!-- Annual Revenue Growth -->
            <div class="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-900 hover:transition-scale duration-300 ease-in-out hover:scale-110 p-3">
              <div class="px-4 py-5 sm:p-16">
                  <dl>
                      <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">Total free
                          servers</dt>
                          <h3 class="text-4xl md:text-5xl font-extrabold leading-tight text-center text-blue-500">
                            <span id="countto2" countTo="455"></span>k+
                        </h3>
                  </dl>
              </div>
            </div>
            <!-- Global Partners -->
            <div class="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-900 hover:transition-scale duration-300 ease-in-out hover:scale-110 p-3">
              <div class="px-4 py-5 sm:p-16">
                  <dl>
                      <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400 ">Total free
                          servers</dt>
                          <h3 class="text-4xl md:text-5xl font-extrabold leading-tight text-center text-blue-500">
                            <span id="countto3" countTo="18000"></span>+
                        </h3>
                  </dl>
              </div>
            </div>
            <!-- Daily Website Visitors -->
            <div class="bg-white overflow-hidden shadow sm:rounded-lg dark:bg-gray-900 hover:transition-scale duration-300 ease-in-out hover:scale-110 p-3">
              <div class="px-4 py-5 sm:p-16">
                  <dl>
                      <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">Total free
                          servers</dt>
                          <h3 class="text-4xl md:text-5xl font-extrabold leading-tight text-center text-blue-500">
                            <span id="countto4" countTo="2888"></span>+
                        </h3>
                  </dl>
              </div>
            </div>
        </div>
      </div>
    </div>


  <section class="best places py-12 bg-">
    <div class="container mx-auto px-6">
      <!-- Section Title -->
      <h2 class="text-2xl font-bold text-gray-800 mb-4 text-right">Best places in Bangladesh</h2>
      <p class=" text-gray-500 mb-8 text-right">Stay in style for your next trip</p>
      
      <!-- Card Container -->
      <div class="flex flex-col lg:flex-row gap-6">
        <!-- Card 1 --> 
        <a href="hotelbook.html">   
        <div class="flex-shrink-0 group relative overflow-hidden rounded-lg shadow-lg flex-1">
          <img src="{{ asset('images/chottogram.jpg') }}" alt="" class="w-full h-48 md:h-60 object-cover group-hover:scale-110 transition-transform duration-300">
          <div class="absolute inset-0  bg-opacity-40 flex items-end p-4">
            <h3 class="text-white font-bold text-lg">Chottogram</h3>
          </div>
        </div></a>
        <!-- Card 2 -->
        <a href="hotelbook.html">
        <div class="flex-shrink-0 group relative overflow-hidden rounded-lg shadow-lg flex-1">
          <img src="{{ asset('images/Sylhet.jpg') }}" alt="Sylhet" class="w-full h-48 md:h-60 object-cover group-hover:scale-110 transition-transform duration-300">
          <div class="absolute inset-0  bg-opacity-40 flex items-end p-4">
            <h3 class="text-white font-bold text-lg">Sylhet</h3>
          </div>
        </div></a>
        <!-- Card 3 -->
        <a href="hotelbook.html">
        <div class="flex-shrink-0 group relative overflow-hidden rounded-lg shadow-lg flex-1">
          <img src="{{ asset('images/Rajshahi.jpg') }}" alt="Rajshahi" class="w-full h-48 md:h-60 object-cover group-hover:scale-110 transition-transform duration-300">
          <div class="absolute inset-0  bg-opacity-40 flex items-end p-4">
            <h3 class="text-white font-bold text-lg">Rajshahi</h3>
          </div>
        </div></a>
        <!-- Card 4 -->
        <a href="hotelbook.html">
        <div class="flex-shrink-0 group relative overflow-hidden rounded-lg shadow-lg flex-1">
          <img src="{{ asset('images/Khulna.jpg') }}" alt="Khulna" class="w-full h-48 md:h-60 object-cover group-hover:scale-110 transition-transform duration-300">
          <div class="absolute inset-0  bg-opacity-40 flex items-end p-4">
            <h3 class="text-white font-bold text-lg">Khulna</h3>
          </div>
        </div></a>
        <!-- Card 4 -->
        <a href="hotelbook.html">
        <div class="flex-shrink-0 group relative overflow-hidden rounded-lg shadow-lg flex-1">
          <img src="{{ asset('images/Barishal.jpg') }}" alt="Barishal" class="w-full h-48 md:h-60 object-cover group-hover:scale-110 transition-transform duration-300">
          <div class="absolute inset-0  bg-opacity-40 flex items-end p-4">
            <h3 class="text-white font-bold text-lg">Barishal</h3>
          </div>
        </div></a>
      </div>
    </div>
  </section>

  <div class="bg-transparent py-10 px-5">
    <div class="max-w-7xl mx-auto">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Special Offer</h2>
      </div>
      <div class="flex space-x-8 overflow-x-auto scrollbar-hide gap-2">
        <!-- Card 1 -->
        <div class="min-w-[300px] bg-white shadow-lg rounded-lg overflow-hidden hover:transition-scale duration-300 ease-in-out hover:scale-95">
          <div class="relative">
            <img
              src="https://via.placeholder.com/300x200"
              alt="Costa Rica Quest"
              class="w-full h-48 object-cover"
            />
            <div class="absolute top-3 left-3 bg-red-500 text-white text-xs px-2 py-1 rounded">
              -30% OFF
            </div>
          </div>
          <div class="p-4">
            <h3 class="text-lg font-semibold">Cox's Bazar</h3>
            <p class="text-sm text-gray-500 mb-2">9 days • ⭐ 4.8 (285)</p>
            <p class="text-sm text-gray-500 line-through">BDT 10,349</p>
            <p class="text-lg font-bold text-red-600">BDT 9,440</p>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="min-w-[300px] bg-white shadow-lg rounded-lg overflow-hidden hover:transition-scale duration-300 ease-in-out hover:scale-95">
          <div class="relative">
            <img
              src="https://via.placeholder.com/300x200"
              alt="Amalfi Coast Walking"
              class="w-full h-48 object-cover"
            />
            <div class="absolute top-3 left-3 bg-red-500 text-white text-xs px-2 py-1 rounded">
              -20% OFF
            </div>
          </div>
          <div class="p-4">
            <h3 class="text-lg font-semibold">Sundarban</h3>            
            <p class="text-sm text-gray-500 mb-2">8 days • ⭐ 4.6 (146)</p>
            <p class="text-sm text-gray-500 line-through">BDT 10,990</p>
            <p class="text-lg font-bold text-red-600">BDT 10,592</p>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="min-w-[300px] bg-white shadow-lg rounded-lg overflow-hidden hover:transition-scale duration-300 ease-in-out hover:scale-95">
          <div class="relative">
            <img
              src="https://via.placeholder.com/300x200"
              alt="Best Of Vietnam"
              class="w-full h-48 object-cover"
            />
            <div class="absolute top-3 left-3 bg-red-500 text-white text-xs px-2 py-1 rounded">
              -55% OFF
            </div>
          </div>
          <div class="p-4">
            <h3 class="text-lg font-semibold">Kuakata</h3>
            <p class="text-sm text-gray-500 mb-2">14 days • ⭐ 4.8 (25)</p>
            <p class="text-sm text-gray-500 line-through">BDT 10,998</p>
            <p class="text-lg font-bold text-red-600">BDT 8,990</p>
          </div>
        </div>
        
        <!-- Card 4 -->
        <div class="min-w-[300px] bg-white shadow-lg rounded-lg overflow-hidden hover:transition-scale duration-300 ease-in-out hover:scale-95">
          <div class="relative">
            <img
              src="https://via.placeholder.com/300x200"
              alt="Spanish Wonder"
              class="w-full h-48 object-cover"
            />
            <div class="absolute top-3 left-3 bg-red-500 text-white text-xs px-2 py-1 rounded">
              -15% OFF
            </div>
          </div>
          <div class="p-4">
            <h3 class="text-lg font-semibold">Saint Martin's Island</h3>                          
            <p class="text-sm text-gray-500 mb-2">9 days • ⭐ 4.6 (26)</p>
            <p class="text-sm text-gray-500 line-through">$2,175</p>
            <p class="text-lg font-bold text-red-600">$1,849</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="max-w-4xl mx-auto my-8">
    <h2 class="text-2xl font-semibold text-center mb-6">
      Here's why travelers choose Journyly
    </h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
      <!-- Great Deals -->
      <div>
        <div class="text-green-600 text-2xl mb-2">✔</div>
        <h3 class="font-semibold text-lg">Get Great Deals!</h3>
        <p class="text-gray-600">Choose from 50+ airlines for low airfares!</p>
      </div>
      <!-- Price Match Promise -->
      <div>
        <div class="text-green-600 text-2xl mb-2">✔</div>
        <h3 class="font-semibold text-lg">Price Match Promise</h3>
        <p class="text-gray-600">Find low prices to destinations worldwide.</p>
      </div>
      <!-- Easy Cancellations -->
      <div>
        <div class="text-green-600 text-2xl mb-2">✔</div>
        <h3 class="font-semibold text-lg">Easy Cancellations with OneTravel</h3>
        <p class="text-gray-600">Convenient self-service options available online.</p>
      </div>
      <!-- Expert Guidance -->
      <div class="mb-8">
        <div class="text-green-600 text-2xl mb-2">✔</div>
        <h3 class="font-semibold text-lg">Expert Guidance</h3>
        <p class="text-gray-600">Get personalized assistance from our travel experts.</p>
      </div>
    </div>
  </div>
  <section x-data="{ showSuccess: false, successMessage: '' }">
      <!-- Success Alert -->
      <div x-show="showSuccess"
          x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="opacity-0 transform -translate-y-2"
          x-transition:enter-end="opacity-100 transform translate-y-0"
          x-transition:leave="transition ease-in duration-300"
          x-transition:leave-start="opacity-100 transform translate-y-0"
          x-transition:leave-end="opacity-0 transform -translate-y-2"
          class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-auto max-w-md">
          <div class="flex items-center p-3 bg-green-100 rounded-lg shadow-lg">
              <svg class="flex-shrink-0 w-6 h-6 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <div class="ml-3 text-base font-medium text-green-700" x-text="successMessage"></div>
          </div>
      </div>

      <!-- Your existing form -->
      <div class="bg-gray-300 text-black py-10">
          <div class="container mx-auto px-4 md:px-8">
              <div class="flex flex-col md:flex-row my-6 md:my-24">
                  <div class="flex flex-col w-full md:w-2/4 justify-center">
                      <div class="bg-white rounded-lg shadow-lg p-8">
                          <h4 class="text-2xl mb-6">Give some feedback?</h4>
                          <form id="feedbackForm">
                              @csrf
                              <div class="mb-4">
                                  <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                  <input type="email" name="email" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2" placeholder="Your Email" required />
                              </div>
                              <div class="mb-4">
                                  <label class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                                  <textarea name="message" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2" rows="4" placeholder="Your Feedback" required></textarea>
                              </div>
                              <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 shadow hover:shadow-lg outline-none focus:outline-none transition-all duration-150">Submit</button>
                          </form>
                      </div>
                  </div>

                  <!-- Your existing map div -->
                  <div class="flex flex-col w-full md:w-2/4 p-4">
                      <div style="height: 400px;" class="bg-white rounded-lg shadow-lg overflow-hidden">
                          <div id="map" style="height: 100%; width: 100%;"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" rel="stylesheet" />
    
      <script>
        window.onload = function() {
          // Set default coordinates
          const defaultLat = 23.7634345420742; 
          const defaultLng = 90.41512739645772;
        
          const map = L.map('map').setView([defaultLat, defaultLng], 13);
        
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
          }).addTo(map);
  
          // Add marker at default location
          const marker = L.marker([defaultLat, defaultLng]).addTo(map);
        
        }
      </script>

      <!-- Updated JavaScript for form submission -->
      <script>
        document.getElementById('feedbackForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('{{ route("feedback.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Get Alpine.js component and update state
                    const component = Alpine.data('component', () => ({
                        showSuccess: true,
                        successMessage: data.message
                    }));
                    
                    // Reset form
                    this.reset();
                    
                    // Auto-hide message after 3 seconds
                    setTimeout(() => {
                        component.showSuccess = false;
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting feedback.');
            });
        });
      </script>
  </section> 
  <footer class="relative bg-blueGray-200 pt-8 pb-6">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap text-left lg:text-left">
        <div class="w-full lg:w-6/12 px-4">
          <h4 class="text-3xl fonat-semibold text-blueGray-700">Let's keep in touch!</h4>
          <h5 class="text-lg mt-0 mb-2 text-blueGray-600">
            Find us on any of these platforms, we respond 1-2 business days.
          </h5>
          <h6 class="text-sm mt-0 text-blueGray-600">Email: support@journyly.com</h6>
          <h6 class="text-sm mt-0 text-blueGray-600">Phone: +880 1234-567890</h6>
          <h6 class="text-sm mt-0 mb-2 text-blueGray-600">Address: Dhaka, Bangladesh</h6>
          <div class="mt-6 lg:mb-0 mb-6">
            <button class="bg-white text-lightBlue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
              <i class="fab fa-twitter"></i></button><button class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
              <i class="fab fa-facebook-square"></i></button><button class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
              <i class="fab fa-instagram"></i></button><button class="bg-white text-blueGray-800 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
              <i class="fab fa-github"></i>
            </button>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <div class="flex flex-wrap items-top mb-6">
            <div class="w-full lg:w-4/12 px-4 ml-auto">
              <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Useful Links</span>
              <ul class="list-unstyled">
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://www.creative-tim.com/presentation?ref=njs-profile">About Us</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://blog.creative-tim.com?ref=njs-profile">Blog</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://www.github.com/creativetimofficial?ref=njs-profile">Github</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://www.creative-tim.com/bootstrap-themes/free?ref=njs-profile">Free Products</a>
                </li>
              </ul>
            </div>
            <div class="w-full lg:w-4/12 px-4">
              <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Other Resources</span>
              <ul class="list-unstyled">
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://github.com/creativetimofficial/notus-js/blob/main/LICENSE.md?ref=njs-profile">MIT License</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm hover:text-blue-500 transition-scale duration-300 ease-in-out " 
                  href="{{ route('terms') }}">Terms &amp; Conditions</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm hover:text-blue-500 transition-scale duration-300 ease-in-out " 
                  href="{{ route('privacy') }}">Privacy &amp; Policy</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://creative-tim.com/contact-us?ref=njs-profile">Contact Us</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-6 border-blueGray-300">
      <div class="flex flex-wrap items-center md:justify-between justify-center">
        <div class="w-full md:w-4/12 px-4 mx-auto text-center">
          <div class="text-sm text-blueGray-500 font-semibold py-1">
            Copyright © <span id="get-current-year">2024</span> Journyly by Shrabon.
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/scripts/plugins/countup.min.js"></script>
  <script>
    let numbers = document.querySelectorAll("[countTo]");

       numbers.forEach((number) => {
           let ID = number.getAttribute("id");
           let value = number.getAttribute("countTo");
           let countUp = new CountUp(ID, value);

           if (number.hasAttribute("data-decimal")) {
           const options = {
                 decimalPlaces: 1,
               };
           countUp = new CountUp(ID, 2.8, options);
           } else {
           countUp = new CountUp(ID, value);
           }

           if (!countUp.error) {
           countUp.start();
           } else {
           console.error(countUp.error);
           number.innerHTML = value;
           }
       });
  </script>
</body>

<script>
const navDialog = document.getElementById('nav-dialog');
function handleMenu(){
    navDialog.classList.toggle('hidden');
}
</script>
</html>