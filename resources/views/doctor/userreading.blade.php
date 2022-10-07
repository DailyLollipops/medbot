@extends('layout',[$style = 'doctor/userreading', $title = 'User Reading'])

@section('content')
<section class="u-align-center u-clearfix u-section-1" id="sec-508f">
  <div class="u-align-left u-clearfix u-sheet u-sheet-1">
    <h3 class="u-text u-text-default u-text-1">User Profile
      <span style="font-weight: 700;"></span>
    </h3>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-3 u-border-palette-1-light-3 u-container-style u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-palette-5-light-3 u-radius-9 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <img class="u-image u-image-circle u-preserve-proportions u-image-1" src="{{ $user_profile ? asset('storage/'.$user_profile) : asset('images/blank_profile.png') }}" alt="" data-image-width="640" data-image-height="640">
        <h2 class="u-text u-text-default u-text-2">
          {{$user_name}}
          <span style="font-weight: 700;"></span>
        </h2>
        <h4 class="u-text u-text-default u-text-3">
          <span class="u-file-icon u-icon">
            <img src="{{ asset('images/joined.png') }}" alt="">
          </span>
          &nbsp; {{$user_joined}}
        </h4>
        <h4 class="u-text u-text-default u-text-4">
          <span class="u-file-icon u-icon">
            <img src="{{ asset('images/age.png') }}" alt="">
          </span>
          &nbsp;{{$user_age}} years old
        </h4>
        <a href="{{'/medbot/public/userlist/id-'.$user_id.'/report'}}" class="u-btn u-button-style u-none u-text-hover-palette-1-base u-text-palette-1-base u-btn-1">
          <span class="u-file-icon u-icon u-icon-3">
            <img src="{{ asset('images/chart.png') }}" alt="">
          </span>
          &nbsp;Reports
        </a>
        <a href="#" class="u-btn u-button-style u-none u-text-hover-palette-1-base u-text-palette-2-base u-btn-2">
          <span class="u-file-icon u-icon u-icon-4">
            <img src="{{ asset('images/monitor.png') }}" alt="">
          </span>
          &nbsp;Readings
        </a>
      </div>
    </div>
  </div>
</section>
<section class="u-align-center u-clearfix u-section-2" id="carousel_38ca">
  <div class="u-clearfix u-sheet u-sheet-1">
    <p class="u-custom-font u-heading-font u-text u-text-default u-text-1">
      <span class="u-file-icon u-icon">
        <img src="{{ asset('images/monitor.png') }}" alt="">
      </span>
      &nbsp;Readings List
    </p>
    <div class="u-form u-form-1">
      <form action="#" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" name="form" style="padding: 10px;">
        <div class="u-form-group u-form-select u-label-none u-form-group-1">
          <label for="select-9d42" class="u-custom-font u-heading-font u-label u-label-1">Dropdown</label>
          <div class="u-form-select-wrapper">
            <select id="select-9d42" name="order" onchange="this.form.submit()" class="u-border-3 u-border-palette-5-light-1 u-custom-font u-input u-input-rectangle u-radius-31 u-text-black u-text-font u-white u-input-1">
              <option value="null">Order by...</option>
              <option value="created_at-desc">Latest</option>
              <option value="created_at-asc">Oldest</option>
              <option value="pulse_rate-desc">Highest Pulse Rate</option>
              <option value="pulse_rate-asc">Lowest Pulse Rate</option>
              <option value="blood_pressure-desc">Highest Blood Pressure</option>
              <option value="blood_pressure-asc">Lowest Blood Pressure</option>
              <option value="blood_saturation-desc">Highest Blood Saturation</option>
              <option value="blood_saturation-asc">Lowest Blood Saturation</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret">
              <path fill="currentColor" d="M4 8L0 4h8z"></path>
            </svg>
          </div>
        </div>
      </form>
    </div>
    <h5 class="u-text u-text-default u-text-2">Ordered By:  {{$filter}} ({{$order}})&nbsp;</h5>
    <div class="u-container-style u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-1">
      <div class="u-container-layout u-valign-middle u-container-layout-1">
        <div class="u-table u-table-responsive u-table-1" style="overflow: scroll; height: 350px">
          <table class="u-table-entity u-table-entity-1" style="height: 350px;">
            <colgroup>
              <col width="26.25%">
              <col width="19%">
              <col width="27.1%">
              <col width="27.65%">
            </colgroup>
            <thead class="u-align-center u-custom-font u-font-courier-new u-palette-1-light-2 u-table-header u-table-header-1">
              <tr style="height: 50px;">
                <th class="u-border-2 u-border-grey-75 u-border-no-left u-border-no-right u-table-cell">Date</th>
                <th class="u-border-2 u-border-grey-75 u-border-no-left u-border-no-right u-table-cell">Pulse Rate</th>
                <th class="u-border-2 u-border-grey-75 u-border-no-left u-border-no-right u-table-cell">Blood Pressure</th>
                <th class="u-border-2 u-border-grey-75 u-border-no-left u-border-no-right u-table-cell">Blood Saturation</th>
              </tr>
            </thead>
            <tbody class="u-table-alt-palette-1-light-3 u-table-body">

              @foreach($readings as $reading)
                <tr style="height: 65px;">
                  <td class="u-align-left u-border-2 u-border-grey-30 u-border-no-left u-border-no-right u-first-column u-table-cell">{{date('M d, Y - H:i:s', strtotime($reading->created_at))}}</td>
                  <td class="u-border-2 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">{{$reading->pulse_rate}} bpm</td>
                  <td class="u-border-2 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">{{$reading->systolic}}/{{$reading->diastolic}} mmHg</td>
                  <td class="u-border-2 u-border-grey-30 u-border-no-left u-border-no-right u-table-cell">{{$reading->blood_saturation}} %</td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection