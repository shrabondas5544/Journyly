<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">
    <!-- Error and Success Messages -->
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

    <form action="{{ route('flight.book.store', ['id' => $flight->id]) }}" method="POST" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        @csrf
        <!-- Hidden inputs for prices -->
        <input type="hidden" name="subtotal" id="subtotal-input">
        <input type="hidden" name="tax" id="tax-input">
        <input type="hidden" name="savings" id="savings-input">
        <input type="hidden" name="total" id="total-input">
        <input type="hidden" name="flight_id" value="{{ $flight->id }}">

        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
            <div class="min-w-0 flex-1 space-y-8">
                <!-- Reservation Details Section -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900">Reservation Details</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <!-- Personal Information -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Your name</label>
                            <input type="text" name="your_name" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" value="{{ Auth::user()->name ?? '' }}" readonly>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Your email*</label>
                            <input type="email" name="your_email" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" value="{{ Auth::user()->email ?? '' }}" readonly>
                        </div>

                        <!-- Flight Details -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">From</label>
                            <input type="text" value="{{ $flight->from_location }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">To</label>
                            <input type="text" value="{{ $flight->to_location }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Booking Date</label>
                            <input type="date" 
                                id="bookingDate" 
                                name="booking_date"
                                value="{{ date('Y-m-d') }}" 
                                class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900"
                                readonly>
                        </div>
                        
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Departure Date</label>
                            <input type="date" 
                                id="departureDate" 
                                name="departure_date"
                                value="{{ $flight->departure_date }}" 
                                class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900"
                                readonly>
                        </div>

                        <div>
                            <label class="flex items-center mb-2 text-sm font-medium text-gray-900">
                                <input type="checkbox" id="returnTripCheckbox" class="mr-2"> Add Return Flight
                            </label>
                            <input type="date" 
                                id="returnDate" 
                                name="return_date"
                                class=" w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900"
                                disabled>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Airline</label>
                            <input type="text" value="{{ $flight->airline_name }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Flight Class</label>
                            <input type="text" value="{{ $flight->flight_class }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Flight Number</label>
                            <input type="text" value="{{ $flight->flight_number }}" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Baggage Allowance</label>
                            <input type="text" value="{{ $flight->baggage_allowance }}kg" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" readonly>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-900">Payment</h3>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Card Number</label>
                            <input type="number" name="card_number" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" placeholder="**** **** **** ****" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">CVV</label>
                            <input type="number" name="cvv" maxlength="3" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" placeholder="***" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-900">Expiration Date</label>
                            <input type="date" name="expiration_date" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" required>
                        </div>
                    </div>
                </div>

                <!-- Passengers and Voucher Section -->
                <div class="flex gap-8 items-end">
                    <div class="w-1/3">
                        <label class="mb-2 block text-sm font-medium text-gray-900">Number of Passengers</label>
                        <div class="flex items-center w-full bg-blue-100 rounded-lg border border-blue-300 h-10">
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

                    <div class="flex-1">
                        <label class="mb-2 block text-sm font-medium text-blue-900">Enter a gift card, voucher or promotional code</label>
                        <div class="flex items-center gap-4">
                            <input type="text" id="voucher" class="block w-full rounded-lg border border-blue-300 bg-blue-100 p-2.5 text-sm text-gray-900" placeholder="JOURNYLY100">
                            <button type="button" class="flex items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800">Apply</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Price Summary Section -->
            <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-10 lg:max-w-xs xl:max-w-md">
                <div class="flow-root">
                    <div class="-my-3 divide-y divide-blue-200">
                        <dl class="flex items-center justify-between gap-4 py-3">
                            <dt class="text-base font-normal text-gray-700">Subtotal</dt>
                            <dd class="text-base font-medium text-gray-900" data-subtotal>BDT 600.00৳</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 py-3">
                            <dt class="text-base font-normal text-gray-700">Savings</dt>
                            <dd class="text-base font-medium text-green-500" data-savings>BDT 0.00৳</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 py-3">
                            <dt class="text-base font-normal text-700">Tax</dt>
                            <dd class="text-base font-medium text-gray-900" data-tax>BDT 30.00৳</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 py-3">
                            <dt class="text-base font-bold text-gray-900">Total</dt>
                            <dd class="text-base font-bold text-gray-900" data-total>BDT 630.00৳</dd>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Get all the necessary elements
    const form = document.querySelector('form');
    const subtotalInput = document.getElementById('subtotal-input');
    const taxInput = document.getElementById('tax-input');
    const savingsInput = document.getElementById('savings-input');
    const totalInput = document.getElementById('total-input');
    const passengerInput = document.getElementById('passengerInput');
    const departureDateInput = document.getElementById('departureDate');
    const returnDateInput = document.getElementById('returnDate');
    const returnTripCheckbox = document.getElementById('returnTripCheckbox');

    // Initialize base price from flight data
    let basePrice = parseFloat('{{ $flight->discounted_price }}');
    const taxRate = 0.05;

    // Handle return trip checkbox
    returnTripCheckbox.addEventListener('change', function() {
        if (this.checked) {
            returnDateInput.classList.remove('hidden');
            returnDateInput.disabled = false;
            
            // Set min date to departure date
            const departureDate = departureDateInput.value;
            if (departureDate) {
                returnDateInput.min = departureDate;
            }
        } else {
            returnDateInput.classList.add('hidden');
            returnDateInput.disabled = true;
            returnDateInput.value = '';
        }
        calculatePrice();
    });

    // Ensure return date can't be before departure date
    departureDateInput.addEventListener('change', function() {
        if (returnTripCheckbox.checked && this.value) {
            returnDateInput.min = this.value;
            if (returnDateInput.value && returnDateInput.value < this.value) {
                returnDateInput.value = this.value;
            }
        }
        calculatePrice();
    });

    returnDateInput.addEventListener('change', calculatePrice);

    function calculatePrice() {
        const passengerCount = parseInt(passengerInput.value) || 1;
        
        // Start with base price × number of passengers
        let subtotal = basePrice * passengerCount;

        // Double the price only if return flight is selected and has a date
        if (returnTripCheckbox.checked && returnDateInput.value) {
            subtotal *= 2;
        }

        const savings = 0;
        const tax = subtotal * taxRate;
        const total = subtotal + tax - savings;

        // Update display elements
        document.querySelector('[data-subtotal]').textContent = `BDT ${subtotal.toFixed(2)}৳`;
        document.querySelector('[data-savings]').textContent = `BDT ${savings.toFixed(2)}৳`;
        document.querySelector('[data-tax]').textContent = `BDT ${tax.toFixed(2)}৳`;
        document.querySelector('[data-total]').textContent = `BDT ${total.toFixed(2)}৳`;

        // Update hidden inputs
        subtotalInput.value = subtotal.toFixed(2);
        taxInput.value = tax.toFixed(2);
        savingsInput.value = savings.toFixed(2);
        totalInput.value = total.toFixed(2);
    }

    // Passenger counter logic remains the same
    const decrementBtn = document.getElementById('decrementBtn');
    const incrementBtn = document.getElementById('incrementBtn');
    const countDisplay = document.getElementById('passengerCount');
    let count = 1;

    function updatePassengerCount() {
        countDisplay.textContent = count;
        passengerInput.value = count;
        
        // Update buttons state
        decrementBtn.disabled = count <= 1;
        incrementBtn.disabled = count >= 10;
        decrementBtn.style.opacity = count <= 1 ? '0.5' : '1';
        incrementBtn.style.opacity = count >= 10 ? '0.5' : '1';

        // Recalculate price whenever passenger count changes
        calculatePrice();
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

    // Initialize
    updatePassengerCount();
    calculatePrice();
});
    </script>

</body>
</html>