<div class="overflow-y-auto max-h-96 rounded-lg border border-gray-300">
    <table class="min-w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2 border text-center bg-gray-100 text-xs">Posisi</th>
                <th class="px-4 py-2 border text-center bg-gray-100 text-xs">Nama Device</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 42; $i >= 1; $i--)
                <tr>
                    <td class="px-4 py-2 border text-center text-xs">U{{ $i }}</td>
                    <td class="px-4 py-2 border text-center text-xs">Device {{ $i }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>
