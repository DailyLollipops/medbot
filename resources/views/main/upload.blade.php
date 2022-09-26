@extends('layout',[$style = 'main/upload', $title = 'Upload QRCode'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-77cd">
  <div class="u-align-left u-clearfix u-sheet u-sheet-1">
    <div class="u-align-center u-container-style u-group u-radius-50 u-shape-round u-white u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <span class="u-border-2 u-border-palette-1-base u-file-icon u-icon u-icon-circle u-icon-1">
          <img src="{{ asset('images/login2.png') }}" alt="">
        </span>
        <a href="/medbot/public/login/user" class="u-btn u-button-style u-none u-text-hover-palette-2-base u-text-palette-1-base u-btn-1">
          <span class="u-file-icon u-icon">
            <img src="{{ asset('images/back.png') }}" alt="">
          </span>&nbsp;Go Back
        </a>
        <h2 class="u-text u-text-default u-text-palette-2-base u-text-1">Upload QR Code</h2>
        <span class="u-file-icon u-icon u-icon-3">
          <img src="{{ asset('images/qrcode2.png') }}" alt="">
        </span>

        <form action="/medbot/public/authenticate/user/upload" method="POST" enctype="multipart/form-data">
        @csrf
          <input type="file" name="qrcode" id="qrcode" class="uploadfile" onchange="this.form.submit()"/>
          <label for="qrcode" class="u-border-none u-btn u-btn-round u-button-style u-gradient u-hover-feature u-hover-palette-1-base u-none u-radius-50 u-text-body-alt-color u-text-hover-palette-2-base u-btn-2">UPLOAD</label>
        </form>

      </div>
    </div>
  </div>
</section>
@endsection