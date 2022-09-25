@extends('layout',[$style = 'user/manage', $title = 'Manage Profile'])

@section('content')
<section class="u-align-center u-clearfix u-section-1" id="carousel_a5a1">
  <div class="u-align-left u-clearfix u-sheet u-sheet-1">
    <h3 class="u-text u-text-default u-text-1">User Profile
      <span style="font-weight: 700;"></span>
    </h3>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-3 u-border-palette-1-light-3 u-container-style u-expanded-width-xs u-group u-palette-5-light-3 u-radius-9 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <img class="u-image u-image-circle u-preserve-proportions u-image-1" src="{{ asset('images/blank_profile.png') }}" alt="" data-image-width="640" data-image-height="640">
        <h2 class="u-text u-text-default u-text-2">{{$user_name}}
          <span style="font-weight: 700;"></span>
        </h2>
        <h5 class="u-text u-text-default u-text-3">{{$user_age}} years old</h5>
        <a href="/medbot/public/manage/update" class="u-border-1 u-border-grey-10 u-border-hover-grey-5 u-btn u-btn-round u-button-style u-grey-10 u-hover-grey-10 u-radius-21 u-text-black u-text-hover-grey-50 u-btn-1">
          <span class="u-file-icon u-icon u-icon-1">
              <img src="{{ asset('images/pencil.png') }}" alt="">
          </span>
          &nbsp;Update INFO
        </a>
      </div>
    </div>
  </div>
</section>
<section class="u-align-center u-clearfix u-section-2" id="carousel_959d">
  <div class="u-align-left u-clearfix u-sheet u-valign-middle u-sheet-1">
    <h3 class="u-text u-text-default u-text-1">
      <span style="font-weight: 700;">Export Data </span>
    </h3>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-align-left u-border-3 u-border-palette-1-light-3 u-container-style u-group u-palette-5-light-3 u-radius-9 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <h4 class="u-text u-text-default u-text-2">Choose Data Range</h4>
        <div class="u-border-2 u-border-palette-5-light-2 u-form u-palette-4-light-3 u-form-1">
          <form action="/medbot/public/manage/export" method="POST" class="u-clearfix u-form-spacing-26 u-inner-form" name="export" style="padding: 26px;">
          @csrf
            <div class="u-form-date u-form-group u-form-group-1">

              <label for="date-bc34" class="u-label">Start Date</label>
              <input type="date" placeholder="MM/DD/YYYY" id="date-bc34" name="start_date" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-1-light-3" style="margin-bottom: 26px" required="">
            </div>
            <div class="u-form-date u-form-group u-form-group-2">
              <label for="date-40b5" class="u-label">End Date</label>
              <input type="date" placeholder="MM/DD/YYYY" id="date-40b5" name="end_date" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-1-light-3" required="">
            </div>
            <div class="u-align-center u-form-group u-form-submit">
              <a href="#" class="u-border-none u-btn u-btn-submit u-button-style u-palette-1-light-1 u-btn-1">Export<br></a>
              <input type="submit" value="submit" class="u-form-control-hidden">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="u-align-left u-border-3 u-border-palette-1-light-3 u-container-style u-group u-palette-5-light-3 u-radius-9 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-2">
        <h4 class="u-text u-text-default u-text-3">Download a Single Reading Report</h4>
        <div class="u-border-2 u-border-palette-5-light-2 u-form u-palette-4-light-3 u-form-2">
          <form action="/medbot/public/manage/generate" method="POST" class="u-clearfix u-form-spacing-26 u-inner-form" name="generate" style="padding: 26px;">
          @csrf
            <div class="u-form-group u-form-select u-form-group-4">
              <label for="select-c6e5" class="u-label">Select Reading Report</label>
              <div class="u-form-select-wrapper">
                <select id="select-c6e5" name="select" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-2" style="margin-bottom: 26px">
                  
                  <option value="null">Select Reading ID</option>
                  @foreach($ids as $id)
                  <option value="{{$id}}">{{$id}}</option>
                  @endforeach

                </select>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret">
                  <path fill="currentColor" d="M4 8L0 4h8z"></path>
                </svg>
              </div>
            </div>
            <div class="u-form-group u-form-group-5">
              <label for="text-562f" class="u-label">Or enter reading #</label>
              <input type="text" placeholder="" id="text-562f" name="text" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-palette-5-light-2">
            </div>
            <div class="u-align-center u-form-group u-form-submit">
              <a href="#" class="u-border-none u-btn u-btn-submit u-button-style u-palette-1-light-1 u-btn-2">Generate Report<br></a>
              <input type="submit" value="submit" class="u-form-control-hidden">
            </div>
            <input type="hidden" value="" name="recaptchaResponse">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection