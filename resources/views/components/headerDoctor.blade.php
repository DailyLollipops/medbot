@props([])

<style class="u-sticky-style" data-style-id="f560">
  .u-sticky-fixed.u-sticky-f560:before, 
  .u-body.u-sticky-fixed .u-sticky-f560:before {
    borders: top right bottom left !important
  }
</style>

<header class="u-clearfix u-header u-palette-5-light-3 u-sticky u-sticky-f560" id="sec-3e0f" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
  <div class="u-clearfix u-sheet u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-sheet-1">
    <p class="u-align-center u-custom-font u-font-lobster u-text u-text-1">
      <span class="u-file-icon u-icon">
        <img src="{{ asset('images/logo.png') }}" alt=""></span>
        &nbsp;Medbot
    </p>
    <nav class="u-dropdown-icon u-menu u-menu-dropdown u-offcanvas u-offcanvas-shift u-menu-1" data-responsive-from="MD" data-submenu-level="on-click">
      <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
        <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
          <svg class="u-svg-link" viewBox="0 0 24 24">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
          </svg>
          <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
            <g>
              <rect y="1" width="16" height="2"></rect>
              <rect y="7" width="16" height="2"></rect>
              <rect y="13" width="16" height="2"></rect>
            </g>
          </svg>
        </a>
      </div>
      <div class="u-custom-menu u-nav-container">
        <ul class="u-nav u-unstyled u-nav-1">
          <li class="u-nav-item">
            <a class="u-button-style u-nav-link" href="/medbot/public/" style="padding: 10px 15px;">Home</a>
          </li>
          <li class="u-nav-item">
            <a class="u-button-style u-nav-link" href="/medbot/public/about" style="padding: 10px 15px;">About</a>
          </li>
          <li class="u-nav-item">
            <a class="u-button-style u-nav-link" href="/medbot/public/userlist" style="padding: 10px 15px;">Users</a>
          </li>
          <li class="u-nav-item">
            <a class="u-button-style u-nav-link" style="padding: 10px 15px;">Profile</a>
            <div class="u-nav-popup">
              <ul class="u-h-spacing-10 u-nav u-unstyled u-v-spacing-20 u-nav-2">
                <li class="u-nav-item">
                  <a class="u-button-style u-hover-palette-2-light-1 u-nav-link u-palette-5-light-3" href="/medbot/public/update">Update Info</a>
                </li>
                <li class="u-nav-item">
                  <a class="u-button-style u-hover-palette-2-light-1 u-nav-link u-palette-5-light-3" href="/medbot/public/logout" rel="nofollow">Logout</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <div class="u-custom-menu u-nav-container-collapse">
        <div class="u-container-style u-inner-container-layout u-palette-5-light-3 u-sidenav u-sidenav-1" data-offcanvas-width="150">
          <div class="u-inner-container-layout u-sidenav-overflow">
            <div class="u-menu-close"></div>
            <ul class="u-align-center u-nav u-popupmenu-items u-text-hover-palette-2-light-1 u-unstyled u-nav-3">
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link" href="/medbot/public/">Home</a>
              </li>
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link" href="/medbot/public/about">About</a>
              </li>
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link" href="/medbot/public/userlist">Users</a>
              </li>
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link">Profile</a>
                <div class="u-nav-popup">
                  <ul class="u-h-spacing-10 u-nav u-unstyled u-v-spacing-20 u-nav-4">
                    <li class="u-nav-item">
                      <a class="u-button-style u-nav-link" href="/medbot/public/update">Update Info</a>
                    </li>
                    <li class="u-nav-item">
                      <a class="u-button-style u-nav-link" href="/medbot/public/logout" rel="nofollow">Logout</a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="u-menu-overlay u-opacity u-opacity-0 u-palette-5-light-3"></div>
      </div>
    </nav>
    <form action="/medbot/public/userlist" method="GET" id="search_form" onsubmit="submitAll();" class="u-border-1 u-border-grey-30 u-border-no-right u-search u-search-left u-white u-search-1">
      <button class="u-search-button" type="submit">
        <span class="u-search-icon u-spacing-10">
          <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 56.966 56.966">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-ab89"></use>
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-ab89" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" class="u-svg-content">
            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path>
          </svg>
        </span>
      </button>
      <input class="u-search-input" type="search" id="search" name="search" value="{{request()->search}}" placeholder="Search">
      <input type="text" id="filter" name="filter" value="{{request()->filter}}" style="display: none;">
      <input type="text" id="order" name="order" value="" style="display: none;">
    </form>
    <div class="u-form u-form-1">
      <form action="/medbot/public/userlist" method="GET" id="filter_form" class="u-clearfix u-form-spacing-0 u-form-vertical u-inner-form" source="email" name="form" style="padding: 0px;">
        <div class="u-form-group u-form-select u-label-none u-form-group-1">
          <div class="u-form-select-wrapper">
            <select id="filter_select" name="filter_select" class="u-border-1 u-border-grey-30 u-border-no-left u-custom-font u-input u-input-rectangle u-text-black u-text-font u-white u-input-1">
              <option value="name">Name</option>
              <option value="address">Address</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret">
              <path fill="currentColor" d="M4 8L0 4h8z"></path>
            </svg>
          </div>
        </div>
      </form>
    </div>
    <a href="https://nicepage.com/c/sale-html-templates" class="u-image u-logo u-image-1" data-image-width="200" data-image-height="200">
      <img src="{{ asset('images/logo2.png') }}" class="u-logo-image u-logo-image-1">
    </a>
  </div>
</header>

<script>
function submitAll(){
  search_form = document.getElementById('search_form');
  filter_select = document.getElementById('filter_select').value;
  filter = document.getElementById('filter');
  filter.value = filter_select;
  order_select = document.getElementById('order_select').value;
  order = document.getElementById('order');
  order.value = order_select;
  search_form.submit();
}
</script>