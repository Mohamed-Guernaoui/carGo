<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
        <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Add New Vehicle</h2>

            <form wire:submit.prevent="save" class="space-y-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Make and Model -->
                    <div>
                        <x-input-label for="make" :value="__('Make')" />
                        <x-text-input wire:model="make" id="make" class="block mt-1 w-full" type="text" required />
                        <x-input-error :messages="$errors->get('make')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="model" :value="__('Model')" />
                        <x-text-input wire:model="model" id="model" class="block mt-1 w-full" type="text" required />
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <!-- Year and License Plate -->
                    <div>
                        <x-input-label for="year" :value="__('Year')" />
                        <x-text-input wire:model="year" id="year" class="block mt-1 w-full" type="number" required />
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="license_plate" :value="__('License Plate')" />
                        <x-text-input wire:model="license_plate" id="license_plate" class="block mt-1 w-full" type="text" required />
                        <x-input-error :messages="$errors->get('license_plate')" class="mt-2" />
                    </div>

                    <!-- Color and Type -->
                    <div>
                        <x-input-label for="color" :value="__('Color')" />
                        <x-text-input wire:model="color" id="color" class="block mt-1 w-full" type="text" required />
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('Vehicle Type')" />
                        <select wire:model="type" id="type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="truck">Truck</option>
                            <option value="van">Van</option>
                            <option value="coupe">Coupe</option>
                            <option value="convertible">Convertible</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <!-- Seats and Price -->
                    <div>
                        <x-input-label for="seats" :value="__('Number of Seats')" />
                        <x-text-input wire:model="seats" id="seats" class="block mt-1 w-full" type="number" min="2" max="12" required />
                        <x-input-error :messages="$errors->get('seats')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="price_per_day" :value="__('Price Per Day ($)')" />
                        <x-text-input wire:model="price_per_day" id="price_per_day" class="block mt-1 w-full" type="number" step="0.01" min="1" required />
                        <x-input-error :messages="$errors->get('price_per_day')" class="mt-2" />
                    </div>

                    <!-- Transmission and Fuel Type -->
                    <div>
                        <x-input-label for="transmission" :value="__('Transmission')" />
                        <select wire:model="transmission" id="transmission" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="automatic">Automatic</option>
                            <option value="manual">Manual</option>
                        </select>
                        <x-input-error :messages="$errors->get('transmission')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="fuel_type" :value="__('Fuel Type')" />
                        <select wire:model="fuel_type" id="fuel_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="gasoline">Gasoline</option>
                            <option value="diesel">Diesel</option>
                            <option value="electric">Electric</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                        <x-input-error :messages="$errors->get('fuel_type')" class="mt-2" />
                    </div>
                </div>

                <!-- Features -->
                <div>
                    <x-input-label :value="__('Features')" />
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 mt-2">
                        @foreach(['air_conditioning', 'bluetooth', 'gps', 'heated_seats', 'sunroof', 'usb_ports', 'backup_camera', 'remote_start'] as $feature)
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model="features" value="{{ $feature }}" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ ucwords(str_replace('_', ' ', $feature)) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea wire:model="description" id="description" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Images -->
                <div>
                    <x-input-label for="images" :value="__('Vehicle Images')" />
                    <input wire:model="images" type="file" id="images" multiple class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/50 dark:file:text-blue-300" accept="image/*">
                    <x-input-error :messages="$errors->get('images.*')" class="mt-2" />

                    @if ($images)
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4">
                            @foreach ($images as $index => $image)
                                <div class="relative">
                                    <img src="{{ $image->temporaryUrl() }}" class="h-32 w-full object-cover rounded-lg">
                                    <button type="button" wire:click="removeImage({{ $index }})" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        {{ __('Save Vehicle') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
