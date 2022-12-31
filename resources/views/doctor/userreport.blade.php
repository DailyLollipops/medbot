@extends('layout',[$style = 'doctor/userreport', $title = 'User Report'])

@section('content')
<section class="u-align-center u-clearfix u-section-1" id="sec-4237">
  <div class="u-align-left u-clearfix u-sheet u-sheet-1">
    <h3 class="u-text u-text-default u-text-1">User Profile
      <span style="font-weight: 700;"></span>
    </h3>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-3 u-border-palette-1-light-3 u-container-style u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-palette-5-light-3 u-radius-9 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <img class="u-image u-image-circle u-preserve-proportions u-image-1" src="{{ $user_profile ? asset('storage/'.$user_profile) : asset('images/blank_profile.png') }}" alt="" data-image-width="640" data-image-height="640">
        <h2 class="u-text u-text-default u-text-2">{{ $user_name}}
          <span style="font-weight: 700;"></span>
        </h2>
        <h4 class="u-text u-text-default u-text-3">
          <span class="u-file-icon u-icon">
            <img src="{{ asset('images/joined.png') }}" alt="">
          </span>&nbsp;{{$user_joined}}
        </h4>
        <h4 class="u-text u-text-default u-text-4">
          <span class="u-file-icon u-icon">
            <img src="{{ asset('images/age.png') }}" alt="">
          </span>&nbsp;{{$user_age}} years old
        </h4>
        <a href="#" class="u-btn u-button-style u-none u-text-hover-palette-1-base u-text-palette-1-base u-btn-1">
          <span class="u-file-icon u-icon u-icon-3">
            <img src="{{ asset('images/chart.png') }}" alt="">
          </span>&nbsp;Reports
        </a>
        <a href="{{'/medbot/public/userlist/id-'.$user_id.'/reading'}}" class="u-btn u-button-style u-none u-text-hover-palette-1-base u-text-palette-2-base u-btn-2">
          <span class="u-file-icon u-icon u-icon-4">
            <img src="{{ asset('images/monitor.png') }}" alt="">
          </span>&nbsp;Readings
        </a>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-2" id="sec-28e3">
  <div class="u-clearfix u-sheet u-sheet-1">
    <p class="u-custom-font u-heading-font u-text u-text-default u-text-1">
      <span class="u-file-icon u-icon">
        <img src="{{ asset('images/chart.png') }}" alt="">
      </span>&nbsp;Readings Reports
    </p>
    <h4 class="u-text u-text-default u-text-2">Recent Reading (Taken Last {{$latest_reading->created_at->format('M-d-Y h:i A')}})</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-expanded-width-sm u-expanded-width-xs u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-align-center u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-1">
          <div class="u-container-layout u-similar-container u-container-layout-1">
            <h5 class="u-text u-text-3">
              <span class="u-file-icon u-icon">

                @if($latest_reading->pulse_rate < 60)
                  <img src="{{ asset('images/sad.png') }}" alt="" title="Below Normal">
                @elseif($latest_reading->pulse_rate < 100)
                  <img src="{{ asset('images/happy.png') }}" alt="" title="Normal">
                @else
                  <img src="{{ asset('images/shocked.png') }}" alt="" title="Above Normal">
                @endif

              </span>&nbsp;Pulse Rate<br>
            </h5>
            <span class="u-custom-item u-file-icon u-icon u-icon-3">
              <img src="{{ asset('images/pulse_rate.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-4">{{$latest_reading->pulse_rate}} bpm</p>
          </div>
        </div>
        <div class="u-align-center u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-2">
          <div class="u-container-layout u-similar-container u-container-layout-2">
            <h5 class="u-text u-text-5">
              <span class="u-file-icon u-icon u-icon-4">

                @if($latest_reading->systolic < 120 && $latest_reading->diastolic < 80)
                  <img src="{{ asset('images/happy.png') }}" alt="" title="Normal">
                @else
                  <img src="{{ asset('images/shocked.png') }}" alt="" title="Above Normal">
                @endif

              </span>&nbsp;Blood Pressure
            </h5>
            <span class="u-custom-item u-file-icon u-icon u-icon-5">
              <img src="{{ asset('images/blood_pressure.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-6">{{$latest_reading->systolic}}/{{$latest_reading->diastolic}} mmHg</p>
          </div>
        </div>
        <div class="u-align-center u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-3">
          <div class="u-container-layout u-similar-container u-container-layout-3">
            <h5 class="u-text u-text-7">
              <span class="u-file-icon u-icon">

                @if($latest_reading->blood_saturation < 95)
                  <img src="{{ asset('images/sad.png') }}" alt="" title="Below Normal">
                @elseif($latest_reading->blood_saturation <= 100)
                  <img src="{{ asset('images/happy.png') }}" alt="" title="Normal">
                @else
                  <img src="{{ asset('images/shocked.png') }}" alt="" title="Above Normal">
                @endif

              </span>&nbsp;Blood Saturation
            </h5>
            <span class="u-custom-item u-file-icon u-icon u-icon-7">
              <img src="{{ asset('images/blood_saturation.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-8">{{$latest_reading->blood_saturation}} %</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-3" id="sec-c70a">
  <div class="u-clearfix u-sheet u-sheet-1">
    <h4 class="u-text u-text-default u-text-1">Previous Recent Reading (Taken Last {{$previous_recent_reading->created_at->format('M-d-Y h:i A')}})
    </h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-expanded-width-sm u-expanded-width-xs u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-align-center u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-1">
          <div class="u-container-layout u-similar-container u-container-layout-1">
            <h5 class="u-text u-text-2">
              <span class="u-file-icon u-icon">

                @if($previous_recent_reading->pulse_rate < 60)
                  <img src="{{ asset('images/sad.png') }}" alt="" title="Below Normal">
                @elseif($previous_recent_reading->pulse_rate < 100)
                  <img src="{{ asset('images/happy.png') }}" alt="" title="Normal">
                @else
                  <img src="{{ asset('images/shocked.png') }}" alt="" title="Above Normal">
                @endif

              </span>&nbsp;Pulse Rate<br>
            </h5>
            <span class="u-custom-item u-file-icon u-icon u-icon-2">
              <img src="{{ asset('images/pulse_rate.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-3">{{$previous_recent_reading->pulse_rate}} bpm</p>
          </div>
        </div>
        <div class="u-align-center u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-2">
          <div class="u-container-layout u-similar-container u-container-layout-2">
            <h5 class="u-text u-text-4">
              <span class="u-file-icon u-icon u-icon-3">

                @if($previous_recent_reading->systolic < 120 && $previous_recent_reading->diastolic < 80)
                  <img src="{{ asset('images/happy.png') }}" alt="" title="Normal">
                @else
                  <img src="{{ asset('images/shocked.png') }}" alt="" title="Above Normal">
                @endif

              </span>&nbsp;Blood Pressure
            </h5>
            <span class="u-custom-item u-file-icon u-icon u-icon-4">
              <img src="{{ asset('images/blood_pressure.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-5">{{$previous_recent_reading->systolic}}/{{$previous_recent_reading->diastolic}} mmHg</p>
          </div>
        </div>
        <div class="u-align-center u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-3">
          <div class="u-container-layout u-similar-container u-container-layout-3">
            <h5 class="u-text u-text-6">
              <span class="u-file-icon u-icon">

                @if($previous_recent_reading->blood_saturation < 95)
                  <img src="{{ asset('images/sad.png') }}" alt="" title="Below Normal">
                @elseif($previous_recent_reading->blood_saturation <= 100)
                  <img src="{{ asset('images/happy.png') }}" alt="" title="Normal">
                @else
                  <img src="{{ asset('images/shocked.png') }}" alt="" title="Above Normal">
                @endif

              </span>&nbsp;Blood Saturation
            </h5>
            <span class="u-custom-item u-file-icon u-icon u-icon-6">
              <img src="{{ asset('images/blood_saturation.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-7">{{$previous_recent_reading->blood_saturation}} %</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-4" id="sec-9c07">
  <div class="u-clearfix u-sheet u-sheet-1">
    <h4 class="u-text u-text-default u-text-1">Report This Month</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-expanded-width-sm u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <canvas id="thisMonthReadingsChart"></canvas>
      </div>
    </div>
    <div class="u-border-2 u-border-palette-5-light-3 u-container-style u-expanded-width-xs u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-2">
        <canvas id="thisMonthRatingsChart"></canvas>
      </div>
    </div>
    <div class="u-expanded-width-xs u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-3">
            <button id="showThisMonthPulseRates" class="u-btn u-btn-round u-button-style u-custom-item u-palette-1-light-1 u-radius-4 u-text-body-alt-color u-btn-1">
              <span class="u-file-icon u-icon u-icon-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/pulse_rate.png') }}" alt="">
              </span>&nbsp;PR&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-4">
            <button id="showThisMonthBloodPressures" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-palette-2-light-1 u-radius-4 u-text-body-alt-color u-btn-2">
              <span class="u-file-icon u-icon u-icon-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_pressure.png') }}" alt="">
              </span>&nbsp;BP&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-5">
            <button id="showThisMonthBloodSaturations" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-grey-70 u-radius-4 u-text-body-alt-color u-btn-3">
              <span class="u-file-icon u-icon u-icon-3" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_saturation.png') }}" alt="">
              </span>&nbsp;SP02
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-6">
            <button id="showThisMonthReadings" class="u-btn u-btn-round u-button-style u-custom-item u-palette-1-light-1 u-radius-4 u-text-body-alt-color u-btn-4">
              <span class="u-file-icon u-icon u-icon-4" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/chart.png') }}" alt="">
              </span>&nbsp;ALL&nbsp;
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="u-list u-list-2">
      <div class="u-repeater u-repeater-2">
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-7">
            <button id="showThisMonthPulseRateRatings" class="u-btn u-btn-round u-button-style u-custom-item u-palette-1-light-1 u-radius-4 u-text-body-alt-color u-btn-5">
              <span class="u-file-icon u-icon u-icon-5" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/pulse_rate.png') }}" alt="">
              </span>&nbsp;PR&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-8">
            <button id="showThisMonthBloodPressureRatings" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-palette-2-light-1 u-radius-4 u-text-body-alt-color u-btn-6">
              <span class="u-file-icon u-icon u-icon-6" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_pressure.png') }}" alt="">
              </span>&nbsp;BP&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-9">
            <button id="showThisMonthBloodSaturationRatings" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-grey-70 u-radius-4 u-text-body-alt-color u-btn-7">
              <span class="u-file-icon u-icon u-icon-7" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_saturation.png') }}" alt="">
              </span>&nbsp;SP02
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-5" id="sec-3a38">
  <div class="u-clearfix u-sheet u-valign-middle-xs u-sheet-1">
    <h4 class="u-text u-text-default u-text-1">Report This Year</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <h5 class="u-text u-text-default u-text-2">Select Date Range</h5>
    <div class="u-form u-form-1">
      <form action="#" method="GET" onsubmit="select_date_range()" id="form" class="u-clearfix u-form-horizontal u-form-spacing-10 u-inner-form" source="email" name="form" style="padding: 10px;">
        <div class="u-form-date u-form-group u-form-group-1">
          <label for="from" class="u-label">From</label>
          <input type="date" placeholder="MM/DD/YYYY" id="from" name="from" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
        </div>
        <div class="u-form-date u-form-group u-form-group-2">
          <label for="to" class="u-label">To</label>
          <input type="date" placeholder="MM/DD/YYYY" id="to" name="to" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
        </div>
        <div class="u-align-left u-form-group u-form-submit">
          <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-radius-15">Submit</a>
          <input type="submit" value="submit" class="u-form-control-hidden">
        </div>
      </form>
    </div>
    <div class="u-border-1 u-border-palette-5-light-3 u-container-style u-expanded-width-xs u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <canvas id="thisRangeRatingsChart"></canvas>
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-2">
        <canvas id="thisRangeReadingsChart"></canvas>
      </div>
    </div>
    <div class="u-expanded-width-xs u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-3">
            <button id="showThisRangePulseRates" class="u-btn u-btn-round u-button-style u-custom-item u-palette-1-light-1 u-radius-4 u-text-body-alt-color u-btn-2">
              <span class="u-file-icon u-icon u-icon-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/pulse_rate.png') }}" alt="">
              </span>&nbsp;PR&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-4">
            <button id="showThisRangeBloodPressures" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-palette-2-light-1 u-radius-4 u-text-body-alt-color u-btn-3">
              <span class="u-file-icon u-icon u-icon-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_pressure.png') }}" alt="">
              </span>&nbsp;BP&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-5">
            <button id="showThisRangeBloodSaturations" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-grey-70 u-radius-4 u-text-body-alt-color u-btn-4">
              <span class="u-file-icon u-icon u-icon-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_saturation.png') }}" alt="">
              </span>&nbsp;SP02
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-6">
            <button id="showThisRangeReadings" class="u-btn u-btn-round u-button-style u-custom-item u-palette-1-light-1 u-radius-4 u-text-body-alt-color u-btn-5">
              <span class="u-file-icon u-icon u-icon-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/chart.png') }}" alt="">
              </span>&nbsp;ALL&nbsp;
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="u-list u-list-2">
      <div class="u-repeater u-repeater-2">
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-xl u-container-layout-7">
            <button id="showThisRangePulseRateRatings" class="u-btn u-btn-round u-button-style u-custom-item u-palette-1-light-1 u-radius-4 u-text-body-alt-color u-btn-6">
              <span class="u-file-icon u-icon u-icon-5" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/pulse_rate.png') }}" alt="">
              </span>&nbsp;PR&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-xl u-container-layout-8">
            <button id="showThisRangeBloodPressureRatings" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-palette-2-light-1 u-radius-4 u-text-body-alt-color u-btn-7">
              <span class="u-file-icon u-icon u-icon-6" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_pressure.png') }}" alt="">
              </span>&nbsp;BP&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-xl u-container-layout-9">
            <button id="showThisRangeBloodSaturationRatings" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-grey-70 u-radius-4 u-text-body-alt-color u-btn-8">
              <span class="u-file-icon u-icon u-icon-7" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_pressure.png') }}" alt="">
              </span>&nbsp;SP02
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-expanded-width-sm u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-3">
      <div class="u-container-layout u-container-layout-10">
        <canvas id="perMonthRatingsChart"></canvas>
      </div>
    </div>
    <div class="u-expanded-width-sm u-expanded-width-xs u-list u-list-3">
      <div class="u-repeater u-repeater-3">
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-xl u-container-layout-11">
            <button id="showPerMonthPulseRateRatings" class="u-btn u-btn-round u-button-style u-custom-item u-palette-1-light-1 u-radius-4 u-text-body-alt-color u-btn-9">
              <span class="u-file-icon u-icon u-icon-8" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/pulse_rate.png') }}" alt="">
              </span>&nbsp;PR&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-xl u-container-layout-12">
            <button id="showPerMonthBloodPressureRatings" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-palette-2-light-1 u-radius-4 u-text-body-alt-color u-btn-10">
              <span class="u-file-icon u-icon u-icon-9" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_pressure.png') }}" alt="">
              </span>&nbsp;BP&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-xl u-container-layout-13">
            <button id="showPerMonthBloodSaturationRatings" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-grey-70 u-radius-4 u-text-body-alt-color u-btn-11">
              <span class="u-file-icon u-icon u-icon-10" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_saturation.png') }}" alt="">
              </span>&nbsp;SP02
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function select_date_range(){
    form = document.getElementById('form');
    form.submit();
  }
