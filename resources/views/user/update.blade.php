@extends('layout',[$style = 'user/update', $title = 'Update Info'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-33b1">
  <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-sheet-1">
    <h3 class="u-text u-text-default u-text-1">Edit Profile Information</h3>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-container-style u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <div class="u-form u-form-1">
          <form action="/medbot/public/manage/update/change_info" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" name="form-1" style="padding: 10px;">
          @csrf  
            <div class="u-form-group u-form-name u-label-top">
              <label for="name-f29d" class="u-label u-label-1">Name</label>
              <input type="text" placeholder="Enter your Name" value="{{$user_name}}" id="name-f29d" name="name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
            </div>
            <div class="u-form-group u-form-partition-factor-2 u-form-select u-label-top u-form-group-2">
              <label for="select-4497" class="u-label u-label-2">Gender</label>
              <div class="u-form-select-wrapper">
                <select id="select-4497" name="select" value="{{$user_gender}}" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white">
                  {{-- <option value="--Select Gender--">--Select Gender--</option> --}}
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
              </div>
            </div>
            <div class="u-form-date u-form-group u-form-partition-factor-2 u-label-top u-form-group-3">
              <label for="date-55ed" class="u-label u-label-3">Birthday</label>
              <input type="date" placeholder="MM/DD/YYYY" value="{{$user_birthday}}"id="date-55ed" name="date" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
            </div>
            <div class="u-form-email u-form-group u-form-partition-factor-2 u-label-top">
              <label for="email-f29d" class="u-label u-label-4">Address</label>
              <input type="email" placeholder="Enter your current home address" value="{{$user_address}}" id="email-f29d" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
            </div>
            <div class="u-form-group u-form-partition-factor-2 u-form-phone u-label-top u-form-group-5">
              <label for="phone-89f8" class="u-label u-label-5">Phone</label>
              <input type="tel" pattern="\+?\d{0,3}[\s\(\-]?([0-9]{2,3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Enter your phone (e.g. +14155552675)" id="phone-89f8" name="phone" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
            </div>
            <div class="u-form-group u-label-top u-form-group-6">
              <label for="text-a66e" class="u-label u-label-6">Email Address</label>
              <input type="text" id="text-a66e" name="text" value="{{$user_email}}" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" placeholder="Enter a valid email address">
            </div>
            <div class="u-form-group u-form-message u-label-top u-form-group-7">
              <label for="message-c5d2" class="u-label u-label-7">Bio</label>
              <textarea placeholder="Enter your message" value="{{$user_bio}}" rows="4" cols="50" id="message-c5d2" name="message" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required=""></textarea>
            </div>
            <div class="u-align-right u-form-group u-form-submit u-label-top">
              <input type="submit" value="submit" class="u-form-control-hidden">
              <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-radius-25">Update User Information</a>
            </div>
            <div class="u-form-send-message u-form-send-success"> Your information was successfully sent. </div>
            <div class="u-form-send-error u-form-send-message"> Error processing your request. Please try again later. </div>
          </form>
        </div>
        <form action="/medbot/public/manage/update/profile_picture" method="POST" enctype="multipart/form-data">
        @csrf
          <input type="file" name="profile_picture" id="profile_picture" style="display:none" onchange="this.form.submit()"/>

            @if(empty($user_profile_picture_path))
              <img class="u-border-2 u-border-grey-75 u-image u-image-circle u-preserve-proportions u-image-1" src="{{ asset($user_profile) }}" alt="" data-image-width="128" data-image-height="128" style="cursor: pointer">
            @else
              <img class="u-border-2 u-border-grey-75 u-image u-image-circle u-preserve-proportions u-image-1" src="{{ asset('images/blank_profile.png') }}" alt="" data-image-width="128" data-image-height="128" style="cursor: pointer">
            @endif
          
          <a href="#" onclick="$('#profile_picture').trigger('click'); return false;" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-2">Update</a></label>
        </form>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-2" id="carousel_adfa">
  <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
    <h3 class="u-text u-text-default u-text-1">Change Password</h3>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-container-style u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <div class="u-form u-form-1">
          <form action="/medbot/public/manage/update/change_password" method="POST" class="u-clearfix u-form-spacing-30 u-form-vertical u-inner-form" source="email" name="form-1" style="padding: 10px;">
          @csrf  
            <div class="u-form-group u-form-name u-form-partition-factor-3 u-label-top">
              <label for="current-password" class="u-label">Current Password</label>
              <input type="password" placeholder="Enter your current assword" id="current-password" name="current-password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
            </div>
            <div class="u-form-group u-form-partition-factor-3 u-label-top u-form-group-2">
              <label for="password" class="u-label">New Password</label>
              <input type="password" placeholder="Enter new password" id="password" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="required">
            </div>
            <div class="u-form-email u-form-group u-form-partition-factor-3 u-label-top">
              <label for="confirm-password" class="u-label">Confirm Password</label>
              <input type="password" placeholder="Confirm your new password" id="confirm-password" name="confirm-password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
            </div>
            <div class="u-align-center u-form-group u-form-submit u-label-top">
              <input type="submit" value="submit" class="u-form-control-hidden">
              <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-radius-25">Change Password</a>
            </div>
            <div class="u-form-send-message u-form-send-success"> Your password was successfully changed. Please download the latest QRCode. </div>
            <div class="u-form-send-error u-form-send-message"> Error processing request. Please try again later. </div>
          </form>
        </div>
        <blockquote class="u-text u-text-2"> Changing your password requires you to download a newly generated QR Code. Upon downloading the QR Code please print it ASAP</blockquote>
        <span class="u-file-icon u-icon u-icon-1">
          <img src="{{ asset('images/warning.png') }}" alt="">
        </span>
      </div>
    </div>
  </div>
</section>
@endsection