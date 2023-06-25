<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-list">
        <div class="navbar-menu-toggle" style="cursor: pointer;">
          <img src="{{ asset('frontend/img/pinpoint/icon/ic-menu.svg') }}" alt="icon">
        </div>
      </div>  
      <div class="navbar-logo">
        @php $logo = \App\Models\Setting::where('setting_name', 'app_logo')->first(); @endphp
        <img src="{{ !is_null($logo) ? url('storage/settings/'.$logo->setting_value) : asset('frontend/img/brand/logo.png') }}" class="my-2" alt="Logo">
      </div>
    </div>
  </div>
</nav>