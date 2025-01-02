<!DOCTYPE html>
<html lang="en" class="h-full bg-[#f0f6fb]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #map {
            height: 500px; /* Set a height for the map */
        }
    </style>
</head>
<body class="h-full">
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<div class="min-h-full">
  <x-navbar :menu-items="[
    ['label' => 'QC Dashboard', 'link' => '/qcdashboard', 'active' => true],
    ['label' => 'It Asset', 'link' => '/itasset', 'active' => false],
    ['label' => 'Projects', 'link' => '#', 'active' => false],
    ['label' => 'Calendar', 'link' => '#', 'active' => false],
    ['label' => 'Reports', 'link' => '#', 'active' => false],
  ]" />


  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard Quality Control AWS Center</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div id="map"></div>
    </div>
  </main>
</div>
</body>
</html>
