@extends('layout',[$style = 'readinglist', $title = 'Reading List'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-c6d7">
  <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-form u-form-1">
      <form action="/medbot/public/list/order" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" name="form" style="padding: 10px;">
       @csrf 
        <div class="u-form-group u-form-select u-label-none u-form-group-1">
          <div class="u-form-select-wrapper">
            <select id="select-9d42" onchange="this.form.submit()" name="filter" class="u-border-3 u-border-palette-5-light-1 u-custom-font u-input u-input-rectangle u-radius-31 u-text-black u-text-font u-white u-input-1">
              <option value="#">Order by...</option>
              <option value="date-asc">Date (Ascending)</option>
              <option value="date-desc">Date (Descending)</option>
              <option value="pulse_rate-asc">Pulse Rate (Ascending)</option>
              <option value="pulse_rate-desc">Pulse Rate (Descending)</option>
              <option value="blood_pressure-asc">Blood Pressure (Ascending)</option>
              <option value="blood_pressure-desc">Blood Pressure (Descending)</option>
              <option value="blood_saturation-asc">Blood Saturation (Ascending)</option>
              <option value="blood_saturation-asc">Blood Saturation (Descending)</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
          </div>
        </div>
        <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
        <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
        <input type="hidden" value="" name="recaptchaResponse">
        <input type="hidden" name="formServices" value="62357873878bb1c7e0f64a441921ee6e">
      </form>
    </div>
    <h4 class="u-text u-text-default u-text-1">Ordered by: {{$filter}} ({{$order}})</h4>
    <div class="u-expanded-width u-list u-list-1">
      <div class="u-repeater u-repeater-1">

        @foreach($readings as $reading)
          <div class="u-align-center u-container-style u-gradient u-list-item u-radius-31 u-repeater-item u-shape-round u-list-item-1">
            <div class="u-container-layout u-similar-container u-container-layout-1">
              <p class="u-custom-font u-heading-font u-text u-text-2"><span class="u-file-icon u-icon"><img src="{{ asset('images/calendar.png') }}" alt=""></span>
                <span style="font-weight: 700;">&nbsp;{{$reading->date}}<span style="font-size: 1.125rem;"></span>
                </span>
              </p>
              <p class="u-custom-font u-heading-font u-text u-text-3"><span class="u-file-icon u-icon"><img src="{{ asset('images/clock.png') }}" alt=""></span>
                <span style="font-weight: 700;">&nbsp;Time Here<span style="font-size: 1.125rem;"></span>
                </span>
              </p>
              <p class="u-heading-font u-text u-text-4">Normal</p>
              <p class="u-text u-text-default u-text-5"><span class="u-file-icon u-icon"><img src="{{ asset('images/pulse_rate.png') }}" alt=""></span>&nbsp;{{$reading->pulse_rate}} bpm
              </p>
              <p class="u-heading-font u-text u-text-6">Below Normal</p>
              <p class="u-text u-text-default u-text-7"><span class="u-file-icon u-icon"><img src="{{ asset('images/blood_pressure.png') }}" alt=""></span>&nbsp;{{$reading->systolic}}/{{$reading->diastolic}} mmHg
              </p>
              <p class="u-heading-font u-text u-text-8">Above Normal</p>
              <p class="u-text u-text-default u-text-9"><span class="u-file-icon u-icon"><img src="{{ asset('images/blood_saturation.png') }}" alt=""></span>&nbsp;{{$reading->blood_saturation}}%
              </p>
            </div>
          </div>
        @endforeach
        
      </div>
    </div>
  </div>
</section>
@endsection
