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
        ]);

        $validated["password"] = Hash::make($validated["password"]);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(
            route("dashboard", absolute: false),
            navigate: true
        );
    }
};
?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <h1 class="text-2xl font-bold text-center">Welcome to our platform!</h1>

        <div class="flex flex-col gap-3 p-4 rounded-lg border border-zinc-700 bg-zinc-800/30 dark:bg-zinc-800">
            <ul class="grid grid-flow-col text-center text-gray-500 bg-gray-100 rounded-lg p-1">
              <li>
                  <flux:radio
                      wire:model.live="role"
                      value="owner"

                      :label="__('Owner')"

                  />
              </li>
              <li>
                <a href="#page2" class="flex justify-center bg-white rounded-lg shadow text-indigo-900 py-4">Titan maintenance</a>
              </li>  </ul>
            <label for="role" class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Select your role') }}</label>
            <div class="space-y-2">

                <flux:radio
                    wire:model.live="role"
                    value="client"
                    :label="__('Client')"
                    description="Access to booking and client features"
                    name="role"
                />
            </div>
        </div>

        <div class="flex flex-row gap-6">
            <!-- Name -->
            <flux:input

                wire:model="name"
                :label="__('Name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Full name')"
            />
            <!-- CIN -->

            <flux:input
                wire:model="cin"
                :label="__('CIN')"
                type="text"
                required
                autocomplete="cin"
                :placeholder="__('CIN')"
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

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            viewable
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirm password')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
