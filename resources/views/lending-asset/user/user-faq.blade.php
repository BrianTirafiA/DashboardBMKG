<x-user-layout-template>
    <section class="py-1 me-6">  
        <div class="relative flex flex-col w-full h-full text-gray-700 bg-[#FFFFFF] border border-blue-gray-100 border-collapse shadow-md rounded-xl bg-clip-border">  
            <div class="flex flex-col justify-center items-center gap-x-16 gap-y-5 xl:gap-28 lg:flex-row lg:justify-between max-lg:max-w-2xl mx-auto max-w-full">  
                <div class="w-full lg:w-1/2">  
                    <img  
                        src="{{ asset('assets/sibatik-maskot.webp') }}"  
                        alt="FAQ tailwind section"  
                        class="w-full rounded-xl object-cover"  
                    />  
                </div>  
                <div class="w-full lg:w-1/2">  
                    <div class="lg:max-w-xl">  
                        <div class="mb-6 lg:mb-6 lg:ms-0 lg:me-0 me-5 ms-5">  
                            <h2 class="text-4xl text-center font-bold text-gray-900 leading-[3.25rem] lg:text-left">Pertanyaan Umum Seputar Layanan</h2>  
                        </div>  
                        <div class="accordion-group lg:ms-0 lg:me-0 me-5 ms-5" data-accordion="default-accordion">  
                            @foreach($pertanyaans as $pertanyaan)  
                            <div class="accordion py-8 border-b border-solid border-gray-200">  
                                <button class="accordion-toggle group inline-flex items-center justify-between text-xl font-normal leading-8 text-gray-600 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600" aria-controls="collapse-{{ $loop->index }}">  
                                    <h5 class=" text-lg text-left">{{ $pertanyaan->question }}</h5>  
                                    <svg class="text-gray-900 transition duration-500 group-hover:text-indigo-600 accordion-active:text-indigo-600 ms-2" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">  
                                        <path d="M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>  
                                    </svg>  
                                </button>  
                                <div id="collapse-{{ $loop->index }}" class="accordion-content w-full px-0 overflow-hidden pr-4" aria-labelledby="heading-{{ $loop->index }}">  
                                    <p class="text-base text-gray-500 font-normal mt-2">{{ $pertanyaan->answer }}</p>  
                                </div>  
                            </div>  
                            @endforeach  
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </section>  
    
    <style>  
        .accordion-content {  
            max-height: 0;  
            overflow: hidden;  
            transition: max-height 0.3s ease-out;  
        }  
    
        .accordion-content.active {  
            max-height: 200px; /* Atur sesuai kebutuhan */  
        }  
    
        .rotate-180 {  
            transform: rotate(180deg);  
            transition: transform 0.3s ease;  
        }  
    </style>  
    
    <script>  
        document.querySelectorAll('.accordion-toggle').forEach(button => {  
            button.addEventListener('click', () => {  
                const accordionContent = button.nextElementSibling;  
    
                // Toggle the active class  
                accordionContent.classList.toggle('active');  
    
                // Toggle the rotation of the arrow  
                button.querySelector('svg').classList.toggle('rotate-180');  
            });  
        });  
    </script>  
</x-user-layout-template>
