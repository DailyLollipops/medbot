@extends('layout',[$style = 'doctor/dashboard', $title = 'Dashboard'])

@section('content')
@php
  use Carbon\Carbon;
@endphp

<section class="u-clearfix u-section-1" id="sec-c5ee">
  <div class="u-clearfix u-sheet u-sheet-1">
    <p class="u-custom-font u-heading-font u-text u-text-default u-text-1"><span class="u-file-icon u-icon"><img src="{{ asset('images/chart.png') }}" alt=""></span>&nbsp;Users Reports
    </p>
    <h4 class="u-text u-text-default u-text-2">Users This Month</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-1">
          <div class="u-container-layout u-similar-container u-valign-top-sm u-container-layout-1">
            <h5 class="u-align-center u-text u-text-3">New Patients</h5>
            <p class="u-align-center u-heading-font u-text u-text-4">{{$this_month_new_user_count}} user</p>
            <span class="u-custom-item u-file-icon u-icon u-icon-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/patient.png') }}" alt="">
            </span>
            <p class="u-custom-item u-text u-text-default-xl u-text-5", style="text-align: center;">

              @if($this_month_new_user_difference < 0)
                <span class="u-custom-item u-file-icon u-icon u-text-custom-color-1">
                  <img src="{{ asset('images/down_trend.png') }}" alt="">
                </span>
                &nbsp;
                <span class="u-text-custom-color-1">{{$this_month_new_user_difference}}%</span> higher this month
              @elseif($this_month_new_user_difference > 0)
                <span class="u-custom-item u-file-icon u-icon u-text-custom-color-9">
                  <img src="{{ asset('images/up_trend.png') }}" alt="">
                </span>
                &nbsp;
                <span class="u-text-custom-color-9">+{{$this_month_new_user_difference}}%</span> higher this month
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
            <p class="u-custom-item u-text u-text-default-xl u-text-8", style="margin-left: 140px;">
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
            <p class="u-custom-item u-text u-text-default-xl u-text-11", style="text-align: center;">

                @if($monthly_user_growth_rate < 0)
                  <span class="u-custom-item u-file-icon u-icon u-text-custom-color-1">
                    <img src="{{ asset('images/down_trend.png') }}" alt="">
                  </span>
                  &nbsp;
                  <span class="u-text-custom-color-1">{{$monthly_user_growth_rate}}%</span> monthly growth rate
                @elseif($monthly_user_growth_rate > 0)
                  <span class="u-custom-item u-file-icon u-icon u-text-custom-color-9">
                    <img src="{{ asset('images/up_trend.png') }}" alt="">
                  </span>
                &nbsp;
                  <span class="u-text-custom-color-9">+{{$monthly_user_growth_rate}}%</span> monthly growth rate
                @else
                  <span class="u-custom-item u-file-icon u-icon u-text-palette-3-base">
                    <img src="{{ asset('images/same_trend.png') }}" alt="">
                  </span>
                  &nbsp;
                  <span class="u-text-palette-3-base">±0%</span> monthly growth rate
                @endif
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="u-container-style u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-4">
        <h4 class="u-text u-text-default u-text-12">New Users From the Last 30 Days</h4>
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
              
              @foreach($this_month_new_users as $user)
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
<section class="u-align-center-lg u-align-center-md u-align-center-sm u-align-center-xs u-clearfix u-section-2" id="sec-7557">
  <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-expanded-width-sm u-expanded-width-xs u-form u-form-1">
      <form action="#" method="GET" onsubmit="select_area()" class="u-clearfix u-form-horizontal u-form-spacing-10 u-inner-form" source="email" name="form" style="padding: 10px;">
        <div class="u-form-group u-form-select u-label-none u-form-group-1">
          <label for="select-d839" class="u-label">Dropdown</label>
          <div class="u-form-select-wrapper">
            <select id="municipality" name="municipality" onchange="change_baranggay_dropdown()" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white u-input-1">
              <option value="All">All</option>
              <option value="Gasan">Gasan</option>
              <option value="Boac">Boac</option>
              <option value="Mogpog">Mogpog</option>
              <option value="Sta. Cruz">Sta. Cruz</option>
              <option value="Torrijos">Torrijos</option>
              <option value="Buenavista">Buenavista</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
          </div>
        </div>
        <div class="u-form-group u-form-select u-label-none u-form-group-2">
          <label for="select-f7c6" class="u-label">Dropdown</label>
          <div class="u-form-select-wrapper">
            <select id="baranggay" name="baranggay" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white u-input-2">
              <option value="Item 1">All</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
          </div>
        </div>
        <div class="u-align-left u-form-group u-form-submit u-label-none">
          <button href="#" onclick="this.form.submit()" class="u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-dark-1 u-palette-1-light-1 u-radius-15 u-text-hover-palette-2-light-1 u-btn-1">
            <span class="u-file-icon u-icon">
              <img src="{{ asset('images/location.png') }}" alt="">
            </span>&nbsp;Select
          </button>
          <input type="submit" value="submit" class="u-form-control-hidden">
        </div>
      </form>
    </div>
    <h5 class="u-text u-text-default u-text-1">Users Overview</h5>
    <div class="u-border-3 u-border-grey-dark-1 u-expanded-width-xs u-line u-line-horizontal u-line-1"></div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-expanded-width-xs u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <canvas id="usersGenderCountChart"></canvas>
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-expanded-width-sm u-expanded-width-xs u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-2">
        <canvas id="usersByAgeChart"></canvas>
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-3">
      <div class="u-container-layout u-container-layout-3">
        <canvas id="usersRatingByGenderChart"></canvas>
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-4">
      <div class="u-container-layout u-container-layout-4">
        <canvas id="usersRatingByAgeChart"></canvas>
      </div>
    </div>
    <div class="u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-5">
            <button id="showPulseRateByGender" class="u-btn u-btn-round u-button-style u-custom-item u-palette-1-light-1 u-radius-4 u-text-body-alt-color u-btn-2">
              <span class="u-file-icon u-icon u-icon-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/pulse_rate.png') }}" alt="">
              </span>&nbsp;PR&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-6">
            <button id="showBloodPressureByGender" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-palette-2-light-1 u-radius-4 u-text-body-alt-color u-btn-3">
              <span class="u-file-icon u-icon u-icon-3" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_pressure.png') }}" alt="">
              </span>&nbsp;BP&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-7">
            <button id="showBloodSaturationByGender" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-grey-70 u-radius-4 u-text-body-alt-color u-btn-4">
              <span class="u-file-icon u-icon u-icon-4" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_saturation.png') }}" alt="">
              </span>&nbsp;SP02
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="u-list u-list-2">
      <div class="u-repeater u-repeater-2">
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-container-layout-8">
            <button id="showPulseRateByAge" class="u-btn u-btn-round u-button-style u-custom-item u-palette-1-light-1 u-radius-4 u-text-body-alt-color u-btn-5">
              <span class="u-file-icon u-icon u-icon-5" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/pulse_rate.png') }}" alt="">
              </span>&nbsp;PR&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-container-layout-9">
            <button id="showBloodPressureByAge" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-palette-2-light-1 u-radius-4 u-text-body-alt-color u-btn-6">
              <span class="u-file-icon u-icon u-icon-6" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_pressure.png') }}" alt="">
              </span>&nbsp;BP&nbsp;&nbsp;
            </button>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle">
          <div class="u-container-layout u-similar-container u-container-layout-10">
            <button id="showBloodSaturationByAge" class="u-border-none u-btn u-btn-round u-button-style u-custom-item u-grey-70 u-radius-4 u-text-body-alt-color u-btn-7">
              <span class="u-file-icon u-icon u-icon-7" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
                <img src="{{ asset('images/blood_saturation.png') }}" alt="">
              </span>&nbsp;SP02
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Script Section --}}
<script>
  function change_baranggay_dropdown(){
    municipality_dropdown = document.getElementById('municipality');
    baranggay_dropdown = document.getElementById('baranggay');
    baranggay_gasan = ['All', 'Antipolo', 'Bachao Ibaba', 'Bachao Ilaya', 'Bacong-bacong', 'Bahi', 'Bangbang', 'Banot',
                        'Banuyo', 'Bognuyan', 'Cabugao', 'Dawis', 'Dili', 'Libtangin', 'Mahunig', 'Mangiliol',
                        'Masiga', 'Mt. Gasan', 'Pangi', 'Pinggan', 'Tabionan', 'Tapuyan', 'Tiguion',
                        'Baranggay I', 'Baranggay II', 'Baranggay III'];
    baranggay_boac = ['All','Agot', 'Agumaymayan', 'Amoingon', 'Apitong', 'Balagasan', 'Balaring', 'Balimbing', 'Balogo',
                        'Bamban', 'Bangbangalon', 'Bantad', 'Bantay', 'Bayuti', 'Binunga', 'Boi', 'Boton', 
                        'Buliasnin', 'Bunganay', 'Caganhao', 'Canat', 'Catubugan', 'Cawit', 'Daig', 'Daypay',
                        'Duyay', 'Hinapulan', 'Ihatub', 'Isok 1', 'Isok 2', 'Laylay', 'Lupac', 'Mahinhin',
                        'Mainit', 'Malbog', 'Maligaya', 'Malusak', 'Mansiwat', 'Mataas na Bayan', 'Maybo', 'Mercado', 
                        'Murallon', 'Ogbac', 'Pawa', 'Pili', 'Poctoy', 'Poras', 'Puting Buhangin', 'Puyog', 'Sabong', 
                        'San Miguel', 'Santol', 'Sawi', 'Tabi', 'Tabigue', 'Tagwak', 'Tambunan', 'Tampus', 'Tanza',
                        'Tugos', 'Tumagabok', 'Tumapon'];
    baranggay_buenavista = ['All', 'Bagacay', 'Bagtingon', 'Bicas-bicas', 'Caigangan', 'Daykitin', 'Libas', 'Malbog', 'Sihi',
                        'Timbo', 'Lipata', 'Yook', 'Baranggay I', 'Baranggay II', 'Baranggay III', 'Baranggay IV'];
    baranggay_mogpog = ['All', 'Argao', 'Balanacan', 'Banto', 'Bintakay', 'Bocboc', 'Butansapa', 'Candahon',
                        'Capayang', 'Danao', 'Dulong Bayan', 'Gitnang Bayan', 'Guisian', 'Hinadharan', 'Hinanggayon',
                        'Ino', 'Janagdong', 'Lamesa', 'Laon', 'Magapua', 'Malayak', 'Malusak', 'Mampaitan',
                        'Mangyan-Mababad', 'Market Site', 'Mataas na Bayan', 'Mendez', 'Nangka I', 'Nangka II', 'Paye',
                        'Pili', 'Puting Buhangin', 'Sayao', 'Sibucao', 'Silangan', 'Sumangga', 'Tarug', 'Villa Mendez'];
    baranggay_stacruz = ['All', 'Alobo', 'Angas', 'Aturan', 'Bagong Silangan', 'Baguidbirin', 'Baliis', 'Balogo', 'Banahaw',
                        'Bangcuangan', 'Biga', 'Botilao', 'Buyabod', 'Dating Bayan', 'Devilla', 'Dolores', 'Haguimit',
                        'Hupi', 'Ipil', 'Jolo', 'Kaganhao', 'Kalangkang', 'Kamandugan', 'Kasily', 'Kilo-kilo',
                        'Kinyaman', 'Labo', 'Lamesa', 'Landy', 'Lapu-lapu', 'Libjo', 'Lipa', 'Lusok', 'Maharlika',
                        'Makulapnit', 'Maniwaya', 'Manlibunan', 'Masaguisi', 'Masalukot', 'Matalaba', 'Mongpong',
                        'Morales', 'Napo', 'Pag-asa', 'Pantayin', 'Polo', 'Pulong-parang', 'Punong', 'San Antonio',
                        'San Isidro', 'Tagum', 'Tamayo', 'Tambangan', 'Tawiran', 'Taytay'];
    baranggay_torrijos = ['All', 'Bangwayin', 'Bayakbakin', 'Bolo', 'Bonliw', 'Buangan', 'Cabuyo', 'Cagpo', 'Dampulan', 'Kay Duke',
                        'Mabuhay', 'Makawayan', 'Malibago', 'Malinao', 'Maranlig', 'Marlangga', 'Matuyatuya', 'Nangka',
                        'Pakaskasan', 'Payanas', 'Poblacion', 'Poctoy', 'Sibuyao', 'Suha', 'Talawan', 'Tigwi'];
    while(baranggay_dropdown.firstChild){
      baranggay_dropdown.removeChild(baranggay_dropdown.firstChild);
    }
    if(municipality_dropdown.value == 'Gasan'){
      for(var i = 0; i < baranggay_gasan.length; i++){
        var option = document.createElement('option');
        option.value = baranggay_gasan[i];
        option.text = baranggay_gasan[i];
        baranggay_dropdown.appendChild(option);
      }
    }
    if(municipality_dropdown.value == 'Boac'){
      for(var i = 0; i < baranggay_boac.length; i++){
        var option = document.createElement('option');
        option.value = baranggay_boac[i];
        option.text = baranggay_boac[i];
        baranggay_dropdown.appendChild(option);
      }
    }
    if(municipality_dropdown.value == 'Mogpog'){
      for(var i = 0; i < baranggay_mogpog.length; i++){
        var option = document.createElement('option');
        option.value = baranggay_mogpog[i];
        option.text = baranggay_mogpog[i];
        baranggay_dropdown.appendChild(option);
      }
    }
    if(municipality_dropdown.value == 'Sta. Cruz'){
      for(var i = 0; i < baranggay_stacruz.length; i++){
        var option = document.createElement('option');
        option.value = baranggay_stacruz[i];
        option.text = baranggay_stacruz[i];
        baranggay_dropdown.appendChild(option);
      }
    }
    if(municipality_dropdown.value == 'Torrijos'){
      for(var i = 0; i < baranggay_torrijos.length; i++){
        var option = document.createElement('option');
        option.value = baranggay_torrijos[i];
        option.text = baranggay_torrijos[i];
        baranggay_dropdown.appendChild(option);
      }
    }
    if(municipality_dropdown.value == 'Buenavista'){
      for(var i = 0; i < baranggay_buenavista.length; i++){
        var option = document.createElement('option');
        option.value = baranggay_buenavista[i];
        option.text = baranggay_buenavista[i];
        baranggay_dropdown.appendChild(option);
      }
    }
  }
  function select_area(){
    select_area_form = document.getElementById('form');
    select_area_form.submit();
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

  function subtractMonths(numOfMonths, date = new Date()) {
    date.setMonth(date.getMonth() - numOfMonths);
    return date;
  }

  // Address Title
  var address = {{Js::from($address)}};

  // Monthly New Users Per Month Chart Variables
  const monthlyNewUsersPerMonth = {{Js::from($monthly_new_users_per_month)}};

  // Users by Age Chart Variables
  const usersByAge = {{Js::from($users_by_age)}};

  const usersGenderCount = {{Js::from($users_gender_count)}};

  const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

  // Past 12 Months Label
  var past_months = [];
  for(var i = 0; i <= 11; i++){
    temp = months[subtractMonths(i).getMonth()];
    past_months.push(temp);
  }
  past_months = past_months.reverse();

  // Monthly New Users Per Month Chart Datasets
  const monthlyNewUsersPerMonthData = {
    labels: past_months,
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

  const usersGenderCountData = {
    labels: ['Male', 'Female'],
    datasets: [{
      label: 'Gender',
      data: [usersGenderCount['male'],usersGenderCount['female']],
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
      scales: {
        x: {
          title: {
            display: true,
            text: 'Month'
          }
        },
        y: {
          title: {
            display: true,
            text: 'User'
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'New Users From Past 12 Months'
        }
      }
    }
  };

  // Users by Age Chart Config
  const usersByAgeConfig = {
    type: 'bar',
    data: usersByAgeData,
    options: {
      scales: {
        x: {
          title: {
            display: true,
            text: 'Age'
          }
        },
        y: {
          title: {
            display: true,
            text: 'User'
          }
        }
      },
      plugins: {
        title: {
          display: true,
          text: 'Users By Age (' + address + ')'
        }
      }
    }
  };

  const usersGenderCountConfig = {
    type: 'pie',
    data: usersGenderCountData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Users By Gender (' + address + ')' 
        }
      }
    }
  }

  const monthlyNewUsersPerMonthChart = new Chart(
    document.getElementById('monthlyNewUsersPerMonthChart'),
    monthlyNewUsersPerMonthConfig
  );

  const usersByAgeChart = new Chart(
    document.getElementById('usersByAgeChart'),
    usersByAgeConfig
  );

  const usersGenderCountChart = new Chart(
    document.getElementById('usersGenderCountChart'),
    usersGenderCountConfig
  );
</script>
<script>
  
  const usersRatingsCountByGender = {{ Js::from($users_ratings_count_by_gender) }};
  const usersRatingsCountByAge = {{ Js::from($users_ratings_count_by_age) }};
  console.log(usersRatingsCountByGender);
  console.log(usersRatingsCountByAge);

    /*
    -----------------------------------------
    *                                       *
    *          RATINGS PER GENDER           *
    *                                       *
    -----------------------------------------
  */

  const pulseRateByGenderData = {
    labels: ['Male', 'Female'],
    datasets: [{
      label: 'Below Normal',
      data: [usersRatingsCountByGender['male']['pulse_rate'][0], usersRatingsCountByGender['female']['pulse_rate'][0]],
      backgroundColor: ['#FFB600'],
      borderColor: ['#FFB600']
    }, {
      label: 'Normal',
      data: [usersRatingsCountByGender['male']['pulse_rate'][1], usersRatingsCountByGender['female']['pulse_rate'][1]],
      backgroundColor: ['#A6CE39'],
      borderColor: ['#A6CE39'] 
    }, {
      label: 'Above Normal',
      data: [usersRatingsCountByGender['male']['pulse_rate'][2], usersRatingsCountByGender['female']['pulse_rate'][2]],
      backgroundColor: ['#990711'],
      borderColor: ['#990711']
    }]
  }

  const pulseRateByGenderConfig = {
    type: 'bar',
    data: pulseRateByGenderData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Users Pulse Rate Rating Pervasiveness by Gender'
        },
      },
      responsive: true,
      scales: {
        x: {
          stacked: true,
          title: {
            display: true,
            text: 'Gender'
          }
        },
        y: {
          stacked: true,
          title: {
            display: true,
            text: 'User'
          }
        }
      }
    }
  };

  const bloodPressureByGenderData = {
    labels: ['Male', 'Female'],
    datasets: [{
      label: 'Normal',
      data: [usersRatingsCountByGender['male']['blood_pressure'][0], usersRatingsCountByGender['female']['blood_pressure'][0]],
      backgroundColor: ['#A6CE39'],
      borderColor: ['#A6CE39']
    }, {
      label: 'Elevated High Blood Pressure',
      data: [usersRatingsCountByGender['male']['blood_pressure'][1], usersRatingsCountByGender['female']['blood_pressure'][1]],
      backgroundColor: ['#FFEC01'],
      borderColor: ['#FFEC01'] 
    }, {
      label: 'Hypertension Stage I',
      data: [usersRatingsCountByGender['male']['blood_pressure'][2], usersRatingsCountByGender['female']['blood_pressure'][2]],
      backgroundColor: ['#FFB600'],
      borderColor: ['#FFB600']
    }, {
      label: 'Hypertension Stage II',
      data: [usersRatingsCountByGender['male']['blood_pressure'][3], usersRatingsCountByGender['female']['blood_pressure'][3]],
      backgroundColor: ['#BB3A01'],
      borderColor: ['#BB3A01']
    }, {
      label: 'Hypertensive Crisis',
      data: [usersRatingsCountByGender['male']['blood_pressure'][4], usersRatingsCountByGender['female']['blood_pressure'][4]],
      backgroundColor: ['#990711'],
      borderColor: ['#990711']
    }]
  }

  const bloodPressureByGenderConfig = {
    type: 'bar',
    data: bloodPressureByGenderData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Users Blood Pressure Rating Pervasiveness by Gender'
        },
      },
      responsive: true,
      scales: {
        x: {
          stacked: true,
          title: {
            display: true,
            text: 'Gender'
          }
        },
        y: {
          stacked: true,
          title: {
            display: true,
            text: 'User'
          }
        }
      }
    }
  };

  const bloodSaturationByGenderData = {
    labels: ['Male', 'Female'],
    datasets: [{
      label: 'Below Normal',
      data: [usersRatingsCountByGender['male']['blood_saturation'][0], usersRatingsCountByGender['female']['blood_saturation'][0]],
      backgroundColor: ['#FFB600'],
      borderColor: ['#FFB600']
    }, {
      label: 'Normal',
      data: [usersRatingsCountByGender['male']['blood_saturation'][1], usersRatingsCountByGender['female']['blood_saturation'][1]],
      backgroundColor: ['#A6CE39'],
      borderColor: ['#A6CE39'] 
    }, {
      label: 'Above Normal',
      data: [usersRatingsCountByGender['male']['blood_saturation'][2], usersRatingsCountByGender['female']['blood_saturation'][2]],
      backgroundColor: ['#990711'],
      borderColor: ['#990711']
    }]
  }

  const bloodSaturationByGenderConfig = {
    type: 'bar',
    data: bloodSaturationByGenderData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Users Blood Saturation Rating Pervasiveness by Gender'
        },
      },
      responsive: true,
      scales: {
        x: {
          stacked: true,
          title: {
            display: true,
            text: 'Gender'
          }
        },
        y: {
          stacked: true,
          title: {
            display: true,
            text: 'User'
          }
        }
      }
    }
  };

  var usersRatingByGenderChart = new Chart(
    document.getElementById('usersRatingByGenderChart'),
    pulseRateByGenderConfig
  );
  function showUsersRatingByGenderChart(id) {
    usersRatingByGenderChart.destroy();
    if (id == 'pulseRateByGender') {
      usersRatingByGenderChart = new Chart(
        document.getElementById('usersRatingByGenderChart'),
        pulseRateByGenderConfig
      );
    }
    else if (id == 'bloodPressureByGender') {
      usersRatingByGenderChart = new Chart(
        document.getElementById('usersRatingByGenderChart'),
        bloodPressureByGenderConfig
      );
    }
    else if (id == 'bloodSaturationByGender') {
      usersRatingByGenderChart = new Chart(
        document.getElementById('usersRatingByGenderChart'),
        bloodSaturationByGenderConfig
      );
    }
  }
  document.getElementById("showPulseRateByGender").addEventListener("click", function() {
    showUsersRatingByGenderChart("pulseRateByGender");
  });
  document.getElementById("showBloodPressureByGender").addEventListener("click", function() {
    showUsersRatingByGenderChart("bloodPressureByGender");
  });
  document.getElementById("showBloodSaturationByGender").addEventListener("click", function() {
    showUsersRatingByGenderChart("bloodSaturationByGender");
  });

    /*
    -----------------------------------------
    *                                       *
    *           RATINGS PER AGE             *
    *                                       *
    -----------------------------------------
  */

  const pulseRateByAgeData = {
    labels: ['0-19', '20-39', '40-59', '60-79', '80 and above'],
    datasets: [{
      label: 'Below Normal',
      data: [
        usersRatingsCountByAge['0-19']['pulse_rate'][0], 
        usersRatingsCountByAge['20-39']['pulse_rate'][0],
        usersRatingsCountByAge['40-59']['pulse_rate'][0],
        usersRatingsCountByAge['60-79']['pulse_rate'][0],
        usersRatingsCountByAge['80-above']['pulse_rate'][0]
      ],
      backgroundColor: ['#FFB600'],
      borderColor: ['#FFB600']
    }, {
      label: 'Normal',
      data: [
        usersRatingsCountByAge['0-19']['pulse_rate'][1], 
        usersRatingsCountByAge['20-39']['pulse_rate'][1],
        usersRatingsCountByAge['40-59']['pulse_rate'][1],
        usersRatingsCountByAge['60-79']['pulse_rate'][1],
        usersRatingsCountByAge['80-above']['pulse_rate'][1]
      ],
      backgroundColor: ['#A6CE39'],
      borderColor: ['#A6CE39'] 
    }, {
      label: 'Above Normal',
      data: [
        usersRatingsCountByAge['0-19']['pulse_rate'][2], 
        usersRatingsCountByAge['20-39']['pulse_rate'][2],
        usersRatingsCountByAge['40-59']['pulse_rate'][2],
        usersRatingsCountByAge['60-79']['pulse_rate'][2],
        usersRatingsCountByAge['80-above']['pulse_rate'][2]
      ],
      backgroundColor: ['#990711'],
      borderColor: ['#990711']
    }]
  }

  const pulseRateByAgeConfig = {
    type: 'bar',
    data: pulseRateByAgeData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Users Pulse Rate Rating Pervasiveness by Age'
        },
      },
      responsive: true,
      scales: {
        x: {
          stacked: true,
          title: {
            display: true,
            text: 'Age'
          }
        },
        y: {
          stacked: true,
          title: {
            display: true,
            text: 'User'
          }
        }
      }
    }
  };

  const bloodPressureByAgeData = {
    labels: ['0-19', '20-39', '40-59', '60-79', '80 and above'],
    datasets: [{
      label: 'Normal',
      data: [
        usersRatingsCountByAge['0-19']['blood_pressure'][0], 
        usersRatingsCountByAge['20-39']['blood_pressure'][0],
        usersRatingsCountByAge['40-59']['blood_pressure'][0],
        usersRatingsCountByAge['60-79']['blood_pressure'][0],
        usersRatingsCountByAge['80-above']['blood_pressure'][0]
      ],
      backgroundColor: ['#A6CE39'],
      borderColor: ['#A6CE39']
    }, {
      label: 'Elevated Blood Pressure',
      data: [
        usersRatingsCountByAge['0-19']['blood_pressure'][1], 
        usersRatingsCountByAge['20-39']['blood_pressure'][1],
        usersRatingsCountByAge['40-59']['blood_pressure'][1],
        usersRatingsCountByAge['60-79']['blood_pressure'][1],
        usersRatingsCountByAge['80-above']['blood_pressure'][1]
      ],
      backgroundColor: ['#FFEC01'],
      borderColor: ['#FFEC01'] 
    }, {
      label: 'Hypertension Stage I',
      data: [
        usersRatingsCountByAge['0-19']['blood_pressure'][2], 
        usersRatingsCountByAge['20-39']['blood_pressure'][2],
        usersRatingsCountByAge['40-59']['blood_pressure'][2],
        usersRatingsCountByAge['60-79']['blood_pressure'][2],
        usersRatingsCountByAge['80-above']['blood_pressure'][2]
      ],
      backgroundColor: ['#FFB600'],
      borderColor: ['#FFB600']
    }, {
      label: 'Hypertension Stage II',
      data: [
        usersRatingsCountByAge['0-19']['blood_pressure'][3], 
        usersRatingsCountByAge['20-39']['blood_pressure'][3],
        usersRatingsCountByAge['40-59']['blood_pressure'][3],
        usersRatingsCountByAge['60-79']['blood_pressure'][3],
        usersRatingsCountByAge['80-above']['blood_pressure'][3]
      ],
      backgroundColor: ['#BB3A01'],
      borderColor: ['#BB3A01']
    }, {
      label: 'Hypertensive Crisis',
      data: [
        usersRatingsCountByAge['0-19']['blood_pressure'][4], 
        usersRatingsCountByAge['20-39']['blood_pressure'][4],
        usersRatingsCountByAge['40-59']['blood_pressure'][4],
        usersRatingsCountByAge['60-79']['blood_pressure'][4],
        usersRatingsCountByAge['80-above']['blood_pressure'][4]
      ],
      backgroundColor: ['#990711'],
      borderColor: ['#990711']  
    }]
  }

  const bloodPressureByAgeConfig = {
    type: 'bar',
    data: bloodPressureByAgeData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Users Blood Pressure Rating Pervasiveness by Age'
        },
      },
      responsive: true,
      scales: {
        x: {
          stacked: true,
          title: {
            display: true,
            text: 'Age'
          }
        },
        y: {
          stacked: true,
          title: {
            display: true,
            text: 'User'
          }
        }
      }
    }
  };

  const bloodSaturationByAgeData = {
    labels: ['0-19', '20-39', '40-59', '60-79', '80 and above'],
    datasets: [{
      label: 'Below Normal',
      data: [
        usersRatingsCountByAge['0-19']['blood_saturation'][0], 
        usersRatingsCountByAge['20-39']['blood_saturation'][0],
        usersRatingsCountByAge['40-59']['blood_saturation'][0],
        usersRatingsCountByAge['60-79']['blood_saturation'][0],
        usersRatingsCountByAge['80-above']['blood_saturation'][0]
      ],
      backgroundColor: ['#FFB600'],
      borderColor: ['#FFB600']
    }, {
      label: 'Normal',
      data: [
        usersRatingsCountByAge['0-19']['blood_saturation'][1], 
        usersRatingsCountByAge['20-39']['blood_saturation'][1],
        usersRatingsCountByAge['40-59']['blood_saturation'][1],
        usersRatingsCountByAge['60-79']['blood_saturation'][1],
        usersRatingsCountByAge['80-above']['blood_saturation'][1]
      ],
      backgroundColor: ['#A6CE39'],
      borderColor: ['#A6CE39'] 
    }, {
      label: 'Above Normal',
      data: [
        usersRatingsCountByAge['0-19']['blood_saturation'][2], 
        usersRatingsCountByAge['20-39']['blood_saturation'][2],
        usersRatingsCountByAge['40-59']['blood_saturation'][2],
        usersRatingsCountByAge['60-79']['blood_saturation'][2],
        usersRatingsCountByAge['80-above']['blood_saturation'][2]
      ],
      backgroundColor: ['#990711'],
      borderColor: ['#990711']
    }]
  }

  const bloodSaturationByAgeConfig = {
    type: 'bar',
    data: bloodSaturationByAgeData,
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Users Blood Saturation Rating Pervasiveness by Age'
        },
      },
      responsive: true,
      scales: {
        x: {
          stacked: true,
          title: {
            display: true,
            text: 'Age'
          }
        },
        y: {
          stacked: true,
          title: {
            display: true,
            text: 'User'
          }
        }
      }
    }
  };

  var usersRatingByAgeChart = new Chart(
    document.getElementById('usersRatingByAgeChart'),
    pulseRateByAgeConfig
  );
  function showUsersRatingByAgeChart(id) {
    usersRatingByAgeChart.destroy();
    if (id == 'pulseRateByAge') {
      usersRatingByAgeChart = new Chart(
        document.getElementById('usersRatingByAgeChart'),
        pulseRateByAgeConfig
      );
    }
    else if (id == 'bloodPressureByAge') {
      usersRatingByAgeChart = new Chart(
        document.getElementById('usersRatingByAgeChart'),
        bloodPressureByAgeConfig
      );
    }
    else if (id == 'bloodSaturationByAge') {
      usersRatingByAgeChart = new Chart(
        document.getElementById('usersRatingByAgeChart'),
        bloodSaturationByAgeConfig
      );
    }
  }
  document.getElementById("showPulseRateByAge").addEventListener("click", function() {
    showUsersRatingByAgeChart("pulseRateByAge");
  });
  document.getElementById("showBloodPressureByAge").addEventListener("click", function() {
    showUsersRatingByAgeChart("bloodPressureByAge");
  });
  document.getElementById("showBloodSaturationByAge").addEventListener("click", function() {
    showUsersRatingByAgeChart("bloodSaturationByAge");
  });
</script>
@endsection