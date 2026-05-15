@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-status-mastered bg-status-mastered/5 border border-status-mastered/20 rounded-lg px-4 py-3']) }}>
        {{ $status }}
    </div>
@endif