@props(['title', 'filled', 'total'])

<div class="rounded-lg border bg-white p-4 shadow-md w-128">
    <div class="flex justify-between mb-1">
        <span class="text-base font-medium">{{ $title }}</span>
        <span class="text-sm font-medium">{{ $filled }} / {{ $total }}</span>
    </div>
    <div class="w-full bg-gray-200 rounded-full h-2.5">
        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($filled / $total) * 100 }}%;"></div>
    </div>
</div>
