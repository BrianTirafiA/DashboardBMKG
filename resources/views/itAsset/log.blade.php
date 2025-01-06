<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Asset: Log</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
<div class="min-h-full">
    <x-navbar :menu-items="[
        ['label' => 'QC Dashboard', 'link' => '/qcdashboard', 'active' => false],
        ['label' => 'It Asset', 'link' => '/itasset', 'active' => true],
        ['label' => 'Projects', 'link' => '#', 'active' => false],
        ['label' => 'Calendar', 'link' => '#', 'active' => false],
        ['label' => 'Reports', 'link' => '#', 'active' => false],
    ]" />
  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">IT Assets Management Center</h1>
    </div>
  </header>

  <x-sidebar-asset :menu-items="[
        ['label' => 'Dashboard', 'link' => '/itasset/dashboard', 'active' => false],
        ['label' => 'Device', 'link' => '/itasset/device', 'active' => false],
        ['label' => 'Rack', 'link' => '/itasset/rack', 'active' => false],
        ['label' => 'Power', 'link' => '/itasset/power', 'active' => false],
        ['label' => 'Maintenance', 'link' => '/itasset/maintenance', 'active' => false],
        ['label' => 'Report', 'link' => '/itasset/report', 'active' => false],
        ['label' => 'Log', 'link' => '/itasset/log', 'active' => true],
    ]" />
</div>
</body>
</html>
