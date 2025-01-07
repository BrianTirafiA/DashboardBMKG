<div class="rounded-lg border bg-white p-4 shadow-md w-128">
    <div class="flex justify-between mb-1">
        <span class="text-base font-medium ">{{ $title }}</span>
        <span class="text-sm font-medium ">{{ $percentage }}%</span>
    </div>
    <div class="w-full bg-gray-200 rounded-full h-2.5">
        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentage }}%;"></div>
    </div>
</div>