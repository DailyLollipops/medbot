@extends('layout',[$style = 'test', $title = 'Test Charts'])

@section('content')
    {{-- <div>
      <canvas id="myChart"></canvas>
    </div> --}}
    <section class="u-clearfix u-section-1" id="sec-33b1">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-border-3 u-border-grey-50 u-container-style u-group u-group-1">
          <div class="u-container-layout u-container-layout-1"></div>
        </div>
        <div class="u-border-3 u-border-palette-1-base u-container-style u-group u-group-2">
          <div class="u-container-layout u-container-layout-2">
            <canvas id="readingsChart"></canvas>
          </div>
        </div>
        <div class="u-border-3 u-border-palette-1-base u-container-style u-group u-group-3">
          <div class="u-container-layout u-container-layout-3">
            <canvas id="testChart"></canvas>
          </div>
        </div>
      </div>
    </section>



  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>

    // Chart 1 Variables
    const ids = {{ Js::from($labels) }};
    const pulseRates = {{ Js::from($pulse_rates) }};
    const systolics = {{ Js::from($systolics) }};
    const diastolics = {{ Js::from($diastolics) }};
    const bloodPressures = {{ Js::from($blood_pressures) }};
    const bloodSaturations = {{ Js::from($blood_saturations) }};
    const dates = {{ Js::from($dates) }};
    const times = {{ Js::from($times) }};

    // Chart 2 Variables
    const types = ['Pulse Rate', 'Blood Pressure', 'Blood Saturation'];
    const pulseRateRatings = {{ Js::from($pulse_rate_ratings) }};
    const bloodPressureRatings = {{ Js::from($blood_pressure_ratings) }};
    const bloodSaturationRatings = {{ Js::from($blood_saturation_ratings) }};

    // Chart 1 Datasets
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

    // Chart 2 Datasets
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
            text: 'Report on the Readings Last Month'
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
            text: 'Total Vital Signs Rating This Month'
          }
        }
      }
    }
  </script>
  <script>
    const readingsChart = new Chart(
      document.getElementById('readingsChart'),
      config1
    );
    const testChart = new Chart(
      document.getElementById('testChart'),
      config2
    );
  </script>
@endsection
