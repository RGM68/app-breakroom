<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Table - Breakroom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white min-h-screen">
    <!-- Navbar -->
    <nav class="bg-black/50 backdrop-blur-md border-b border-gray-700 fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Navigation -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('photos/breakroom.png') }}" alt="Breakroom Logo" class="h-10 w-10 rounded-lg object-contain"/>
                        <span class="ml-3 text-xl font-bold bg-gradient-to-r from-yellow-400 to-yellow-600 text-transparent bg-clip-text">Breakroom</span>
                    </div>
                    
                    <!-- Main Navigation -->
                    <div class="hidden md:flex ml-10 space-x-6">
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-yellow-400 px-3 py-2 rounded-md transition-colors duration-200">Home</a>
                        <a href="{{ route('user.tables') }}" class="text-yellow-400 font-bold px-3 py-2 rounded-md">Tables</a>
                        <a href="#" class="text-gray-300 hover:text-yellow-400 px-3 py-2 rounded-md transition-colors duration-200">Events</a>
                        <a href="#" class="text-gray-300 hover:text-yellow-400 px-3 py-2 rounded-md transition-colors duration-200">Products</a>
                        <a href="#" class="text-gray-300 hover:text-yellow-400 px-3 py-2 rounded-md transition-colors duration-200">Food & Drinks</a>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button class="flex items-center space-x-3 focus:outline-none" id="user-menu-button">
                        <div class="flex items-center">
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : '/api/placeholder/40/40' }}" 
                                 alt="Profile" 
                                 class="h-8 w-8 rounded-full object-cover border-2 border-yellow-400"/>
                            <div class="ml-3 hidden md:block text-left">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">Member</p>
                            </div>
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg border border-gray-700" id="user-menu">
                        <div class="py-1">
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-yellow-400">Profile Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-yellow-400">Booking History</a>
                            <div class="border-t border-gray-700 mt-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif
    <!-- Main Content -->
     
    <div class="pt-20 pb-12 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Booking Form Card -->
            <div class="relative">
                <!-- Decorative Elements -->
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/10 to-yellow-600/10 rounded-xl transform rotate-1"></div>
                <div class="absolute inset-0 bg-gradient-to-l from-purple-400/10 to-purple-600/10 rounded-xl transform -rotate-1"></div>
                
                <!-- Main Form Container -->
                <div class="relative bg-gray-800/80 backdrop-blur rounded-xl shadow-xl p-8">
                    <!-- Form Header -->
                    <div class="mb-8 text-center">
                        <h2 class="text-2xl font-bold text-yellow-400 mb-2">Book Your Table</h2>
                        <p class="text-gray-400">Table #{{ $table->number }} - Capacity: {{ $table->capacity }} people</p>
                    </div>

                    <!-- Booking Form -->
                    <form method="POST" action="{{ route('user.tables.book', ['table_id' => $table->id]) }}" class="space-y-6">
                        @csrf

                        <!-- Current Table Info -->
                        <div class="bg-gray-900/50 rounded-lg p-4 mb-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-400">Price per hour</p>
                                    <p class="text-lg font-bold text-yellow-400">Rp {{ number_format($table->price, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-400">Status</p>
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ strtolower($table->status) == 'open' ? 'bg-green-900/80 text-green-300' : 'bg-red-900/80 text-red-300' }}">
                                        {{ $table->status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Loyalty Benefits & Discounts -->
                        <div class="bg-gray-900/50 rounded-lg p-4 mb-6">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <span class="text-sm text-gray-400">Your Loyalty Tier</span>
                                    <h3 class="text-lg font-bold text-yellow-400">{{ $loyaltyTier->name }}</h3>
                                </div>
                                @if($loyaltyTier->table_discount_percentage > 0)
                                    <span class="bg-green-900/80 text-green-300 px-3 py-1 rounded-full text-sm">
                                        {{ $loyaltyTier->table_discount_percentage }}% Tier Discount
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Voucher Selection -->
                        @if($applicableVouchers->isNotEmpty())
                            <div class="space-y-2">
                                <label for="voucher_id" class="block text-sm font-medium text-gray-300">Apply Voucher (Optional)</label>
                                <select name="voucher_id" 
                                        id="voucher_id"
                                        class="w-full bg-gray-900/50 border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                                    <option value="">No voucher</option>
                                    @foreach($applicableVouchers as $userVoucher)
                                        <option value="{{ $userVoucher->id }}" 
                                                data-type="{{ $userVoucher->voucher->discount_type }}"
                                                data-value="{{ $userVoucher->voucher->discount_value }}"
                                                data-min="{{ $userVoucher->voucher->min_purchase }}"
                                                data-max="{{ $userVoucher->voucher->max_discount }}">
                                            {{ $userVoucher->voucher->name }} 
                                            (@if($userVoucher->voucher->discount_type === 'percentage')
                                                {{ $userVoucher->voucher->discount_value }}%
                                            @else
                                                Rp {{ number_format($userVoucher->voucher->discount_value) }}
                                            @endif off)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Modified Price Estimation with Discounts -->
                        <div id="price-estimation" class="bg-gray-900/50 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-300 mb-2">Price Details</h4>
                            <div class="space-y-2">
                                <!-- Original Price -->
                                <div class="flex justify-between items-center">
                                    <span>Original Price</span>
                                    <span id="original-price" class="text-gray-400"></span>
                                </div>
                                
                                <!-- Loyalty Discount -->
                                @if($loyaltyTier->table_discount_percentage > 0)
                                    <div class="flex justify-between items-center text-green-400">
                                        <span>Loyalty Tier Discount ({{ $loyaltyTier->table_discount_percentage }}%)</span>
                                        <span id="loyalty-discount">-Rp 0</span>
                                    </div>
                                @endif
                                
                                <!-- Voucher Discount (Hidden by default) -->
                                <div id="voucher-discount-row" class="flex justify-between items-center text-green-400 hidden">
                                    <span id="voucher-label">Voucher Discount</span>
                                    <span id="voucher-discount">-Rp 0</span>
                                </div>
                                
                                <!-- Final Price -->
                                <div class="flex justify-between items-center pt-2 border-t border-gray-700">
                                    <span>Final Price</span>
                                    <span id="final-price" class="text-xl font-bold text-yellow-400">Rp 0</span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1" id="price-info"></p>
                        </div>

                        <!-- Datetime Picker -->
                        <div class="space-y-2">
                            <label for="datetime" class="block text-sm font-medium text-gray-300">Choose Date & Time</label>
                            <input type="datetime-local" 
                                   name="datetime" 
                                   id="datetime" 
                                   value="{{ old('datetime') }}"
                                   class="w-full bg-gray-900/50 border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:border-transparent"
                                   required>
                        </div>

                        <!-- Duration Selector -->
                        <div class="space-y-2">
                            <label for="duration" class="block text-sm font-medium text-gray-300">Select Duration</label>
                            <select name="duration" 
                                    id="duration"
                                    class="w-full bg-gray-900/50 border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:border-transparent"
                                    required>
                                <option value="" disabled selected>Choose your duration</option>
                                <option value="60" {{ old('duration') == '60' ? 'selected' : '' }}>1 Hour Package</option>
                                <option value="120" {{ old('duration') == '120' ? 'selected' : '' }}>2 Hour Package</option>
                                <option value="180" {{ old('duration') == '180' ? 'selected' : '' }}>3 Hour Package</option>
                                <option value="open" {{ old('duration') == 'open' ? 'selected' : '' }}>Open Duration</option>
                            </select>
                        </div>

                        <!-- Custom Duration Input (Hidden by default) -->
                        <div id="open-duration-container" class="space-y-2 hidden">
                            <label for="open-duration" class="block text-sm font-medium text-gray-300">Specify Duration (minutes)</label>
                            <input type="number" 
                                   name="open_duration" 
                                   id="open-duration"
                                   min="30"
                                   step="30"
                                   placeholder="Enter duration in minutes"
                                   class="w-full bg-gray-900/50 border border-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                            <p class="text-sm text-gray-400">Minimum duration: 30 minutes</p>
                        </div>

                        <!-- Price Estimation -->
                        <div id="price-estimation" class="bg-gray-900/50 rounded-lg p-4 hidden">
                            <h4 class="text-sm font-medium text-gray-300 mb-2">Estimated Price</h4>
                            <p class="text-xl font-bold text-yellow-400" id="estimated-price">Rp 0</p>
                            <p class="text-xs text-gray-400 mt-1">Final price may vary based on actual duration</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4 pt-4">
                            <a href="{{ route('user.tables') }}" 
                               class="flex-1 px-6 py-3 bg-gray-700 text-white rounded-lg text-center hover:bg-gray-600 transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="flex-1 px-6 py-3 bg-gradient-to-r from-yellow-400 to-yellow-600 text-black font-bold rounded-lg hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
                                Confirm Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8 bg-gray-800/50 backdrop-blur rounded-lg p-6">
                <h3 class="text-lg font-semibold text-yellow-400 mb-4">Booking Information</h3>
                <ul class="space-y-2 text-gray-300">
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-yellow-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Bookings must be made at least 1 hour in advance</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-yellow-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Please arrive 15 minutes before your booking time</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-yellow-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Payment must be made upon arrival</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Duration selector logic
        const durationSelect = document.getElementById('duration');
        const openDurationContainer = document.getElementById('open-duration-container');
        const openDurationInput = document.getElementById('open-duration');
        const priceEstimation = document.getElementById('price-estimation');
        const estimatedPriceDisplay = document.getElementById('estimated-price');
        const pricePerHour = {{ $table->price }};

        durationSelect.addEventListener('change', function() {
            if (this.value === '') {
                estimatedPriceDisplay.textContent = 'Please select a package';
                return;
            }
            if (this.value === 'open') {
                openDurationContainer.classList.remove('hidden');
                openDurationInput.required = true;
                priceEstimation.classList.remove('hidden');
            } else {
                openDurationContainer.classList.add('hidden');
                openDurationInput.required = false;

                const hours = parseInt(this.value) / 60;
                const estimatedPrice = pricePerHour * hours;
                estimatedPriceDisplay.textContent = `Rp ${numberFormat(estimatedPrice)}`;
                priceEstimation.classList.remove('hidden');
            }
        });

        

        // Calculate estimated price for open duration
        openDurationInput.addEventListener('input', function() {
            const minutes = parseInt(this.value) || 0;
            const hours = minutes / 60;
            const estimatedPrice = pricePerHour * hours;
            estimatedPriceDisplay.textContent = `Rp ${numberFormat(estimatedPrice)}`;
        });

        // Form submission handling
        const bookingForm = document.querySelector('form');
        bookingForm.addEventListener('submit', function(e) {
            const selectedDateTime = new Date(document.getElementById('datetime').value);
            const now = new Date();
            
            // Add 1 hour to current time for minimum booking time
            const minBookingTime = new Date(now.getTime() + (60 * 60 * 1000));

            // Validate booking time
            if (selectedDateTime < minBookingTime) {
                e.preventDefault();
                showToast('Booking must be made at least 1 hour in advance', 'error');
                return;
            }

            // Validate duration for open bookings
            if (durationSelect.value === 'open') {
                const duration = parseInt(openDurationInput.value);
                if (!duration || duration < 30) {
                    e.preventDefault();
                    showToast('Please specify a valid duration (minimum 30 minutes)', 'error');
                    return;
                }
            }

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;
        });

        // User menu toggle
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        
        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });

        // Helper function for number formatting
        function numberFormat(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        // Toast notification function
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg text-white ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } transform transition-transform duration-300 ease-in-out z-50`;
            toast.textContent = message;
            document.body.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.style.transform = 'translateY(-20px)';
            }, 100);

            // Animate out and remove
            setTimeout(() => {
                toast.style.transform = 'translateY(100px)';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Set minimum date time for booking
        document.addEventListener('DOMContentLoaded', () => {
            const datetimeInput = document.getElementById('datetime');
            const now = new Date();
            const minDateTime = new Date(now.getTime() + (60 * 60 * 1000)); // Add 1 hour
            
            // Format datetime for input
            const year = minDateTime.getFullYear();
            const month = String(minDateTime.getMonth() + 1).padStart(2, '0');
            const day = String(minDateTime.getDate()).padStart(2, '0');
            const hours = String(minDateTime.getHours()).padStart(2, '0');
            const minutes = String(minDateTime.getMinutes()).padStart(2, '0');
            
            datetimeInput.min = `${year}-${month}-${day}T${hours}:${minutes}`;
        });

        // Add these variables
        const voucherSelect = document.getElementById('voucher_id');
        const loyaltyDiscountPercentage = {{ $loyaltyTier->table_discount_percentage ?? 0 }};
        const originalPriceDisplay = document.getElementById('original-price');
        const loyaltyDiscountDisplay = document.getElementById('loyalty-discount');
        const voucherDiscountRow = document.getElementById('voucher-discount-row');
        const voucherDiscountDisplay = document.getElementById('voucher-discount');
        const finalPriceDisplay = document.getElementById('final-price');

        function calculatePrice() {
            let originalPrice = 0;
            let finalPrice = 0;
            
            // Calculate base price
            const minutes = parseInt(durationSelect.value) || 0;
            originalPrice = (pricePerHour * minutes) / 60;
            
            originalPriceDisplay.textContent = `Rp ${numberFormat(originalPrice)}`;
            
            // Apply loyalty discount
            const loyaltyDiscount = Math.floor((originalPrice * loyaltyDiscountPercentage) / 100);
            if (loyaltyDiscountDisplay) {
                loyaltyDiscountDisplay.textContent = `-Rp ${numberFormat(loyaltyDiscount)}`;
            }
            
            finalPrice = originalPrice - loyaltyDiscount;
            
            // Apply voucher discount if selected
            if (voucherSelect && voucherSelect.value) {
                const selectedOption = voucherSelect.selectedOptions[0];
                const discountType = selectedOption.dataset.type;
                const discountValue = parseInt(selectedOption.dataset.value);
                const maxDiscount = parseInt(selectedOption.dataset.max);
                
                let voucherDiscount = 0;
                if (discountType === 'percentage') {
                    voucherDiscount = Math.floor((originalPrice * discountValue) / 100);
                    if (maxDiscount) {
                        voucherDiscount = Math.min(voucherDiscount, maxDiscount);
                    }
                } else {
                    voucherDiscount = discountValue;
                }
                
                voucherDiscountRow.classList.remove('hidden');
                voucherDiscountDisplay.textContent = `-Rp ${numberFormat(voucherDiscount)}`;
                finalPrice -= voucherDiscount;
            } else {
                voucherDiscountRow.classList.add('hidden');
            }
            
            finalPriceDisplay.textContent = `Rp ${numberFormat(Math.max(0, finalPrice))}`;
        }

        // Add event listeners
        durationSelect.addEventListener('change', calculatePrice);
        if (openDurationInput) {
            openDurationInput.addEventListener('input', calculatePrice);
        }
        if (voucherSelect) {
            voucherSelect.addEventListener('change', calculatePrice);
        }
    </script>
</body>
</html>