@extends('layout',[$style = 'user/dashboard', $title = 'Dashboard'])

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
            <p class="u-custom-item u-heading-font u-text u-text-2">{{$count}}</p>
            <h5 class="u-text u-text-3">Total Reading<br>
            </h5>
          </div>
        </div>
        <div class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-2">
          <div class="u-container-layout u-similar-container u-valign-bottom-sm u-container-layout-2">
            <span class="u-file-icon u-icon u-icon-2">
              <img src="{{ asset('images/pulse_rate.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-4">{{$average_pulse_rate_all}} bpm</p>
            <h5 class="u-text u-text-5">Pulse Rate<br>
            </h5>
          </div>
        </div>
        <div class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-3">
          <div class="u-container-layout u-similar-container u-valign-bottom-sm u-container-layout-3">
            <span class="u-file-icon u-icon u-icon-3">
              <img src="{{ asset('images/blood_pressure.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-6">{{$average_systolic_all}}/{{$average_diastolic_all}} mmHg </p>
            <h5 class="u-text u-text-7">Blood Pressure<br>
            </h5>
          </div>
        </div>
        <div class="u-align-center u-container-style u-custom-item u-grey-5 u-list-item u-repeater-item u-shape-rectangle u-list-item-4">
          <div class="u-container-layout u-similar-container u-valign-bottom-sm u-container-layout-4">
            <span class="u-file-icon u-icon u-icon-4">
              <img src="{{ asset('images/blood_saturation.png') }}" alt="">
            </span>
            <p class="u-custom-item u-heading-font u-text u-text-8">{{$average_blood_saturation_all}}%</p>
            <h5 class="u-text u-text-9">Sp02<br>
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-4">
  <div class="u-clearfix u-sheet u-sheet-1">
    <h4 class="u-text u-text-default u-text-1">Compared to Previous Months</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-grey-5 u-group u-radius-14 u-shape-round u-group-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
      <div class="u-container-layout u-container-layout-1">
        <button id="allTimeBloodPressureRatings" class="u-btn u-btn-round u-button-style u-gradient u-none u-radius-4 u-text-body-alt-color u-btn-1"><span class="u-file-icon u-icon"><img src="{{ asset('images/blood_pressure.png' ) }}" alt=""></span>&nbsp;BP
        </button>
        <button id="allTimePulseRateRatings" class="u-btn u-btn-round u-button-style u-gradient u-none u-radius-4 u-text-body-alt-color u-btn-2"><span class="u-file-icon u-icon"><img src="{{ asset('images/pulse_rate.png' ) }}" alt=""></span>&nbsp;PR
        </button>
        <button id="allTimeBloodSaturationRatings" class="u-btn u-btn-round u-button-style u-gradient u-none u-radius-4 u-text-body-alt-color u-btn-3"><span class="u-file-icon u-icon"><img src="{{ asset('images/blood_saturation.png' ) }}" alt=""></span>&nbsp;SP02
        </button>
        
      </div>
    </div>
    <div class="u-align-center u-border-1 u-border-grey-15 u-container-style u-grey-5 u-group u-radius-14 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-2">
        <canvas id="yearlyReadingsChart"></canvas>
      </div>
    </div>
    <div class="u-align-center u-border-1 u-border-grey-15 u-container-style u-grey-5 u-group u-radius-14 u-shape-round u-group-3">
      <div class="u-container-layout u-container-layout-3">
        <canvas id="allTimeRatingsChart"></canvas>
      </div>
    </div>
  </div>
</section>


