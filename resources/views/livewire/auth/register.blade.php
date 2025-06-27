<?php

use App\Modules\GestionUtilisateurs\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout("components.layouts.auth")] class extends Component {
    public string $name = "";
    public string $email = "";
    public string $cin = "";
    public string $password = "";
    public string $password_confirmation = "";
    public string $role = "client"; // Default role
    public string $company_name = ""; // For owners only
    public string $telephone = ""; // Common but might be required for owners

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            "name" => ["required", "string", "max:255"],
            "cin" => ["required", "string", "unique:" . User::class],
            "email" => [
                "required",
                "string",
                "lowercase",
                "email",
                "max:255",
                "unique:" . User::class,
            ],
            "password" => [
                "required",
                "string",
                "confirmed",
                Rules\Password::defaults(),
            ],
            "role" => ["required", "string"],
            "company_name" => [
                "required_if:role,owner",
                "nullable",
                "string",
                "max:255",
            ],
            "telephone" => ["required", "string", "max:20"],
        ]);

        $validated["password"] = Hash::make($validated["password"]);
        $validated["role"] = $this->role;
        $user = User::create([
            "name" => $this->name,
            "cin" => $this->cin,
            "email" => $this->email,
            "password" => bcrypt($this->password),
            "role" => $this->role,
            "company_name" => $this->company_name,
            "telephone" => $this->telephone,
        ]);
        event(new Registered($user));

        Auth::login($user);

        $this->redirectIntended(
            route(
                $this->role === "owner" ? "admin.dashboard" : "dashboard",
                absolute: false
            ),
            navigate: true
        );
    }
};
?>

<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Create an account')"
        :description="__('Enter your details below to create your account')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Role Selection Tabs -->
        <div class="flex flex-col gap-3">
            <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                {{ __('I am registering as a:') }}
            </label>

            <div class="grid grid-cols-2 gap-2">
                <!-- Client Tab -->
                <button
                    type="button"
                    wire:click="$set('role', 'client')"

                    @class([
                    'py-3 px-4 rounded-lg border transition-all duration-10 ease-in-out text-center cursor-pointer',
                        'bg-blue-600  text-white shadow-md' => $role === 'client',
                        'bg-white dark:bg-zinc-800 border-zinc-300 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700' => $role !== 'client'
                    ])
                >
                    <div class="flex flex-col items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">{{ __('Client') }}</span>
                        <span class="text-xs opacity-80">{{ __('Rent vehicles') }}</span>
                    </div>
                </button>

                <!-- Owner Tab -->
                <button
                    type="button"
                    wire:click="$set('role', 'owner')"
                    @class([
                        'py-3 px-4 rounded-lg border transition-all duration-10 ease-in-out text-center cursor-pointer',
                        'bg-blue-600  text-white shadow-md' => $role === 'owner',
                        'bg-white dark:bg-zinc-800 border-zinc-300 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700' => $role !== 'owner'
                    ])
                >
                    <div class="flex flex-col items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="font-medium">{{ __('Vehicle Owner') }}</span>
                        <span class="text-xs opacity-80">{{ __('List your vehicles') }}</span>
                    </div>
                </button>
            </div>
        </div>

        <!-- Common Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <flux:input
                wire:model="name"
                :label="__('Full Name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('John Doe')"
            />

            <!-- CIN -->
            <flux:input
                wire:model="cin"
                :label="__('CIN')"
                type="text"
                required
                autocomplete="cin"
                :placeholder="__('Your CIN number')"
            />
        </div>

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Phone Number -->
        <flux:input
            wire:model="telephone"
            :label="__('Phone Number')"
            type="tel"
            required
            autocomplete="tel"
            placeholder="+212 600 000 000"
        />

        <!-- Owner-specific Fields -->
        <div x-show="$wire.role === 'owner'">
            <flux:input
                wire:model="company_name"
                :label="__('Company Name')"
                type="text"
                :required="$role === 'owner'"
                :placeholder="__('Your company name (if applicable)')"
            />
        </div>

        <!-- Password Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Password -->
            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Minimum 8 characters')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirm Password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirm your password')"
                viewable
            />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account as ') }}
                <span x-text="$wire.role === 'client' ? 'Client' : 'Vehicle Owner'"></span>
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
