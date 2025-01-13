<div>  
    @php  
        $currentUrl = request()->url(); // Get the current URL  
    @endphp  
  
    <x-navbar :menu-items="[  
        ['label' => 'AWS QC', 'link' => '/admin/qcdashboard', 'active' => $currentUrl === url('/admin/qcdashboard')],  
        ['label' => 'Server Room', 'link' => '/admin/itasset/dashboard', 'active' => str_starts_with($currentUrl, url('/admin/itasset/'))],  
        ['label' => 'Lending Items', 'link' => '/admin/lendasset/lendingitems', 'active' => str_starts_with($currentUrl, url('/admin/lendasset/'))],  
        ['label' => 'Calendar', 'link' => '#', 'active' => $currentUrl === url('/admin/calendar')],  
        ['label' => 'Reports', 'link' => '#', 'active' => $currentUrl === url('/admin/reports')],  
    ]" />  
</div>  
