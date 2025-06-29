@props([
    'title',
    'value',
    'trend' => null,
    'trendDirection' => 'up', // 'up' or 'down'
    'icon' => null,
    'color' => 'bg-blue-100 text-blue-600',
    'href' => null,
    'onclick' => null
])

<div
    @if($href) onclick="window.location.href='{{ $href }}'" @endif
    @if($onclick) onclick="{{ $onclick }}" @endif
    @class([
        'group relative cursor-pointer overflow-hidden rounded-xl border p-6 transition-all hover:shadow-lg',
        'border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-800',
        'hover:border-blue-500' => str_contains($color, 'blue'),
        'hover:border-green-500' => str_contains($color, 'green'),
        'hover:border-purple-500' => str_contains($color, 'purple'),
        'hover:border-amber-500' => str_contains($color, 'amber'),
    ])
    {{ $attributes }}
>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $title }}</p>
            <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">
                {{ $value }}
            </p>
        </div>

        @if($icon)
        <div @class([
            'rounded-lg p-3',
            $color
        ])>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
            </svg>
        </div>
        @endif
    </div>

    @if($trend)
    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
        <span @class([
            'inline-flex items-center',
            'text-green-600 dark:text-green-400' => $trendDirection === 'up',
            'text-red-600 dark:text-red-400' => $trendDirection === 'down',
        ])>
            @if($trendDirection === 'up')
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            @else
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            @endif
            <span class="ml-1">{{ $trend }}</span>
        </span>
        {{ $trendDirection === 'up' ? 'increase' : 'decrease' }} from last month
    </p>
    @endif
</div>
