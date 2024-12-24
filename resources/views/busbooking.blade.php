<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking Page</title>
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
<!----------------------------------------------------->
<section>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif
<form action="{{ route('bus.book.store', ['id' => $bus->id]) }}" method="POST" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    @csrf

    <!-- Hidden inputs for prices -->
    <input type="hidden" name="subtotal" id="subtotal-input">
        <input type="hidden" name="tax" id="tax-input">
        <input type="hidden" name="savings" id="savings-input">
        <input type="hidden" name="total" id="total-input">
        <input type="hidden" name="bus_id" value="{{ $bus->id }}">
    
    <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
      <div class="min-w-0 flex-1 space-y-8">
        <div class="space-y-4">
          <h2 class="text-xl font-semibold text-gray-900 ">Reservation Details</h2>

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="your_name" class="mb-2 block text-sm font-medium text-gray-900"> Your name </label>
                <input type="text" 
                      id="your_name" 
                      name="your_name"
                      class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" 
                      value="{{ Auth::user()->name ?? '' }}"
                      readonly />
            </div>

            <div>
                <label for="your_email" class="mb-2 block text-sm font-medium text-gray-900"> Your email* </label>
                <input type="email" 
                      id="your_email" 
                      name="your_email"
                      class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" 
                      value="{{ Auth::user()->email ?? '' }}"
                      readonly />
            </div>

            <div>
                <label for="your_phone" class="mb-2 block text-sm font-medium text-gray-900"> Your phone* </label>
                <input type="number" 
                      id="your_phone" 
                      name="your_phone"
                      class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" 
                      value="{{ Auth::user()->phone ?? '' }}"
                      readonly />
            </div>

            <div>
              <label for="date" class="mb-2 block text-sm font-medium text-gray-900 "> Date </label>
              <input type="date" 
                  id="date" 
                  name="date"
                  value="<?php echo date('Y-m-d'); ?>"
                  class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                  required />
            </div>

            <div>
                <label for="from" class="mb-2 block text-sm font-medium text-gray-900">From</label>
                <input type="text" id="from" value="{{ $bus->from_location }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly />
            </div>

            <div>
                <label for="to" class="mb-2 block text-sm font-medium text-gray-900">To</label>
                <input type="text" id="to" value="{{ $bus->to_location }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly />
            </div>

            <div>
                <label for="bus_type" class="mb-2 block text-sm font-medium text-gray-900">Bus Type</label>
                <input type="text" id="bus_type" value="{{ $bus->bus_type }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly />
            </div>

            <div>
                <label for="operator_name" class="mb-2 block text-sm font-medium text-gray-900">Operator name</label>
                <input type="text" id="operator_name" value="{{ $bus->operator_name }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly />
            </div>

            <div>
                <label for="bording_point" class="mb-2 block text-sm font-medium text-gray-900">Bording Point</label>
                <input type="text" id="bording_point" value="{{ $bus->boarding_point }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly />
            </div>

            <div>
                <label for="departure_date" class="mb-2 block text-sm font-medium text-gray-900">Departure Date</label>
                <input type="date" id="departure_date" value="{{ $bus->journey_date }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly />
            </div>

            <!--<div class="sm:col-span-2">
                <label for="email" class="mb-2 block text-sm font-medium text-gray-900 ">Address</label>
                <input type="email" id="email" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 " placeholder="name@flowbite.com" required />
            </div>-->
          </div>
        </div>

        <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-900">Payment</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div>
                    <label for="card_num" class="mb-2 block text-sm font-medium text-gray-900">Card Number</label>
                    <input type="number" 
                        id="card_num" 
                        name="card_number"
                        class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                        placeholder="**** **** **** ****"
                        required />
                </div>

                <div>
                    <label for="cvv" class="mb-2 block text-sm font-medium text-gray-900">CVV</label>
                    <input type="number"
                        id="cvv"
                        name="cvv"
                        maxlength="3"
                        class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                        placeholder="***"
                        required />
                </div>

                <div>
                    <label for="exp_date" class="mb-2 block text-sm font-medium text-gray-900">Expiration Date</label>
                    <input type="date"
                        id="exp_date"
                        name="expiration_date"
                        class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                        required />
                </div>
            </div>
        </div>

        <div class="flex gap-8 items-end"> <!-- Added items-end to align bottom -->
            <!-- Passenger Counter -->
            <div class="w-1/3"> <!-- Removed space-y-4 -->
                <label for="passengers" class="mb-2 block text-sm font-medium text-gray-900">Number of Passengers</label>
                <div class="flex items-center w-full bg-blue-100 rounded-lg border border-blue-300 h-10"> <!-- Added h-10 to match input height -->
                    <button type="button" id="decrementBtn" class="px-4 py-2 text-blue-600 hover:text-blue-800 disabled:text-gray-400">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="flex-1 text-center">
                        <span id="passengerCount" class="text-sm font-medium">1</span>
                    </div>
                    <button type="button" id="incrementBtn" class="px-4 py-2 text-blue-600 hover:text-blue-800 disabled:text-gray-400">
                        <i class="fas fa-plus"></i>
                    </button>
                    <input type="hidden" id="passengerInput" name="passengers" value="1">
                </div>
            </div>

            <!-- Voucher Field -->
            <div class="flex-1">
                <label for="voucher" class="mb-2 block text-sm font-medium text-blue-900">Enter a gift card, voucher or promotional code</label>
                <div class="flex items-center gap-4">
                    <input type="text" id="voucher" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="JOURNYLY100" />
                    <button type="button" class="flex items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 ">Apply</button>
                </div>
            </div>
        </div>
      
      </div>

      <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-10 lg:max-w-xs xl:max-w-md">
          <div class="flow-root">
              <div class="-my-3 divide-y divide-blue-200">
                  <dl class="flex items-center justify-between gap-4 py-3">
                      <dt class="text-base font-normal text-gray-700">Subtotal</dt>
                      <dd class="text-base font-medium text-gray-900" data-subtotal>BDT 900.00৳</dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4 py-3">
                      <dt class="text-base font-normal text-gray-700">Savings</dt>
                      <dd class="text-base font-medium text-green-500" data-savings>BDT 0.00৳</dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4 py-3">
                      <dt class="text-base font-normal text-700">Tax</dt>
                      <dd class="text-base font-medium text-gray-900" data-tax>BDT 18.00৳</dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4 py-3">
                      <dt class="text-base font-bold text-gray-900">Total</dt>
                      <dd class="text-base font-bold text-gray-900" data-total>BDT 918.00৳</dd>
                  </dl>
              </div>
          </div>
    
          <div class="space-y-3">
              <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-blue-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                  Proceed to Payment
              </button>
              <p class="text-sm font-normal text-gray-500">
                  One or more items in your cart require an account.
                  <a href="#" class="font-medium text-primary-700 underline hover:no-underline">
                      Sign in or create an account now.
                  </a>
              </p>
          </div>
      </div>
    </div>
  </form>
