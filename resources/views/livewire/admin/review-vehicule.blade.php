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
            <a href="{{ route('admin.dashboard') }}" class=" cursor-pointer inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Vehicles List
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                {{ $vehicule->marque }} {{ $vehicule->modele }} ({{ $vehicule->annee }})
            </h1>
            <p class="text-gray-600 dark:text-gray-400">{{ $vehicule->plaque_immatriculation }}</p>
        </div>

        <div class="flex gap-2">
            <x-button wire:click="redirectToEdit" variant="outline"     >
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Edit Vehicle
            </x-button>
            <x-button wire:click="deleteVehicule" variant="danger"       onclick="return confirm('Are you sure you want to delete this vehicle? This action cannot be undone.');">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H8a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Delete Vehicle
            </x-button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <div class="mb-6">
                <img src="{{ $vehicule->getFirstMediaUrl('vehicules') }}"
                     alt="{{ $vehicule->marque }} {{ $vehicule->modele }}"
                     class="w-full h-80 object-cover rounded-lg shadow-md">
            </div>

            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Vehicle Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300 mb-6">
                <div>
                    <span class="font-semibold">Make:</span> {{ $vehicule->marque }}
                </div>
                <div>
                    <span class="font-semibold">Model:</span> {{ $vehicule->modele }}
                </div>
                <div>
                    <span class="font-semibold">Year:</span> {{ $vehicule->annee }}
                </div>
                <div>
                    <span class="font-semibold">Color:</span> {{ $vehicule->couleur ?? 'N/A' }}
                </div>
                <div>
                    <span class="font-semibold">License Plate:</span> {{ $vehicule->plaque_immatriculation }}
                </div>
                <div>
                    <span class="font-semibold">Seats:</span> {{ $vehicule->nombre_places }}
                </div>
                <div>
                    <span class="font-semibold">Transmission:</span> {{ ucfirst($vehicule->transmission ?? 'N/A') }}
                </div>
                <div>
                    <span class="font-semibold">Fuel Type:</span> {{ ucfirst($vehicule->type_carburant ?? 'N/A') }}
                </div>
                <div>
                    <span class="font-semibold">Daily Rate:</span> ${{ number_format($vehicule->tarif_journalier, 2) }}
                </div>
                 <div>
                    <span class="font-semibold">Location:</span> {{ $vehicule->location->name ?? 'N/A' }}
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Description</h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ $vehicule->description ?? 'No description provided.' }}
                </p>
            </div>

            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">
                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                    Availability:
                    <span class="{{ $vehicule->disponible ? 'text-green-600' : 'text-red-600' }}">
                        {{ $vehicule->disponible ? 'Available' : 'Unavailable' }}
                    </span>
                </div>
                <x-button wire:click="toggleAvailability"  >
                    {{ $vehicule->disponible ? 'Set Unavailable' : 'Set Available' }}
                </x-button>
            </div>
        </div>

        <div class="lg:col-span-1 rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Recent Rentals for This Vehicle</h2>

            @php
                // Fetch recent rentals for this specific vehicle
                $recentVehicleRentals = $vehicule->reservations()->with('client')
                                        ->orderBy('date_debut_location', 'desc')
                                        ->limit(5)->get();
            @endphp

            @if($recentVehicleRentals->isEmpty())
                <div class="rounded-lg border-2 border-dashed border-gray-300 p-6 text-center dark:border-gray-600">
                    <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H8a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No recent rentals</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This vehicle has no recent booking history.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($recentVehicleRentals as $rental)
                        <div class="border border-neutral-200 dark:border-neutral-700 rounded-lg p-3">
                            <div class="flex items-center justify-between mb-1">
                                <div class="font-medium text-gray-900 dark:text-white">
                                    {{ $rental->client->name ?? 'Guest' }}
                                </div>
                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $rental->status_color }}">
                                    {{ $rental->status_text }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                                {{ $rental->date_debut_location->format('M j, Y') }} - {{ $rental->date_fin_location->format('M j, Y') }}
                            </p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                Total: ${{ number_format($rental->prix_total, 2) }}
                            </p>
                            <a {{--href="{{ route('owner.rentals.show', $rental->id) }}" --}} class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 text-xs mt-2 inline-block">View Details</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
