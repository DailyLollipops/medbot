@extends('layout',[$style = 'doctor/dashboards', $title = 'Dashboard'])

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
            <p class="u-custom-item u-text u-text-default-xl u-text-5">

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
  <div class="u-clearfix u-sheet u-valign-middle-xs u-sheet-1">
    <div class="u-expanded-width-sm u-expanded-width-xs u-form u-form-1">
      <form id="form" action="#" method="GET" onsubmit="select_area()" class="u-clearfix u-form-horizontal u-form-spacing-10 u-inner-form" name="form" style="padding: 10px;">
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
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret">
              <path fill="currentColor" d="M4 8L0 4h8z"></path>
            </svg>
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
        <input id="address" name="address" style="display: none;">
        <div class="u-align-left u-form-group u-form-submit u-label-none">
          <a href="#" class="u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-dark-1 u-palette-1-light-1 u-radius-15 u-text-hover-palette-2-light-1 u-btn-1">
            <span class="u-file-icon u-icon">
              <img src="{{ asset('images/location.png') }}" alt="">
            </span>
            &nbsp;Select
          </a>
          <input type="submit" value="submit" class="u-form-control-hidden">
        </div>
      </form>
    </div>
    <h4 class="u-text u-text-default u-text-1">Users Overview ({{$current_users}} out of {{$total_users}} users)</h4>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-1">
          <div class="u-container-layout u-similar-container u-valign-middle-sm u-valign-middle-xs u-container-layout-1">
            <h5 class="u-align-center u-text u-text-2">Pulse Rate</h5>
            <span class="u-file-icon u-icon u-icon-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/pulse_rate.png') }}" alt="">
            </span>
            <p class="u-align-center u-heading-font u-text u-text-3">{{$users_average_pulse_rate}} bpm</p>

              @if($users_average_pulse_rate < 60)
                <h5 class="u-align-center u-text u-text-4">
                  <span class="u-file-icon u-icon">
                    <img src="{{ asset('images/sad.png') }}" alt="">
                  </span>&nbsp;
                  <span class="u-text-palette-1-base">&nbsp;B​elo​w Normal</span>
                </h5>
              @elseif($users_average_pulse_rate < 100)
                <h5 class="u-align-center u-text u-text-4">
                  <span class="u-file-icon u-icon">
                    <img src="{{ asset('images/happy.png') }}" alt="">
                  </span>&nbsp;
                  <span class="u-text-custom-color-9">Normal</span>
                </h5>
              @else
                <h5 class="u-align-center u-text u-text-4">
                  <span class="u-file-icon u-icon">
                    <img src="{{ asset('images/shocked.png') }}" alt="">
                  </span>&nbsp;
                  <span class="u-text-custom-color-1">Above Normal</span>
                </h5>
              @endif    

          </div>
        </div>
        <div class="u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-1">
          <div class="u-container-layout u-similar-container u-valign-middle-sm u-valign-middle-xs u-container-layout-1">
            <h5 class="u-align-center u-text u-text-2">Blood Pressure</h5>
            <span class="u-file-icon u-icon u-icon-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/blood_pressure.png') }}" alt="">
            </span>
            <p class="u-align-center u-heading-font u-text u-text-3">{{$users_average_systolic}}/{{$users_average_diastolic}} mmHg</p>

              @if($users_average_systolic < 60)
              <h5 class="u-align-center u-text u-text-4">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/sad.png') }}" alt="">
                </span>&nbsp;
                <span class="u-text-palette-1-base">&nbsp;B​elo​w Normal</span>
              </h5>
            @elseif($users_average_systolic <= 120)
              <h5 class="u-align-center u-text u-text-4">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/happy.png') }}" alt="">
                </span>&nbsp;
                <span class="u-text-custom-color-9">Normal</span>
              </h5>
            @else
              <h5 class="u-align-center u-text u-text-4">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/shocked.png') }}" alt="">
                </span>&nbsp;
                <span class="u-text-custom-color-1">Above Normal</span>
              </h5>
            @endif   

          </div>
        </div>
        <div class="u-border-1 u-border-palette-5-light-2 u-container-style u-list-item u-palette-5-light-3 u-radius-5 u-repeater-item u-shape-round u-list-item-1">
          <div class="u-container-layout u-similar-container u-valign-middle-sm u-valign-middle-xs u-container-layout-1">
            <h5 class="u-align-center u-text u-text-2">Blood Saturation</h5>
            <span class="u-file-icon u-icon u-icon-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              <img src="{{ asset('images/blood_saturation.png') }}" alt="">
            </span>
            <p class="u-align-center u-heading-font u-text u-text-3">{{$users_average_blood_saturation}} %</p>

              @if($users_average_blood_saturation < 95)
              <h5 class="u-align-center u-text u-text-4">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/sad.png') }}" alt="">
                </span>&nbsp;
                <span class="u-text-palette-1-base">&nbsp;B​elo​w Normal</span>
              </h5>
            @elseif($users_average_blood_saturation <= 100)
              <h5 class="u-align-center u-text u-text-4">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/happy.png') }}" alt="">
                </span>&nbsp;
                <span class="u-text-custom-color-9">Normal</span>
              </h5>
            @else
              <h5 class="u-align-center u-text u-text-4">
                <span class="u-file-icon u-icon">
                  <img src="{{ asset('images/shocked.png') }}" alt="">
                </span>&nbsp;
                <span class="u-text-custom-color-1">Above Normal</span>
              </h5>
            @endif   

          </div>
        </div>  
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-4">
        <canvas id="usersGenderCountChart"></canvas>
      </div>
    </div>
    <div class="u-border-1 u-border-grey-15 u-container-style u-group u-palette-5-light-3 u-radius-14 u-shape-round u-group-2">
      <div class="u-container-layout u-container-layout-5">
        <canvas id="usersByAgeChart"></canvas>
      </div>
    </div>
  </div>