</section>
<footer class="relative bg-blueGray-200 pt-8 pb-6 mt-40">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap text-left lg:text-left">
        <div class="w-full lg:w-6/12 px-4">
          <h4 class="text-3xl fonat-semibold text-blueGray-700">Let's keep in touch!</h4>
          <h5 class="text-lg mt-0 mb-2 text-blueGray-600">
            Find us on any of these platforms, we respond 1-2 business days.
          </h5>
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
<!--price script start-->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const subtotalInput = document.getElementById('subtotal-input');
    const taxInput = document.getElementById('tax-input');
    const savingsInput = document.getElementById('savings-input');
    const totalInput = document.getElementById('total-input');
    const decrementBtn = document.getElementById('decrementBtn');
    const incrementBtn = document.getElementById('incrementBtn');
    const countDisplay = document.getElementById('passengerCount');
    const passengerInput = document.getElementById('passengerInput');
    const cardNumInput = document.getElementById('card_num');
    const cvvInput = document.getElementById('cvv');
    const expDateInput = document.getElementById('exp_date');

    let basePrice = parseFloat('{{ $bus->discounted_price ?? 900 }}');
    const taxRate = 0.05;
    let count = 1;

    // Set minimum date for expiration date to tomorrow
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    expDateInput.min = tomorrow.toISOString().split('T')[0];

    // Card number validation
    cardNumInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 16);
    });

    // CVV validation
    cvvInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 3);
    });

    function validateForm() {
        const errors = [];

        // Card number validation
        if (!cardNumInput.value) {
            errors.push('Please enter card number');
        } else if (cardNumInput.value.length !== 16) {
            errors.push('Card number must be 16 digits');
        }

        // CVV validation
        if (!cvvInput.value) {
            errors.push('Please enter CVV');
        } else if (cvvInput.value.length !== 3) {
            errors.push('CVV must be 3 digits');
        }

        // Expiration date validation
        if (!expDateInput.value) {
            errors.push('Please select expiration date');
        } else {
            const selectedDate = new Date(expDateInput.value);
            const today = new Date();
            if (selectedDate <= today) {
                errors.push('Expiration date must be in the future');
            }
        }

        return errors;
    }

    function updatePrices() {
        const subtotal = basePrice * count;
        const savings = 0;
        const tax = subtotal * taxRate;
        const total = subtotal + tax - savings;

        document.querySelector('[data-subtotal]').textContent = `BDT ${subtotal.toFixed(2)}৳`;
        document.querySelector('[data-savings]').textContent = `BDT ${savings.toFixed(2)}৳`;
        document.querySelector('[data-tax]').textContent = `BDT ${tax.toFixed(2)}৳`;
        document.querySelector('[data-total]').textContent = `BDT ${total.toFixed(2)}৳`;

        subtotalInput.value = subtotal.toFixed(2);
        taxInput.value = tax.toFixed(2);
        savingsInput.value = savings.toFixed(2);
        totalInput.value = total.toFixed(2);
    }

    function updatePassengerCount() {
        countDisplay.textContent = count;
        passengerInput.value = count;
        
        decrementBtn.disabled = count <= 1;
        incrementBtn.disabled = count >= 10;
        
        decrementBtn.style.opacity = count <= 1 ? '0.5' : '1';
        incrementBtn.style.opacity = count >= 10 ? '0.5' : '1';

        updatePrices();
    }

    decrementBtn.addEventListener('click', function() {
        if (count > 1) {
            count--;
            updatePassengerCount();
        }
    });

    incrementBtn.addEventListener('click', function() {
        if (count < 10) {
            count++;
            updatePassengerCount();
        }
    });

    // Form submission handler
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const errors = validateForm();
        
        if (errors.length > 0) {
            alert(errors.join('\n'));
            return false;
        }

        const confirmMessage = `Are you sure you want to book this ticket?\n\nNumber of Passengers: ${count}\nTotal Amount: ${document.querySelector('[data-total]').textContent}`;
        
        if (confirm(confirmMessage)) {
            // Set a flag to prevent double submission
            if (this.getAttribute('data-submitting')) {
                return false;
            }
            this.setAttribute('data-submitting', 'true');
            
            // Submit the form
            this.submit();
        }
    });

    // Initialize
    updatePassengerCount();
});
</script>
<!----------------------------------------------------->
<!--passenger num counter-->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const decrementBtn = document.getElementById('decrementBtn');
    const incrementBtn = document.getElementById('incrementBtn');
    const countDisplay = document.getElementById('passengerCount');
    const passengerInput = document.getElementById('passengerInput');
    let count = 1;

    function updateDisplay() {
        countDisplay.textContent = count;
        passengerInput.value = count;
        
        // Disable/enable buttons based on count
        decrementBtn.disabled = count <= 1;
        incrementBtn.disabled = count >= 10;
        
        // Visual feedback for disabled state
        decrementBtn.style.opacity = count <= 1 ? '0.5' : '1';
        incrementBtn.style.opacity = count >= 10 ? '0.5' : '1';
    }

    decrementBtn.addEventListener('click', function() {
        if (count > 1) {
            count--;
            updateDisplay();
        }
    });

    incrementBtn.addEventListener('click', function() {
        if (count < 10) {
            count++;
            updateDisplay();
        }
    });

    // Initialize display
    updateDisplay();
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