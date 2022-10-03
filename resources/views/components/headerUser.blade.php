@props([])

<header class="u-clearfix u-header u-palette-5-light-3 u-sticky u-sticky-f560" id="sec-3e0f" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
  <style class="u-sticky-style" data-style-id="f560">
    .u-sticky-fixed.u-sticky-f560:before, 
    .u-body.u-sticky-fixed .u-sticky-f560:before {
      borders: top right bottom left !important
    }
  </style>
  <div class="u-clearfix u-sheet u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-sheet-1">
    <p class="u-align-center u-custom-font u-font-lobster u-text u-text-1">
      <span class="u-file-icon u-icon">
        <img src="{{ asset('images/logo.png') }}" alt="">
      </span>
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
            <a class="u-button-style u-nav-link" href="/medbot/public/readinglist" style="padding: 10px 15px;">Readings</a>
          </li>
          <li class="u-nav-item">
            <a class="u-button-style u-nav-link" style="padding: 10px 15px;">Profile</a>
            <div class="u-nav-popup">
              <ul class="u-h-spacing-10 u-nav u-unstyled u-v-spacing-20 u-nav-2">
                <li class="u-nav-item">
                  <a class="u-button-style u-hover-palette-2-light-1 u-nav-link u-palette-5-light-3" href="/medbot/public/manage">User Info</a>
                </li>
                <li class="u-nav-item">
                  <a class="u-button-style u-hover-palette-2-light-1 u-nav-link u-palette-5-light-3" href="/medbot/public/logout">Logout</a>
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
                <a class="u-button-style u-nav-link" href="/medbot/public/readinglist">Readings</a>
              </li>
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link">Profile</a>
                <div class="u-nav-popup">
                  <ul class="u-h-spacing-10 u-nav u-unstyled u-v-spacing-20 u-nav-4">
                    <li class="u-nav-item">
                      <a class="u-button-style u-nav-link" href="/medbot/public/manage">User Info</a>
                    </li>
                    <li class="u-nav-item">
                      <a class="u-button-style u-nav-link" href="/medbot/public/logout">Logout</a>
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
    <a href="/medbot/public/" class="u-image u-logo u-image-1" data-image-width="200" data-image-height="200">
      <img src="{{ asset('images/logo2.png') }}" class="u-logo-image u-logo-image-1">
    </a>
  </div>
</header>