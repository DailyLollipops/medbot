@extends('layout',[$style = 'main/about', $title = 'About'])

@section('content')
  <section class="u-align-center u-clearfix u-section-1" id="sec-0ffd">
    <div class="u-clearfix u-sheet u-sheet-1">
      <div class="u-container-style u-group u-group-1">
        <div class="u-container-layout u-container-layout-1">
          <h2 class="u-text u-text-default u-text-1">Med-bot</h2>
          <p class="u-text u-text-2">Med-bot aims to provide healthcare assistance that lessens contact between patients and doctors to help lessen the infection of COVID-19 virus. It was made by a team of three and presented as a thesis for Marinduque State College. The source code is available at the github repository :)<br>
            <br>
            <a href="https://github.com/DailyLollipops/medbot" class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-1" target="_blank">-&gt; Github</a>
            <br>
          </p>
        </div>
      </div>
    </div>
  </section>
  <section class="u-clearfix u-section-2" id="sec-3b84">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h1 class="u-text u-text-default u-text-1">The Team</h1>
      <div class="u-list u-list-1">
        <div class="u-repeater u-repeater-1">
          <div class="u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-1">
              <img class="u-border-2 u-border-grey-75 u-expanded-width u-image u-image-circle u-preserve-proportions u-image-1" src="{{ asset('images/dev1.png') }}" alt="" data-image-width="128" data-image-height="128">
              <p class="u-align-center u-small-text u-text u-text-default u-text-variant u-text-2">Clarence Madrigal</p>
            </div>
          </div>
          <div class="u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-2">
              <img class="u-border-2 u-border-grey-75 u-expanded-width u-image u-image-circle u-preserve-proportions u-image-2" src="{{ asset('images/dev2.png') }}" alt="" data-image-width="128" data-image-height="128">
              <p class="u-align-center u-small-text u-text u-text-default u-text-variant u-text-3">James Arvie Malapote</p>
            </div>
          </div>
          <div class="u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-3">
              <img class="u-border-2 u-border-grey-75 u-expanded-width u-image u-image-circle u-image-contain u-preserve-proportions u-image-3" src="{{ asset('images/dev3.png') }}" alt="" data-image-width="128" data-image-height="128">
              <p class="u-align-center u-small-text u-text u-text-default u-text-variant u-text-4">Gilbert Esplana</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection