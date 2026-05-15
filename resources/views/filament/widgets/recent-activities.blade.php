<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Recent Activities
        </x-slot>

        <div class="space-y-3">
            @forelse ($this->getRecentActivities() as $activity)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <x-filament::badge :color="$activity['color']">
                            {{ $activity['type'] }}
                        </x-filament::badge>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                {{ $activity['number'] }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $activity['created_at']->format('M j, Y H:i') }}
                            </p>
                        </div>
                    </div>
                    <x-filament::badge 
                        :color="match($activity['status']) {
                            'Planned' => 'warning',
                            'In Progress' => 'info', 
                            'Completed' => 'success',
                            'Cancelled' => 'danger',
                            'Active' => 'success',
                            default => 'gray'
                        }"
                    >
                        {{ $activity['status'] }}
                    </x-filament::badge>
                </div>
            @empty
                <div class="text-center py-6 text-gray-500 dark:text-gray-400">
                    No recent activities found.
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>