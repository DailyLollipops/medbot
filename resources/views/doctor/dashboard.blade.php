@extends('layout',[$style = 'doctor/dashboard', $title = 'Dashboard'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-c5ee">
  <div class="u-clearfix u-sheet u-sheet-1">
    <p class="u-custom-font u-heading-font u-text u-text-default u-text-1"><span class="u-file-icon u-icon"><img src="images/1170616.png" alt=""></span>&nbsp;Users Reports
    </p>
    <h4 class="u-text u-text-default u-text-2">Users This Month</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-1">
          <div class="u-container-layout u-similar-container u-valign-top-sm u-container-layout-1">
            <h5 class="u-align-center u-text u-text-3">New Patients</h5>
            <p class="u-align-center u-heading-font u-text u-text-4">10 user</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/patient.png') }}" alt="">
            </span>
            <p class="u-custom-item u-text u-text-default-xl u-text-5">
              <span class="u-custom-item u-file-icon u-icon u-text-custom-color-9">
                <img src="{{ asset('images/up_trend.png') }}" alt=""></span>&nbsp;<span class="u-text-custom-color-9">+50%</span> higher this month
            </p>
          </div>
        </div>
        <div class="u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-2">
          <div class="u-container-layout u-similar-container u-valign-top-sm u-container-layout-2">
            <h5 class="u-align-center u-text u-text-6">New Patients</h5>
            <p class="u-align-center u-heading-font u-text u-text-7">10 user</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-4" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/two_patient.png') }}" alt="">
            </span>
            <p class="u-custom-item u-text u-text-default-xl u-text-8"><span class="u-custom-item u-file-icon u-icon u-text-custom-color-1"><img src="images/4230009-34159dff.png" alt=""></span>&nbsp;<span class="u-text-custom-color-1">-50%</span> higher this month
            </p>
          </div>
        </div>
        <div class="u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-3">
          <div class="u-container-layout u-similar-container u-valign-top-sm u-container-layout-3">
            <h5 class="u-align-center u-text u-text-9">New Patients</h5>
            <p class="u-align-center u-heading-font u-text u-text-10">10 user</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-6" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/three_patient.png') }}" alt="">
            </span>
            <p class="u-custom-item u-text u-text-default-xl u-text-11"><span class="u-custom-item u-file-icon u-icon u-text-palette-3-base"><img src="images/5436326-a91d58cf.png" alt=""></span>&nbsp;<span class="u-text-palette-3-base">±0%</span> higher this month
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="u-container-style u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-4">
        <h4 class="u-text u-text-default u-text-12">New Users This Month</h4>
        <div class="u-table u-table-responsive u-table-1">
          <table class="u-table-entity">
            <colgroup>
              <col width="33.3%">
              <col width="33.3%">
              <col width="33.400000000000006%">
            </colgroup>
            <thead class="u-align-center u-grey-50 u-table-header u-table-header-1">
              <tr style="height: 48px;">
                <th class="u-border-3 u-border-grey-50 u-table-cell u-table-cell-1">Name</th>
                <th class="u-border-3 u-border-grey-50 u-table-cell u-table-cell-2">Age</th>
                <th class="u-border-3 u-border-grey-50 u-table-cell u-table-cell-3">Joined</th>
              </tr>
            </thead>
            <tbody class="u-table-alt-palette-1-light-3 u-table-body">
              <tr style="height: 74px;">
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Row 1</td>
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Description</td>
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Description</td>
              </tr>
              <tr style="height: 75px;">
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Row 2</td>
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Description</td>
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Description</td>
              </tr>
              <tr style="height: 75px;">
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Row 3</td>
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Description</td>
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Description</td>
              </tr>
              <tr style="height: 75px;">
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Row 4</td>
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Description</td>
                <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">Description</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="u-container-style u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-5"></div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-2" id="sec-7557">
  <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-sheet-1">
    <h4 class="u-text u-text-default u-text-1">Users Overview</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-grey-5 u-group u-radius-14 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1"></div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-2"></div>
    </div>
  </div>
</section>
@endsection