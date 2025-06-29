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

    <div class="flex flex-col gap-2">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Owner Dashboard
        </h1>
        <div class="flex items-center gap-4">
            <p class="text-gray-600 dark:text-gray-400">
                Manage your Vehicules and rentals
            </p>
            {{-- Make sure x-button is available, or use a standard <button> --}}
            <x-button
                wire:click="redirectToAddVehicule"
                variant="primary"
                size="sm"
                class="cursor-pointer"
            >
                Add New Vehicle
            </x-button>
        </div>
    </div>

    <div class="grid auto-rows-min gap-4 md:grid-cols-4">
        {{-- Make sure x-dashboard.stat-card is available, or create the HTML manually --}}
        <x-dashboard.stat-card
            title="Total Vehicules"
            value="{{ $totalVehicules }}"
            trend="5%" {{-- Trend static, add logic in component if dynamic --}}
            trend-direction="up"
            icon="M8 7h12m0 0l-4-4m4 4  l-4 4m0 6H4m0 0l4 4m-4-4l4-4"
            color="bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400"
            {{--onclick="window.location.href='{{ route('owner.vehicules.index') }}'" --}}
        />

        <x-dashboard.stat-card
            title="Active Rentals"
            value="{{ $activeRentals }}"
            trend="12%" {{-- Trend static --}}
            trend-direction="up"
            icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
            color="bg-green-100 text-green-600 dark:bg-green-900/50 dark:text-green-400"
           {{--onclick="window.location.href='{{ route('owner.rentals.index', ['status' => 'active']) }}'"--}}
        />

        <x-dashboard.stat-card
            title="Monthly Revenue"
            value="${{ $monthlyRevenue }}"
            trend="8%" {{-- Trend static --}}
            trend-direction="up"
            icon="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            color="bg-purple-100 text-purple-600 dark:bg-purple-900/50 dark:text-purple-400"
           {{-- onclick="window.location.href='{{ route('owner.payments.index') }}'"--}}
        />

        <x-dashboard.stat-card
            title="Occupancy Rate"
            value="{{ $occupancyRate }}%"
            trend="3%" {{-- Trend static --}}
            trend-direction="down"
            icon="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
            color="bg-amber-100 text-amber-600 dark:bg-amber-900/50 dark:text-amber-400"
        />
    </div>

    <div class="grid flex-1 gap-6 lg:grid-cols-3">
        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800 lg:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Your Vehicules</h2>
                <x-button
                  {{--onclick="window.location.href='{{ route('owner.vehicules.index') }}'" --}}
                    variant="outline"
                    size="sm"
                >
                    Manage All
                </x-button>
            </div>

            @if($ownerVehicules->isEmpty())
                <div class="col-span-2 rounded-lg border-2 border-dashed border-gray-300 p-8 text-center dark:border-gray-600">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No Vehicules added yet</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add your first vehicle to get started and manage your inventory.</p>
                    <div class="mt-6">
                        <x-button
                            wire:click="redirectToAddVehicule"
                            variant="primary"
                            size="sm"
                        >
                            Add Vehicle
                        </x-button>
                    </div>
                </div>
            @else
                <div class="grid gap-4 md:grid-cols-2">
                    @foreach($ownerVehicules as $vehicle)
                        <div class="cursor-pointer rounded-lg border border-gray-200 p-4 transition hover:shadow-md dark:border-gray-700"
                             onclick="window.location.href='{{ route('admin.vehicules.show', $vehicle->id) }}'">
                            <div class="flex items-center">
                                <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md">
                                    <img class="h-full w-full object-cover" src="{{ $vehicle->getFirstMediaUrl('vehicules') }}" alt="{{ $vehicle->marque }} {{ $vehicle->modele }}">
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-medium text-gray-900 dark:text-white">{{ $vehicle->marque }} {{ $vehicle->modele }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $vehicle->annee }} • {{ $vehicle->display_type }}</p>
                                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">${{ number_format($vehicle->tarif_journalier, 2) }}/day</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Rental Calendar</h2>
                <x-button
                    {{-- onclick="window.location.href='{{ route('owner.calendar.index') }}'" --}}
                    variant="outline"
                    size="sm"
                >
                    View Full Calendar
                </x-button>
            </div>

            @if($ownerVehicules->isEmpty()) {{-- If no Vehicules, no rentals to show --}}
                <div class="rounded-lg border-2 border-dashed border-gray-300 p-8 text-center dark:border-gray-600">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No vehicle to display calendar for</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a vehicle to see its rental schedule.</p>
                </div>
            @else
                <div class="overflow-hidden rounded-lg">
                    <div class="flex items-center justify-between border-b border-neutral-200 bg-neutral-50 px-4 py-2 dark:border-neutral-800 dark:bg-neutral-800">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ now()->format('F Y') }}</span>
                        {{-- Add actual prev/next month logic if needed --}}
                        <div class="flex gap-2">
                            <button type="button" class="rounded-lg p-1 hover:bg-neutral-100 dark:hover:bg-neutral-700">
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <button type="button" class="rounded-lg p-1 hover:bg-neutral-100 dark:hover:bg-neutral-700">
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-7 gap-px bg-neutral-200 dark:bg-neutral-700">
                        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                            <div class="bg-neutral-50 py-1 text-center text-xs font-medium text-gray-500 dark:bg-neutral-800 dark:text-gray-400">
                                {{ $day }}
                            </div>
                        @endforeach

                        @for($i = 0; $i < $firstDayOfMonth; $i++)
                            <div class="relative h-16 bg-white p-1 text-gray-400 dark:bg-neutral-900"></div>
                        @endfor

                        @for($day = 1; $day <= $daysInMonth; $day++)
                            <div @class([
                                'relative h-16 bg-white p-1 dark:bg-neutral-900',
                                'border-l-2 border-blue-500' => $day == $todayDay, // Highlight today
                            ])>
                                <span class="absolute top-1 right-1 text-xs text-gray-700 dark:text-gray-300">{{ $day }}</span>

                                @foreach($calendarReservations as $reservation)
                                    @php
                                        // Calculate if this reservation overlaps with the current day
                                        $start = \Carbon\Carbon::createFromDate(now()->year, now()->month, $reservation['start_day']);
                                        $end = \Carbon\Carbon::createFromDate(now()->year, now()->month, $reservation['end_day']);
                                        $currentDay = \Carbon\Carbon::createFromDate(now()->year, now()->month, $day);

                                        $isDuringReservation = $currentDay->between($start->startOfDay(), $end->endOfDay());
                                    @endphp

                                    @if($isDuringReservation)
                                        <div class="mt-4 overflow-hidden rounded px-1 py-0.5 text-xs {{ $reservation['status_color'] }}">
                                            <p class="truncate">{{ $reservation['vehicule_name'] }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endfor
                    </div>
                </div>
            @endif
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800 lg:col-span-3">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Rentals</h2>
                <x-button
                    {{--onclick="window.location.href='{{ route('owner.rentals.index') }}'" --}}
                    variant="outline"
                    size="sm"
                >
                    View All Rentals
                </x-button>
            </div>

            @if($recentRentals->isEmpty())
                <div class="col-span-2 rounded-lg border-2 border-dashed border-gray-300 p-8 text-center dark:border-gray-600">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H8a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No rentals found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">You haven't had any rentals recently. Start promoting your Vehicules!</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                        <thead class="bg-neutral-50 dark:bg-neutral-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Vehicle</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Client</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Dates</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Amount</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 bg-white dark:divide-neutral-700 dark:bg-neutral-800">
                            @foreach($recentRentals as $rental)
                            <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/50">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-md object-cover" src="{{ $rental->vehicule->getFirstMediaUrl('vehicules') }}" alt="{{ $rental->vehicule->marque }} {{ $rental->vehicule->modele }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $rental->vehicule->marque }} {{ $rental->vehicule->modele }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $rental->vehicule->plaque_immatriculation }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $rental->client->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $rental->client->email ?? 'N/A' }}</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $rental->date_debut_location->format('M j') }} - {{ $rental->date_fin_location->format('M j') }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $rental->duration_in_days }} day{{ $rental->duration_in_days !== 1 ? 's' : '' }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $rental->status_color }}">
                                        {{ $rental->status_text }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    ${{ number_format($rental->prix_total, 2) }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <a href="{{ route('admin.rentals.show', $rental->id) }}" class="cursor-pointer text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
