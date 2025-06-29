<div class="flex h-full w-full flex-1 flex-col gap-6 p-4">
    <!-- Session Messages -->
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

    <!-- Page Header -->
    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to All Rentals
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                Rental Details #{{ $rental->id }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">Manage this vehicle reservation.</p>
        </div>

        <!-- Status Update -->
        <div class="flex items-center gap-2">
            <label for="status-select" class="text-sm font-medium text-gray-700 dark:text-gray-300">Update Status:</label>
            <select wire:model.live="newStatus" id="status-select"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                <option value="en_attente">En Attente</option>
                <option value="confirme">Confirmé</option>
                <option value="actif">Actif</option>
                <option value="termine">Terminé</option>
                <option value="annule">Annulé</option>
            </select>
            <x-button wire:click="updateStatus" variant="primary" size="sm">
                Save Status
            </x-button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Rental Information -->
        <div class="lg:col-span-2 rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Reservation Overview</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300 mb-6">
                <div>
                    <span class="font-semibold">Status:</span>
                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $rental->status_color }}">
                        {{ $rental->status_text }}
                    </span>
                </div>
                <div>
                    <span class="font-semibold">Total Price:</span> ${{ number_format($rental->prix_total, 2) }}
                </div>
                <div>
                    <span class="font-semibold">Pickup Date:</span> {{ $rental->date_debut_location->format('M j, Y g:i A') }}
                </div>
                <div>
                    <span class="font-semibold">Return Date:</span> {{ $rental->date_fin_location->format('M j, Y g:i A') }}
                </div>
                <div>
                    <span class="font-semibold">Duration:</span> {{ $rental->duration_in_days }} day{{ $rental->duration_in_days !== 1 ? 's' : '' }}
                </div>
            </div>

            <!-- Client Information -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Client Information</h3>
                <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg p-4">
                    <p class="text-gray-700 dark:text-gray-300">
                        <span class="font-semibold">Name:</span> {{ $rental->client->name ?? 'N/A' }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-300">
                        <span class="font-semibold">Email:</span> {{ $rental->client->email ?? 'N/A' }}
                    </p>
                    {{-- Add more client details if available in your User model, e.g., phone, address --}}
                    @if(isset($this->parsedNotesSpeciales['primary_driver']['phone']))
                        <p class="text-gray-700 dark:text-gray-300">
                            <span class="font-semibold">Phone:</span> {{ $this->parsedNotesSpeciales['primary_driver']['phone'] }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Vehicle Information -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Vehicle Information</h3>
                <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg p-4 flex items-center">
                    <img src="{{ $rental->vehicule->getFirstMediaUrl('vehicules') }}"
                         alt="{{ $rental->vehicule->marque }} {{ $rental->vehicule->modele }}"
                         class="w-20 h-16 object-cover rounded-md mr-4">
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ $rental->vehicule->annee }} {{ $rental->vehicule->marque }} {{ $rental->vehicule->modele }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            License Plate: {{ $rental->vehicule->plaque_immatriculation }}
                        </p>
                        <a href="{{ route('admin.vehicules.show', $rental->vehicule->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm mt-1 inline-block">View Vehicle Details</a>
                    </div>
                </div>
            </div>

            <!-- Additional Notes/Details (from parsedNotesSpeciales) -->
            @if(!empty($this->parsedNotesSpeciales))
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Additional Details</h3>
                    <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg p-4 space-y-2 text-gray-700 dark:text-gray-300">
                        @if(isset($this->parsedNotesSpeciales['insurance']))
                            <p><span class="font-semibold">Insurance:</span> {{ ucfirst(str_replace('_', ' ', $this->parsedNotesSpeciales['insurance'])) }}</p>
                        @endif
                        @if(isset($this->parsedNotesSpeciales['addons']) && is_array($this->parsedNotesSpeciales['addons']) && count($this->parsedNotesSpeciales['addons']) > 0)
                            <p><span class="font-semibold">Add-ons:</span> {{ implode(', ', array_map('ucfirst', array_map(function($a){ return str_replace('_', ' ', $a); }, $this->parsedNotesSpeciales['addons']))) }}</p>
                        @endif
                        @if(isset($this->parsedNotesSpeciales['primary_driver']))
                            <p><span class="font-semibold">Primary Driver:</span> {{ $this->parsedNotesSpeciales['primary_driver']['first_name'] ?? '' }} {{ $this->parsedNotesSpeciales['primary_driver']['last_name'] ?? '' }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 ml-4">
                                Email: {{ $this->parsedNotesSpeciales['primary_driver']['email'] ?? 'N/A' }} |
                                License: {{ $this->parsedNotesSpeciales['primary_driver']['license_number'] ?? 'N/A' }}
                            </p>
                        @endif
                        @if(isset($this->parsedNotesSpeciales['additional_driver']) && $this->parsedNotesSpeciales['additional_driver'])
                            <p><span class="font-semibold">Additional Driver:</span> {{ $this->parsedNotesSpeciales['additional_driver']['first_name'] ?? '' }} {{ $this->parsedNotesSpeciales['additional_driver']['last_name'] ?? '' }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 ml-4">
                                License: {{ $this->parsedNotesSpeciales['additional_driver']['license_number'] ?? 'N/A' }}
                            </p>
                        @endif
                        @if(isset($this->parsedNotesSpeciales['payment_method']))
                            <p><span class="font-semibold">Payment Method:</span> {{ ucfirst(str_replace('_', ' ', $this->parsedNotesSpeciales['payment_method'])) }}</p>
                        @endif
                        @if($rental->notes_speciales && empty($this->parsedNotesSpeciales))
                            <p><span class="font-semibold">Raw Notes:</span> {{ $rental->notes_speciales }}</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Special Notes</h3>
                    <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg p-4 text-gray-700 dark:text-gray-300">
                        <p>{{ $rental->notes_speciales ?? 'No special notes for this reservation.' }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Rental History/Timeline (Placeholder) -->
        <div class="lg:col-span-1 rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Rental History/Timeline</h2>
            <div class="rounded-lg border-2 border-dashed border-gray-300 p-6 text-center dark:border-gray-600">
                <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No detailed history</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Timeline of status changes and events will appear here.</p>
            </div>
        </div>
    </div>
</div>