</section>

{{-- Script Section --}}
<script>
function change_baranggay_dropdown(){
  municipality_dropdown = document.getElementById('municpality');
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
  baranggay_mogpog = ['All', 'Sibucao', 'Argao', 'Balanacan', 'Banto', 'Bintakay', 'Bocboc', 'Butansapa', 'Candahon',
                      'Capayang', 'Danao', 'Dulong Bayan', 'Gitnang Bayan', 'Guisian', 'Hinadharan', 'Hinanggayon',
                      'Ino', 'Janagdong', 'Lamesa', 'Laon', 'Magapua', 'Malayak', 'Malusak', 'Mampaitan',
                      'Mangyan-Mababad', 'Market Site', 'Mataas na Bayan', 'Mendez', 'Nangka I', 'Nangka II', 'Paye',
                      'Pili', 'Puting Buhangin', 'Sayao', 'Silangan', 'Sumangga', 'Tarug', 'Villa Mendez'];
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
  if(municipality.value == 'Gasan'){
    for(var i = 0; i < baranggay_gasan.length; i++){
      var option = document.createElement('option');
      option.value = baranggay_gasan[i];
      option.text = baranggay_gasan[i];
      baranggay_dropdown.appendChild(option);
    }
  }
  if(municipality.value == 'Boac'){
    for(var i = 0; i < baranggay_boac.length; i++){
      var option = document.createElement('option');
      option.value = baranggay_boac[i];
      option.text = baranggay_boac[i];
      baranggay_dropdown.appendChild(option);
    }
  }
  if(municipality.value == 'Mogpog'){
    for(var i = 0; i < baranggay_mogpog.length; i++){
      var option = document.createElement('option');
      option.value = baranggay_mogpog[i];
      option.text = baranggay_mogpog[i];
      baranggay_dropdown.appendChild(option);
    }
  }
  if(municipality.value == 'Sta. Cruz'){
    for(var i = 0; i < baranggay_stacruz.length; i++){
      var option = document.createElement('option');
      option.value = baranggay_stacruz[i];
      option.text = baranggay_stacruz[i];
      baranggay_dropdown.appendChild(option);
    }
  }
  if(municipality.value == 'Torrijos'){
    for(var i = 0; i < baranggay_torrijos.length; i++){
      var option = document.createElement('option');
      option.value = baranggay_torrijos[i];
      option.text = baranggay_torrijos[i];
      baranggay_dropdown.appendChild(option);
    }
  }
  if(municipality.value == 'Buenavista'){
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
  municipality = document.getElementById('municipality').value;
  baranggay = document.getElementById('baranggay').value;
  address = document.getElementById('address');
  address.value = baranggay + ', ' + municipality;
  select_area_form.submit();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

  // Address Title
  var address = {{Js::from($address)}};

  // Monthly New Users Per Month Chart Variables
  const monthlyNewUsersPerMonth = {{Js::from($monthly_new_users_per_month)}};

  // Users by Age Chart Variables
  const usersByAge = {{Js::from($users_by_age)}};

  const usersGenderCount = {{Js::from($users_gender_count)}};

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

  const usersGenderCountChart = new Chart(
    document.getElementById('usersGenderCountChart'),
    usersGenderCountConfig
  );
</script>
@endsection