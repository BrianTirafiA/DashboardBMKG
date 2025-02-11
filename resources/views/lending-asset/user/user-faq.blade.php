<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar FAQ - User</title>
</head>

<x-user-layout-template>  
    <section class="py-1 me-5">      
        <div class="flex flex-col lg:flex-row w-full mb-6 h-full text-gray-700 bg-[#FFFFFF] border border-blue-gray-100 border-collapse shadow-md rounded-xl bg-clip-border">      
            <!-- Konten Utama -->  
            <div class="flex-1 p-4"> <!-- Konten Utama -->  
            <div class="flex flex-col lg:flex-row justify-center items-start gap-5">    
                    <div class="w-full lg:w-1/2 flex justify-center">    
                        <img src="{{ asset('assets/sibatik-maskot.webp') }}" class="w-60rem rounded-xl object-cover" />        
                    </div>      
                
                    <div class="w-full lg:w-1/2">        
                        <div class="lg:max-w-2xl">        
                            <div class="mb-6">    
                                <h2 class="text-4xl xl:ms-8 ms-text-center font-bold text-gray-900 leading-[3.25rem] lg:text-left">Pertanyaan Umum Seputar Layanan</h2>        
                            </div>        
                            <div class="accordion-group ms-0 xl:ms-8" data-accordion="default-accordion">        
                                @foreach($pertanyaans as $pertanyaan)        
                                    @if ($loop->index < 5)        
                                        <div class="accordion py-8 border-b border-solid border-gray-200">        
                                            <button class="accordion-toggle group inline-flex items-center justify-between text-xl font-normal leading-8 text-gray-600 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600" aria-controls="collapse-{{ $loop->index }}">        
                                                <h5 class="text-lg text-left">{{ $pertanyaan->question }}</h5>        
                                                <svg class="text-gray-900 transition duration-500 group-hover:text-indigo-600 accordion-active:text-indigo-600 ms-2" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">        
                                                    <path d="M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>        
                                                </svg>        
                                            </button>        
                                            <div id="collapse-{{ $loop->index }}" class="accordion-content w-full px-0 overflow-hidden pr-4" aria-labelledby="heading-{{ $loop->index }}">        
                                                <p class="text-base text-gray-500 font-normal mt-2">{{ $pertanyaan->answer }}</p>        
                                            </div>        
                                        </div>        
                                    @endif        
                                @endforeach        
                            </div>        
                        </div>        
                    </div>        
                </div>  
    
  
               <!-- Bagian untuk menampilkan data selanjutnya dalam dua kolom -->      
<div class="flex flex-col justify-center items-center gap-y-3 mt-6">       
    <h3 class="text-xl text-center font-bold text-gray-900 leading-[1.5rem] lg:text-left">Pertanyaan Lainnya</h3>      
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 gap-y-4 mt-2 mb-6">      
        @foreach($pertanyaans as $pertanyaan)      
            @if ($loop->index >= 5)      
                <div class="accordion py-2 border-b border-solid border-gray-200">        
                    <button class="accordion-toggle group inline-flex items-center justify-between text-base font-normal leading-6 text-gray-600 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600" aria-controls="collapse-{{ $loop->index }}">        
                        <h5 class="text-base text-left">{{ $pertanyaan->question }}</h5>        
                        <svg class="text-gray-900 transition duration-500 group-hover:text-indigo-600 accordion-active:text-indigo-600 ms-2" width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">        
                            <path d="M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>        
                        </svg>        
                    </button>        
                    <div id="collapse-{{ $loop->index }}" class="accordion-content w-full px-0 overflow-hidden pr-4" aria-labelledby="heading-{{ $loop->index }}">        
                        <p class="text-sm text-gray-500 font-normal mt-1">{{ $pertanyaan->answer }}</p>        
                    </div>        
                </div>        
            @endif        
        @endforeach        
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
