@extends('layout',[$style = 'doctor/userinfo', $title = 'User Info'])

@section('content')

<section class="u-align-center u-clearfix u-section-1" id="sec-4237">
  <div class="u-align-left u-clearfix u-sheet u-sheet-1">
    <h3 class="u-text u-text-default u-text-1">
      User Profile
      <span style="font-weight: 700;"></span>
    </h3>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-3 u-border-palette-1-light-3 u-container-style u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-palette-5-light-3 u-radius-9 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <img class="u-image u-image-circle u-preserve-proportions u-image-1" src="{{ $profile ? asset('storage/'.$profile) : asset('images/blank_profile.png') }}" alt="" data-image-width="640" data-image-height="640">
        <h2 class="u-text u-text-default u-text-2">
          {{$name}}
          <span style="font-weight: 700;"></span>
        </h2>
        <h4 class="u-text u-text-default u-text-3">
          <span class="u-file-icon u-icon">
            <img src="{{ asset('images/joined.png') }}" alt="">
          </span>
          &nbsp;{{$joined}}
        </h4>
        <h4 class="u-text u-text-default u-text-4">
          <span class="u-file-icon u-icon">
            <img src="{{ asset('images/age.png') }}" alt=""></span>
            &nbsp;{{$age}} years old
        </h4>
        <a href="{{'/medbot/public/userlist/id-'.$id.'/report'}}" class="u-btn u-button-style u-none u-text-hover-palette-1-base u-text-palette-2-base u-btn-1">
          <span class="u-file-icon u-icon u-icon-3">
            <img src="{{ asset('images/chart.png') }}" alt=""></span>
            &nbsp;Reports
        </a>
        <a href="{{'/medbot/public/userlist/id-'.$id.'/reading'}}" class="u-btn u-button-style u-none u-text-hover-palette-1-base u-text-palette-2-base u-btn-2">
          <span class="u-file-icon u-icon u-icon-4">
            <img src="{{ asset('images/monitor.png') }}" alt=""></span>
            &nbsp;Readings
        </a>
      </div>
    </div>
    <div class="u-container-style u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-2">
      <div class="u-container-layout u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xl u-container-layout-2">
        <div class="u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xl u-tab-links-align-left u-tabs u-tabs-1">
          <ul class="u-border-1 u-border-grey-75 u-spacing-30 u-tab-list u-unstyled" role="tablist">
            <li class="u-tab-item u-tab-item-1" role="presentation">
              <a class="active u-active-palette-1-light-2 u-border-2 u-border-active-grey-75 u-border-hover-grey-75 u-border-no-bottom u-button-style u-hover-palette-2-light-2 u-tab-link u-text-active-black u-text-hover-white u-tab-link-1" id="link-tab-081f" href="#tab-081f" role="tab" aria-controls="tab-081f" aria-selected="true">About</a>
            </li>
            <li class="u-tab-item u-tab-item-2" role="presentation">
              <a class="u-active-palette-1-light-2 u-border-2 u-border-active-grey-75 u-border-hover-grey-75 u-border-no-bottom u-button-style u-hover-palette-2-light-2 u-tab-link u-text-active-black u-text-hover-white u-tab-link-2" id="tab-6219" href="#link-tab-6219" role="tab" aria-controls="link-tab-6219" aria-selected="false">Overview</a>
            </li>
          </ul>
          <div class="u-tab-content">
            <div class="u-container-style u-palette-5-light-3 u-tab-active u-tab-pane u-tab-pane-1" id="tab-081f" role="tabpanel" aria-labelledby="link-tab-081f">
              <div class="u-container-layout u-container-layout-3">
                <h3 class="u-text u-text-default u-text-5">Personal Information</h3>
                <h4 class="u-text u-text-default u-text-6">
                  <span class="u-file-icon u-icon u-icon-5">
                    <img src="{{ asset('images/phone.png') }}" alt=""></span>
                    &nbsp;​&nbsp;Phone No.
                </h4>
                <h4 class="u-text u-text-default u-text-7">
                  <span class="u-file-icon u-icon u-icon-6">
                    <img src="{{ asset('images/gender.png') }}" alt="">
                  </span>
                  &nbsp;Gender
                </h4>
                <h4 class="u-text u-text-default u-text-8">{{$gender}}</h4>
                <h4 class="u-text u-text-default u-text-9">{{ $phone ? $phone : 'N/A' }}</h4>
                <h4 class="u-text u-text-default u-text-10">
                  <span class="u-file-icon u-icon u-icon-7">
                    <img src="{{ asset('images/birthday.png') }}" alt=""></span>
                    &nbsp;​
                    &nbsp;Birthday
                </h4>
                <h4 class="u-text u-text-default u-text-11">
                  <span class="u-file-icon u-icon u-icon-8">
                    <img src="{{ asset('images/email.png') }}" alt=""></span>
                    &nbsp;​
                    &nbsp;Email
                </h4>
                <h4 class="u-text u-text-default u-text-12">{{$birthday}}</h4>
                <h4 class="u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-13">{{ $email ? $email : 'N/A' }}</h4>
                <h4 class="u-text u-text-default u-text-14">
                  <span class="u-file-icon u-icon u-icon-9">
                    <img src="{{ asset('images/location.png') }}" alt="">
                  </span>
                  &nbsp;​ Address
                </h4>
                <h4 class="u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-15">{{ $address ? $address : 'N/A' }}</h4>
                <h4 class="u-text u-text-default u-text-16">
                  <span class="u-file-icon u-icon u-icon-10">
                    <img src="{{ asset('images/bio.png') }}" alt="">
                  </span>
                  &nbsp;​ Bio
                </h4>
                <blockquote class="u-text u-text-17">{{ $bio ? $bio : 'Nothing here yet' }}</blockquote>
              </div>
            </div>
            <div class="u-align-left u-container-style u-palette-5-light-3 u-tab-pane u-tab-pane-2" id="link-tab-6219" role="tabpanel" aria-labelledby="tab-6219">
              <div class="u-container-layout u-container-layout-4">
                <h3 class="u-text u-text-default u-text-18">Latest Reading: {{$latest_reading}}</h3>
                <div class="u-list u-list-1">
                  <div class="u-repeater u-repeater-1">
                    <div class="u-align-center u-container-style u-list-item u-repeater-item">
                      <div class="u-container-layout u-similar-container u-valign-top u-container-layout-5">
                        <div class="u-align-center u-border-3 u-border-grey-50 u-container-style u-group u-group-3">
                          <div class="u-container-layout u-container-layout-6">
                            <img class="u-image u-image-circle u-image-contain u-preserve-proportions u-image-2" src="{{ asset('images/pulse_rate.png') }}" alt="" data-image-width="128" data-image-height="128">
                            <h3 class="u-align-center u-text u-text-default u-text-19">{{$latest_pulse_rate}}</h3>
                            <h4 class="u-align-center u-text u-text-default u-text-20">bpm</h4>
                            <h5 class="u-align-center u-text u-text-default u-text-21">
                              <span style="font-weight: 700;">
                                Average:
                                <span style="font-weight: 700;"></span>
                              </span>
                              <br>
                            </h5>
                            <h5 class="u-align-center u-text u-text-default u-text-22">{{$average_pulse_rate}} bpm</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="u-align-center u-container-style u-list-item u-repeater-item">
                      <div class="u-container-layout u-similar-container u-valign-top u-container-layout-5">
                        <div class="u-align-center u-border-3 u-border-grey-50 u-container-style u-group u-group-3">
                          <div class="u-container-layout u-container-layout-6">
                            <img class="u-image u-image-circle u-image-contain u-preserve-proportions u-image-2" src="{{ asset('images/blood_pressure.png') }}" alt="" data-image-width="128" data-image-height="128">
                            <h3 class="u-align-center u-text u-text-default u-text-19">{{$latest_systolic}}/{{$latest_diastolic}}</h3>
                            <h4 class="u-align-center u-text u-text-default u-text-20">mmHg</h4>
                            <h5 class="u-align-center u-text u-text-default u-text-21">
                              <span style="font-weight: 700;">
                                Average:
                                <span style="font-weight: 700;"></span>
                              </span>
                              <br>
                            </h5>
                            <h5 class="u-align-center u-text u-text-default u-text-22">{{$average_systolic}}/{{$average_diastolic}} mmHg</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="u-align-center u-container-style u-list-item u-repeater-item">
                      <div class="u-container-layout u-similar-container u-valign-top u-container-layout-5">
                        <div class="u-align-center u-border-3 u-border-grey-50 u-container-style u-group u-group-3">
                          <div class="u-container-layout u-container-layout-6">
                            <img class="u-image u-image-circle u-image-contain u-preserve-proportions u-image-2" src="{{ asset('images/blood_saturation.png') }}" alt="" data-image-width="128" data-image-height="128">
                            <h3 class="u-align-center u-text u-text-default u-text-19">{{$latest_blood_saturation}}</h3>
                            <h4 class="u-align-center u-text u-text-default u-text-20"> %</h4>
                            <h5 class="u-align-center u-text u-text-default u-text-21">
                              <span style="font-weight: 700;">
                                Average:
                                <span style="font-weight: 700;"></span>
                              </span>
                              <br>
                            </h5>
                            <h5 class="u-align-center u-text u-text-default u-text-22">{{$average_blood_saturation}} %</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection