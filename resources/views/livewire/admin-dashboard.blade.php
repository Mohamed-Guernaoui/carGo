<div>
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

                    wire:click="redirectToAddVehicule"
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
                value="8"
                trend="5%"
                trend-direction="up"
                icon="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"
                color="bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400"
                onclick="window.location.href='/owner/vehicles'"
            />

            <!-- Active Rentals -->
            <x-dashboard.stat-card
                title="Active Rentals"
                value="3"
                trend="12%"
                trend-direction="up"
                icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                color="bg-green-100 text-green-600 dark:bg-green-900/50 dark:text-green-400"
                onclick="window.location.href='/owner/rentals?status=active'"
            />

            <!-- Revenue -->
            <x-dashboard.stat-card
                title="Monthly Revenue"
                value="$4,250.00"
                trend="8%"
                trend-direction="up"
                icon="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                color="bg-purple-100 text-purple-600 dark:bg-purple-900/50 dark:text-purple-400"
                onclick="window.location.href='/owner/payments'"
            />

            <!-- Occupancy Rate -->
            <x-dashboard.stat-card
                title="Occupancy Rate"
                value="72%"
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
                        onclick="window.location.href='/owner/vehicles'"
                        variant="outline"
                        size="sm"
                    >
                        Manage All
                    </x-button>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <!-- Fake Vehicle 1 -->
                    <div class="cursor-pointer rounded-lg border border-gray-200 p-4 transition hover:shadow-md dark:border-gray-700"
                         onclick="window.location.href='/owner/vehicles/1'">
                        <div class="flex items-center">
                            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md">
                                <img class="h-full w-full object-cover" src="https://source.unsplash.com/random/300x200/?car,1" alt="Vehicle">
                            </div>
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-900 dark:text-white">Toyota Camry</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">2022 • Sedan</p>
                                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">$85/day</p>
                            </div>
                        </div>
                    </div>

                    <!-- Fake Vehicle 2 -->
                    <div class="cursor-pointer rounded-lg border border-gray-200 p-4 transition hover:shadow-md dark:border-gray-700"
                         onclick="window.location.href='/owner/vehicles/2'">
                        <div class="flex items-center">
                            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md">
                                <img class="h-full w-full object-cover" src="https://source.unsplash.com/random/300x200/?car,2" alt="Vehicle">
                            </div>
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-900 dark:text-white">Ford Explorer</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">2021 • SUV</p>
                                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">$120/day</p>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State (commented out since we have fake vehicles) -->
                    <!-- <div class="col-span-2 rounded-lg border-2 border-dashed border-gray-300 p-8 text-center dark:border-gray-600">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No vehicles added</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add your first vehicle to get started</p>
                        <div class="mt-6">
                            <x-button
                                onclick="window.location.href='/owner/vehicles/create'"
                                variant="primary"
                                size="sm"
                            >
                                Add Vehicle
                            </x-button>
                        </div>
                    </div> -->
                </div>
            </div>

            <!-- Rental Calendar -->
            <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Rental Calendar</h2>
                    <x-button
                        onclick="window.location.href='/owner/calendar'"
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

                        <!-- Fake calendar days with events -->
                        @php
                            $today = now()->day;
                            $daysInMonth = now()->daysInMonth;
                            $firstDayOfMonth = now()->startOfMonth()->dayOfWeek;
                            $totalDays = $firstDayOfMonth + $daysInMonth;
                            $weeks = ceil($totalDays / 7);
                        @endphp

                        @for($i = 0; $i < $firstDayOfMonth; $i++)
                            <div class="relative h-16 bg-white p-1 text-gray-400 dark:bg-neutral-900"></div>
                        @endfor

                        @for($day = 1; $day <= $daysInMonth; $day++)
                            <div @class([
                                'relative h-16 bg-white p-1 dark:bg-neutral-900',
                                'border-l border-blue-500' => $day == $today,
                            ])>
                                <span class="absolute top-1 right-1 text-xs">{{ $day }}</span>

                                @if($day == 5)
                                    <div class="mt-4 overflow-hidden rounded bg-blue-50 px-1 py-0.5 text-xs text-blue-700 dark:bg-blue-900/50 dark:text-blue-300">
                                        <p class="truncate">Toyota Camry</p>
                                    </div>
                                @endif

                                @if($day == 12 || $day == 13)
                                    <div class="mt-4 overflow-hidden rounded bg-green-50 px-1 py-0.5 text-xs text-green-700 dark:bg-green-900/50 dark:text-green-300">
                                        <p class="truncate">Ford Explorer</p>
                                    </div>
                                @endif

                                @if($day == 20)
                                    <div class="mt-4 overflow-hidden rounded bg-purple-50 px-1 py-0.5 text-xs text-purple-700 dark:bg-purple-900/50 dark:text-purple-300">
                                        <p class="truncate">Honda Accord</p>
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Recent Rentals -->
            <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-800 lg:col-span-3">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Rentals</h2>
                    <x-button
                        onclick="window.location.href='/owner/rentals'"
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
                            <!-- Fake Rental 1 -->
                            <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/50">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-md object-cover" src="https://source.unsplash.com/random/300x200/?car,1" alt="Toyota Camry">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">Toyota Camry</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">ABC-1234</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">John Doe</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">john@example.com</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white">Jun 12 - Jun 15</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">3 days</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                        Active
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    $360.00
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <a href="/owner/rentals/1" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                </td>
                            </tr>

                            <!-- Fake Rental 2 -->
                            <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/50">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-md object-cover" src="https://source.unsplash.com/random/300x200/?car,2" alt="Ford Explorer">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">Ford Explorer</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">XYZ-5678</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Jane Smith</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">jane@example.com</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white">Jun 5 - Jun 10</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">5 days</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                                        Completed
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    $600.00
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <a href="/owner/rentals/2" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                </td>
                            </tr>

                            <!-- Fake Rental 3 -->
                            <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-700/50">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-md object-cover" src="https://source.unsplash.com/random/300x200/?car,3" alt="Honda Accord">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">Honda Accord</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">DEF-9012</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Robert Johnson</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">robert@example.com</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white">Jun 20 - Jun 25</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">5 days</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300">
                                        Upcoming
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    $425.00
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <a href="/owner/rentals/3" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
