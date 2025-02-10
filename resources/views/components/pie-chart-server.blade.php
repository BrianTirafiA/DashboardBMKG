@props(['title', 'percentages', 'colors', 'labels'])

@php
    $total = array_sum($percentages);
    $startAngle = 0;
    $segments = [];

    foreach ($percentages as $index => $value) {
        $angle = ($value / $total) * 360;
        $segments[] = "{$colors[$index]} {$startAngle}deg " . ($startAngle + $angle) . "deg";
        $startAngle += $angle;
    }

    $conicGradient = implode(', ', $segments);
@endphp

<div class="flex flex-col items-center p-6 bg-white shadow-md rounded-lg max-h-full">
    <div class="relative w-40 h-40 rounded-full" style="background: conic-gradient({{ $conicGradient }});">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-20 h-20 bg-white rounded-full"></div>
        </div>
    </div>
    <div class="mt-4 text-sm">
        @if (count($percentages) > 0)
            @foreach ($percentages as $index => $value)
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full" style="background: {{ $colors[$index] }};"></span>
                    <span>{{ $labels[$index] ?? 'Unknown' }}</span>
                </div>
            @endforeach
        @else
            <p class="text-gray-500">Tidak ada data status tersedia.</p>
        @endif
    </div>
</div>
    