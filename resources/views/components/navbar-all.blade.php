<div>  
    @php  
        $currentUrl = request()->url(); // Get the current URL  
    @endphp  
  
    <x-navbar :menu-items="[  
        ['label' => 'AWS QC', 'link' => '/qcdashboard', 'active' => $currentUrl === url('/qcdashboard')],  
        ['label' => 'Server Room', 'link' => '/itasset/dashboard', 'active' => str_starts_with($currentUrl, url('/itasset/'))],  
        ['label' => 'Lending Items', 'link' => '/lendasset/lendingitems', 'active' => str_starts_with($currentUrl, url('/lendasset/'))],  
        ['label' => 'Calendar', 'link' => '#', 'active' => $currentUrl === url('/calendar')],  
        ['label' => 'Reports', 'link' => '#', 'active' => $currentUrl === url('/reports')],  
    ]" />  
</div>  
