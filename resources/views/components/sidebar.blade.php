<div class="flex">  
    <!-- Sidebar 1 -->  
    <div id="sidebarContent" class="relative h-full min-h-[54rem] w-full max-w-[20rem] flex-col rounded-xl bg-[#F1F5F9] p-4 text-gray-700 mt-5 ms-3 mb-5 shadow-xl shadow-blue-gray-900/5 border border-blue-gray-100 border-collapse bg-clip-border md:block hidden">  
        <nav id="navMenu" class="flex flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">  
            @foreach($menuItems as $item)  
                @if($item['type'] === 'dropdown')  
                    @php  
                        $isDropdownActive = collect($item['items'])->contains(fn($subItem) => $subItem['active']);  
                    @endphp  
                    <div class="relative block w-full">  
                        <button onclick="toggleSubMenu('{{ $item['title'] }}SubMenu', this)" class="flex items-center rounded-lg justify-between w-full p-3 font-sans text-xl font-semibold leading-snug text-left transition-colors border-b-0 select-none border-b-blue-gray-100 text-blue-gray-700 hover:bg-blue-gray-50 hover:text-blue-500 hover:bg-opacity-80 hover:bg-gray-100 hover:shadow-md {{ $isDropdownActive ? 'bg-gray-200' : '' }}">  
                            <div class="flex items-center">  
                                <div class="grid mr-2 place-items-center">{!! $item['icon'] !!}</div>  
                                <p class="block font-sans text-base font-normal leading-relaxed text-blue-gray-900 transition-colors duration-200 hover:text-blue-primary">{{ $item['title'] }}</p>  
                            </div>  
                            <span class="ml-1 arrow-icon">  
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4 mx-auto transition-transform duration-200 hover:text-blue-primary">  
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>  
                                </svg>  
                            </span>  
                        </button>  
                        <div id="{{ $item['title'] }}SubMenu" class="overflow-hidden transition-all duration-300 ease-in-out max-h-0">  
                            <nav class="flex flex-col gap-1 p-0 font-sans text-base font-normal text-blue-gray-700">  
                                @foreach($item['items'] as $subItem)  
                                    <a href="{{ $subItem['link'] }}" class="flex items-center w-full p-2 leading-tight transition-all rounded-lg outline-none text-start hover:bg-gray-100 hover:shadow-md {{ $subItem['active'] ? 'bg-gray-200' : '' }}">  
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
                @elseif($item['type'] === 'static')  
                    <a href="{{ $item['link'] }}" class="flex items-center w-full p-3 leading-tight transition-all rounded-xl outline-none text-start hover:text-blue-500 hover:bg-gray-100 hover:shadow-md {{ $item['active'] ? 'bg-gray-200' : '' }}">  
                        <div class="grid mr-2 place-items-center">{!! $item['icon'] !!}</div>  
                        <span class="block">{{ $item['title'] }}</span>  
                    </a>  
                @endif  
            @endforeach  

            <div id="account-card" class="m-2 mt-2 max-w-sm border border-blue-gray-100 border-collapse shadow-md rounded-xl bg-clip-border">    
                <div class="rounded-xl border bg-gray-700 shadow-lg p-5">    
                <h1 id="FullName" class="text-center text-xl font-bold {{ session('fullname') ? 'text-white' : 'text-red-500' }}">  
                    {{ session('fullname') ?? 'Nama Lengkap Belum Diisi' }}  
                </h1>      
                
                <h3 id="NIP" class=" mt-2 text-center text-sm font-semibold {{ session('nip') ? 'text-white' : 'text-red-500' }}">  
                    {{ session('nip') ?? 'NIP Belum Diisi' }}  
                </h3>      
                
                <p class=" text-center text-sm {{ session('unit_kerja_name') ? 'text-white' : 'text-red-500' }} hover:text-[#F1F5F9]">    
                    {{ session('unit_kerja_name') ?? 'Unit Kerja Belum Diisi' }}    
                </p>    

                    <ul class="mt-3 rounded-xl bg-gray-100 p-3 text-gray-600 shadow-sm hover:text-gray-700 hover:shadow">      
                        <li class="flex flex-col items-center text-sm">      
                            <span>Data Account</span>       
                            <span class="mt-1 mb-1">    
                                @if(session('fullname') && session('nip') && session('no_telepon') && session('unit_kerja_id'))    
                                    <span class="rounded-full bg-green-200 px-2 py-1 text-xs font-medium text-green-700">Lengkap</span>    
                                @else    
                                    <span class="rounded-full bg-red-200 px-2 py-1 text-xs font-medium text-red-700">Tidak Lengkap</span>    
                                @endif    
                            </span>   
                        </li>    
                    </ul>  
  
                    <a id="toProfile" href="">
                    <button type="button" class="flex justify-center mt-5 w-full bg-[#050708] hover:bg-[#050708]/80 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-white">    
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">    
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>    
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>    
                        </svg>    
                        Edit Data Account    
                    </button> 
                    </a>
                       
            
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">    
                        @csrf    
                    </form>    
                    <button type="button" onclick="document.getElementById('logout-form').submit();" class="mt-2 mb-2 w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">    
                        Logout    
                    </button>    
                </div>    
            </div>  
  
        </nav>  
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

        if (submenu.classList.contains('max-h-0')) {
            submenu.classList.remove('max-h-0');
            submenu.classList.add('max-h-screen'); // Allow submenu to expand
            arrowIcon.classList.add('rotate-180'); // Rotate arrow up
        } else {
            submenu.classList.add('max-h-0');
            submenu.classList.remove('max-h-screen'); // Allow submenu to collapse
            arrowIcon.classList.remove('rotate-180'); // Rotate arrow down
        }
    }
</script>