{{-- Script Section --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

  // Monthly Readings Chart Variables
  const ids = {{ Js::from($labels) }};
  const monthlyPulseRates = {{ Js::from($pulse_rates) }};
  const monthlySystolics = {{ Js::from($systolics) }};
  const monthlyDiastolics = {{ Js::from($diastolics) }};
  const monthlyBloodPressures = {{ Js::from($blood_pressures) }};
  const monthlyBloodSaturations = {{ Js::from($blood_saturations) }};
  const dates = {{ Js::from($dates) }};
  const times = {{ Js::from($times) }};

  // Monthly Rating Chart Variables
  const types = ['Pulse Rate', 'Blood Pressure', 'Blood Saturation'];
  const monthlyPulseRateRatings = {{ Js::from($pulse_rate_ratings) }};
  const monthlyBloodPressureRatings = {{ Js::from($blood_pressure_ratings) }};
  const monthlyBloodSaturationRatings = {{ Js::from($blood_saturation_ratings) }};

  // Year Readings Chart Variables
  const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  const monthsEx = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  const yearlyPulseRates = {{ Js::from($pulse_rates_year) }};
  const yearlySystolics = {{ Js::from($systolics_year) }};
  const yearlyDiastolics = {{ Js::from($diastolics_year) }};
  const yearlyBloodPressures = {{ Js::from($blood_pressures_year) }};
  const yearlyBloodSaturations = {{ Js::from($blood_saturations_year) }};

  // All Time Ratings  Chart Variables
  const count = {{ Js::from($count) }};
  const allTimePulseRateRatings = {{ Js::from($all_pulse_rate_ratings) }};
  const allTimeBloodPressureRatings = {{ Js::from($all_blood_pressure_ratings) }};
  const allTimeBloodSaturationRatings = {{ Js::from($all_blood_saturation_ratings) }};

  // Monthly Readings Chart Datasets
  const monthlyReadingsData = {
    labels: ids,
    datasets: [{
      label: 'Pulse Rate',
      backgroundColor: '#94ca74',
      borderColor: '#ced96c',
      data: monthlyPulseRates,
    },
    {
      label: 'Blood Pressure',
      backgroundColor: '#e88a41',
      borderColor: '#ff752f',
      data: monthlyBloodPressures,
    },
    {
      label: 'Blood Saturation',
      backgroundColor: '#70f1fa',
      borderColor: '#33647e',
      data: monthlyBloodSaturations,
    }]
  };

  // Monthly Rating Chart Datasets
  const monthlyRatingsData = {
    labels: types,
    datasets: [{
      label: 'Below Normal',
      backgroundColor: '#94ca74',
      borderColor: '#ced96c',
      data: [monthlyPulseRateRatings[0],monthlyBloodPressureRatings[0],monthlyBloodSaturationRatings[0]]
    },
    {
      label: 'Normal',
      backgroundColor: '#e88a41',
      borderColor: '#ff752f',
      data: [monthlyPulseRateRatings[1],monthlyBloodPressureRatings[1],monthlyBloodSaturationRatings[1]]
    },
    {
      label: 'Above Normal',
      backgroundColor: '#70f1fa',
      borderColor: '#33647e',
      data: [monthlyPulseRateRatings[2],monthlyBloodPressureRatings[2],monthlyBloodSaturationRatings[2]]
    },
    ]
  };

  // Yearly Readings Chart Datasets
  const yearlyReadingsData = {
    labels: months,
    datasets: [{
      label: 'Pulse Rate',
      backgroundColor: '#94ca74',
      borderColor: '#ced96c',
      data: yearlyPulseRates,
    },
    {
      label: 'Blood Pressure',
      backgroundColor: '#e88a41',
      borderColor: '#ff752f',
      data: yearlyBloodPressures,
    },
    {
      label: 'Blood Saturation',
      backgroundColor: '#70f1fa',
      borderColor: '#33647e',
      data: yearlyBloodSaturations,
    }]
  };

  // All Time Ratings Chart Datasets
  // Pulse Rate
  const allTimePulseRateRatingsData = {
    labels: ['Below Normal', 'Normal', 'Above Normal'],
    datasets: [{
      label: 'Pulse Rate',
      data: allTimePulseRateRatings,
      backgroundColor: ['#1F89E9','#2EDC15','#F43818'],
      hoverOffset: 4
    }]
  };

  // Blood Pressure
  const allTimeBloodPressureRatingsData = {
    labels: ['Below Normal', 'Normal', 'Above Normal'],
    datasets: [{
      label: 'Blood Pressure',
      backgroundColor: ['#1F89E9','#2EDC15','#F43818'],
      data: allTimeBloodPressureRatings
    }]
  };

  // Blood Saturation
  const allTimeBloodSaturationRatingsData = {
    labels: ['Below Normal', 'Normal', 'Above Normal'],
    datasets: [{
      label: 'Blood Saturation',
      backgroundColor: ['#1F89E9','#2EDC15','#F43818'],
      data: allTimeBloodSaturationRatings
    }]
  };

  // Monthly Readings Chart Config
  const monthlyReadingsConfig = {
    type: 'line',
    data: monthlyReadingsData,
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
                return monthlySystolics[context.dataIndex] + '/' + monthlyDiastolics[context.dataIndex] + ' mmHg';
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

  // Monthly Ratings Chart Config
  const monthlyRatingsConfig = {
    type: 'bar',
    data: monthlyRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Ratings from the Last 30 Days'
        }
      }
    }
  };

  // Yearly Readings Chart Config
  const yearlyReadingsConfig = {
    type: 'line',
    data: yearlyReadingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Average Readings This Year'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '=================';
            },
            title: function(context) {
              console.log(context[0]);
              return 'Month of ' + monthsEx[context[0].dataIndex];
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
                return yearlySystolics[context.dataIndex] + '/' + yearlyDiastolics[context.dataIndex] + ' mmHg';
              }
            },
            footer: function(context) {
              return '=================';
            }
          }
        }
      }
    }
  };


  // All Time Ratings Chart Config
  // Pulse Rate
  const allTimePulseRateRatingsConfig = {
    type: 'pie',
    data: allTimePulseRateRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'All Time Pulse Rate Ratings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';

              if (label) {
                label += ': ';
              }
              if (context.parsed.y !== null) {
                percentage = (allTimePulseRateRatings[context.dataIndex]/count)*100;
                percentage = percentage.toFixed(2);
                label += ': ' + percentage + '%';
              }
              return label;
            },
            afterLabel: function(context) {
              return 'Total of ' + allTimePulseRateRatings[context.dataIndex] + ' times out of ' + count;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Pressure
  const allTimeBloodPressureRatingsConfig = {
    type: 'pie',
    data: allTimeBloodPressureRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'All Time Blood Pressure Ratings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';

              if (label) {
                label += ': ';
              }
              if (context.parsed.y !== null) {
                percentage = (allTimeBloodPressureRatings[context.dataIndex]/count)*100;
                percentage = percentage.toFixed(2);
                label += ': ' + percentage + '%';
              }
              return label;
            },
            afterLabel: function(context) {
              return 'Total of ' + allTimeBloodPressureRatings[context.dataIndex] + ' times out of ' + count;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };

  // Blood Saturation
  const allTimeBloodSaturationRatingsConfig = {
    type: 'pie',
    data: allTimeBloodSaturationRatingsData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'All Time Blood Saturation Ratings'
        },
        tooltip: {
          yAlign: 'bottom',
          titleAlign: 'center',
          footerAlign: 'center',
          callbacks: {
            beforeTitle: function(context) {
              return '======================';
            },
            title: function(context) {
              return context[0].label;
            },
            label: function(context) {
              let label = context.dataset.label || '';

              if (label) {
                label += ': ';
              }
              if (context.parsed.y !== null) {
                percentage = (allTimeBloodSaturationRatings[context.dataIndex]/count)*100;
                percentage = percentage.toFixed(2);
                label += ': ' + percentage + '%';
              }
              return label;
            },
            afterLabel: function(context) {
              return 'Total of ' + allTimeBloodSaturationRatings[context.dataIndex] + ' times out of ' + count;
            },
            footer: function(context) {
              return '======================';
            }
          }
        }
      }
    }
  };
