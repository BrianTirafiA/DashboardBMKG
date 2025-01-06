<div class="flex">
    <!-- Sidebar 1 -->
    <div id="sidebarContent" class="relative flex h-[calc(150vh-2rem)] w-full max-w-[20rem] flex-col rounded-xl bg-[#F1F5F9] bg-clip-border p-4 text-gray-700 mt-5 ms-5 mb-5 shadow-xl shadow-blue-gray-900/5 md:block hidden">
        <nav id="navMenu" class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">
            @foreach($menuItems as $item)
                @if($item['type'] === 'dropdown')
                    <div class="relative block w-full">
                        <div role="button" onclick="toggleSubMenu('{{ $item['title'] }}SubMenu', this)" class="flex items-center w-full p-0 leading-tight rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:text-blue-500 hover:bg-opacity-80 hover:bg-gray-100 hover:shadow-md focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                            <button type="button" class="flex items-center justify-between w-full p-3 font-sans text-xl antialiased font-semibold leading-snug text-left transition-colors border-b-0 select-none border-b-blue-gray-100 text-blue-gray-700">
                                <div class="flex items-center">
                                    <div class="grid mr-2 place-items-center">
                                        {!! $item['icon'] !!}
                                    </div>
                                    <p class="block font-sans text-base antialiased font-normal leading-relaxed text-blue-gray-900 transition-colors duration-200 hover:text-blue-primary">{{ $item['title'] }}</p>
                                </div>
                                <span class="ml-1 arrow-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4 mx-auto transition-transform duration-200 hover:text-blue-primary">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div id="{{ $item['title'] }}SubMenu" class="overflow-hidden hidden">
                            <div class="block w-full py-1 font-sans text-sm antialiased font-light leading-normal text-gray-700">
                                <nav class="flex min-w-[240px] flex-col gap-1 p-0 font-sans text-base font-normal text-blue-gray-700">
                                    @foreach($item['items'] as $subItem)
                                        <a href="{{ $subItem['link'] }}" role="button" class="flex items-center w-full p-2 leading-tight transition-all rounded-lg outline-none text-start hover:bg-gray-100 hover:shadow-md">
                                            <span class="mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" aria-hidden="true" class="w-5 h-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
                                                </svg>
                                            </span>
                                            <span class="text-gray-700">{{ $subItem['title'] }}</span>
                                        </a>
                                    @endforeach
                                </nav>
                            </div>
                        </div>
                    </div>
                @elseif($item['type'] === 'static')
                    <a href="{{ $item['link'] }}" role="button" class="flex items-center w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:text-blue-500 hover:bg-gray-100 hover:shadow-md">
                        <div class="grid mr-2 place-items-center">
                            {!! $item['icon'] !!}
                        </div>
                        <span class="block">{{ $item['title'] }}</span>
                    </a>
                @endif
            @endforeach
        </nav>
    </div>

    <!-- Sidebar 2 -->
    <div id="sidebar2" class="relative flex h-[calc(150vh-2rem)] w-full max-w-[3rem] flex-col rounded-xl bg-[#F1F5F9] bg-clip-border justify-center p-4 text-gray-700 mt-5 me-5 mb-5 shadow-xl shadow-blue-gray-900/5 items-center ms-4">
        <div class="flex items-center justify-center h-full w-full">
            <button id="hide-unhide" class="flex items-center justify-center">
                <span class="arrow-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="-rotate-90 hover:rotate-90 w-4 h-4 transition-transform duration-200 hover:text-blue-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to toggle the sidebar visibility
        document.getElementById('hide-unhide').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebarContent');
            sidebar.classList.toggle('hidden'); // Toggle the hidden class
        });

        // Function to handle sidebar2 visibility based on screen size
        function handleSidebar2Visibility() {
            const sidebar2 = document.getElementById('sidebar2');
            if (window.innerWidth < 768) { // md breakpoint is 768px
                sidebar2.classList.remove('hidden'); // Show sidebar2 on small screens
            } else {
                sidebar2.classList.add('hidden'); // Hide sidebar2 on medium and larger screens
            }
        }

        // Initial check
        handleSidebar2Visibility();

        // Add event listener for window resize
        window.addEventListener('resize', handleSidebar2Visibility);
    });

    function toggleSubMenu(id, buttonElement) {
        const submenu = document.getElementById(id);
        const arrowIcon = buttonElement.querySelector('.arrow-icon svg');

        if (submenu.classList.contains('hidden')) {
            submenu.classList.remove('hidden');
            arrowIcon.classList.add('rotate-180'); // Rotate arrow up
        } else {
            submenu.classList.add('hidden');
            arrowIcon.classList.remove('rotate-180'); // Rotate arrow down
        }
    }
</script>
