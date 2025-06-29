<div class="min-h-screen bg-gray-50">
    <div class="bg-white shadow-md border-b border-gray-100 sticky top-0 z-40 backdrop-filter backdrop-blur-lg bg-opacity-90 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition-colors duration-200">CarGo</a>
                </div>

                <div class="flex-1 max-w-lg mx-8">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="quickSearch" type="text"
                               placeholder="Search by make, model, or location..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <button type="button" class="text-gray-400 hover:text-blue-500 focus:outline-none">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        @if($favoritesCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center transform transition-transform duration-200 hover:scale-110">
                            {{ $favoritesCount }}
                        </span>
                        @endif
                    </button>
                    <button class="relative p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        @if($compareCount > 0)
                        <span class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center transform transition-transform duration-200 hover:scale-110">
                            {{ $compareCount }}
                        </span>
                        @endif
                    </button>
                    <div class="h-8 w-px bg-gray-200 mx-1"></div>

                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Filters</h3>
                        <button wire:click="clearFilters" class="text-sm text-blue-600 hover:text-blue-700">
                            Clear All
                        </button>
                    </div>

                    @if(count($this->activeFilters) > 0)
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-2">
                            @foreach($this->activeFilters as $filter)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $filter }}
                                <button wire:click="removeFilter('{{ $filter }}')" class="ml-1 cursor-pointer text-blue-600 hover:text-blue-800">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Price Range (per day)</h4>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <input wire:model.live="minPrice" type="number" placeholder="Min"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <input wire:model.live="maxPrice" type="number" placeholder="Max"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>25 MAD</span>
                                <span>500 MAD+</span>
                            </div>
                        </div>
                    </div>

                    {{--
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">vehicule Type</h4>
                        <div class="space-y-2">
                            @foreach($this->vehiculeTypes as $type => $count)
                            <label class="flex items-center">
                                <input wire:model.live="selectedTypes" type="checkbox" value="{{ $type }}"
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">{{ ucfirst($type) }}</span>
                                <span class="ml-auto text-xs text-gray-500">({{ $count }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>--}}


                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Transmission</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input wire:model.live="transmission" type="radio" value="automatique"
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Automatic</span>
                            </label>
                            <label class="flex items-center">
                                <input wire:model.live="transmission" type="radio" value="manuelle"
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Manual</span>
                            </label>
                            <label class="flex items-center">
                                <input wire:model.live="transmission" type="radio" value=""
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Any</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Fuel Type</h4>
                        <div class="space-y-2">
                            @foreach(['essence', 'diesel', 'hybrid', 'electrique'] as $fuel)
                            <label class="flex items-center">
                                <input wire:model.live="selectedFuelTypes" type="checkbox" value="{{ $fuel }}"
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">{{ ucfirst($fuel) }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Features</h4>
                        <div class="space-y-2">
                            @foreach(['gps', 'bluetooth', 'backup_camera', 'heated_seats', 'sunroof', 'leather_seats'] as $feature)
                            <label class="flex items-center">
                                <input wire:model.live="selectedFeatures" type="checkbox" value="{{ $feature }}"
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">{{ ucfirst($feature) }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Pickup Location</h4>
                        <select wire:model.live="selectedLocation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Any Location</option>
                            @foreach($this->locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 mt-8 lg:mt-0">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Available vehicules</h2>
                        <p class="text-sm text-gray-600 mt-1">{{ $vehicules->total() }} vehicules found</p>
                    </div>

                    <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                        <div class="flex bg-gray-100 rounded-lg p-1">
                            <button wire:click="$set('viewMode', 'grid')"
                                    class="px-3 py-1 rounded-md text-sm font-medium transition-colors {{ $viewMode === 'grid' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500' }}">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm6 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V4zm6 6a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4zM3 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H4a1 1 0 01-1-1v-4z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button wire:click="$set('viewMode', 'list')"
                                    class="px-3 py-1 rounded-md text-sm font-medium transition-colors {{ $viewMode === 'list' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500' }}">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 000 2h14a1 1 0 100-2H3zm0 4a1 1 0 000 2h14a1 1 0 100-2H3zm0 4a1 1 0 000 2h14a1 1 0 100-2H3z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <select wire:model.live="sortBy"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="rating_desc">Highest Rated</option>
                            <option value="year_desc">Newest First</option>
                            <option value="make_asc">Make A-Z</option>
                        </select>
                    </div>
                </div>

                @if($viewMode === 'grid')
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($vehicules as $vehicule)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group hover:shadow-lg transition-all duration-300">
                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                @if($vehicule->getFirstMediaUrl('vehicules'))
                              <img src="{{ $vehicule->getFirstMediaUrl('vehicules') }}"
                                     alt="{{ $vehicule->marque }} {{ $vehicule->modele }}"
                                     class="w-full h-48 object-cover">

                                @else

                                     <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                         <span class="text-gray-500">No image available</span>

                                     </div>
                                     @endif

                                {{--
                                <button wire:click="toggleFavorite({{ $vehicule->id }})"
                                        class="absolute top-3 right-3 w-8 h-8 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-colors">
                                    <svg class="w-4 h-4 {{ in_array($vehicule->id, $favorites ?? []) ? 'text-red-500 fill-current' : 'text-gray-400' }}"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                                --}}
                                    {{--
                                    <div class="absolute top-3 left-3">
                                        <label class="flex items-center">
                                            <input wire:model.live="compareList" type="checkbox" value="{{ $vehicule->id }}"
                                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 bg-white/90">
                                            <span class="ml-2 text-xs font-medium text-white bg-black/50 px-2 py-1 rounded">Compare</span>
                                        </label>
                                    </div>
                                    --}}


                                <div class="absolute bottom-3 left-3">
                                    <span class="backdrop-blur-sm bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                        {{-- $vehicule->type isn't in your DB schema, defaulting to marque/modele --}}
                                        {{ ucfirst($vehicule->modele) }} {{-- Or add a 'type' column to Vehicules --}}
                                    </span>
                                </div>
                                {{--

                                @if($vehicule->discount_percentage > 0)
                                <div class="absolute top-3 left-1/2 transform -translate-x-1/2">
                                    <span class="bg-red-300 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        {{ $vehicule->discount_percentage }}% OFF
                                    </span>
                                </div>
                                @endif
                                --}}
                            </div>

                            <div class="p-5">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            {{ $vehicule->annee }} {{ $vehicule->marque }} {{ $vehicule->modele }}
                                        </h3>
                                        <p class="text-sm text-gray-600">{{ $vehicule->location->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="text-right">
                                        @if($vehicule->original_price > $vehicule->tarif_journalier)
                                        <p class="text-sm text-gray-400 line-through">MAD {{ number_format($vehicule->original_price, 2) }}</p>
                                        @endif
                                        <p class="text-lg font-bold text-blue-600">MAD {{ number_format($vehicule->tarif_journalier, 2) }}<span class="text-sm font-normal text-gray-600">/day</span></p>
                                    </div>
                                </div>

                                <div class="flex items-center mb-3">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $vehicule->average_rating ? 'fill-current' : 'text-gray-300' }}"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">{{ number_format($vehicule->average_rating, 1) }} ({{ $vehicule->reviews_count }} reviews)</span>
                                </div>

                                <div class="grid grid-cols-3 gap-4 mb-4 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1h.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-2a1 1 0 00-.293-.707l-3-3A1 1 0 0016 7h-1V5a1 1 0 00-1-1H3z"></path>
                                        </svg>
                                        <span class="truncate">{{ $vehicule->nombre_places }} seats</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="truncate">{{ ucfirst($vehicule->type_carburant) }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="truncate">{{ ucfirst($vehicule->transmission) }}</span>
                                    </div>
                                </div>

                                <div class="flex space-x-2">
                                    <a href="{{ route('vehicules.show', $vehicule->id) }}"
                                        class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors">
                                         View Details
                                     </a>
                                    <!-- <button wire:click="selectvehicule({{ $vehicule->id }})"
                                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                        Select
                                    </button> -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($vehicules as $vehicule)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                            <div class="flex flex-col lg:flex-row lg:items-center">
                                <div class="lg:w-64 lg:flex-shrink-0 mb-4 lg:mb-0">
                                    <div class="relative h-40 lg:h-32 bg-gray-200 rounded-lg overflow-hidden">
                                        <img src="{{ $vehicule->primary_image_url }}"
                                             alt="{{ $vehicule->marque }} {{ $vehicule->modele }}"
                                             class="w-full h-full object-cover">

                                                 {{--
                                             <div class="absolute top-2 left-2">
                                            <label class="flex items-center">
                                                <input wire:model.live="compareList" type="checkbox" value="{{ $vehicule->id }}"
                                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                         --}}
                                    </div>
                                </div>

                                <div class="flex-1 lg:ml-6">
                                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between mb-2">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    {{ $vehicule->annee }} {{ $vehicule->marque }} {{ $vehicule->modele }}
                                                </h3>
                                                <button wire:click="toggleFavorite({{ $vehicule->id }})"
                                                        class="ml-2 p-1 text-gray-400 hover:text-red-500">
                                                    <svg class="w-5 h-5 {{ in_array($vehicule->id, $favorites ?? []) ? 'text-red-500 fill-current' : '' }}"
                                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                    </svg>
                                                </button>
                                            </div>

                                            <p class="text-sm text-gray-600 mb-3">{{ $vehicule->location->name ?? 'N/A' }}</p>

                                            <div class="flex items-center mb-3">
                                                <div class="flex text-yellow-400">
                                                    @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $vehicule->average_rating ? 'fill-current' : 'text-gray-300' }}"
                                                         fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    @endfor
                                                </div>
                                                <span class="ml-2 text-sm text-gray-600">{{ number_format($vehicule->average_rating, 1) }} ({{ $vehicule->reviews_count }} reviews)</span>
                                            </div>

                                            <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1h.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-2a1 1 0 00-.293-.707l-3-3A1 1 0 0016 7h-1V5a1 1 0 00-1-1H3z"></path>
                                                    </svg>
                                                    <span>{{ $vehicule->nombre_places }} seats</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span>{{ ucfirst($vehicule->type_carburant) }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span>{{ ucfirst($vehicule->transmission) }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                                        {{-- vehicule type (e.g., Sedan, SUV). Not directly in DB, adjust if needed --}}
                                                        {{ ucfirst($vehicule->modele) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col lg:items-end">
                                            <div class="text-right mb-4">
                                                @if($vehicule->discount_percentage > 0)
                                                <p class="text-sm text-gray-400 line-through">${{ number_format($vehicule->original_price, 2) }}/day</p>
                                                @endif
                                                <p class="text-2xl font-bold text-blue-600">${{ number_format($vehicule->tarif_journalier, 2) }}<span class="text-base font-normal text-gray-600">/day</span></p>
                                            </div>

                                            <div class="flex space-x-2">
                                                <a href="{{ route('vehicules.show', $vehicule->id) }}"
                                                         class="px-4 py-2 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg transition-colors">
                                                          View Details
                                                      </a>
                                                <button wire:click="selectvehicule({{ $vehicule->id }})"
                                                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                                    Select
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-8">
                    {{ $vehicules->links() }}
                </div>

                @if($vehicules->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H8a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No vehicules found</h3>
                    <p class="mt-2 text-gray-500">Try adjusting your search filters or search criteria.</p>
                    <button wire:click="clearFilters" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Clear All Filters
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if(count($compareList) > 0)
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-700">
                        {{ count($compareList) }} vehicule(s) selected for comparison
                    </span>
                </div>
                <div class="flex items-center space-x-3">
                    <button wire:click="$set('compareList', [])"
                            class="text-sm text-gray-500 hover:text-gray-700">
                        Clear All
                    </button>
                    <button wire:click="comparevehicules"
                            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors"
                            @if(count($compareList) < 2) disabled @endif>
                        Compare Selected
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
