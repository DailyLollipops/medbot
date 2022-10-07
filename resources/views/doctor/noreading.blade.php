@extends('layout',[$style = 'doctor/noreading', $title = 'User Reading'])

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
        <h2 class="u-text u-text-default u-text-2">
          {{$user_name}}
          <span style="font-weight: 700;"></span>
        </h2>
        <h4 class="u-text u-text-default u-text-3">
          <span class="u-file-icon u-icon">
            <img src="{{ asset('images/joined.png') }}" alt="">
          </span>
          &nbsp;{{$user_joined}}
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
<section class="u-clearfix u-section-2" id="sec-5d60">
  <div class="u-clearfix u-sheet u-sheet-1">
    <img class="u-image u-image-contain u-image-default u-image-1" src="{{ asset('images/nothing_found.png') }}" alt="" data-image-width="411" data-image-height="250">
    <h4 class="u-text u-text-1">It seems you haven't taken any readings yet that's why we can't display anything here</h4>
    <h4 class="u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-2">Suggestions:</h4>
    <ul class="u-text u-text-3">
      <li>
        <span style="font-size: 24px;">Visit your local Med-bot and start measuring your vital signs</span>
      </li>
    </ul>
  </div>
</section>
@endsection