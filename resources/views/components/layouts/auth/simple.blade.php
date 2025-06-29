<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-9 w-9 mb-1 items-center justify-center rounded-md">
                        <!-- <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" /> -->
                        <div class="flex-shrink-0">
                                                 <a href="/" class="flex justify-center items-center">
                                                     <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                         <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                                                     </svg>
                                                     <h1 class="text-2xl font-bold text-center ml-2 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text">CarGo</h1>
                                                 </a>
                                             </div>
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
