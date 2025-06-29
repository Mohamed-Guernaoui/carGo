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
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Welcome, {{ Auth::user()->name ?? 'Client' }}!
            </h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your car rental reservations.</p>
        </div>

    </div>

    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <x-dashboard.stat-card
            title="Upcoming Rentals"
            value="{{ $upcomingReservations->count() }}"
            trend="" {{-- You can add dynamic trends if your component calculates them --}}
            trend-direction="none"
            icon="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
            color="bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400"
            onclick="window.location.href='#upcoming-rentals'" {{-- Scroll to section --}}
        />

        <x-dashboard.stat-card
            title="Active Rentals"
            value="{{ $activeReservations->count() }}"
            trend=""
            trend-direction="none"
            icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
            color="bg-green-100 text-green-600 dark:bg-green-900/50 dark:text-green-400"
            onclick="window.location.href='#active-rentals'" {{-- Scroll to section --}}
        />

        <x-dashboard.stat-card
            title="Past Rentals"
            value="{{ $pastReservations->count() }}"
            trend=""
            trend-direction="none"
            icon="M14 10h-4m0 0l4-4m-4 4l4 4m7-3a9 9 0 11-18 0 9 9 0 0118 0z"
            color="bg-purple-100 text-purple-600 dark:bg-purple-900/50 dark:text-purple-400"
            onclick="window.location.href='#past-rentals'" {{-- Scroll to section --}}
        />
    </div>

    <div class="grid flex-1 gap-6 lg:grid-cols-1">
        <div id="upcoming-rentals" class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Upcoming Reservations</h2>

            @if($upcomingReservations->isEmpty())
                <div class="rounded-lg border-2 border-dashed border-gray-300 p-8 text-center dark:border-gray-600">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No upcoming reservations</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Time to book your next adventure!</p>
                    <div class="mt-6">
                        <x-button href="{{ route('vehicules.index') }}" variant="primary" size="sm">
                            Book a Car
                        </x-button>
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($upcomingReservations as $reservation)
                        <div class="border border-neutral-200 dark:border-neutral-700 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <img src="{{ $reservation->vehicule->getFirstMediaUrl('vehicules')  }}" alt="{{ $reservation->vehicule->marque }}" class="w-24 h-16 object-cover rounded-md flex-shrink-0 mb-3 sm:mb-0 sm:mr-4">
                                <div class="flex-grow">
                                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white">
                                        {{ $reservation->vehicule->marque }} {{ $reservation->vehicule->modele }}
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $reservation->vehicule->annee }} | License: {{ $reservation->vehicule->plaque_immatriculation }}
                                    </p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 mt-2 text-sm text-gray-700 dark:text-gray-300">
                                        <div>
                                            <span class="font-medium">Pickup:</span> {{ $reservation->date_debut_location->format('M j, Y H:i') }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Return:</span> {{ $reservation->date_fin_location->format('M j, Y H:i') }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Duration:</span> {{ $reservation->duration_in_days }} day{{ $reservation->duration_in_days !== 1 ? 's' : '' }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Total:</span> ${{ number_format($reservation->prix_total, 2) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 sm:ml-auto flex flex-col items-end gap-2">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $reservation->status_color }}">
                                        {{ $reservation->status_text }}
                                    </span>
                                    <a href="{{-- route('client.reservations.show', $reservation->id) --}}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                        View Details
                                    </a>
                                    {{-- Add options for cancelling if appropriate for 'upcoming' --}}
                                    {{-- <x-button wire:click="cancelReservation({{ $reservation->id }})" variant="danger" size="xs">Cancel</x-button> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="active-rentals" class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Active Reservations</h2>
            @if($activeReservations->isEmpty())
                <div class="rounded-lg border-2 border-dashed border-gray-300 p-8 text-center dark:border-gray-600">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No active rentals right now</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Enjoy your current ride, or plan your next!</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($activeReservations as $reservation)
                        <div class="border border-neutral-200 dark:border-neutral-700 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <img src="{{ $reservation->vehicule->primary_image_url }}" alt="{{ $reservation->vehicule->marque }}" class="w-24 h-16 object-cover rounded-md flex-shrink-0 mb-3 sm:mb-0 sm:mr-4">
                                <div class="flex-grow">
                                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white">
                                        {{ $reservation->vehicule->marque }} {{ $reservation->vehicule->modele }}
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $reservation->vehicule->annee }} | License: {{ $reservation->vehicule->plaque_immatriculation }}
                                    </p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 mt-2 text-sm text-gray-700 dark:text-gray-300">
                                        <div>
                                            <span class="font-medium">Pickup:</span> {{ $reservation->date_debut_location->format('M j, Y H:i') }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Return:</span> {{ $reservation->date_fin_location->format('M j, Y H:i') }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Duration:</span> {{ $reservation->duration_in_days }} day{{ $reservation->duration_in_days !== 1 ? 's' : '' }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Total:</span> ${{ number_format($reservation->prix_total, 2) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 sm:ml-auto flex flex-col items-end gap-2">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $reservation->status_color }}">
                                        {{ $reservation->status_text }}
                                    </span>
                                    <a href="{{-- route('client.reservations.show', $reservation->id) --}}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="past-rentals" class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Past Reservations</h2>
            @if($pastReservations->isEmpty())
                <div class="rounded-lg border-2 border-dashed border-gray-300 p-8 text-center dark:border-gray-600">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 10h-4m0 0l4-4m-4 4l4 4m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No past reservations</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Your rental history will appear here.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($pastReservations as $reservation)
                        <div class="border border-neutral-200 dark:border-neutral-700 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200 opacity-75">
                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <img src="{{ $reservation->vehicule->primary_image_url }}" alt="{{ $reservation->vehicule->marque }}" class="w-24 h-16 object-cover rounded-md flex-shrink-0 mb-3 sm:mb-0 sm:mr-4">
                                <div class="flex-grow">
                                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white">
                                        {{ $reservation->vehicule->marque }} {{ $reservation->vehicule->modele }}
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $reservation->vehicule->annee }} | License: {{ $reservation->vehicule->plaque_immatriculation }}
                                    </p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 mt-2 text-sm text-gray-700 dark:text-gray-300">
                                        <div>
                                            <span class="font-medium">Pickup:</span> {{ $reservation->date_debut_location->format('M j, Y H:i') }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Return:</span> {{ $reservation->date_fin_location->format('M j, Y H:i') }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Duration:</span> {{ $reservation->duration_in_days }} day{{ $reservation->duration_in_days !== 1 ? 's' : '' }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Total:</span> ${{ number_format($reservation->prix_total, 2) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 sm:ml-auto flex flex-col items-end gap-2">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $reservation->status_color }}">
                                        {{ $reservation->status_text }}
                                    </span>
                                    <a href="{{-- route('client.reservations.show', $reservation->id) --}}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
