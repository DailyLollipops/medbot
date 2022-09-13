@extends('layout',[$style = 'dashboard', $title = 'Dashboard'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-33b1">
  <div class="u-clearfix u-sheet u-sheet-1">
    <p class="u-custom-font u-heading-font u-text u-text-default u-text-1">
      <span class="u-file-icon u-icon">
        <img src="{{ asset('images/chart.png') }}" alt="">
      </span>
      &nbsp;Readings Reports
    </p>
    <h4 class="u-text u-text-default u-text-2">Average This Month</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-1">
          <div class="u-container-layout u-similar-container u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xl u-container-layout-1">
            <h5 class="u-text u-text-default u-text-3">Pulse Rate</h5>
            <p class="u-heading-font u-text u-text-default u-text-4">{{$average_pulse_rate_month}} bpm</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-2">
              <img src="{{ asset('images/pulse_rate.png') }}" alt="">
            </span>

            @if($pulse_rate_diff < 0)
              <span class="u-custom-item u-file-icon u-icon u-text-custom-color-1 u-icon-5">
                <img src="{{ asset('images/down_trend.png') }}" alt="">
              </span>
              <p class="u-text u-text-default u-text-8">
                <span class="u-text-custom-color-1">{{$pulse_rate_diff}}%</span> lower this month
              </p>
            @elseif($pulse_rate_diff > 0)
              <span class="u-custom-item u-file-icon u-icon u-text-custom-color-9 u-icon-3">
                <img src="{{ asset('images/up_trend.png') }}" alt="">
              </span>
              <p class="u-text u-text-default u-text-5">
                <span class="u-text-custom-color-9">+{{$pulse_rate_diff}}%</span> higher this month
              </p>
            @else
              <span class="u-custom-item u-file-icon u-icon u-text-palette-3-base u-icon-7">
                <img src="{{ asset('images/same_trend.png') }}" alt="">
              </span>
              <p class="u-text u-text-default u-text-11">
                <span class="u-text-palette-3-base">±0%</span> same this month
              </p>
            @endif

          </div>
        </div>
        <div class="u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-2">
          <div class="u-container-layout u-similar-container u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xl u-container-layout-2">
            <h5 class="u-text u-text-default u-text-6">Blood Pressure</h5>
            <p class="u-heading-font u-text u-text-default u-text-7">{{$average_systolic_month}}/{{$average_diastolic_month}} mmHg</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-4">
              <img src="{{ asset('images/blood_pressure.png') }}" alt="">
            </span>

            @if($blood_pressure_diff < 0)
              <span class="u-custom-item u-file-icon u-icon u-text-custom-color-1 u-icon-5">
                <img src="{{ asset('images/down_trend.png') }}" alt="">
              </span>
              <p class="u-text u-text-default u-text-8">
                <span class="u-text-custom-color-1">{{$blood_pressure_diff}}%</span> lower this month
              </p>
            @elseif($blood_pressure_diff > 0)
              <span class="u-custom-item u-file-icon u-icon u-text-custom-color-9 u-icon-3">
                <img src="{{ asset('images/up_trend.png') }}" alt="">
              </span>
              <p class="u-text u-text-default u-text-5">
                <span class="u-text-custom-color-9">+{{$blood_pressure_diff}}%</span> higher this month
              </p>
            @else
              <span class="u-custom-item u-file-icon u-icon u-text-palette-3-base u-icon-7">
                <img src="{{ asset('images/same_trend.png') }}" alt="">
              </span>
              <p class="u-text u-text-default u-text-11">
                <span class="u-text-palette-3-base">±0%</span> same this month
              </p>
            @endif

          </div>
        </div>
        <div class="u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-3">
          <div class="u-container-layout u-similar-container u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xl u-container-layout-3">
            <h5 class="u-text u-text-default u-text-9">Sp02</h5>
            <p class="u-heading-font u-text u-text-default u-text-10">{{$average_blood_saturation_month}} %</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-6">
              <img src="{{ asset('images/blood_saturation.png') }}" alt="">
            </span>

            @if($blood_saturation_diff < 0)
              <span class="u-custom-item u-file-icon u-icon u-text-custom-color-1 u-icon-5">
                <img src="{{ asset('images/down_trend.png') }}" alt="">
              </span>
              <p class="u-text u-text-default u-text-8">
                <span class="u-text-custom-color-1">{{$blood_saturation_diff}}%</span> lower this month
              </p>
            @elseif($blood_saturation_diff > 0)
              <span class="u-custom-item u-file-icon u-icon u-text-custom-color-9 u-icon-3">
                <img src="{{ asset('images/up_trend.png') }}" alt="">
              </span>
              <p class="u-text u-text-default u-text-5">
                <span class="u-text-custom-color-9">+{{$blood_saturation_diff}}%</span> higher this month
              </p>
            @else
              <span class="u-custom-item u-file-icon u-icon u-text-palette-3-base u-icon-7">
                <img src="{{ asset('images/same_trend.png') }}" alt="">
              </span>
              <p class="u-text u-text-default u-text-11">
                <span class="u-text-palette-3-base">±0%</span> same this month
              </p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-2" id="sec-1e9e">
  <div class="u-clearfix u-sheet u-valign-middle-xl u-sheet-1">
    <h4 class="u-text u-text-default u-text-1">Readings This Month</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-expanded-width-xs u-grey-5 u-group u-radius-14 u-shape-round u-group-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
      <div class="u-container-layout u-container-layout-1">
        {{-- Monthly Ratings Chart --}}
        <canvas id="monthlyRatingsChart"></canvas>
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-expanded-width-xs u-grey-5 u-group u-radius-14 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-2">
        {{-- Monthly Readings Chart --}}
        <canvas id="monthlyReadingsChart"></canvas>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-3" id="carousel_400a">
  <div class="u-clearfix u-sheet u-sheet-1">
    <h4 class="u-text u-text-default u-text-1">Average All Time</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-1">
          <div class="u-container-layout u-similar-container u-valign-bottom-sm u-container-layout-1">
            <span class="u-file-icon u-icon u-icon-1">
              <img src="{{ asset('images/monitor.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-2">125</p>
            <h5 class="u-text u-text-3">Total Reading<br>
            </h5>
          </div>
        </div>
        <div class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-2">
          <div class="u-container-layout u-similar-container u-valign-bottom-sm u-container-layout-2">
            <span class="u-file-icon u-icon u-icon-2">
              <img src="{{ asset('images/pulse_rate.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-4">125 bpm</p>
            <h5 class="u-text u-text-5">Pulse Rate<br>
            </h5>
          </div>
        </div>
        <div class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-3">
          <div class="u-container-layout u-similar-container u-valign-bottom-sm u-container-layout-3">
            <span class="u-file-icon u-icon u-icon-3">
              <img src="{{ asset('images/blood_pressure.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-6">125/130 mmHg </p>
            <h5 class="u-text u-text-7">Blood Pressure<br>
            </h5>
          </div>
        </div>
        <div class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-4">
          <div class="u-container-layout u-similar-container u-valign-bottom-sm u-container-layout-4">
            <span class="u-file-icon u-icon u-icon-4">
              <img src="{{ asset('images/blood_saturation.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-8">96%</p>
            <h5 class="u-text u-text-9">Sp02<br>
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-4" id="carousel_4e22">
  <div class="u-clearfix u-sheet u-valign-middle-xl u-sheet-1">
    <h4 class="u-text u-text-default u-text-1">Compared to Previous Months</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-expanded-width-xs u-grey-5 u-group u-radius-14 u-shape-round u-group-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
      <div class="u-container-layout u-container-layout-1">
        {{-- Some Charts here --}}
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-expanded-width-xs u-grey-5 u-group u-radius-14 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-2">
        {{-- Year Reading Chart here --}}
      </div>
    </div>
  </div>
</section>


{{-- Script Section --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

  // Monthly Readings Chart Variables
  const ids = {{ Js::from($labels) }};
  const pulseRates = {{ Js::from($pulse_rates) }};
  const systolics = {{ Js::from($systolics) }};
  const diastolics = {{ Js::from($diastolics) }};
  const bloodPressures = {{ Js::from($blood_pressures) }};
  const bloodSaturations = {{ Js::from($blood_saturations) }};
  const dates = {{ Js::from($dates) }};
  const times = {{ Js::from($times) }};

  // Monthly Rating Chart Variables
  const types = ['Pulse Rate', 'Blood Pressure', 'Blood Saturation'];
  const pulseRateRatings = {{ Js::from($pulse_rate_ratings) }};
  const bloodPressureRatings = {{ Js::from($blood_pressure_ratings) }};
  const bloodSaturationRatings = {{ Js::from($blood_saturation_ratings) }};

  // Monthly Readings Chart Datasets
  const data1 = {
    labels: ids,
    datasets: [{
      label: 'Pulse Rate',
      backgroundColor: '#94ca74',
      borderColor: '#ced96c',
      data: pulseRates,
    },
    {
      label: 'Blood Pressure',
      backgroundColor: '#e88a41',
      borderColor: '#ff752f',
      data: bloodPressures,
    },
    {
      label: 'Blood Saturation',
      backgroundColor: '#70f1fa',
      borderColor: '#33647e',
      data: bloodSaturations,
    }]
  };

  // Monthly Rating Chart Datasets
  const data2 = {
    labels: types,
    datasets: [{
      label: 'Below Normal',
      backgroundColor: '#94ca74',
      borderColor: '#ced96c',
      data: [pulseRateRatings[0],bloodPressureRatings[0],bloodSaturationRatings[0]]
    },
    {
      label: 'Normal',
      backgroundColor: '#e88a41',
      borderColor: '#ff752f',
      data: [pulseRateRatings[1],bloodPressureRatings[1],bloodSaturationRatings[1]]
    },
    {
      label: 'Above Normal',
      backgroundColor: '#70f1fa',
      borderColor: '#33647e',
      data: [pulseRateRatings[2],bloodPressureRatings[2],bloodSaturationRatings[2]]
    },
    ]
  };
  
  const config1 = {
    type: 'line',
    data: data1,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Readings from the Last 30 Days'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '=================';
            },
            title: function(context) {
              console.log(context[0]);
              return `Reading #${context[0].label}`;
            },
            label: function(context) {
              let label = context.dataset.label || '';

              if (label) {
                label += ': ';
              }
              if (context.parsed.y !== null) {
                if (context.dataset.label == "Pulse Rate") {
                  label += context.parsed.y + ' bpm';
                }
                else if (context.dataset.label == "Blood Saturation") {
                  label += context.parsed.y + ' %';
                }
                else if (context.dataset.label == "Blood Pressure") {
                  // label += systolics[context.dataIndex] + '/' + diastolics[context.dataIndex] + ' mmHg';
                }
              }
              return label;
            },
            afterLabel: function(context) {
              if (context.dataset.label == "Blood Pressure") {
                return systolics[context.dataIndex] + '/' + diastolics[context.dataIndex] + ' mmHg';
              }
            },
            afterBody: function(context) {
              return '=================';
            },
            beforeFooter: function(context) {
              return `Taken at`;
            },
            footer: function(context) {
              return `Date: ${dates[context[0].dataIndex]}`;
            },
            afterFooter: function(context) {
              return `Time: ${times[context[0].dataIndex]}`;
            }
          }
        }
      }
    }
  };

  const config2 = {
    type: 'bar',
    data: data2,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Ratings from the Last 30 Days'
        }
      }
    }
  }
</script>
<script>
  const readingsChart = new Chart(
    document.getElementById('monthlyReadingsChart'),
    config1
  );
  const testChart = new Chart(
    document.getElementById('monthlyRatingsChart'),
    config2
  );
</script>
@endsection