</script>

{{-- Script Section --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  function determinePulseRate(age, pulse_rate){
    if(age <= 1){
      low = 100;
      high = 160;
    }
    else if(age <= 3){
      low = 80;
      high = 130;  
    }
    else if(age <= 5){
      low = 80;
      high = 120;  
    }
    else if(age <= 10){
      low = 70;
      high = 110;  
    }
    else if(age <= 14){
      const low = 60;
      high = 105;  
    }
    else{
      low = 60;
      high = 100;
    }
    if(pulse_rate < low){
      return 'Below Normal';
    }
    else if(pulse_rate < high){
      return 'Normal';
    }
    else{
      return 'Above Normal';
    }
  }
  
  function determineBloodPressure(systolic, diastolic){
    if(systolic < 120 && diastolic < 80){
      rating = 'Normal';
    }
    else if(systolic <= 129 && diastolic < 80){
      rating = 'Elevated High Blood Pressure';
    }
    else if(systolic <= 139 || diastolic <= 89){
      rating = 'Hypertension Stage I';
    }
    else if(systolic <= 180 || diastolic <= 120){
      rating = 'Hypertension Stage II';
    }
    else{
      rating = 'Hypertensive Crisis';
    }
    return rating;
  }

  function determineBloodSaturation(blood_saturation){
    if(blood_saturation < 95){
      rating = 'Below Normal';
    }
    else if(blood_saturation <= 100){
      rating = 'Normal';
    }
    else{
      rating = 'Above Normal';
    }
    return rating;
  }

  const dailyPerMonthReadings = {{ Js::from($daily_per_month_readings) }};
  console.log(dailyPerMonthReadings);

  const userAge = {{ Js::from($user_age) }};
  const thisMonthReadings = {{ Js::from($this_month_readings) }};
  console.log(thisMonthReadings);

  const startDate = {{ Js::from($from) }};
  const endDate = {{ Js::from($to)}};
  const dailyReadingsFromRange = {{ Js::from($daily_readings_from_range) }};
  const readingsFromRange = {{ Js::from($readings_from_range) }};
  console.log(dailyReadingsFromRange);
  console.log(readingsFromRange);
  
  const perMonthReadings = {{ Js::from($daily_per_month_yearly_readings) }};
  console.log(perMonthReadings);
  /*
    -----------------------------------------
    *                                       *
    *       THIS MONTH RATINGS CHART        *
    *                                       *
    -----------------------------------------
  */

  var daysWithReadings = 0;
  dailyPerMonthReadings.forEach(function(item){
    if(item.length > 0){
      daysWithReadings++;
    }
  })

  var thisMonthPulseRateRatings = [0, 0, 0];
  dailyPerMonthReadings.forEach(function(item){
    if(item.length > 0){
      var temp = [0,0,0];
      item.forEach(function(object){
        var rating = determinePulseRate(userAge, object['pulse_rate']);
        if(rating == 'Below Normal'){
          temp[0]++;
        }
        else if(rating == 'Normal'){
          temp[1]++;
        }
        else if(rating == 'Above Normal'){
          temp[2]++;
        }
      });
      if(temp[2] > 0){
        thisMonthPulseRateRatings[2]++;
      }
      else if(temp[0] > 0){
        thisMonthPulseRateRatings[0]++;
      }
      else{
        thisMonthPulseRateRatings[1]++;
      }
    }
  });
  
  var thisMonthBloodPressureRatings = [0, 0, 0, 0, 0];
  dailyPerMonthReadings.forEach(function(item){
    if(item.length > 0){
      var temp = [0,0,0,0,0];
      item.forEach(function(object){
        var rating = determineBloodPressure(object['systolic'], object['diastolic']);
        if(rating == 'Normal'){
          temp[0]++;
        }
        else if(rating == 'Elevated High Blood Pressure'){
          temp[1]++;
        }
        else if(rating == 'Hypertension Stage I'){
          temp[2]++;
        }
        else if(rating == 'Hypertension Stage II'){
          temp[3]++;
        }
        else if(rating == 'Hypertensive Crisis'){
          temp[4]++;
        }
      });
      if(temp[4] > 0){
        thisMonthBloodPressureRatings[4]++;
      }
      else if(temp[3] > 0){
        thisMonthBloodPressureRatings[3]++;
      }
      else if(temp[2] > 0){
        thisMonthBloodPressureRatings[2]++;
      }
      else if(temp[1] > 0){
        thisMonthBloodPressureRatings[1]++;
      }
      else{
        thisMonthBloodPressureRatings[0]++;
      }
    }
  });

  var thisMonthBloodSaturationRatings = [0, 0, 0];
  dailyPerMonthReadings.forEach(function(item){
    if(item.length > 0){
      var temp = [0,0,0];
      item.forEach(function(object){
        var rating = determineBloodSaturation(object['blood_saturation']);
        if(rating == 'Below Normal'){
          temp[0]++;
        }
        else if(rating == 'Normal'){
          temp[1]++;
        }
        else if(rating == 'Above Normal'){
          temp[2]++;
        }
      });
      if(temp[2] > 0){
        thisMonthBloodSaturationRatings[2]++;
      }
      else if(temp[0] > 0){
        thisMonthBloodSaturationRatings[0]++;
      }
      else{
        thisMonthBloodSaturationRatings[1]++;
      }
    }
  });
  
  // Pulse Rate
  const thisMonthPulseRateRatingsData = {
    labels: ['Below Normal', 'Normal', 'Above Normal'],
    datasets: [{
      label: 'Pulse Rate',
      data: thisMonthPulseRateRatings,
      backgroundColor: ['#FFB600','#A6CE39','#990711'],
      hoverOffset: 4
    }]
  };
  const thisMonthPulseRateRatingsConfig = {
    type: 'pie',
    data: thisMonthPulseRateRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'This Month Pulse Rate Ratings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                percentage = (thisMonthPulseRateRatings[context.dataIndex]/daysWithReadings)*100;
                percentage = percentage.toFixed(2);
                label += ': ' + percentage + '%';
              }
              return label;
            },
            afterLabel: function(context) {
              return 'Total of ' + thisMonthPulseRateRatings[context.dataIndex] + ' days out of ' + daysWithReadings;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Pressure
  const thisMonthBloodPressureRatingsData = {
    labels: ['Normal', 'Elevated High Blood Pressure', 'Hypertension Stage I', 'Hypertension Stage II', 'Hypertensive Crisis'],
    datasets: [{
      label: 'Blood Pressure',
      backgroundColor: ['#A6CE39','#FFEC01','#FFB600', '#BB3A01', '#990711'],
      data: thisMonthBloodPressureRatings,
      hoverOffset: 4
    }]
  };
  const thisMonthBloodPressureRatingsConfig = {
    type: 'pie',
    data: thisMonthBloodPressureRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'This Month Blood Pressure Ratings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                percentage = (thisMonthBloodPressureRatings[context.dataIndex]/daysWithReadings)*100;
                percentage = percentage.toFixed(2);
                label += ': ' + percentage + '%';
              }
              return label;
            },
            afterLabel: function(context) {
              return 'Total of ' + thisMonthBloodPressureRatings[context.dataIndex] + ' days out of ' + daysWithReadings;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Saturation
  const thisMonthBloodSaturationRatingsData = {
    labels: ['Below Normal', 'Normal', 'Above Normal'],
    datasets: [{
      label: 'Blood Saturation',
      backgroundColor: ['#FFB600','#A6CE39','#990711'],
      data: thisMonthBloodSaturationRatings,
      hoverOffset: 4
    }]
  };
  const thisMonthBloodSaturationRatingsConfig = {
    type: 'pie',
    data: thisMonthBloodSaturationRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'This Month Blood Saturation Ratings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                percentage = (thisMonthBloodSaturationRatings[context.dataIndex]/daysWithReadings)*100;
                percentage = percentage.toFixed(2);
                label += ': ' + percentage + '%';
              }
              return label;
            },
            afterLabel: function(context) {
              return 'Total of ' + thisMonthBloodSaturationRatings[context.dataIndex] + ' days out of ' + daysWithReadings;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  var thisMonthRatingsChart = new Chart(
    document.getElementById('thisMonthRatingsChart'),
    thisMonthPulseRateRatingsConfig
  );
  function showthisMonthRatingsChart(id) {
    thisMonthRatingsChart.destroy();
    if (id == 'thisMonthPulseRateRatings') {
      thisMonthRatingsChart = new Chart(
        document.getElementById('thisMonthRatingsChart'),
        thisMonthPulseRateRatingsConfig
      );
    }
    else if (id == 'thisMonthBloodPressureRatings') {
      thisMonthRatingsChart = new Chart(
        document.getElementById('thisMonthRatingsChart'),
        thisMonthBloodPressureRatingsConfig
      );
    }
    else if (id == 'thisMonthBloodSaturationRatings') {
      thisMonthRatingsChart = new Chart(
        document.getElementById('thisMonthRatingsChart'),
        thisMonthBloodSaturationRatingsConfig
      );
    }
  }
  document.getElementById("showThisMonthPulseRateRatings").addEventListener("click", function() {
    showthisMonthRatingsChart("thisMonthPulseRateRatings");
  });
  document.getElementById("showThisMonthBloodPressureRatings").addEventListener("click", function() {
    showthisMonthRatingsChart("thisMonthBloodPressureRatings");
  });
  document.getElementById("showThisMonthBloodSaturationRatings").addEventListener("click", function() {
    showthisMonthRatingsChart("thisMonthBloodSaturationRatings");
  });

  /*
    -----------------------------------------
    *                                       *
    *       THIS MONTH READING CHART        *
    *                                       *
    -----------------------------------------
  */

  const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

  var thisMonthReadingsDates = [];
  thisMonthReadings.forEach(function(item){
    var date = new Date(item['created_at']);
    var temp = months[date.getMonth()] + ' ' + date.getDate();
    thisMonthReadingsDates.push(temp);
  });

  var thisMonthReadingsTimes = [];
  thisMonthReadings.forEach(function(item){
    var date = new Date(item['created_at']);
    var temp = date.getHours() + ':' + date.getMinutes();
    thisMonthReadingsTimes.push(temp);
  });

  var thisMonthPulseRates = [];
  thisMonthReadings.forEach(function(item){
    thisMonthPulseRates.push(item['pulse_rate']);
  });
  
  var thisMonthBloodPressures = [];
  thisMonthReadings.forEach(function(item){
    thisMonthBloodPressures.push(item['blood_pressure']);
  });

  var thisMonthSystolics = [];
  thisMonthReadings.forEach(function(item){
    thisMonthSystolics.push(item['systolic']);
  });

  var thisMonthDiastolics = [];
  thisMonthReadings.forEach(function(item){
    thisMonthDiastolics.push(item['diastolic']);
  });

  var thisMonthBloodSaturations = [];
  thisMonthReadings.forEach(function(item){
    thisMonthBloodSaturations.push(item['blood_saturation']);
  });
  
  // Pulse Rate
  const thisMonthPulseRatesData = {
    labels: thisMonthReadingsDates,
    datasets: [{
      label: 'Pulse Rate',
      data: thisMonthPulseRates,
      backgroundColor: ['#77AAD9'],
      borderColor: ['#77AAD9'],
      tension: 0.1
    }]
  };
  const thisMonthPulseRatesConfig = {
    type: 'line',
    data: thisMonthPulseRatesData,
    options: {
      responsive: true,
      scales: {
        x: {
          border: {
            display: true
          },
          grid: {
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
          }
        },
        y: {
          border: {
            display: false
          },
          grid: {
            color: function(context){
              if (context.tick.value < 60){
                return '#FFB600';
              }
              else if(context.tick.value < 101){
                return '#A6CE39';
              }
              else{
                return '#990711';
              }
            }
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'This Month Pulse Rate Readings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            beforeLabel: function(context){
              return 'Time Taken: ' + thisMonthReadingsTimes[context.dataIndex];
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                label += ': ' + thisMonthPulseRates[context.dataIndex] + 'bpm';
              }
              return label;
            },
            afterLabel: function(context){
              return 'Rating: ' + determinePulseRate(userAge, thisMonthPulseRates[context.dataIndex]);
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Pressure
  const thisMonthBloodPressuresData = {
    labels: thisMonthReadingsDates,
    datasets: [{
      label: 'Blood Pressure',
      data: thisMonthBloodPressures,
      backgroundColor: ['#E68387'],
      hoverOffset: 4,
      tension: 0.1
    }]
  };
  const thisMonthBloodPressuresConfig = {
    type: 'line',
    data: thisMonthBloodPressuresData,
    options: {
      responsive: true,
      scales: {
        x: {
          border: {
            display: true
          },
          grid: {
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
          }
        },
        y: {
          border: {
            display: false
          },
          grid: {
            color: function(context){
              if (context.tick.value < 85){
                return '#A6CE39';
              }
              else if(context.tick.value < 90){
                return '#FFEC01';
              }
              else if(context.tick.value < 95){
                return '#FFB600';
              }
              else if(context.tick.value < 105){
                return '#BB3A01';
              }
              else{
                return '#990711';
              }
            }
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'This Month Blood Pressure Readings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            beforeLabel: function(context){
              return 'Time Taken: ' + thisMonthReadingsTimes[context.dataIndex];
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                label += ': ' + thisMonthSystolics[context.dataIndex] + '/' + thisMonthDiastolics[context.dataIndex] + ' mmHg';
              }
              return label;
            },
            afterLabel: function(context){
              return 'Rating: ' + determineBloodPressure(thisMonthSystolics[context.dataIndex], thisMonthDiastolics[context.dataIndex]);
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Saturation
  const thisMonthBloodSaturationsData = {
    labels: thisMonthReadingsDates,
    datasets: [{
      label: 'Blood Saturation',
      data: thisMonthBloodSaturations,
      backgroundColor: ['#4D4D4D'],
      hoverOffset: 4,
      tension: 0.1
    }]
  };
  const thisMonthBloodSaturationsConfig = {
    type: 'line',
    data: thisMonthBloodSaturationsData,
    options: {
      responsive: true,
      scales: {
        x: {
          border: {
            display: true
          },
          grid: {
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
          }
        },
        y: {
          border: {
            display: false
          },
          grid: {
            color: function(context){
              if (context.tick.value < 95){
                return '#FFB600';
              }
              else if(context.tick.value < 100){
                return '#A6CE39';
              }
              else{
                return '#990711';
              }
            }
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'This Month Blood Saturation Readings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            beforeLabel: function(context){
              return 'Time Taken: ' + thisMonthReadingsTimes[context.dataIndex];
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                label += ': ' + thisMonthBloodSaturations[context.dataIndex] + ' %';
              }
              return label;
            },
            afterLabel: function(context){
              return 'Rating: ' + determineBloodSaturation(thisMonthBloodSaturations[context.dataIndex]);
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // All Variables
  const thisMonthReadingsData = {
    labels: thisMonthReadingsDates,
    datasets: [{
      label: 'Pulse Rate',
      data: thisMonthPulseRates,
      backgroundColor: ['#77AAD9'],
      borderColor: ['#77AAD9'],
      tension: 0.1
    },{
      label: 'Blood Pressure',
      data: thisMonthBloodPressures,
      backgroundColor: ['#E68387'],
      hoverOffset: 4,
      tension: 0.1
    },{
      label: 'Blood Saturation',
      data: thisMonthBloodSaturations,
      backgroundColor: ['#4D4D4D'],
      hoverOffset: 4,
      tension: 0.1
    }]
  };
  const thisMonthReadingsConfig = {
    type: 'line',
    data: thisMonthReadingsData,
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'This Month Readings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            beforeLabel: function(context){
              return 'Time Taken: ' + thisMonthReadingsTimes[context.dataIndex];
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                if(label == 'Pulse Rate'){
                  label += ': ' + thisMonthPulseRates[context.dataIndex] + ' bpm';
                }
                else if(label == 'Blood Pressure'){
                  label += ': ' + thisMonthSystolics[context.dataIndex] + '/' + thisMonthDiastolics[context.dataIndex] + ' mmHg'
                }
                else{
                  label += ': ' + thisMonthBloodSaturations[context.dataIndex] + ' %';
                }
              }
              return label;
            },
            afterLabel: function(context){
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                if(label == 'Pulse Rate'){
                  return 'Rating: ' + determinePulseRate(userAge, thisMonthPulseRates[context.dataIndex]);
                }
                else if(label == 'Blood Pressure'){
                  return 'Rating: ' + determineBloodPressure(thisMonthSystolics[context.dataIndex], thisMonthDiastolics[context.dataIndex]);
                }
                else{
                  return 'Rating: ' + determineBloodSaturation(thisMonthBloodSaturations[context.dataIndex]);
                }
              }
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  var thisMonthReadingsChart = new Chart(
    document.getElementById('thisMonthReadingsChart'),
    thisMonthPulseRatesConfig
  );
  function showthisMonthReadingsChart(id) {
    thisMonthReadingsChart.destroy();
    if (id == 'thisMonthPulseRates') {
      thisMonthReadingsChart = new Chart(
        document.getElementById('thisMonthReadingsChart'),
        thisMonthPulseRatesConfig
      );
    }
    else if (id == 'thisMonthBloodPressures') {
      thisMonthReadingsChart = new Chart(
        document.getElementById('thisMonthReadingsChart'),
        thisMonthBloodPressuresConfig
      );
    }
    else if (id == 'thisMonthBloodSaturations') {
      thisMonthReadingsChart = new Chart(
        document.getElementById('thisMonthReadingsChart'),
        thisMonthBloodSaturationsConfig
      );
    }
    else if (id == 'thisMonthReadings') {
      thisMonthReadingsChart = new Chart(
        document.getElementById('thisMonthReadingsChart'),
        thisMonthReadingsConfig
      );
    }
  }
  document.getElementById("showThisMonthPulseRates").addEventListener("click", function() {
    showthisMonthReadingsChart("thisMonthPulseRates");
  });
  document.getElementById("showThisMonthBloodPressures").addEventListener("click", function() {
    showthisMonthReadingsChart("thisMonthBloodPressures");
  });
  document.getElementById("showThisMonthBloodSaturations").addEventListener("click", function() {
    showthisMonthReadingsChart("thisMonthBloodSaturations");
  });
  document.getElementById("showThisMonthReadings").addEventListener("click", function() {
    showthisMonthReadingsChart("thisMonthReadings");
  });

  /*
    -----------------------------------------
    *                                       *
    *         ALL TIME RATINGS CHART        *
    *                                       *
    -----------------------------------------
  */

  var daysFromRangeWithReadings = 0;
  dailyReadingsFromRange.forEach(function(item){
    if(item.length > 0){
      daysFromRangeWithReadings++;
    }
  })

  var thisRangePulseRateRatings = [0, 0, 0];
  dailyReadingsFromRange.forEach(function(item){
    if(item.length > 0){
      var temp = [0,0,0];
      item.forEach(function(object){
        var rating = determinePulseRate(userAge, object['pulse_rate']);
        if(rating == 'Below Normal'){
          temp[0]++;
        }
        else if(rating == 'Normal'){
          temp[1]++;
        }
        else if(rating == 'Above Normal'){
          temp[2]++;
        }
      });
      if(temp[2] > 0){
        thisRangePulseRateRatings[2]++;
      }
      else if(temp[0] > 0){
        thisRangePulseRateRatings[0]++;
      }
      else{
        thisRangePulseRateRatings[1]++;
      }
    }
  });

  var thisRangeBloodPressureRatings = [0, 0, 0, 0, 0];
  dailyReadingsFromRange.forEach(function(item){
    if(item.length > 0){
      var temp = [0,0,0,0,0];
      item.forEach(function(object){
        var rating = determineBloodPressure(object['systolic'], object['diastolic']);
        if(rating == 'Normal'){
          temp[0]++;
        }
        else if(rating == 'Elevated High Blood Pressure'){
          temp[1]++;
        }
        else if(rating == 'Hypertension Stage I'){
          temp[2]++;
        }
        else if(rating == 'Hypertension Stage II'){
          temp[3]++;
        }
        else if(rating == 'Hypertensive Crisis'){
          temp[4]++;
        }
      });
      if(temp[4] > 0){
        thisRangeBloodPressureRatings[4]++;
      }
      else if(temp[3] > 0){
        thisRangeBloodPressureRatings[3]++;
      }
      else if(temp[2] > 0){
        thisRangeBloodPressureRatings[2]++;
      }
      else if(temp[1] > 0){
        thisRangeBloodPressureRatings[1]++;
      }
      else{
        thisRangeBloodPressureRatings[0]++;
      }
    }
  });

  var thisRangeBloodSaturationRatings = [0, 0, 0];
  dailyReadingsFromRange.forEach(function(item){
    if(item.length > 0){
      var temp = [0,0,0];
      item.forEach(function(object){
        var rating = determineBloodSaturation(object['blood_saturation']);
        if(rating == 'Below Normal'){
          temp[0]++;
        }
        else if(rating == 'Normal'){
          temp[1]++;
        }
        else if(rating == 'Above Normal'){
          temp[2]++;
        }
      });
      if(temp[2] > 0){
        thisRangeBloodSaturationRatings[2]++;
      }
      else if(temp[0] > 0){
        thisRangeBloodSaturationRatings[0]++;
      }
      else{
        thisRangeBloodSaturationRatings[1]++;
      }
    }
  });
  
  // Pulse Rate
  const thisRangePulseRateRatingsData = {
    labels: ['Below Normal', 'Normal', 'Above Normal'],
    datasets: [{
      label: 'Pulse Rate',
      data: thisRangePulseRateRatings,
      backgroundColor: ['#FFB600','#A6CE39','#990711'],
      hoverOffset: 4
    }]
  };
  const thisRangePulseRateRatingsConfig = {
    type: 'pie',
    data: thisRangePulseRateRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Pulse Rate Ratings from ' + startDate + ' to ' + endDate
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                percentage = (thisRangePulseRateRatings[context.dataIndex]/daysFromRangeWithReadings)*100;
                percentage = percentage.toFixed(2);
                label += ': ' + percentage + '%';
              }
              return label;
            },
            afterLabel: function(context) {
              return 'Total of ' + thisRangePulseRateRatings[context.dataIndex] + ' days out of ' + daysFromRangeWithReadings;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Pressure
  const thisRangeBloodPressureRatingsData = {
    labels: ['Normal', 'Elevated High Blood Pressure', 'Hypertension Stage I', 'Hypertension Stage II', 'Hypertensive Crisis'],
    datasets: [{
      label: 'Blood Pressure',
      backgroundColor: ['#A6CE39','#FFEC01','#FFB600', '#BB3A01', '#990711'],
      data: thisRangeBloodPressureRatings,
      hoverOffset: 4
    }]
  };
  const thisRangeBloodPressureRatingsConfig = {
    type: 'pie',
    data: thisRangeBloodPressureRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Blood Pressure Ratings from ' + startDate + ' to ' + endDate
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                percentage = (thisRangeBloodPressureRatings[context.dataIndex]/daysFromRangeWithReadings)*100;
                percentage = percentage.toFixed(2);
                label += ': ' + percentage + '%';
              }
              return label;
            },
            afterLabel: function(context) {
              return 'Total of ' + thisRangeBloodPressureRatings[context.dataIndex] + ' days out of ' + daysFromRangeWithReadings;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Saturation
  const thisRangeBloodSaturationRatingsData = {
    labels: ['Below Normal', 'Normal', 'Above Normal'],
    datasets: [{
      label: 'Blood Saturation',
      backgroundColor: ['#FFB600','#A6CE39','#990711'],
      data: thisRangeBloodSaturationRatings,
      hoverOffset: 4
    }]
  };
  const thisRangeBloodSaturationRatingsConfig = {
    type: 'pie',
    data: thisRangeBloodSaturationRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Blood Saturation Ratings from ' + startDate + ' to ' + endDate
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                percentage = (thisRangeBloodSaturationRatings[context.dataIndex]/daysFromRangeWithReadings)*100;
                percentage = percentage.toFixed(2);
                label += ': ' + percentage + '%';
              }
              return label;
            },
            afterLabel: function(context) {
              return 'Total of ' + thisRangeBloodSaturationRatings[context.dataIndex] + ' days out of ' + daysFromRangeWithReadings;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };
  var thisRangeRatingsChart = new Chart(
    document.getElementById('thisRangeRatingsChart'),
    thisRangePulseRateRatingsConfig
  );
  function showThisRangeRatingsChart(id) {
    thisRangeRatingsChart.destroy();
    if (id == 'thisRangePulseRateRatings') {
      thisRangeRatingsChart = new Chart(
        document.getElementById('thisRangeRatingsChart'),
        thisRangePulseRateRatingsConfig
      );
    }
    else if (id == 'thisRangeBloodPressureRatings') {
      thisRangeRatingsChart = new Chart(
        document.getElementById('thisRangeRatingsChart'),
        thisRangeBloodPressureRatingsConfig
      );
    }
    else if (id == 'thisRangeBloodSaturationRatings') {
      thisRangeRatingsChart = new Chart(
        document.getElementById('thisRangeRatingsChart'),
        thisRangeBloodSaturationRatingsConfig
      );
    }
  }
  document.getElementById("showThisRangePulseRateRatings").addEventListener("click", function() {
    showThisRangeRatingsChart("thisRangePulseRateRatings");
  });
  document.getElementById("showThisRangeBloodPressureRatings").addEventListener("click", function() {
    showThisRangeRatingsChart("thisRangeBloodPressureRatings");
  });
  document.getElementById("showThisRangeBloodSaturationRatings").addEventListener("click", function() {
    showThisRangeRatingsChart("thisRangeBloodSaturationRatings");
  });

  /*
    -----------------------------------------
    *                                       *
    *        ALL TIME READINGS CHART        *
    *                                       *
    -----------------------------------------
  */

  var thisRangeReadingsDates = [];
  readingsFromRange.forEach(function(item){
    var date = new Date(item['created_at']);
    var temp = months[date.getMonth()] + ' ' + date.getDate();
    thisRangeReadingsDates.push(temp);
  });

  var thisRangeReadingsTimes = [];
  readingsFromRange.forEach(function(item){
    var date = new Date(item['created_at']);
    var temp = date.getHours() + ':' + date.getMinutes();
    thisRangeReadingsTimes.push(temp);
  });

  var thisRangePulseRates = [];
  readingsFromRange.forEach(function(item){
    thisRangePulseRates.push(item['pulse_rate']);
  });
  
  var thisRangeBloodPressures = [];
  readingsFromRange.forEach(function(item){
    thisRangeBloodPressures.push(item['blood_pressure']);
  });

  var thisRangeSystolics = [];
  readingsFromRange.forEach(function(item){
    thisRangeSystolics.push(item['systolic']);
  });

  var thisRangeDiastolics = [];
  readingsFromRange.forEach(function(item){
    thisRangeDiastolics.push(item['diastolic']);
  });

  var thisRangeBloodSaturations = [];
  readingsFromRange.forEach(function(item){
    thisRangeBloodSaturations.push(item['blood_saturation']);
  });
  
  // Pulse Rate
  const thisRangePulseRatesData = {
    labels: thisRangeReadingsDates,
    datasets: [{
      label: 'Pulse Rate',
      data: thisRangePulseRates,
      backgroundColor: ['#77AAD9'],
      borderColor: ['#77AAD9'],
      tension: 0.1
    }]
  };
  const thisRangePulseRatesConfig = {
    type: 'line',
    data: thisRangePulseRatesData,
    options: {
      responsive: true,
      scales: {
        x: {
          border: {
            display: true
          },
          grid: {
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
          }
        },
        y: {
          border: {
            display: false
          },
          grid: {
            color: function(context){
              if (context.tick.value < 60){
                return '#FFB600';
              }
              else if(context.tick.value < 101){
                return '#A6CE39';
              }
              else{
                return '#990711';
              }
            }
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Pulse Rate Readings from ' + startDate + ' to ' + endDate
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            beforeLabel: function(context){
              return 'Time Taken: ' + thisRangeReadingsTimes[context.dataIndex];
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                label += ': ' + thisRangePulseRates[context.dataIndex] + 'bpm';
              }
              return label;
            },
            afterLabel: function(context){
              return 'Rating: ' + determinePulseRate(userAge, thisRangePulseRates[context.dataIndex]);
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Pressure
  const thisRangeBloodPressuresData = {
    labels: thisRangeReadingsDates,
    datasets: [{
      label: 'Blood Pressure',
      data: thisRangeBloodPressures,
      backgroundColor: ['#E68387'],
      hoverOffset: 4,
      tension: 0.1
    }]
  };
  const thisRangeBloodPressuresConfig = {
    type: 'line',
    data: thisRangeBloodPressuresData,
    options: {
      responsive: true,
      scales: {
        x: {
          border: {
            display: true
          },
          grid: {
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
          }
        },
        y: {
          border: {
            display: false
          },
          grid: {
            color: function(context){
              if (context.tick.value < 85){
                return '#A6CE39';
              }
              else if(context.tick.value < 90){
                return '#FFEC01';
              }
              else if(context.tick.value < 95){
                return '#FFB600';
              }
              else if(context.tick.value < 105){
                return '#BB3A01';
              }
              else{
                return '#990711';
              }
            }
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Blood Pressure Readings from ' + startDate + ' to ' + endDate
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            beforeLabel: function(context){
              return 'Time Taken: ' + thisRangeReadingsTimes[context.dataIndex];
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                label += ': ' + thisRangeSystolics[context.dataIndex] + '/' + thisRangeDiastolics[context.dataIndex] + ' mmHg';
              }
              return label;
            },
            afterLabel: function(context){
              return 'Rating: ' + determineBloodPressure(thisRangeSystolics[context.dataIndex], thisRangeDiastolics[context.dataIndex]);
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Saturation
  const thisRangeBloodSaturationsData = {
    labels: thisRangeReadingsDates,
    datasets: [{
      label: 'Blood Saturation',
      data: thisRangeBloodSaturations,
      backgroundColor: ['#4D4D4D'],
      hoverOffset: 4,
      tension: 0.1
    }]
  };
  const thisRangeBloodSaturationsConfig = {
    type: 'line',
    data: thisRangeBloodSaturationsData,
    options: {
      responsive: true,
      scales: {
        x: {
          border: {
            display: true
          },
          grid: {
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
          }
        },
        y: {
          border: {
            display: false
          },
          grid: {
            color: function(context){
              if (context.tick.value < 95){
                return '#FFB600';
              }
              else if(context.tick.value < 100){
                return '#A6CE39';
              }
              else{
                return '#990711';
              }
            }
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Blood Saturation Readings from ' + startDate + ' to ' + endDate
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            beforeLabel: function(context){
              return 'Time Taken: ' + thisRangeReadingsTimes[context.dataIndex];
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                label += ': ' + thisRangeBloodSaturations[context.dataIndex] + ' %';
              }
              return label;
            },
            afterLabel: function(context){
              return 'Rating: ' + determineBloodSaturation(thisRangeBloodSaturations[context.dataIndex]);
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // All Variables
  const thisRangeReadingsData = {
    labels: thisRangeReadingsDates,
    datasets: [{
      label: 'Pulse Rate',
      data: thisRangePulseRates,
      backgroundColor: ['#77AAD9'],
      borderColor: ['#77AAD9'],
      tension: 0.1
    },{
      label: 'Blood Pressure',
      data: thisRangeBloodPressures,
      backgroundColor: ['#E68387'],
      hoverOffset: 4,
      tension: 0.1
    },{
      label: 'Blood Saturation',
      data: thisRangeBloodSaturations,
      backgroundColor: ['#4D4D4D'],
      hoverOffset: 4,
      tension: 0.1
    }]
  };
  const thisRangeReadingsConfig = {
    type: 'line',
    data: thisRangeReadingsData,
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'This Month Readings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            beforeLabel: function(context){
              return 'Time Taken: ' + thisRangeReadingsTimes[context.dataIndex];
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                if(label == 'Pulse Rate'){
                  label += ': ' + thisRangePulseRates[context.dataIndex] + ' bpm';
                }
                else if(label == 'Blood Pressure'){
                  label += ': ' + thisRangeSystolics[context.dataIndex] + '/' + thisRangeDiastolics[context.dataIndex] + ' mmHg'
                }
                else{
                  label += ': ' + thisRangeBloodSaturations[context.dataIndex] + ' %';
                }
              }
              return label;
            },
            afterLabel: function(context){
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                if(label == 'Pulse Rate'){
                  return 'Rating: ' + determinePulseRate(userAge, thisRangePulseRates[context.dataIndex]);
                }
                else if(label == 'Blood Pressure'){
                  return 'Rating: ' + determineBloodPressure(thisRangeSystolics[context.dataIndex], thisRangeDiastolics[context.dataIndex]);
                }
                else{
                  return 'Rating: ' + determineBloodSaturation(thisRangeBloodSaturations[context.dataIndex]);
                }
              }
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  var thisRangeReadingsChart = new Chart(
    document.getElementById('thisRangeReadingsChart'),
    thisRangePulseRatesConfig
  );
  function showThisRangeReadingsChart(id) {
    thisRangeReadingsChart.destroy();
    if (id == 'thisRangePulseRates') {
      thisRangeReadingsChart = new Chart(
        document.getElementById('thisRangeReadingsChart'),
        thisRangePulseRatesConfig
      );
    }
    else if (id == 'thisRangeBloodPressures') {
      thisRangeReadingsChart = new Chart(
        document.getElementById('thisRangeReadingsChart'),
        thisRangeBloodPressuresConfig
      );
    }
    else if (id == 'thisRangeBloodSaturations') {
      thisRangeReadingsChart = new Chart(
        document.getElementById('thisRangeReadingsChart'),
        thisRangeBloodSaturationsConfig
      );
    }
    else if (id == 'thisRangeReadings') {
      thisRangeReadingsChart = new Chart(
        document.getElementById('thisRangeReadingsChart'),
        thisRangeReadingsConfig
      );
    }
  }
  document.getElementById("showThisRangePulseRates").addEventListener("click", function() {
    showThisRangeReadingsChart("thisRangePulseRates");
  });
  document.getElementById("showThisRangeBloodPressures").addEventListener("click", function() {
    showThisRangeReadingsChart("thisRangeBloodPressures");
  });
  document.getElementById("showThisRangeBloodSaturations").addEventListener("click", function() {
    showThisRangeReadingsChart("thisRangeBloodSaturations");
  });
  document.getElementById("showThisRangeReadings").addEventListener("click", function() {
    showThisRangeReadingsChart("thisRangeReadings");
  });

  /*
    -----------------------------------------
    *                                       *
    *         BY MONTH RATINGS CHART        *
    *                                       *
    -----------------------------------------
  */

  var belowNormalPulseRates = [0,0,0,0,0,0,0,0,0,0,0,0];
  var normalPulseRates = [0,0,0,0,0,0,0,0,0,0,0,0];
  var aboveNormalPulseRates = [0,0,0,0,0,0,0,0,0,0,0,0];
  perMonthReadings.forEach(function(month, month_index){
    month.forEach(function(day, day_index){
      if(day.length > 0){
        var temp = [0,0,0];
        day.forEach(function(reading, reading_index){
          var rating = determinePulseRate(userAge, reading['pulse_rate']);
          if(rating == 'Below Normal'){
            temp[0]++;
          }
          else if(rating == 'Normal'){
            temp[1]++;
          }
          else if(rating == 'Above Normal'){
            temp[2]++;
          }
        });
        if(temp[2] > 0){
          aboveNormalPulseRates[month_index]++;
        }
        else if(temp[0] > 0){
          belowNormalPulseRates[month_index]++;
        }
        else{
          normalPulseRates[month_index]++;
        }
      }
    });
  });

  var normalBloodPressures = [0,0,0,0,0,0,0,0,0,0,0,0];
  var elevatedBloodPressures = [0,0,0,0,0,0,0,0,0,0,0,0];
  var hypertensionIBloodPressures = [0,0,0,0,0,0,0,0,0,0,0,0];
  var hypertensionIIBloodPressures = [0,0,0,0,0,0,0,0,0,0,0,0];
  var hypertensiveBloodPressures = [0,0,0,0,0,0,0,0,0,0,0,0];
  perMonthReadings.forEach(function(month, month_index){
    month.forEach(function(day, day_index){
      if(day.length > 0){
        var temp = [0,0,0,0,0];
        day.forEach(function(reading, reading_index){
          var rating = determineBloodPressure(reading['systolic'], reading['diastolic']);
          if(rating == 'Normal'){
            temp[0]++;
          }
          else if(rating == 'Elevated High Blood Pressure'){
            temp[1]++;
          }
          else if(rating == 'Hypertension Stage I'){
            temp[2]++;
          }
          else if(rating == 'Hypertension Stage II'){
            temp[3]++;
          }
          else if(rating == 'Hypertensive Crisis'){
            temp[4]++;
          }
        });
        if(temp[4] > 0){
          hypertensiveBloodPressures[month_index]++;
        }
        else if(temp[3] > 0){
          hypertensionIIBloodPressures[month_index]++;
        }
        else if(temp[2] > 0){
          hypertensionIBloodPressures[month_index]++;
        }
        else if(temp[1] > 0){
          elevatedBloodPressures[month_index]++;
        }
        else{
          normalBloodPressures[month_index]++;
        }
      }
    });
  });

  var belowNormalBloodSaturations = [0,0,0,0,0,0,0,0,0,0,0,0];
  var normalBloodSaturations = [0,0,0,0,0,0,0,0,0,0,0,0];
  var aboveNormalBloodSaturations = [0,0,0,0,0,0,0,0,0,0,0,0];
  perMonthReadings.forEach(function(month, month_index){
    month.forEach(function(day, day_index){
      if(day.length > 0){
        var temp = [0,0,0];
        day.forEach(function(reading, reading_index){
          var rating = determineBloodSaturation(reading['blood_saturation']);
          if(rating == 'Below Normal'){
            temp[0]++;
          }
          else if(rating == 'Normal'){
            temp[1]++;
          }
          else if(rating == 'Above Normal'){
            temp[2]++;
          }
        });
        if(temp[2] > 0){
          aboveNormalBloodSaturations[month_index]++;
        }
        else if(temp[0] > 0){
          belowNormalBloodSaturations[month_index]++;
        }
        else{
          normalBloodSaturations[month_index]++;
        }
      }
    });
  });

  // Pulse Rate
  const perMonthPulseRateRatingsData = {
    labels: months,
    datasets: [{
      label: 'Below Normal',
      data: belowNormalPulseRates,
      backgroundColor: ['#FFB600'],
      borderColor: ['#FFB600']
    },{
      label: 'Normal',
      data: normalPulseRates,
      backgroundColor: ['#A6CE39'],
      borderColor: ['#A6CE39']
    },{
      label: 'Above Normal',
      data: aboveNormalPulseRates,
      backgroundColor: ['#990711'],
      borderColor: ['#990711']
    }]
  };
  const perMonthPulseRateRatingsConfig = {
    type: 'bar',
    data: perMonthPulseRateRatingsData,
    options: {
      responsive: true,
      scales: {
        x: {
          stacked: true,
        },
        y: {
          stacked: true
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Per Month Pulse Rate Ratings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                if(label == 'Below Normal'){
                  label += ': ' + belowNormalPulseRates[context.dataIndex] + ' times';
                }
                else if(label == 'Normal'){
                  label += ': ' + normalPulseRates[context.dataIndex] + ' times'
                }
                else{
                  label += ': ' + aboveNormalPulseRates[context.dataIndex] + ' times';
                }
              }
              return label;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Pressure
  const perMonthBloodPressureRatingsData = {
    labels: months,
    datasets: [{
      label: 'Normal',
      data: normalBloodPressures,
      backgroundColor: ['#A6CE39'],
      borderColor: ['#A6CE39']
    },{
      label: 'Elevated High Blood Pressure',
      data: elevatedBloodPressures,
      backgroundColor: ['#FFEC01'],
      borderColor: ['#FFEC01']
    },{
      label: 'Hypertension Stage I',
      data: hypertensionIBloodPressures,
      backgroundColor: ['#FFB600'],
      borderColor: ['#FFB600']
    },{
      label: 'Hypertension Stage II',
      data: hypertensionIIBloodPressures,
      backgroundColor: ['#BB3A01'],
      borderColor: ['#BB3A01']
    },{
      label: 'Hypertensive Crisis',
      data: hypertensiveBloodPressures,
      backgroundColor: ['#990711'],
      borderColor: ['#990711'] 
    }]
  };
  const perMonthBloodPressureRatingsConfig = {
    type: 'bar',
    data: perMonthBloodPressureRatingsData,
    options: {
      responsive: true,
      scales: {
        x: {
          stacked: true,
        },
        y: {
          stacked: true
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Per Month Blood Pressure Ratings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                if(label == 'Normal'){
                  label += ': ' + normalBloodPressures[context.dataIndex] + ' times';
                }
                else if(label == 'Elevated High Blood Pressure'){
                  label += ': ' + elevatedBloodPressures[context.dataIndex] + ' times';
                }
                else if(label == 'Hypertension Stage I'){
                  label += ': ' + hypertensionIBloodPressures[context.dataIndex] + ' times';
                }
                else if(label == 'Hypertension Stage II'){
                  label += ': ' + hypertensionIIBloodPressures[context.dataIndex] + ' times';
                }
                else{
                  label += ': ' + hypertensiveBloodPressures[context.dataIndex] + ' times';
                }
              }
              return label;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Saturation
  const perMonthBloodSaturationRatingsData = {
    labels: months,
    datasets: [{
      label: 'Below Normal',
      data: belowNormalBloodSaturations,
      backgroundColor: ['#FFB600'],
      borderColor: ['#FFB600']
    },{
      label: 'Normal',
      data: normalBloodSaturations,
      backgroundColor: ['#A6CE39'],
      borderColor: ['#A6CE39']
    },{
      label: 'Above Normal',
      data: aboveNormalBloodSaturations,
      backgroundColor: ['#990711'],
      borderColor: ['#990711']
    }]
  };
  const perMonthBloodSaturationRatingsConfig = {
    type: 'bar',
    data: perMonthBloodSaturationRatingsData,
    options: {
      responsive: true,
      scales: {
        x: {
          stacked: true,
        },
        y: {
          stacked: true
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Per Month Blood Saturation Ratings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';
              if (context.parsed.y !== null) {
                if(label == 'Below Normal'){
                  label += ': ' + belowNormalBloodSaturations[context.dataIndex] + ' times';
                }
                else if(label == 'Normal'){
                  label += ': ' + normalBloodSaturations[context.dataIndex] + ' times'
                }
                else{
                  label += ': ' + aboveNormalBloodSaturations[context.dataIndex] + ' times';
                }
              }
              return label;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  var perMonthRatingsChart = new Chart(
    document.getElementById('perMonthRatingsChart'),
    perMonthPulseRateRatingsConfig
  );
  function showPerMonthRatingsChart(id) {
    perMonthRatingsChart.destroy();
    if (id == 'perMonthPulseRateRatings') {
      perMonthRatingsChart = new Chart(
        document.getElementById('perMonthRatingsChart'),
        perMonthPulseRateRatingsConfig
      );
    }
    else if (id == 'perMonthBloodPressureRatings') {
      perMonthRatingsChart = new Chart(
        document.getElementById('perMonthRatingsChart'),
        perMonthBloodPressureRatingsConfig
      );
    }
    else if (id == 'perMonthBloodSaturationRatings') {
      perMonthRatingsChart = new Chart(
        document.getElementById('perMonthRatingsChart'),
        perMonthBloodSaturationRatingsConfig
      );
    }
  }
  document.getElementById("showPerMonthPulseRateRatings").addEventListener("click", function() {
    showPerMonthRatingsChart("perMonthPulseRateRatings");
  });
  document.getElementById("showPerMonthBloodPressureRatings").addEventListener("click", function() {
    showPerMonthRatingsChart("perMonthBloodPressureRatings");
  });
  document.getElementById("showPerMonthBloodSaturationRatings").addEventListener("click", function() {
    showPerMonthRatingsChart("perMonthBloodSaturationRatings");
  });
</script>
@endsection