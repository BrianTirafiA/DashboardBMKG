<div>  
    @php  
        $currentUrl = request()->url(); // Get the current URL  
    @endphp  
  
    <x-navbar :menu-items="[  
        ['label' => 'QC Dashboard', 'link' => '/qcdashboard', 'active' => $currentUrl === url('/qcdashboard')],  
        ['label' => 'It Asset', 'link' => '/itasset', 'active' => $currentUrl === url('/itasset')],  
        ['label' => 'Lending Items', 'link' => '/lendasset/lendingitems', 'active' => $currentUrl === url('/lendasset/lendingitems')],  
        ['label' => 'Calendar', 'link' => '#', 'active' => $currentUrl === url('/calendar')],  
        ['label' => 'Reports', 'link' => '#', 'active' => $currentUrl === url('/reports')],  
    ]" />  
</div>  
