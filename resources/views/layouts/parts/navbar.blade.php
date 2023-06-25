<div class="navbar-menu-drop" style="display: none;">
  <div class="navbar-m-content">
   <div class="navbar-m-header">
     <h3>Menu</h3>
     <div class="navbar-close" style="cursor: pointer;">
      <img src="{{ asset('frontend/img/pinpoint/icon/ic-close.svg') }}" alt="icon">
     </div>
   </div>
   <div class="navbar-m-wrapper">
      <div class="w-100">
        <a href="{{route('shot_chart')}}" class="navbar-m-list nav-shot">
          <img src="{{ asset('frontend/img/pinpoint/icon/ic-chart.svg') }}" alt="icon">
          <p>Shot Chart</p>
        </a>
        <a href="{{route('stat_tracker')}}" class="navbar-m-list nav-stats">
          <img src="{{ asset('frontend/img/pinpoint/icon/ic-timer.svg') }}" alt="icon">
          <p>Stat Counter</p>
        </a>
        <a href="{{route('reports_index')}}" class="navbar-m-list nav-options">
          <img src="{{ asset('frontend/img/pinpoint/icon/ic-assignment.svg') }}" alt="icon">
          <p>Reports</p>
        </a>
      </div>
      <div class="mt-auto w-100">
        <a href="{{route('settings_index')}}" class="navbar-m-list nav-settings">
          <img src="{{ asset('frontend/img/pinpoint/icon/ic-setting.svg') }}" alt="icon">
          <p>Settings</p>
        </a>
        <a href="{{route('options_index')}}" class="navbar-m-list nav-options">
          <img src="{{ asset('frontend/img/pinpoint/icon/ic-filter.svg') }}" alt="icon">
          <p>Options</p>
        </a>
        @auth
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="navbar-m-list">
          <img src="{{ asset('frontend/img/pinpoint/icon/ic-logout.svg') }}" alt="icon">
          <p>Logout</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @endauth
      </div>
   </div>
  </div>
</div>
