{{--<div class="p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-lg font-semibold text-blue-gray-900 mb-4 text-center">
        Daftar Rak Panel
    </h2>
    <table class="mt-4 text-left border-collapse table-auto min-w-full">
        <thead>
            <tr>
                <th
                    class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 text-center">
                    #
                </th>
                <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900">
                    Nama Rak
                </th>
                <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900">
                    Panel ID
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $rakPanel)
                <tr>
                    <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 text-center">
                        {{ $index + 1 }}
                    </td>
                    <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900">
                        {{ $rakPanel->name ?? '-' }}
                    </td>
                    <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900">
                        {{ $rakPanel->panel->id ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}