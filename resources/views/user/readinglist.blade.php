@extends('layout',[$style = 'user/readinglist', $title = 'Reading List'])

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/pagination.css') }}">

<section class="u-clearfix u-section-1" id="sec-c6d7">
  <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-expanded-width-xs u-form u-form-1">
      <form action="#" method="GET" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" name="form" style="padding: 10px;">
        <div class="u-form-group u-form-select u-label-none u-form-group-1">
          <div class="u-form-select-wrapper">
            <select id="select-9d42" onchange="this.form.submit()" name="filter" class="u-border-3 u-border-palette-5-light-1 u-custom-font u-input u-input-rectangle u-radius-31 u-text-black u-text-font u-white u-input-1">
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
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
          </div>
        </div>
      </form>
    </div>
    <h5 class="u-text u-text-default u-text-1">Ordered by: {{$filter}} ({{$order}})</h5>
    <div class="u-expanded-width u-list u-list-1">
      <div class="u-repeater u-repeater-1">

        @foreach($readings as $reading)
          <div class="u-align-center u-container-style u-gradient u-list-item u-radius-31 u-repeater-item u-shape-round u-list-item-1">
            <div class="u-container-layout u-similar-container u-container-layout-1">
              <p class="u-custom-font u-heading-font u-text u-text-2">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/calendar.png') }}" alt="">
                </span>
                <span style="font-weight: 700;">&nbsp;{{date('M d, Y', strtotime($reading->created_at))}}
                  <span style="font-size: 1.125rem;"></span>
                </span>
              </p>
              <p class="u-custom-font u-heading-font u-text u-text-3">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/clock.png') }}" alt=""></span>
                <span style="font-weight: 700;">&nbsp;{{date('H:i:s', strtotime($reading->created_at))}}
                  <span style="font-size: 1.125rem;">
                  </span>
                </span>
              </p>
              <p class="u-heading-font u-text u-text-4">Normal</p>
              <p class="u-text u-text-default u-text-5">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/pulse_rate.png') }}" alt="">
                </span>&nbsp;{{$reading->pulse_rate}} bpm
              </p>
              <p class="u-heading-font u-text u-text-4">Below Normal</p>
              <p class="u-text u-text-default u-text-5">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/blood_pressure.png') }}" alt="">
                </span>&nbsp;{{$reading->systolic}}/{{$reading->diastolic}} mmHg
              </p>
              <p class="u-heading-font u-text u-text-4">Above Normal</p>
              <p class="u-text u-text-default u-text-5">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/blood_saturation.png') }}" alt="">
                </span>&nbsp;{{$reading->blood_saturation}}%
              </p>
            </div>
          </div>
        @endforeach

      </div>
    </div>
    {{$readings->links('pagination::custom')}}
  </div>
</section>
@endsection
