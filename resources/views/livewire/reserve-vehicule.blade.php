<div class="min-h-screen bg-gray-50">
    <div class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <div class="relative flex items-center justify-between">
                <div class="flex items-center space-x-8 w-full justify-between">
                    <div class="flex flex-col items-center flex-1">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $currentStep >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }} font-medium text-sm">
                            @if($currentStep > 1)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            @else
                                1
                            @endif
                        </div>
                        <span class="mt-2 text-xs text-center font-medium {{ $currentStep >= 1 ? 'text-gray-900' : 'text-gray-500' }}">Vehicle & Dates</span>
                    </div>


                    <div class="flex flex-col items-center flex-1">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $currentStep >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }} font-medium text-sm">
                            @if($currentStep > 2)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            @else
                                2
                            @endif
                        </div>
                        <span class="mt-2 text-xs text-center font-medium {{ $currentStep >= 2 ? 'text-gray-900' : 'text-gray-500' }}">Options</span>
                    </div>

                    <div class="flex flex-col items-center flex-1">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $currentStep >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }} font-medium text-sm">
                            @if($currentStep > 3)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            @else
                                3
                            @endif
                        </div>
                        <span class="mt-2 text-xs text-center font-medium {{ $currentStep >= 3 ? 'text-gray-900' : 'text-gray-500' }}">Driver Info</span>
                    </div>

                    <div class="flex flex-col items-center flex-1">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $currentStep >= 4 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }} font-medium text-sm">
                            @if($currentStep > 4)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            @else
                                4
                            @endif
                        </div>
                        <span class="mt-2 text-xs text-center font-medium {{ $currentStep >= 4 ? 'text-gray-900' : 'text-gray-500' }}">Payment</span>
                    </div>

                    <div class="flex flex-col items-center flex-1">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $currentStep >= 5 ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }} font-medium text-sm">
                            @if($currentStep >= 5)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            @else
                                5
                            @endif
                        </div>
                        <span class="mt-2 text-xs text-center font-medium {{ $currentStep >= 5 ? 'text-gray-900' : 'text-gray-500' }}">Confirmation</span>
                    </div>
                </div>

            </div>
                <div class="absolute top-[100%] bottom-[100%] left-0 right-0 h-0.5 bg-gray-200 -z-10">
                    <div class="h-full bg-blue-600 transition-all duration-500" style="width: {{ (($currentStep - 1) / 4) * 100 }}%"></div>
                </div>
        </div>
    </div>


    <div class="max-w-6xl mx-auto px-4 py-8">
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                @if($currentStep === 1)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Selected Vehicle</h2>
                        <button wire:click="changeVehicule" class="cursor-pointer ml-auto text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Change Vehicle
                        </button>
                    </div>

                    <div class="border border-gray-200 rounded-lg p-4 mb-6">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/3 mb-4 md:mb-0">
                                <img src="{{ $selectedVehicule->getFirstMediaUrl('vehicules') }}"
                                       alt="{{ $selectedVehicule->marque }} {{ $selectedVehicule->modele }}"
                                     class="w-full h-32 object-cover rounded-lg">
                            </div>
                            <div class="md:w-2/3 md:ml-4">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    {{ $selectedVehicule->annee }} {{ $selectedVehicule->marque }} {{ $selectedVehicule->modele }}
                                </h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600 mb-4">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1h.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-2a1 1 0 00-.293-.707l-3-3A1 1 0 0016 7h-1V5a1 1 0 00-1-1H3z"></path>
                                        </svg>
                                        <span>{{ $selectedVehicule->nombre_places }} seats</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ ucfirst($selectedVehicule->type_carburant) }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ ucfirst($selectedVehicule->transmission) }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        {{-- Adjusted based on potential 'type' column or fallback to modele --}}
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                            {{ ucfirst($selectedVehicule->type ?? $selectedVehicule->modele) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $selectedVehicule->average_rating ? 'fill-current' : 'text-gray-300' }}"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-600">{{ number_format($selectedVehicule->average_rating, 1) }} ({{ $selectedVehicule->reviews_count }})</span>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-2xl font-bold text-blue-600">MAD {{ number_format($selectedVehicule->tarif_journalier, 2) }}<span class="text-sm font-normal text-gray-600">/day</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                           <div>
                                               <label for="pickup_datetime" class="block text-sm font-medium text-gray-700 mb-2">Pick-up Date & Time *</label>
                                               <input wire:model.live="pickupDateTime" type="datetime-local" id="pickup_datetime"
                                                      min="{{ Carbon\Carbon::now()->addMinutes(15)->format('Y-m-d\TH:i') }}"
                                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                               @error('pickupDateTime') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                           </div>
                                           <div>
                                               <label for="return_datetime" class="block text-sm font-medium text-gray-700 mb-2">Return Date & Time *</label>
                                               <input wire:model.live="returnDateTime" type="datetime-local" id="return_datetime"
                                                      min="{{ \Carbon\Carbon::parse($pickupDateTime)->addMinutes(30)->format('Y-m-d\TH:i') ?? Carbon\Carbon::now()->addHour()->format('Y-m-d\TH:i') }}"
                                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                               @error('returnDateTime') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                           </div>
                                       </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Location</label>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                        <h4 class="font-medium text-gray-900">{{ $selectedVehicule->location->name ?? 'N/A' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $selectedVehicule->location->address ?? 'Address not available' }}</p>
                                    <p class="text-sm text-gray-600">{{ $selectedVehicule->location->city ?? '' }}, {{ $selectedVehicule->location->state ?? '' }} {{ $selectedVehicule->location->zip_code ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @elseif($currentStep === 2)
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Insurance Coverage</h2>
                        <div class="space-y-4">
                            <label class="block">
                                <div class="flex items-start p-4 border-2 rounded-lg cursor-pointer {{ $selectedInsurance === 'basic' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }}">
                                    <input wire:model.live="selectedInsurance" type="radio" value="basic" class="mt-1 text-blue-600">
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="font-semibold text-gray-900">Basic Coverage</h3>
                                            <span class="text-lg font-bold text-green-600">Included</span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">Standard protection with $1,000 deductible</p>
                                        <ul class="mt-2 text-sm text-gray-600 space-y-1">
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Collision damage waiver
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Theft protection
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </label>

                            <label class="block">
                                <div class="flex items-start p-4 border-2 rounded-lg cursor-pointer {{ $selectedInsurance === 'premium' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }}">
                                    <input wire:model.live="selectedInsurance" type="radio" value="premium" class="mt-1 text-blue-600">
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="font-semibold text-gray-900">Premium Coverage</h3>
                                            <span class="text-lg font-bold text-blue-600">+$12/day</span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">Enhanced protection with $500 deductible</p>
                                        <ul class="mt-2 text-sm text-gray-600 space-y-1">
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Everything in Basic
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Personal accident insurance
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Personal effects coverage
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </label>

                            <label class="block">
                                <div class="flex items-start p-4 border-2 rounded-lg cursor-pointer {{ $selectedInsurance === 'comprehensive' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }}">
                                    <input wire:model.live="selectedInsurance" type="radio" value="comprehensive" class="mt-1 text-blue-600">
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="font-semibold text-gray-900">Comprehensive Coverage</h3>
                                            <span class="text-lg font-bold text-blue-600">+$25/day</span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">Full protection with zero deductible</p>
                                        <ul class="mt-2 text-sm text-gray-600 space-y-1">
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Everything in Premium
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Zero deductible
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                24/7 roadside assistance
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Additional Options</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-start p-4 border border-gray-200 rounded-lg hover:border-blue-300 cursor-pointer">
                                <input wire:model.live="selectedAddons" type="checkbox" value="gps" class="mt-1 text-blue-600">
                                <div class="ml-3 flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900">GPS Navigation</h4>
                                            <p class="text-sm text-gray-600">Built-in GPS with real-time traffic</p>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">+$8/day</span>
                                    </div>
                                </div>
                            </label>

                            <label class="flex items-start p-4 border border-gray-200 rounded-lg hover:border-blue-300 cursor-pointer">
                                <input wire:model.live="selectedAddons" type="checkbox" value="child_seat" class="mt-1 text-blue-600">
                                <div class="ml-3 flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900">Child Safety Seat</h4>
                                            <p class="text-sm text-gray-600">Safe and secure for children 2-8 years</p>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">+$10/day</span>
                                    </div>
                                </div>
                            </label>

                            <label class="flex items-start p-4 border border-gray-200 rounded-lg hover:border-blue-300 cursor-pointer">
                                <input wire:model.live="selectedAddons" type="checkbox" value="wifi" class="mt-1 text-blue-600">
                                <div class="ml-3 flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900">Mobile WiFi Hotspot</h4>
                                            <p class="text-sm text-gray-600">Stay connected with 4G internet</p>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">+$6/day</span>
                                    </div>
                                </div>
                            </label>

                            <label class="flex items-start p-4 border border-gray-200 rounded-lg hover:border-blue-300 cursor-pointer">
                                <input wire:model.live="selectedAddons" type="checkbox" value="additional_driver" class="mt-1 text-blue-600">
                                <div class="ml-3 flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900">Additional Driver</h4>
                                            <p class="text-sm text-gray-600">Allow another person to drive</p>
                                        </div>
                                        <span class="text-sm font-medium text-blue-600">+$15/day</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                @elseif($currentStep === 3)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Driver Information</h2>

                    <form class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Primary Driver</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_first_name">First Name *</label>
                                    <input wire:model.live="driverInfo.first_name" type="text" id="driver_first_name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.first_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_last_name">Last Name *</label>
                                    <input wire:model.live="driverInfo.last_name" type="text" id="driver_last_name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.last_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_cin">CIN *</label>
                                    <input wire:model.live="driverInfo.cin" type="text" id="driver_cin" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.cin') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_email">Email Address *</label>
                                    <input wire:model.live="driverInfo.email" type="email" id="driver_email" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_phone">Phone Number *</label>
                                    <input wire:model.live="driverInfo.phone" type="tel" id="driver_phone" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_dob">Date of Birth *</label>
                                    <input wire:model.live="driverInfo.date_of_birth" type="date" id="driver_dob" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.date_of_birth') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_license">Driver's License Number *</label>
                                    <input wire:model.live="driverInfo.license_number" type="text" id="driver_license" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.license_number') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="license_expiry">License Expiry Date *</label>
                                    <input wire:model.live="driverInfo.license_expiry" type="date" id="license_expiry" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.license_expiry') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_address">Address *</label>
                                    <input wire:model.live="driverInfo.address" type="text" id="driver_address" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_city">City *</label>
                                    <input wire:model.live="driverInfo.city" type="text" id="driver_city" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.city') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_state">State *</label>
                                    <select wire:model.live="driverInfo.state" id="driver_state" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Select State</option>
                                        @foreach($states as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('driverInfo.state') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="driver_zip_code">ZIP Code *</label>
                                    <input wire:model.live="driverInfo.zip_code" type="text" id="driver_zip_code" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('driverInfo.zip_code') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>

                            </div>
                        </div>

                        @if(in_array('additional_driver', $selectedAddons))
                        <div class="pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Additional Driver</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="add_driver_first_name">First Name *</label>
                                    <input wire:model.live="additionalDriverInfo.first_name" type="text" id="add_driver_first_name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('additionalDriverInfo.first_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="add_driver_last_name">Last Name *</label>
                                    <input wire:model.live="additionalDriverInfo.last_name" type="text" id="add_driver_last_name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('additionalDriverInfo.last_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="add_driver_dob">Date of Birth *</label>
                                    <input wire:model.live="additionalDriverInfo.date_of_birth" type="date" id="add_driver_dob" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('additionalDriverInfo.date_of_birth') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="add_driver_license">Driver's License Number *</label>
                                    <input wire:model.live="additionalDriverInfo.license_number" type="text" id="add_driver_license" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('additionalDriverInfo.license_number') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>

                @elseif($currentStep === 4)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Information</h2>

                    <form class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Method *</h3>
                            <div class="space-y-3">
                                <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-300">
                                    <input wire:model.live="paymentMethod" type="radio" value="credit_card" class="text-blue-600">
                                    <div class="ml-3 flex items-center">
                                        <svg class="w-8 h-5 mr-2" viewBox="0 0 32 20" fill="none">
                                            <rect width="32" height="20" rx="4" fill="#1976D2"/>
                                            <path d="M8 8h16v4H8V8z" fill="white"/>
                                        </svg>
                                        <span class="font-medium">Credit/Debit Card</span>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-300">
                                    <input wire:model.live="paymentMethod" type="radio" value="paypal" class="text-blue-600">
                                    <div class="ml-3 flex items-center">
                                        <svg class="w-8 h-5 mr-2" viewBox="0 0 32 20" fill="none">
                                            <rect width="32" height="20" rx="4" fill="#003087"/>
                                            <path d="M12 6c2.2 0 4 1.8 4 4s-1.8 4-4 4H8V6h4z" fill="#009CDE"/>
                                        </svg>
                                        <span class="font-medium">PayPal</span>
                                    </div>
                                </label>
                            </div>
                            @error('paymentMethod') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        @if($paymentMethod === 'credit_card')
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="card_number">Card Number *</label>
                                <input wire:model.live="cardInfo.number" type="text" id="card_number" placeholder="1234 5678 9012 3456" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('cardInfo.number') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="card_name">Cardholder Name *</label>
                                <input wire:model.live="cardInfo.name" type="text" id="card_name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('cardInfo.name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="card_expiry">Expiry Date (MM/YY) *</label>
                                    <input wire:model.live="cardInfo.expiry" type="text" id="card_expiry" placeholder="MM/YY" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('cardInfo.expiry') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="card_cvv">CVV *</label>
                                    <input wire:model.live="cardInfo.cvv" type="text" id="card_cvv" placeholder="123" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('cardInfo.cvv') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        @endif

                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Billing Address</h3>
                                <label class="flex items-center">
                                    <input wire:model.live="sameAsDriverAddress" type="checkbox" class="rounded border-gray-300 text-blue-600">
                                    <span class="ml-2 text-sm text-gray-600">Same as driver address</span>
                                </label>
                            </div>

                            @unless($sameAsDriverAddress)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="billing_address">Address *</label>
                                    <input wire:model.live="billingInfo.address" type="text" id="billing_address" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('billingInfo.address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="billing_city">City *</label>
                                    <input wire:model.live="billingInfo.city" type="text" id="billing_city" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('billingInfo.city') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="billing_state">State *</label>
                                    <select wire:model.live="billingInfo.state" id="billing_state" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Select State</option>
                                        @foreach($states as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('billingInfo.state') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="billing_zip_code">ZIP Code *</label>
                                    <input wire:model.live="billingInfo.zip_code" type="text" id="billing_zip_code" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('billingInfo.zip_code') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @endunless
                        </div>
                    </form>
                </div>

                @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Booking Confirmed!</h2>
                        <p class="text-gray-600">Your reservation has been successfully processed.</p>
                        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-blue-800">
                                <strong>Confirmation Number:</strong> {{ $confirmationNumber }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Details</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium text-gray-700">Vehicle:</span>
                                        <span class="text-gray-900">{{ $selectedVehicule->annee }} {{ $selectedVehicule->marque }} {{ $selectedVehicule->modele }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700">Pickup Date:</span>
                                        <span class="text-gray-900">{{ \Carbon\Carbon::parse($pickupDateTime)->format('M j, Y g:i A') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700">Return Date:</span>
                                        <span class="text-gray-900">{{ \Carbon\Carbon::parse($returnDateTime)->format('M j, Y g:i A') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700">Duration:</span>
                                        <span class="text-gray-900">{{ $this->totalDays }} day{{ $this->totalDays > 1 ? 's' : '' }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700">Pickup Location:</span>
                                        <span class="text-gray-900">{{ $selectedVehicule->location->name ?? 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-700">Total Amount:</span>
                                        <span class="text-gray-900 font-bold">${{ number_format($finalTotalPrice, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">What's Next?</h3>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <span class="text-blue-600 text-sm font-bold">1</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Check your email</p>
                                        <p class="text-sm text-gray-600">We've sent you a confirmation email with all the details.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <span class="text-blue-600 text-sm font-bold">2</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Bring required documents</p>
                                        <p class="text-sm text-gray-600">Valid driver's license and credit card for pickup.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <span class="text-blue-600 text-sm font-bold">3</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Arrive at pickup location</p>
                                        <p class="text-sm text-gray-600">Please arrive 15 minutes before your scheduled pickup time.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <button wire:click="downloadConfirmation"
                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                Download Confirmation
                            </button>
                            <button wire:click="manageBooking"
                                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-4 rounded-lg transition-colors">
                                Manage Booking
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Summary</h3>

                    <div class="flex items-center mb-4 pb-4 border-b border-gray-200">
                    <img src="{{ $selectedVehicule->getFirstMediaUrl('vehicules') }}"
                           alt="{{ $selectedVehicule->marque }} {{ $selectedVehicule->modele }}"
                             class="w-16 h-12 object-cover rounded mr-3">
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $selectedVehicule->marque }} {{ $selectedVehicule->modele }}</h4>
                            {{-- Adjusted for potentially missing 'type' column --}}
                            <p class="text-sm text-gray-600">{{ $selectedVehicule->annee }} • {{ ucfirst($selectedVehicule->type ?? $selectedVehicule->modele) }}</p>
                        </div>
                    </div>

                    @if($pickupDateTime && $returnDateTime)
                    <div class="space-y-2 mb-4 pb-4 border-b border-gray-200 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pick-up:</span>
                            <span class="text-gray-900">{{ \Carbon\Carbon::parse($pickupDateTime)->format('M j, g:i A') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Return:</span>
                            <span class="text-gray-900">{{ \Carbon\Carbon::parse($returnDateTime)->format('M j, g:i A') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Duration:</span>
                            <span class="text-gray-900">{{ $this->totalDays }} day{{ $this->totalDays !== 1 ? 's' : '' }}</span>
                        </div>
                    </div>
                    @endif

                    @if($this->totalDays > 0)
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Daily rate:</span>
                            <span class="text-gray-900">MAD {{ number_format($selectedVehicule->tarif_journalier, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ $this->totalDays }} day{{ $this->totalDays !== 1 ? 's' : '' }}:</span>
                            <span class="text-gray-900">${{ number_format($this->subtotal, 2) }}</span>
                        </div>

                        @if($this->selectedInsurance && $this->selectedInsurance !== 'basic')
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $this->selectedInsurance)) }} Insurance:</span>
                            <span class="text-gray-900">${{ number_format($this->insuranceCost, 2) }}</span>
                        </div>
                        @endif

                        @if(count($this->selectedAddons) > 0)
                        @foreach($this->selectedAddons as $addon)
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $addon)) }}:</span>
                            <span class="text-gray-900">${{ number_format($this->addonCosts[$addon] ?? 0, 2) }}</span>
                        </div>
                        @endforeach
                        @endif

                        <div class="flex justify-between">
                            <span class="text-gray-600">Taxes & fees:</span>
                            <span class="text-gray-900">${{ number_format($this->taxesAndFees, 2) }}</span>
                        </div>

                        @if($this->discountAmount > 0)
                        <div class="flex justify-between text-red-600">
                            <span>Discount:</span>
                            <span>-${{ number_format($this->discountAmount, 2) }}</span>
                        </div>
                        @endif

                        <div class="flex justify-between pt-2 border-t border-gray-200 font-bold text-lg">
                            <span>Total:</span>
                            <span class="text-blue-600">${{ number_format($this->totalPrice, 2) }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="mt-6 space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Free cancellation up to 24 hours</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Secure payment processing</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span>24/7 customer support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex justify-between mt-8">
            @if($currentStep > 1 && $currentStep < 5)
            <button wire:click="previousStep"
                    class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                Previous
            </button>
            @else
            <div></div> {{-- Placeholder to keep buttons aligned --}}
            @endif

            @if($currentStep < 4)
            <button wire:click="nextStep"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                Continue
            </button>
            @elseif($currentStep === 4)
            <button wire:click="processPayment"
                    class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                Complete Booking
            </button>
            @else
            <a href="{{ route('vehicules.index') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                Book Another Vehicle
            </a>
            @endif
        </div>
    </div>
</div>