</script>
<script>
  const monthlyReadingsChart = new Chart(
    document.getElementById('monthlyReadingsChart'),
    monthlyReadingsConfig
  );
  const monthlyRatingsChart = new Chart(
    document.getElementById('monthlyRatingsChart'),
    monthlyRatingsConfig
  );
  const yearlyReadingsChart = new Chart(
    document.getElementById('yearlyReadingsChart'),
    yearlyReadingsConfig
  );

  var allTimeRatingsChart = new Chart(
    document.getElementById('allTimeRatingsChart'),
    allTimePulseRateRatingsConfig
  );

  function showAllTimeRatingsChart(id) {
    allTimeRatingsChart.destroy();
    if (id == 'allTimePulseRateRatings') {
      allTimeRatingsChart = new Chart(
        document.getElementById('allTimeRatingsChart'),
        allTimePulseRateRatingsConfig
      );
    }
    else if (id == 'allTimeBloodPressureRatings') {
      allTimeRatingsChart = new Chart(
        document.getElementById('allTimeRatingsChart'),
        allTimeBloodPressureRatingsConfig
      );
    }
    else if (id == 'allTimeBloodSaturationRatings') {
      allTimeRatingsChart = new Chart(
        document.getElementById('allTimeRatingsChart'),
        allTimeBloodSaturationRatingsConfig
      );
    }
  }

  document.getElementById("allTimePulseRateRatings").addEventListener("click", function() {
    showAllTimeRatingsChart("allTimePulseRateRatings");
  });

  document.getElementById("allTimeBloodPressureRatings").addEventListener("click", function() {
    showAllTimeRatingsChart("allTimeBloodPressureRatings");
  });

  document.getElementById("allTimeBloodSaturationRatings").addEventListener("click", function() {
    showAllTimeRatingsChart("allTimeBloodSaturationRatings");
  });
</script>
@endsection