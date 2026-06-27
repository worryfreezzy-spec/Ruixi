<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ $heading }}
        </x-slot>

        <div class="grid gap-3 sm:grid-cols-2">
            @foreach ($links as $link)
                <a
                    href="{{ $link['url'] }}"
                    @if ($openInNewTab ?? false) target="_blank" rel="noopener" @endif
                    class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 transition hover:border-primary-500 hover:text-primary-600 dark:border-white/10 dark:bg-white/5 dark:text-gray-200"
                >
                    <span>{{ $link['label'] }}</span>
                    <span aria-hidden="true">›</span>
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
