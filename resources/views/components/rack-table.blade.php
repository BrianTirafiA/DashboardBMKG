<!-- Template Rak (rak.blade.php atau komponen lainnya) -->
<div class="w-full sm:w-1/3 p-3">
    <div class="overflow-x-auto bg-white rounded-lg border shadow-sm">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 border-b">Posisi</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 border-b">Nama Device</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= $capacity; $i++)
                    <tr>
                        <td class="px-4 py-0 text-gray-700 font-sm border-b">U{{ $i }}</td>
                        <td class="px-4 py-0 text-gray-700 font-sm border-b">Device {{ $i }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
