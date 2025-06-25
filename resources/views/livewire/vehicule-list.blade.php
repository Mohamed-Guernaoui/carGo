<div>

<x-layouts.guest :title="__('Our Vehicle Fleet')">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Our Vehicle Fleet</h1>

        <!-- Filters Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex flex-wrap items-center gap-4">
                <div class="w-full md:w-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" placeholder="Find a vehicle..."
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full sm:w-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select class="w-full px-4 py-2 border rounded-lg">
                        <option>All Vehicles</option>
                        <option>Sedan</option>
                        <option>SUV</option>
                        <option>Luxury</option>
                    </select>
                </div>
                <div class="w-full sm:w-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                    <select class="w-full px-4 py-2 border rounded-lg">
                        <option>Any Price</option>
                        <option>$0 - $50</option>
                        <option>$50 - $100</option>
                        <option>$100+</option>
                    </select>
                </div>
                <button class="mt-6 sm:mt-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Vehicle Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($vehicules as $vehicule)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <!-- Image with badge -->
                <div class="relative">
                    @if($vehicule->getFirstMediaUrl('vehicules'))
                    <img src="{{ $vehicule->getFirstMediaUrl('vehicules') }}"
                         alt="{{ $vehicule->marque }} {{ $vehicule->modele }}"
                         class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No image available</span>
                    </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                        ${{ $vehicule->tarif_journalier }}/day
                    </div>
                </div>

                <!-- Vehicle Details -->
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $vehicule->marque }} {{ $vehicule->modele }}</h3>
                            <p class="text-gray-600">{{ $vehicule->annee }} • {{ $vehicule->type_carburant }}</p>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                            {{ ucfirst($vehicule->transmission) }}
                        </span>
                    </div>

                    <!-- Features Icons -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ $vehicule->nombre_places }} seats
                        </span>
                        <span class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                            </svg>
                            {{ $vehicule->couleur }}
                        </span>
                    </div>

                    <!-- Action Button -->
                    <div class="mt-6">
                        <a href=""
                           class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $vehicules->links() }}
        </div>
    </div>
</x-layouts.guest>
</div>
