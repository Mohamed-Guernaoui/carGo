<div class="flex h-full w-full flex-1 flex-col gap-6 p-4">
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Vehicles List
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                Add New Vehicle
            </h1>
            <p class="text-gray-600 dark:text-gray-400">Enter the details for your new rental vehicle.</p>
        </div>
    </div>

    <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
        <form wire:submit.prevent="saveVehicule" class="space-y-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="marque" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Make *</label>
                        <input wire:model.live="marque" type="text" id="marque" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                        @error('marque') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="modele" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Model *</label>
                        <input wire:model.live="modele" type="text" id="modele" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                        @error('modele') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="plaque_immatriculation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">License Plate *</label>
                        <input wire:model.live="plaque_immatriculation" type="text" id="plaque_immatriculation" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                        @error('plaque_immatriculation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="annee" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Year</label>
                        <input wire:model.live="annee" type="number" id="annee" min="1900" max="{{ now()->year + 5 }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                        @error('annee') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="couleur" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Color</label>
                        <input wire:model.live="couleur" type="text" id="couleur"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                        @error('couleur') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="nombre_places" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Number of Seats *</label>
                        <input wire:model.live="nombre_places" type="number" id="nombre_places" required min="1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                        @error('nombre_places') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vehicle Type (e.g., Sedan, SUV)</label>
                        <select wire:model.live="type" id="type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                            <option value="">Select Type</option>
                            @foreach($this->availableVehicleTypes as $vehicleType)
                                <option value="{{ $vehicleType }}">{{ ucfirst($vehicleType) }}</option>
                            @endforeach
                        </select>
                        @error('type') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    {{--

                    <div>
                        <label for="selectedLocationId" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location</label>
                        <select wire:model.live="selectedLocationId" id="selectedLocationId"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                            <option value="">Select Location</option>
                            @foreach($this->locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedLocationId') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    --}}
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Technical Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="transmission" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Transmission *</label>
                        <select wire:model.live="transmission" id="transmission" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                            <option value="">Select Transmission</option>
                            <option value="manuelle">Manual</option>
                            <option value="automatique">Automatic</option>
                        </select>
                        @error('transmission') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="type_carburant" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fuel Type *</label>
                        <select wire:model.live="type_carburant" id="type_carburant" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                            <option value="">Select Fuel Type</option>
                            <option value="essence">Gasoline</option>
                            <option value="diesel">Diesel</option>
                            <option value="electrique">Electric</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                        @error('type_carburant') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="tarif_journalier" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Daily Rate ($) *</label>
                        <input wire:model.live="tarif_journalier" type="number" id="tarif_journalier" step="0.01" min="0.01" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                        @error('tarif_journalier') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Description & Image</h3>
                <div class="space-y-4">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                        <textarea wire:model.live="description" id="description" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white"></textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vehicle Image (Primary)</label>
                        <input wire:model="images" type="file" id="images" accept="image/*"
                               class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100
                                      dark:file:bg-blue-900/50 dark:file:text-blue-300 dark:hover:file:bg-blue-900">
                        @error('images') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                        @if ($images)
                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Image Preview:
                                <img src="{{ $images->temporaryUrl() }}" class="mt-1 max-h-40 rounded-lg object-cover">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Availability</h3>
                <label class="inline-flex items-center cursor-pointer">
                    <input wire:model.live="disponible" type="checkbox" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Available for rental</span>
                </label>
            </div>

            <div class="mt-8 flex justify-end">
                <x-button type="submit" variant="primary">
                    Add Vehicle
                </x-button>
            </div>
        </form>
    </div>
</div>
