@extends('layout',[$style = 'main/registration', $title = 'Register'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-e07b">
  <div class="u-align-left u-clearfix u-sheet u-sheet-1">
    <div class="u-border-2 u-border-palette-1-base u-container-style u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-radius-50 u-shape-round u-white u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <span class="u-file-icon u-icon u-icon-circle u-palette-1-base u-icon-1">
          <img src="{{ asset('images/register1.png') }}" alt="">
        </span>
        <h2 class="u-align-center u-text u-text-default u-text-palette-2-base u-text-1">Register Now</h2>
        <div class="u-form u-form-1">
          <form action="/medbot/public/register/store" method="POST" enctype="multipart/form-data" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" name="form" style="padding: 10px;">
          @csrf
            <input type="text" name="null" value="null" style="display: none;">
            <div class="u-form-group u-form-partition-factor-3 u-form-select u-form-group-6">
              <div class="u-form-group u-form-name">
                <label for="name" class="u-label">First Name</label>
                <input type="text" placeholder="Enter your Name" id="first_name" name="first_name" value="{{old('first_name')}}" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white" required="">
              </div>
            </div>
            <div class="u-form-group u-form-partition-factor-3 u-form-select u-form-group-6">
              <div class="u-form-group u-form-name">
                <label for="name" class="u-label">Middle Initial</label>
                <input type="text" placeholder="Enter your Name" id="middle_initial" name="middle_initial" value="{{old('middle_initial')}}" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white" required="">
              </div>
            </div>
            <div class="u-form-group u-form-partition-factor-3 u-form-select u-form-group-6">
              <div class="u-form-group u-form-name">
                <label for="name" class="u-label">Last Name</label>
                <input type="text" placeholder="Enter your Name" id="last_name" name="last_name" value="{{old('last_name')}}" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white" required="">
              </div>
            </div>
            <div class="u-form-group u-form-partition-factor-2 u-form-select u-form-group-2">
              <label for="gender" class="u-label">Gender</label>
              <div class="u-form-select-wrapper">
                <select id="gender" name="gender" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white">
                  <option value="null">Select gender...</option>
                  <option value="male" {{"male" === old('gender') ? 'selected': ''}}>Male</option>
                  <option value="female" {{"female" === old('gender') ? 'selected': ''}}>Female</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
              </div>
            </div>
            <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-3">
              <label for="birthday" class="u-label">Birthday</label>
              <input type="date" placeholder="MM/DD/YYYY" id="birthday" name="birthday" value="{{old('birthday')}}" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white" required="">
            </div>
            <div class="u-form-group u-form-partition-factor-3 u-form-phone u-form-group-4">
              <label for="phone_number" class="u-label">Phone</label>
              <input type="tel" pattern="\+?\d{0,3}[\s\(\-]?([0-9]{2,3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Enter your phone (e.g. +14155552675)" id="phone_number" name="phone_number" value="{{old('phone_number')}}" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white" required="">
            </div>
            <div class="u-form-group u-form-partition-factor-3 u-form-select u-form-group-5">
              <label for="municipality" class="u-label">Municipality</label>
              <div class="u-form-select-wrapper">
                <select id="municipality" name="municipality" onchange="change_baranggay_dropdown()" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white" required="required">
                  <option value="null">Select Municipality...</option>
                  <option value="Boac" {{"Boac" === old('municipality') ? 'selected': ''}}>Boac</option>
                  <option value="Buenavista" {{"Buenavista" === old('municipality') ? 'selected': ''}}>Buenavista</option>
                  <option value="Gasan" {{"Gasan" === old('municipality') ? 'selected': ''}}>Gasan</option>
                  <option value="Mogpog" {{"Mogpog" === old('municipality') ? 'selected': ''}}>Mogpog</option>
                  <option value="Sta. Cruz" {{"Sta.Cruz" === old('municipality') ? 'selected': ''}}>Sta. Cruz</option>
                  <option value="Torrijos" {{"Torrijos" === old('municipality') ? 'selected': ''}}>Torrijos</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
              </div>
            </div>
            <div class="u-form-group u-form-partition-factor-3 u-form-select u-form-group-6">
              <label for="baranggay" class="u-label">Baranggay</label>
              <div class="u-form-select-wrapper">
                <select id="baranggay" name="baranggay" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white" required="required">
                  <option value="null">Select Municipality First</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
              </div>
            </div>
            <div class="u-form-email u-form-group">
              <label for="email" class="u-label">Email</label>
              <input type="email" placeholder="Enter a valid email address" id="email" name="email" value="{{old('email')}}" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white" required="">
            </div>
            <div class="u-form-group u-form-partition-factor-2 u-form-group-8">
              <label for="password" class="u-label">Password</label>
              <input type="password" placeholder="Enter your password" id="password" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white">
            </div>
            <div class="u-form-group u-form-partition-factor-2 u-form-group-9">
              <label for="password-confirmation" class="u-label">Confirm Password</label>
              <input type="password" placeholder="Confirm your password" id="password_confirmation" name="password_confirmation" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white">
            </div>
            <div class="u-form-group u-form-message">
              <label for="bio" class="u-label">Bio (optional)</label>
              <textarea placeholder="Say something about yourself" rows="4" cols="50" id="bio" name="bio" value="{{old('bio')}}" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-10 u-white" required="" maxlength="200"></textarea>
            </div>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/png, image/gif, image/jpeg" style="display:none" onchange="changeImage(event)"/>
            <div class="u-align-center u-form-group u-form-submit">
              <a href="#" class="u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-dark-1 u-palette-2-base u-radius-10 u-btn-1">
                <span class="u-file-icon u-icon u-icon-2">
                  <img src="{{ asset('images/register2.png') }}" alt="">
                </span>
                &nbsp;​&nbsp;Register
              </a>
              <input type="submit" value="submit" onclick="this.form.submit()" class="u-form-control-hidden">
            </div>
          </form>
        </div>
        <img id="profile_picture_holder" class="u-border-2 u-border-grey-75 u-image u-image-circle u-preserve-proportions u-image-1" src="{{ asset('images/blank_profile.png') }}" alt="" data-image-width="640" data-image-height="640">
        <a href="#" onclick="$('#profile_picture').trigger('click'); return false;" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-2">Add PIcture</a>
        <p class="u-small-text u-text u-text-default u-text-variant u-text-2">(optional)</p>
      </div>
    </div>
  </div>
</section>

<script>
  var changeImage = function(event) {
    var profile_picture_holder = document.getElementById('profile_picture_holder');
    profile_picture_holder.src = URL.createObjectURL(event.target.files[0]);
    profile_picture_holder.onload = function() {
      URL.revokeObjectURL(profile_picture_holder.src) // free memory
    }
  };
  function change_baranggay_dropdown(){
    municipality_dropdown = document.getElementById('municipality');
    baranggay_dropdown = document.getElementById('baranggay');
    baranggay_gasan = ['Antipolo', 'Bachao Ibaba', 'Bachao Ilaya', 'Bacong-bacong', 'Bahi', 'Bangbang', 'Banot',
                        'Banuyo', 'Bognuyan', 'Cabugao', 'Dawis', 'Dili', 'Libtangin', 'Mahunig', 'Mangiliol',
                        'Masiga', 'Mt. Gasan', 'Pangi', 'Pinggan', 'Tabionan', 'Tapuyan', 'Tiguion',
                        'Baranggay I', 'Baranggay II', 'Baranggay III'];
    baranggay_boac = ['Agot', 'Agumaymayan', 'Amoingon', 'Apitong', 'Balagasan', 'Balaring', 'Balimbing', 'Balogo',
                        'Bamban', 'Bangbangalon', 'Bantad', 'Bantay', 'Bayuti', 'Binunga', 'Boi', 'Boton', 
                        'Buliasnin', 'Bunganay', 'Caganhao', 'Canat', 'Catubugan', 'Cawit', 'Daig', 'Daypay',
                        'Duyay', 'Hinapulan', 'Ihatub', 'Isok 1', 'Isok 2', 'Laylay', 'Lupac', 'Mahinhin',
                        'Mainit', 'Malbog', 'Maligaya', 'Malusak', 'Mansiwat', 'Mataas na Bayan', 'Maybo', 'Mercado', 
                        'Murallon', 'Ogbac', 'Pawa', 'Pili', 'Poctoy', 'Poras', 'Puting Buhangin', 'Puyog', 'Sabong', 
                        'San Miguel', 'Santol', 'Sawi', 'Tabi', 'Tabigue', 'Tagwak', 'Tambunan', 'Tampus', 'Tanza',
                        'Tugos', 'Tumagabok', 'Tumapon'];
    baranggay_buenavista = ['Bagacay', 'Bagtingon', 'Bicas-bicas', 'Caigangan', 'Daykitin', 'Libas', 'Malbog', 'Sihi',
                        'Timbo', 'Lipata', 'Yook', 'Baranggay I', 'Baranggay II', 'Baranggay III', 'Baranggay IV'];
    baranggay_mogpog = ['Argao', 'Balanacan', 'Banto', 'Bintakay', 'Bocboc', 'Butansapa', 'Candahon',
                        'Capayang', 'Danao', 'Dulong Bayan', 'Gitnang Bayan', 'Guisian', 'Hinadharan', 'Hinanggayon',
                        'Ino', 'Janagdong', 'Lamesa', 'Laon', 'Magapua', 'Malayak', 'Malusak', 'Mampaitan',
                        'Mangyan-Mababad', 'Market Site', 'Mataas na Bayan', 'Mendez', 'Nangka I', 'Nangka II', 'Paye',
                        'Pili', 'Puting Buhangin', 'Sayao', 'Sibucao', 'Silangan', 'Sumangga', 'Tarug', 'Villa Mendez'];
    baranggay_stacruz = ['Alobo', 'Angas', 'Aturan', 'Bagong Silangan', 'Baguidbirin', 'Baliis', 'Balogo', 'Banahaw',
                        'Bangcuangan', 'Biga', 'Botilao', 'Buyabod', 'Dating Bayan', 'Devilla', 'Dolores', 'Haguimit',
                        'Hupi', 'Ipil', 'Jolo', 'Kaganhao', 'Kalangkang', 'Kamandugan', 'Kasily', 'Kilo-kilo',
                        'Kinyaman', 'Labo', 'Lamesa', 'Landy', 'Lapu-lapu', 'Libjo', 'Lipa', 'Lusok', 'Maharlika',
                        'Makulapnit', 'Maniwaya', 'Manlibunan', 'Masaguisi', 'Masalukot', 'Matalaba', 'Mongpong',
                        'Morales', 'Napo', 'Pag-asa', 'Pantayin', 'Polo', 'Pulong-parang', 'Punong', 'San Antonio',
                        'San Isidro', 'Tagum', 'Tamayo', 'Tambangan', 'Tawiran', 'Taytay'];
    baranggay_torrijos = ['Bangwayin', 'Bayakbakin', 'Bolo', 'Bonliw', 'Buangan', 'Cabuyo', 'Cagpo', 'Dampulan', 'Kay Duke',
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
        option.value = baranggay_buenavista[i];                        ;
        option.text = baranggay_buenavista[i];
        baranggay_dropdown.appendChild(option);
      }
    }
  }
  function on_failure(){
    var test = {{Js::from(old('baranggay') )}};
    var municipality = {{Js::from(old('municipality'))}};
    if(test != null){
      change_baranggay_dropdown();
      var dropdown = document.getElementById('baranggay');
      dropdown.value = {{Js::from(old('baranggay') )}};
    }
  }
  on_failure();
</script>
@endsection