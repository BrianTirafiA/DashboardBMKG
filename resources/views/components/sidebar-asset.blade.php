<div class="flex min-h-screen">
    <div class="bg-gray-800 text-white w-64 p-4">
        <h2 class="text-center text-xl font-bold mb-6">Menu</h2>
        <ul>
            @foreach ($menuItems as $item)
                <li>
                    <a href="{{ $item['link'] }}"
                    class="block py-2 px-3 rounded-md {{ $item['active'] ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
