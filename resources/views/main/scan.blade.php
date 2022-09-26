@extends('layout',[$style = 'main/scan', $title = 'Scan QRCode'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-23a1">
  <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-container-style u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-1">
      <div class="u-container-layout u-valign-middle u-container-layout-1">
        <div class="u-container-style u-group u-shape-rectangle u-group-2">
          <div class="u-container-layout u-container-layout-2" id="scanner"></div>
        </div>
      </div>
    </div>
    <button id="front" class="u-btn u-btn-round u-button-style u-hidden-lg u-hidden-xl u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-1">
      <span class="u-file-icon u-icon u-icon-1">
        <img src="{{ asset('images/front_camera.png') }}" alt="">
      </span>
      &nbsp;FRONT CAM
    </button>
    <button id="back" class="u-btn u-btn-round u-button-style u-hidden-lg u-hidden-xl u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-2">
      <span class="u-file-icon u-icon u-icon-2">
        <img src="{{ asset('images/back_camera.png') }}" alt="">
      </span>
      &nbsp;BACK CAM
    </button>
    <div class="u-form u-form-1">
      <form action="/medbot/public/authenticate/user/scan" method="POST" class="u-clearfix u-form-horizontal u-form-spacing-10 u-inner-form" id="qrcode_form" name="qrcode_form" style="padding: 10px;">
      @csrf 
        <div class="u-form-group u-form-name">
          <input type="text" placeholder="Enter encrypted qrcode" id="qrcode" name="qrcode" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" style="display: none;" required="">
        </div>
      </form>
    </div>
  </div>
</section>
<script type="text/javascript" src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script>
  const html5QrCode = new Html5Qrcode('scanner');
  const qrCodeSuccessCallback = (decodedText, decodedResult) => {
      console.log(decodedText);
      html5QrCode.stop().then((ignore) => {
        // QR Code scanning is stopped.
      }).catch((err) => {
        // Stop failed, handle it.
      });
      document.getElementById('qrcode').value = decodedText;
      document.getElementById('qrcode_form').submit();
  };
  const config = { fps: 10, qrbox: { width: 250, height: 250 } };
  html5QrCode.start({ facingMode: 'environment' }, config, qrCodeSuccessCallback);

  var mode = 'user';
  document.getElementById('front').addEventListener('click', switchCamera());
  document.getElementById('back').addEventListener('click', switchCamera());
  function switchCamera(){
    if(mode == 'user'){
      html5QrCode.stop().then((ignore) => {
        html5QrCode.start({ facingMode: 'environment' }, config, qrCodeSuccessCallback);
      }).catch((err) => {
        // Stop failed, handle it.
      });
      mode = 'environment';
    }
    else if(mode == 'environment'){
      html5QrCode.stop().then((ignore) => {
        html5QrCode.start({ facingMode: 'user' }, config, qrCodeSuccessCallback);
      }).catch((err) => {
        // Stop failed, handle it.
      });
      mode = 'user';
    }
  }
</script>
@endsection