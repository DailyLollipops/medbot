@extends('layout',[$style = 'main/index', $title = 'Home'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-b481">
  <div class="u-clearfix u-sheet u-sheet-1">
    <img class="u-image u-image-contain u-image-default u-preserve-proportions u-image-1" src="{{ asset('images/logo.png') }}" alt="" data-image-width="229" data-image-height="220">
    <h1 class="u-align-center-md u-align-center-sm u-align-center-xs u-text u-text-1">Med-bot</h1>
    <h2 class="u-text u-text-2">Your Partner in Health</h2>
    <div class="u-expanded-width u-layout-grid u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-align-center u-container-style u-list-item u-repeater-item">
          <div class="u-container-layout u-similar-container u-container-layout-1">
            <span class="u-file-icon u-icon u-icon-circle u-palette-1-base u-icon-1">
              <img src="{{ asset('images/feature1.png') }}" alt="">
            </span>
            <h3 class="u-text u-text-default u-text-3">Easy to use</h3>
            <p class="u-text u-text-default u-text-4">Medbot takes care of the trivial task. You just have to sit and wait till the reading of your vital signs is complete</p>
          </div>
        </div>
        <div class="u-align-center u-container-style u-list-item u-repeater-item">
          <div class="u-container-layout u-similar-container u-container-layout-2">
            <span class="u-file-icon u-icon u-icon-circle u-palette-1-base u-icon-2">
              <img src="{{ asset('images/feature2.png') }}" alt="">
            </span>
            <h3 class="u-text u-text-default u-text-5">Different Vital Signs</h3>
            <p class="u-text u-text-default u-text-6">The Medbot can measure blood pressure, pulse rate and blood saturation in just one sitting. You don't have to wait for each one to finish after another. Its all done concurrently</p>
          </div>
        </div>
        <div class="u-align-center u-container-style u-list-item u-repeater-item">
          <div class="u-container-layout u-similar-container u-container-layout-3">
            <span class="u-file-icon u-icon u-icon-circle u-palette-1-base u-icon-3">
              <img src="{{ asset('images/feature3.png') }}" alt="">
            </span>
            <h3 class="u-text u-text-default u-text-7">Online Monitoring</h3>
            <p class="u-text u-text-default u-text-8">Readings of each user is saved to the cloud and can be viewed by user or doctors for monitoring purposes</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection