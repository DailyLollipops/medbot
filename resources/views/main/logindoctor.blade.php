@extends('layout',[$style = 'main/logindoctor', $title = 'Doctor Login'])

@section('content')
  <section class="u-clearfix u-section-1" id="sec-8103">
    <div class="u-clearfix u-sheet u-sheet-1">
      <div class="u-container-style u-group u-radius-50 u-shape-round u-white u-group-1">
        <div class="u-container-layout u-container-layout-1">
          <span class="u-border-8 u-border-white u-file-icon u-icon u-icon-circle u-icon-1">
            <img src="{{ asset('images/login1.png') }}" alt="">
          </span>
          <h2 class="u-align-center u-text u-text-default u-text-palette-2-base u-text-1">Login Now</h2>
          <div class="u-form u-login-control u-form-1">
            <form action="/medbot/public/authenticate/doctor" method="POST">
              @csrf
              <div class="u-form-group u-form-name u-label-top">
                <label for="username-a30d" class="u-label u-text-grey-30 u-label-1">Username *</label>
                <input type="text" value="{{old('email')}}" placeholder="Enter your Email" name="email" class="u-border-10 u-border-grey-10 u-grey-10 u-input u-input-rectangle u-radius-50 u-input-1" />
              </div>
              <div class="u-form-group u-form-password u-label-top">
                <label for="password-a30d" class="u-label u-text-grey-30 u-label-2">Password *</label>
                <input type="password" value="" placeholder="Enter your Password" name="password" class="u-border-10 u-border-grey-10 u-grey-10 u-input u-input-rectangle u-radius-50 u-input-2">
              </div>
              <div class="u-form-checkbox u-form-group u-label-top">
                <input type="checkbox" id="checkbox-a30d" name="remember" value="On">
                <label for="checkbox-a30d" class="u-label u-text-grey-30 u-label-3">Remember me</label>
              </div>
              <div class="u-align-center u-form-group u-form-submit u-label-top">
                <input type="submit" value="submit" class="u-form-control-hidden">
                <a href="#" class="u-active-palette-1-base u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-base u-palette-2-base u-radius-50 u-btn-1">Login</a>
              </div>
              <input type="hidden" value="" name="recaptchaResponse">
            </form>
          </div>
          <a href="/medbot/public/login/user" data-page-id="36626688" class="u-border-active-palette-2-base u-border-hover-palette-2-base u-border-none u-btn u-button-style u-login-control u-login-create-account u-none u-text-palette-2-base u-btn-2">Login as User?</a>
        </div>
      </div>
    </div>
  </section>
@endsection