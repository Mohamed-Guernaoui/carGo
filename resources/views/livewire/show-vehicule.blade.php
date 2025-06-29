<div>
    <nav class="bg-white shadow-md border-b border-gray-100 sticky top-0 z-100 backdrop-filter backdrop-blur-lg bg-opacity-95 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <div class="flex-shrink-0">
                        <a href="/" class="flex items-center">
                            <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                            </svg>
                            <h1 class="text-2xl font-bold text-gray-900 ml-2 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">CarGo</h1>
                        </a>
                    </div>
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ route('vehicules.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 relative group">
                            Vehicules
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                        </a>
                        <a href="/locations" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 relative group">
                            Locations
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                        </a>
                        <a href="/about" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 relative group">
                            About Us
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                        </a>
                        <a href="/contact" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 relative group">
                            Contact
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                        </a>
                    </div>
                </div>

                @if($isAuthenticated)
                <div class="flex items-center space-x-5">
                    <a href="/favorites" class="text-gray-600 hover:text-blue-600 relative p-2 rounded-full hover:bg-gray-100 transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full">3</span>
                    </a>
                    <a href="/notifications" class="text-gray-600 hover:text-blue-600 relative p-2 rounded-full hover:bg-gray-100 transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-blue-500 rounded-full">2</span>
                    </a>
                    <div class="relative group">
                        <button
                            onclick="toggleProfileMenu()"
                            class="flex items-center focus:outline-none transition-transform duration-300 hover:scale-105"
                            aria-label="Profile menu"
                        >
                            <img
                                src="https://th.bing.com/th?q=User+Icon+Unique+Background&w=120&h=120&c=1&rs=1&qlt=90&r=0&cb=1&pid=InlineBlock&mkt=en-XA&cc=MA&setlang=en&adlt=strict&t=1&mw=247"
                                alt="Profile"
                                class="h-10 w-10 rounded-full object-cover border-2 border-blue-100 shadow-md hover:shadow-lg transition-all duration-300"
                            >
                            <div class="ml-2 hidden md:block">
                                <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->role }}</p>
                            </div>
                            <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div
                            id="profileMenu"
                            class="absolute z-100 right-0 mt-3 w-64 bg-white/95 backdrop-blur-sm rounded-xl shadow-xl py-2 hidden transform origin-top-right transition-all duration-300 ease-out opacity-0 scale-95 border border-gray-100"
                        >
                            <div class="px-5 py-3 border-b border-gray-100">
                                <p class="font-medium text-gray-800">Welcome back!</p>
                                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                            <a
                                href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                                class="flex items-center px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 rounded-lg mx-1"
                            >
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Dashboard
                            </a>
                            <a
                                href="/bookings"
                                class="flex items-center px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 rounded-lg mx-1"
                            >
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                My Bookings
                            </a>
                            <a
                                href="/profile"
                                class="flex items-center px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 rounded-lg mx-1"
                            >
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <a
                                href="/settings"
                                class="flex items-center px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 rounded-lg mx-1"
                            >
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a
                                href="/logout"
                                class="flex items-center px-5 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200 rounded-lg mx-1"
                            >
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Sign out
                            </a>
                        </div>
                    </div>
                </div>
                <script>
                    function toggleProfileMenu() {
                        const menu = document.getElementById('profileMenu');

                        // Add smooth transition effects
                        if (menu.classList.contains('hidden')) {
                            menu.classList.remove('hidden');
                            // Force a reflow to ensure the transition works
                            void menu.offsetWidth;
                            menu.classList.remove('opacity-0', 'scale-95');
                            menu.classList.add('opacity-100', 'scale-100');
                        } else {
                            menu.classList.add('opacity-0', 'scale-95');
                            menu.addEventListener('transitionend', function handler() {
                                menu.classList.add('hidden');
                                menu.removeEventListener('transitionend', handler);
                            }, { once: true });
                        }

                        // Close when clicking outside
                        const closeMenu = function(event) {
                            if (!event.target.closest('.relative.group')) {
                                menu.classList.add('opacity-0', 'scale-95');
                                menu.addEventListener('transitionend', function handler() {
                                    menu.classList.add('hidden');
                                    menu.removeEventListener('transitionend', handler);
                                }, { once: true });
                                document.removeEventListener('click', closeMenu);
                            }
                        };

                        document.addEventListener('click', closeMenu);
                    }
                </script>

                @else
                <div class="flex items-center space-x-4">
                    <a href="/search" class="text-gray-600 hover:text-blue-600 p-2 rounded-full hover:bg-gray-100 transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </a>
                    <a href="/login" class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors border border-transparent hover:border-blue-100">Sign In</a>
                    <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition-colors shadow-md hover:shadow-lg transform hover:scale-105">Sign Up</a>
                </div>
                @endif
            </div>
        </div>

        <!-- Mobile Menu Button (Hidden on desktop) -->
        <div class="md:hidden flex items-center absolute right-4 top-5">
            <button class="mobile-menu-button text-gray-500 hover:text-blue-600 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>
    <!-- Modal Overlay -->
    <div class="fixed inset-0 mt-28 bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white  max-w-6xl w-full max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ $vehicule->annee }} {{ $vehicule->marque }} {{ $vehicule->modele }}
                    </h2>
                    <p class="text-gray-600 mt-1">location</p>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Share Button -->
                    <button class="p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                        </svg>
                    </button>
                    <!-- Favorite Button -->
                    <button wire:click="toggleFavorite" class="p-2 text-gray-400 hover:text-red-500 rounded-full hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                    <!-- Close Button -->
                    <button wire:click="closeModal" class="p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="flex overflow-hidden h-[calc(90vh-120px)]">
                <!-- Left Column - Images and Details -->
                <div class="flex-1 overflow-y-auto">
                    <!-- Image Gallery -->
                    <div class="relative">
                        <!-- Main Image -->
                        <div class="relative h-80 bg-gray-200 overflow-hidden">
                            <img src="{{ $vehicule->getFirstMediaUrl('vehicules') }}"
                                 alt="{{ $vehicule->marque }} {{ $vehicule->modele }}"
                                 class="w-full h-full object-cover">

                            <div class="absolute top-4 left-4 flex flex-col space-y-2">
                              {{--
                              @if($vehicule)
                                <span class="bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    FEATURED
                                </span>
                                @endif
                                @if($vehicule->discount_percentage > 0)
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    {{ $vehicule->discount_percentage }}% OFF
                                </span>
                                @endif
                              --}}
                                @if($vehicule)
                                <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    AVAILABLE NOW
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Image Thumbnails -->

                    </div>

                    <!-- vehicule Information Tabs -->
                    <div class="px-6 py-4">
                        <!-- Tab Navigation -->
                        <div class="flex border-b border-gray-200 mb-6">
                            <button wire:click="$set('activeTab', 'overview')"
                                    class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'overview' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                                Overview
                            </button>
                            <button wire:click="$set('activeTab', 'features')"
                                    class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'features' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                                Features
                            </button>
                            <button wire:click="$set('activeTab', 'reviews')"
                                    class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'reviews' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                                Reviews ({{ $vehicule->reviews_count }})
                            </button>
                            <button wire:click="$set('activeTab', 'location')"
                                    class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'location' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                                Location
                            </button>
                        </div>

                        <!-- Tab Content -->
                        <div class="space-y-6">
                            @if($activeTab === 'overview')
                            <!-- Overview Tab -->
                            <div>
                                <!-- Rating -->
                                <div class="flex items-center mb-4">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $vehicule->average_rating ? 'fill-current' : 'text-gray-300' }}"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-lg font-semibold text-gray-900">{{ number_format($vehicule->average_rating, 1) }}</span>
                                    <span class="ml-2 text-gray-600">({{ $vehicule->reviews_count }} reviews)</span>
                                </div>

                                <!-- Description -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $vehicule->description }}</p>
                                </div>

                                <!-- Specifications Grid -->
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1h.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-2a1 1 0 00-.293-.707l-3-3A1 1 0 0016 7h-1V5a1 1 0 00-1-1H3z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Seats</p>
                                            <p class="font-semibold text-gray-900">{{ $vehicule->seats }} passengers</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Fuel Type</p>
                                            <p class="font-semibold text-gray-900">{{ ucfirst($vehicule->fuel_type) }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Transmission</p>
                                            <p class="font-semibold text-gray-900">{{ ucfirst($vehicule->transmission) }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Category</p>
                                            <p class="font-semibold text-gray-900">{{ ucfirst($vehicule->type) }}</p>
                                        </div>
                                    </div>



                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Year</p>
                                            <p class="font-semibold text-gray-900">{{ $vehicule->year }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @elseif($activeTab === 'features')
                            <!-- Features Tab -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">vehicule Features</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Safety Features -->
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Safety Features
                                        </h4>
                                        <div class="space-y-2">
                                            @foreach($vehicule->safety_features as $feature)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-gray-700">{{ $feature }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Comfort Features -->
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Comfort Features
                                        </h4>
                                        <div class="space-y-2">
                                            @foreach($vehicule->comfort_features as $feature)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-gray-700">{{ $feature }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Technology Features -->
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"></path>
                                            </svg>
                                            Technology Features
                                        </h4>
                                        <div class="space-y-2">
                                            @foreach($vehicule->technology_features as $feature)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-gray-700">{{ $feature }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Entertainment Features -->
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 text-orange-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h3.763l7.79 3.894A1 1 0 0018 15V3zM3.24 6.912a60.06 60.06 0 00-.471 6.876 1 1 0 101.992.024c.048-2.312.206-4.62.471-6.9a1 1 0 00-1.992-.024z" clip-rule="evenodd"></path>
                                            </svg>
                                            Entertainment Features
                                        </h4>
                                        <div class="space-y-2">
                                            @foreach($vehicule->entertainment_features as $feature)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-gray-700">{{ $feature }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @elseif($activeTab === 'reviews')
                            <!-- Reviews Tab -->
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900">Customer Reviews</h3>
                                    <button class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                        Write a Review
                                    </button>
                                </div>

                                <!-- Rating Summary -->
                                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                    <div class="flex items-center mb-2">
                                        <span class="text-3xl font-bold text-gray-900 mr-2">{{ number_format($vehicule->average_rating, 1) }}</span>
                                        <div class="flex text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $vehicule->average_rating ? 'fill-current' : 'text-gray-300' }}"
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-gray-600">Based on {{ $vehicule->reviews_count }} reviews</p>
                                </div>

                                <!-- Individual Reviews -->
                                <div class="space-y-4">
                                    @foreach($vehicule->reviews->take(3) as $review)
                                    <div class="border-b border-gray-200 pb-4">
                                        <div class="flex items-start justify-between mb-2">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                                    <span class="text-sm font-medium text-gray-700">{{ substr($review->user->name, 0, 2) }}</span>
                                                </div>
                                                <div>
                                                    <h4 class="font-medium text-gray-900">{{ $review->user->name }}</h4>
                                                    <div class="flex text-yellow-400">
                                                        @for($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300' }}"
                                                             fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-700">{{ $review->comment }}</p>
                                    </div>
                                    @endforeach
                                </div>

                                @if($vehicule->reviews_count > 3)
                                <div class="text-center mt-4">
                                    <button class="text-blue-600 hover:text-blue-700 font-medium">
                                        View All {{ $vehicule->reviews_count }} Reviews
                                    </button>
                                </div>
                                @endif
                            </div>

                            @else
                            <!-- Location Tab -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pickup Location</h3>

                                <!-- Location Details -->
                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                    <div class="flex items-start">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900">{{ $vehicule->location->name }}</h4>
                                            <p class="text-gray-600">{{ $vehicule->location->address }}</p>
                                            <p class="text-gray-600">{{ $vehicule->location->city }}, {{ $vehicule->location->state }} {{ $vehicule->location->zip_code }}</p>

                                            <!-- Operating Hours -->
                                            <div class="mt-3">
                                                <h5 class="text-sm font-medium text-gray-900 mb-2">Operating Hours</h5>
                                                <div class="text-sm text-gray-600 space-y-1">
                                                    <div class="flex justify-between">
                                                        <span>Monday - Friday:</span>
                                                        <span>8:00 AM - 8:00 PM</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span>Saturday:</span>
                                                        <span>9:00 AM - 6:00 PM</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span>Sunday:</span>
                                                        <span>10:00 AM - 4:00 PM</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span class="text-gray-700">{{ $vehicule->location->phone }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-gray-700">{{ $vehicule->location->email }}</span>
                                    </div>
                                </div>

                                <!-- Map Placeholder -->
                                <div class="mt-6 h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                                        </svg>
                                        <p class="text-gray-500">Interactive map coming soon</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Booking Sidebar -->
                <div class="w-80 border-l border-gray-200 bg-gray-50 overflow-y-auto">
                    <div class="p-6">
                        <!-- Price Summary -->
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 mb-6">
                            <div class="text-center mb-4">
                                @if($vehicule->original_price > $vehicule->price_per_day)
                                <p class="text-lg text-gray-400 line-through">${{ $vehicule->original_price }}</p>
                                @endif
                                <p class="text-2xl font-bold text-blue-600">
                                    MAD{{ number_format($vehicule->tarif_journalier, 1) }}
                                    <span class="text-base font-normal text-gray-600">/day</span>
                                </p>
                                @if($vehicule->discount_percentage > 0)
                                <span class="inline-block bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full mt-2">
                                    Save {{ $vehicule->discount_percentage }}%
                                </span>
                                @endif
                            </div>

                            <!-- Rental Duration Calculator -->
                            {{--

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pick-up Date & Time</label>
                                    <input wire:model.live="pickupDateTime" type="datetime-local"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Return Date & Time</label>
                                    <input wire:model.live="returnDateTime" type="datetime-local"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            --}}


                        </div>

                        <!-- Booking Form -->
                        <div class="space-y-4">
                            <!-- Insurance Options -->
                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <h4 class="font-medium text-gray-900 mb-3">Insurance Options</h4>
                                <div class="space-y-3">
                                    <label class="flex items-start">
                                        <input wire:model.live="selectedInsurance" type="radio" value="basic"
                                               class="mt-0.5 text-blue-600 focus:ring-blue-500">
                                        <div class="ml-3">
                                            <div class="font-medium text-sm">Basic Coverage</div>
                                            <div class="text-xs text-gray-600">Standard protection included</div>
                                            <div class="text-sm font-medium text-green-600">Free</div>
                                        </div>
                                    </label>
                                    <label class="flex items-start">
                                        <input wire:model.live="selectedInsurance" type="radio" value="premium"
                                               class="mt-0.5 text-blue-600 focus:ring-blue-500">
                                        <div class="ml-3">
                                            <div class="font-medium text-sm">Premium Coverage</div>
                                            <div class="text-xs text-gray-600">Enhanced protection with lower deductible</div>
                                            <div class="text-sm font-medium text-blue-600">+$12/day</div>
                                        </div>
                                    </label>
                                    <label class="flex items-start">
                                        <input wire:model.live="selectedInsurance" type="radio" value="comprehensive"
                                               class="mt-0.5 text-blue-600 focus:ring-blue-500">
                                        <div class="ml-3">
                                            <div class="font-medium text-sm">Comprehensive Coverage</div>
                                            <div class="text-xs text-gray-600">Full protection with zero deductible</div>
                                            <div class="text-sm font-medium text-blue-600">+$25/day</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Add-ons -->
                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <h4 class="font-medium text-gray-900 mb-3">Add-ons</h4>
                                <div class="space-y-3">
                                    <label class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input wire:model.live="selectedAddons" type="checkbox" value="gps"
                                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm">GPS Navigation</span>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">+$8/day</span>
                                    </label>
                                    <label class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input wire:model.live="selectedAddons" type="checkbox" value="child_seat"
                                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm">Child Safety Seat</span>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">+$10/day</span>
                                    </label>
                                    <label class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input wire:model.live="selectedAddons" type="checkbox" value="wifi"
                                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm">Mobile WiFi Hotspot</span>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">+$6/day</span>
                                    </label>
                                    <label class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input wire:model.live="selectedAddons" type="checkbox" value="additional_driver"
                                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm">Additional Driver</span>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">+$15/day</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <button wire:click="reserveVehicule"
                                        class="cursor-pointer w-[100%] bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-lg hover:shadow-xl transform hover:scale-[1.02]"
                                        >
                                    Reserve Now
                                </button>

{{--
<button wire:click="addToCompare"
         class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-xl transition-colors">
     Add to Compare
 </button>
--}}

                            </div>

                            <!-- Trust Indicators -->
                            <div class="bg-green-50 rounded-lg p-3 text-center">
                                <div class="flex items-center justify-center text-green-600 mb-1">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Free Cancellation</span>
                                </div>
                                <p class="text-xs text-green-700">Cancel up to 24 hours before pickup</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
