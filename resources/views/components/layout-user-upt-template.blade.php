   <!-- resources/views/components/lend-layout-template.blade.php -->
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <script src="https://cdn.tailwindcss.com"></script>
        
   </head>

   <body class="h-full">
   <div class="min-h-full">
       <x-navbar-admin/>

           <div id="main-content" class=" flex-grow p-10 transition-transform duration-300">
               {{ $slot }} <!-- Slot for main content -->
           </div>


       <x-footer/>
   </div>

   </body>
   </html>
