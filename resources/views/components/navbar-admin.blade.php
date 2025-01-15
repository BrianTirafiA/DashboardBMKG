<div>  
    @php  
        $currentUrl = request()->url(); // Get the current URL  
    @endphp  
  
    <x-navbar :menu-items="[  
        ['label' => 'AWS QC', 'link' => '/admin/qcdashboard', 'active' => $currentUrl === url('admin/qcdashboard')],  
        ['label' => 'Server Room', 'link' => '/admin/itasset/dashboard', 'active' => str_starts_with($currentUrl, url('/admin/itasset/'))],  
        ['label' => 'Lending Items', 'link' => '/admin/lendasset/lendingitems', 'active' => str_starts_with($currentUrl, url('/admin/lendasset/'))]
    ]" />  
</div>  
