   <!-- resources/views/components/lend-layout-template.blade.php -->  
   <!DOCTYPE html>      
   <html lang="en">      
   <head>      
       <meta charset="UTF-8">      
       <meta name="viewport" content="width=device-width, initial-scale=1.0">      
       <title>Login Page</title>      
       <script src="https://cdn.tailwindcss.com"></script>      
   </head>      
         
   <body class="h-full">      
   <div class="min-h-full">      
       <x-navbar-admin/>    
         
       <div class="flex flex-nowrap">      
           <!-- Sidebar -->      
           <div id="sidebar" class="p-4 transition-transform duration-300">      
               <x-sidebar-server />      
           </div>      
         
           <!-- Sidebar 2 (Hide/Show Button) -->      
           <div id="sidebar2" class="lg:hidden relative flex h-[calc(150vh-2rem)] w-[3rem] flex-col rounded-xl bg-[#F1F5F9] bg-clip-border justify-center p-4 text-gray-700 mt-9 me-5 mb-5 shadow-xl shadow-blue-gray-900 items-center md:block transition-transform duration-300">      
               <div class="flex items-center justify-center h-full w-full">      
                   <button id="hide-unhide" class="flex items-center justify-center">      
                       <span class="arrow-icon">      
                           <svg id="arrow-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="-rotate-90 w-4 h-4 transition-transform duration-200 hover:text-blue-primary">      
                               <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>      
                           </svg>      
                       </span>      
                   </button>      
               </div>      
           </div>      
         
           <!-- Main Content -->      
           <div id="main-content" class="mt-7 flex-grow p-1 transition-transform duration-300">      
               {{ $slot }} <!-- Slot for main content -->  
           </div>      
       </div>      
         
       <x-footer/>      
   </div>      
         
   <script>      
       document.addEventListener('DOMContentLoaded', function() {      
           const sidebar = document.getElementById('sidebar');      
           const sidebar2 = document.getElementById('sidebar2');      
           const mainContent = document.getElementById('main-content');      
           const hideUnhideButton = document.getElementById('hide-unhide');      
           const arrowIcon = document.getElementById('arrow-icon');      
         
           function handleSidebarVisibility() {      
               if (window.innerWidth < 768) { // md breakpoint is 768px      
                   sidebar.classList.add('hidden'); // Hide the main sidebar      
                   sidebar2.classList.remove('hidden'); // Show the toggle button sidebar      
                   mainContent.classList.remove('ml-4'); // Remove margin when sidebar is hidden      
                   arrowIcon.classList.remove('rotate-90'); // Reset arrow rotation      
               } else {      
                   sidebar.classList.remove('hidden'); // Show the main sidebar      
                   sidebar2.classList.add('hidden'); // Ensure sidebar2 is hidden      
                   mainContent.classList.add('ml-4'); // Add a smaller margin when sidebar is shown      
                   arrowIcon.classList.add('rotate-90'); // Rotate arrow when sidebar is shown      
               }      
           }      
         
           // Initial check      
           handleSidebarVisibility();      
         
           // Add event listener for window resize      
           window.addEventListener('resize', handleSidebarVisibility);      
         
           // Toggle sidebar visibility      
           hideUnhideButton.addEventListener('click', function() {      
               if (sidebar.classList.contains('hidden')) {      
                   sidebar.classList.remove('hidden'); // Show the main sidebar      
                   mainContent.classList.add('ml-4'); // Add margin to main content      
                   arrowIcon.classList.add('rotate-90'); // Rotate arrow when sidebar is shown      
               } else {      
                   sidebar.classList.add('hidden'); // Hide the main sidebar      
                   mainContent.classList.remove('ml-4'); // Remove margin from main content      
                   arrowIcon.classList.remove('rotate-90'); // Reset arrow rotation      
               }      
           });      
       });      
   </script>     
   </body>      
   </html>    
