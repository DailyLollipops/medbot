@extends('layout',[$style = 'main/loginuser', $title = 'User Login'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-77cd">
  <div class="u-align-left u-clearfix u-sheet u-sheet-1">
    <div class="u-align-center u-container-style u-group u-radius-50 u-shape-round u-white u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <span class="u-border-8 u-border-white u-file-icon u-icon u-icon-circle u-icon-1">
          <img src="{{ asset('images/login1.png') }}" alt="">
        </span>
        <h2 class="u-text u-text-default u-text-palette-2-base u-text-1">Login Now</h2>
        <img class="u-image u-image-default u-preserve-proportions u-image-1" src="{{ asset('images/qrcode.png') }}" alt="" data-image-width="128" data-image-height="128">
        <a href="/medbot/public/login/user/scan" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-text-hover-palette-2-base u-btn-1">
          <span class="u-file-icon u-icon">
            <img src="{{ asset('images/scan.png') }}" alt="">
          </span>&nbsp;Scan QRCODE
        </a>
        <a href="/medbot/public/login/user/upload" class="u-border-none u-btn u-btn-round u-button-style u-gradient u-hover-palette-1-base u-none u-radius-50 u-text-body-alt-color u-text-hover-palette-2-base u-btn-2">
          <span class="u-file-icon u-icon u-icon-3">
            <img src="{{ asset('images/upload.png') }}" alt="">
          </span>&nbsp;UPLOAD QRCODE
        </a>
        <a href="/medbot/public/login/doctor" class="u-active-none u-border-2 u-border-hover-white u-border-palette-2-base u-btn u-button-style u-hover-none u-none u-text-hover-palette-2-base u-text-palette-1-base u-btn-3">
          Login as Doctor
          <span style="font-size: 1.5rem;">
            <span style="font-size: 2.25rem;">
            
            </span>
          </span>
        </a>
      </div>
    </div>
  </div>
</section>
@endsection