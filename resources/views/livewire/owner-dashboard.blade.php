<x-layouts.app :title="__('Owner Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 p-4">
        <!-- Dashboard Header -->
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Owner Dashboard
            </h1>
            <div class="flex items-center gap-4">
                <p class="text-gray-600 dark:text-gray-400">
                    Manage your vehicles and rentals
                </p>
                <x-button
                    wire:click="redirectToAddVehicle"
                    icon="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    variant="primary"
                    size="sm"
                >
                    Add New Vehicle
                </x-button>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <!-- Total Vehicles -->
            <x-dashboard.stat-card
                title="Total Vehicles"
                :value="$totalVehicles"
                trend="5%"
                trend-direction="up"
                icon="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"
                color="bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400"
                wire:click="redirectToVehicles"
            />

            <!-- Active Rentals -->
            <x-dashboard.stat-card
                title="Active Rentals"
                :value="$activeRentals"
                trend="12%"
                trend-direction="up"
                icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                color="bg-green-100 text-green-600 dark:bg-green-900/50 dark:text-green-400"
                wire:click="redirectToRentals('active')"
            />

            <!-- Revenue -->
            <x-dashboard.stat-card
                title="Monthly Revenue"
                :value="'$'.number_format($monthlyRevenue, 2)"
                trend="8%"
                trend-direction="up"
                icon="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                color="bg-purple-100 text-purple-600 dark:bg-purple-900/50 dark:text-purple-400"
                wire:click="redirectToPayments"
            />

            <!-- Occupancy Rate -->
            <x-dashboard.stat-card
                title="Occupancy Rate"
                :value="$occupancyRate.'%'"
                trend="3%"
                trend-direction="down"
                icon="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                color="bg-amber-100 text-amber-600 dark:bg-amber-900/50 dark:text-amber-400"
            />
        </div>

        <!-- Main Content Grid -->
        <div class="grid flex-1 gap-6 lg:grid-cols-3">
            <!-- Vehicle List -->
            <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800 lg:col-span-2">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Your Vehicles</h2>
                    <x-button
                        wire:click="redirectToAddVehicle"
                        variant="outline"
                        size="sm"
                    >
                        Manage All
                    </x-button>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    @forelse($recentVehicles as $vehicle)
                        <x-vehicle.card
                            :vehicle="$vehicle"
                            wire:click="redirectToVehicle({{ $vehicle->id }})"
                        />
                    @empty
                        <div class="col-span-2 rounded-lg border-2 border-dashed border-gray-300 p-8 text-center dark:border-gray-600">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No vehicles added</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add your first vehicle to get started</p>
                            <div class="mt-6">
                                <x-button
                                    wire:click="redirectToAddVehicle"
                                    variant="primary"
                                    size="sm"
                                >
                                    Add Vehicle
                                </x-button>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Rental Calendar -->
            <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Rental Calendar</h2>
                    <x-button
                        wire:click="redirectToCalendar"
                        variant="outline"
                        size="sm"
                    >
                        View Full Calendar
                    </x-button>
                </div>

                <div class="overflow-hidden rounded-lg">
                    <div class="flex items-center justify-between border-b border-neutral-200 bg-neutral-50 px-4 py-2 dark:border-neutral-700 dark:bg-neutral-800">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ now()->format('F Y') }}</span>
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

                        @foreach($calendarDays as $day)
                            <div @class([
                                'relative h-16 bg-white p-1 dark:bg-neutral-900',
                                'border-l border-blue-500' => $day['isToday'],
                                'text-gray-400' => !$day['isCurrentMonth'],
                            ])>
                                <span class="absolute top-1 right-1 text-xs">{{ $day['day'] }}</span>

                                @foreach($day['events'] as $event)
                                    <div
                                        class="mt-4 overflow-hidden rounded bg-blue-50 px-1 py-0.5 text-xs text-blue-700 dark:bg-blue-900/50 dark:text-blue-300"
                                        title="{{ $event['title'] }}"
                                    >
                                        <p class="truncate">{{ $event['title'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Rentals -->
            <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800 lg:col-span-3">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Rentals</h2>
                    <x-button
                        wire:click="redirectToRentals"
                        variant="outline"
                        size="sm"
                    >
                        View All Rentals
                    </x-button>
                </div>

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
                            @forelse($recentRentals as $rental)
                                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/50">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-md object-cover" src="{{ $rental->vehicle->image_url }}" alt="{{ $rental->vehicle->make }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $rental->vehicle->make }} {{ $rental->vehicle->model }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $rental->vehicle->license_plate }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $rental->client->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $rental->client->email }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-white">{{ $rental->start_date->format('M d') }} - {{ $rental->end_date->format('M d') }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $rental->duration_in_days }} days</div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <x-rental.status-badge :status="$rental->status" />
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        ${{ number_format($rental->total_amount, 2) }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <x-dropdown>
                                            <x-slot name="trigger">
                                                <button type="button" class="flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                    <span class="sr-only">Open options</span>
                                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                                    </svg>
                                                </button>
                                            </x-slot>
                                            <x-dropdown-link wire:click="viewRental({{ $rental->id }})">View</x-dropdown-link>
                                            <x-dropdown-link wire:click="editRental({{ $rental->id }})">Edit</x-dropdown-link>
                                            @if($rental->canBeCancelled())
                                                <x-dropdown-link wire:click="cancelRental({{ $rental->id }})">Cancel</x-dropdown-link>
                                            @endif
                                        </x-dropdown>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No rentals found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
