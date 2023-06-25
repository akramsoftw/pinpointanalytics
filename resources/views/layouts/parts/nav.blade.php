<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-list">
        <div class="navbar-menu-toggle" style="cursor: pointer;">
          <img src="{{ asset('frontend/img/pinpoint/icon/ic-menu.svg') }}" alt="icon">
        </div>
        <a href="javascript:void(0);" class="btn btn-border diff d-none d-md-flex">Choose Activity</a>
      </div>  
      <div class="navbar-logo">
        <img src="{{ asset('frontend/img/brand/logo.png') }}" alt="Logo">
        <div class="switch-wrapper">
          <span>Live</span>
          <label class="switch">
            <input type="checkbox" class="swith-shot">
            <span class="slider round"></span>
          </label>
          <span>All</span>
        </div>
      </div>
    </div>
  </div>
</nav>