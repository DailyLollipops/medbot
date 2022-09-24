@extends('layout',[$style = 'doctor/dashboard', $title = 'Dashboard'])

@section('content')
@php
  use Carbon\Carbon;
@endphp

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
            <p class="u-align-center u-heading-font u-text u-text-4">{{$monthly_new_user_count}} user</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/patient.png') }}" alt="">
            </span>
            <p class="u-custom-item u-text u-text-default-xl u-text-5">

              @if($monthly_new_user_difference < 0)
                <span class="u-custom-item u-file-icon u-icon u-text-custom-color-1">
                  <img src="{{ asset('images/down_trend.png') }}" alt="">
                </span>
                &nbsp;
                <span class="u-text-custom-color-1">{{$monthly_new_user_difference}}%</span> higher this month
              @elseif($monthly_new_user_difference > 0)
                <span class="u-custom-item u-file-icon u-icon u-text-custom-color-9">
                  <img src="{{ asset('images/up_trend.png') }}" alt="">
                </span>
                &nbsp;
                <span class="u-text-custom-color-9">+{{$monthly_new_user_difference}}%</span> higher this month
              @else
                <span class="u-custom-item u-file-icon u-icon u-text-palette-3-base">
                  <img src="{{ asset('images/same_trend.png') }}" alt="">
                </span>
                &nbsp;
                <span class="u-text-palette-3-base">±0%</span> higher this month
              @endif

            </p>
          </div>
        </div>
        <div class="u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-2">
          <div class="u-container-layout u-similar-container u-valign-top-sm u-container-layout-2">
            <h5 class="u-align-center u-text u-text-6">Old Patients</h5>
            <p class="u-align-center u-heading-font u-text u-text-7">{{$old_user_count}} user</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-4" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/two_patient.png') }}" alt="">
            </span>
            <p class="u-custom-item u-text u-text-default-xl u-text-8">
              <span class="u-custom-item u-file-icon u-icon u-text-custom-color-1">
                <img src="{{ asset('images/calendar.png') }}" alt="">
              </span>
              &nbsp;
              <span class="u-text-custom-color-9">Since</span> {{$first_record}}
            </p>
          </div>
        </div>
        <div class="u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-3">
          <div class="u-container-layout u-similar-container u-valign-top-sm u-container-layout-3">
            <h5 class="u-align-center u-text u-text-9">Total Patients</h5>
            <p class="u-align-center u-heading-font u-text u-text-10">{{$all_user_count}} user</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-6" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/three_patient.png') }}" alt="">
            </span>
            <p class="u-custom-item u-text u-text-default-xl u-text-11">
              <span class="u-custom-item u-file-icon u-icon u-text-custom-color-1">
                <img src="{{ asset('images/down_trend.png') }}" alt="">
              </span>
              &nbsp;
              <span class="u-text-custom-color-1">-{{$monthly_user_growth_rate}}%</span> monthly growth rate
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="u-container-style u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-4">
        <h4 class="u-text u-text-default u-text-12">New Users This Month</h4>
        <div class="u-table u-table-responsive u-table-1"  style="overflow: scroll; height: 350px">
          <table class="u-table-entity" style="height: 350px;">
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
              
              @foreach($monthly_new_users as $user)
                <tr style="height: 75px;">
                  <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">{{$user->name}}</td>
                  <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">{{Carbon::parse($user->birthday)->age}}</td>
                  <td class="u-border-1 u-border-grey-40 u-border-no-left u-border-no-right u-table-cell">{{date_format($user->created_at,'m-d-Y')}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="u-container-style u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-5">
        <canvas id="monthlyNewUsersPerMonthChart"></canvas>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-2" id="sec-7557">
  <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-sheet-1">
    <h4 class="u-text u-text-default u-text-1">Users Overview</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-grey-5 u-group u-radius-14 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <canvas id="userGenderCountChart"></canvas>
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-2">
        <canvas id="usersByAgeChart"></canvas>
      </div>
    </div>
  </div>
</section>

{{-- Script Section --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Monthly New Users Per Month Chart Variables
  const monthlyNewUsersPerMonth = {{Js::from($monthly_new_users_per_month)}};

  // Users by Age Chart Variables
  const usersByAge = {{Js::from($users_by_age)}};

  const userGenderCount = {{Js::from($user_gender_count)}};

  // Monthly New Users Per Month Chart Datasets
  const monthlyNewUsersPerMonthData = {
    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    datasets: [{
      label: 'Users',
      backgroundColor: '#ffd966',
      borderColor: '#6666ff',
      data: monthlyNewUsersPerMonth
    }]
  };

  // Users By Ages Datasets
  const usersByAgeData = {
    labels: ['0-20','21-30','31-40','41-50','51-60','61-70','71-80','81-90','90 up'],
    datasets: [{
      label: 'Users',
      backgroundColor: [
        '#ff6666',
        '#ff8c66',
        '#ffff66',
        '#66ff66',
        '#66ffd9',
        '#66ffd9',
        '#6666ff',
        '#8c66ff',
        '#ff66ff',
        '#ff66b3',
        '#ff668c',
        '#ff6666'],
      borderColor: '#345fde',
      data: usersByAge
    }]
  };

  const userGenderCountData = {
    labels: ['Male', 'Female'],
    datasets: [{
      label: 'Gender',
      data: [userGenderCount['male'],userGenderCount['female']],
      backgroundColor: [
      '#8cff66',
      '#66b3ff'
      ]
    }]
  };

  // Monthly New Users Per Month Chart Config
  const monthlyNewUsersPerMonthConfig = {
    type: 'line',
    data: monthlyNewUsersPerMonthData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'New Users Per Month'
        }
      }
    }
  };

  // Users by Age Chart Config
  const usersByAgeConfig = {
    type: 'bar',
    data: usersByAgeData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Users By Age'
        }
      }
    }
  };

  const userGenderCountConfig = {
    type: 'pie',
    data: userGenderCountData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Users By Gender'
        }
      }
    }
  }
</script>
<script>
    const monthlyNewUsersPerMonthChart = new Chart(
    document.getElementById('monthlyNewUsersPerMonthChart'),
    monthlyNewUsersPerMonthConfig
  );

  const usersByAgeChart = new Chart(
    document.getElementById('usersByAgeChart'),
    usersByAgeConfig
  );

  const userGenderCountChart = new Chart(
    document.getElementById('userGenderCountChart'),
    userGenderCountConfig
  );
</script>
@endsection