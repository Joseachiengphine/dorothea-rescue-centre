<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Quick Actions
        </x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($this->getActions() as $action)
                <div class="text-center">
                    {{ $action }}
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>