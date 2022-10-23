@extends('layout',[$style = 'doctor/updateinfo', $title = 'Update Info'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-4a91">
  <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-sheet-1">
    <h3 class="u-text u-text-default u-text-1">Edit Profile Information</h3>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-container-style u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <div class="u-form u-form-1">
          <form action="/medbot/public/update/info" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" id="informationform" name="form-1" style="padding: 10px;">
          @csrf 
            <div class="u-form-group u-form-name u-label-top">
              <label for="name" class="u-label u-label-1">Name</label>
              <input type="text" id="name" placeholder="Enter your Name" value="{{$user_name}}" name="name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
            </div>
            <div class="u-form-group u-form-partition-factor-2 u-form-select u-label-top u-form-group-2">
              <label for="gender" class="u-label u-label-2">Gender</label>
              <div class="u-form-select-wrapper">
                <select id="gender" value="{{$user_gender}}" name="gender" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-radius-15">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
              </div>
            </div>
            <div class="u-form-date u-form-group u-form-partition-factor-2 u-label-top u-form-group-3">
              <label for="birthday" class="u-label u-label-3">Birthday</label>
              <input type="date" id="birthday" placeholder="MM/DD/YYYY" value="{{$user_birthday}}"name="birthday" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
            </div>
            <div class="u-form-email u-form-group u-form-partition-factor-3 u-label-top">
              <label for="baranggay" class="u-label u-label-4">Baranggay</label>
              <select id="baranggay" placeholder="Enter your current home address" value="{{$user_baranggay}}" name="baranggay" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
                <option value="test"> Test </option>
              </select>
            </div>
            <div class="u-form-email u-form-group u-form-partition-factor-3 u-label-top">
              <label for="municipality" class="u-label u-label-4">Municipality</label>
              <select id="municipality" placeholder="Enter your current home address" value="{{$user_municipality}}" name="municipality" onchange="change_baranggay_dropdown()" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
                <option value="Boac"> Boac </option>
                <option value="Buenavista"> Buenavista </option>
                <option value="Gasan"> Gasan </option>
                <option value="Mogpog"> Mogpog </option>
                <option value="Sta. Cruz"> Sta. Cruz </option>
                <option value="Torrijos"> Torrijos </option>
              </select>    
            </div>
            <div class="u-form-group u-form-partition-factor-3 u-form-phone u-label-top u-form-group-5">
              <label for="phone" class="u-label u-label-5">Phone</label>
              <input type="tel" id="phone" pattern="\+?\d{0,3}[\s\(\-]?([0-9]{2,3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Enter your phone (e.g. +14155552675)" value="{{$user_phone}}" name="phone_number" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="">
            </div>
            <div class="u-form-group u-label-top">
              <label for="email" class="u-label u-label-6">Email Address</label>
              <input type="email" id="email" value="{{$user_email}}" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" placeholder="Enter a valid email address">
            </div>
            <div class="u-form-group u-form-message u-label-top u-form-group-7">
              <label for="bio" class="u-label u-label-7">Bio</label>
              <textarea id="bio" placeholder="Enter a short message about yourself (up to 200 characters)" rows="4" cols="50" value="{{$user_bio}}" name="bio" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required=""></textarea>
            </div>
            <div class="u-align-right u-form-group u-form-submit u-label-top">
              <input type="submit" value="submit" class="u-form-control-hidden">
              <a href="#" onclick="document.getElementById('informationform').submit()" id="submitinfo" class="u-btn u-btn-round u-btn-submit u-button-style u-radius-25">Update Info</a>
            </div>
          </form>
        </div>
        <div class="u-container-style u-group u-palette-5-light-3 u-group-2">
          <div class="u-container-layout u-valign-middle u-container-layout-2">
            <form action="/medbot/public/update/profile_picture" method="POST" enctype="multipart/form-data">
            @csrf
              <input type="file" name="profile_picture" id="profile_picture" accept="image/png, image/gif, image/jpeg" style="display:none" onchange="this.form.submit()"/>
              <img class="u-border-2 u-border-grey-75 u-image u-image-circle u-preserve-proportions u-image-1" src="{{ $user_profile ? asset('storage/'.$user_profile) : asset('images/blank_profile.png') }}" alt="" data-image-width="128" data-image-height="128" style="cursor: pointer">
              <a href="#" onclick="$('#profile_picture').trigger('click'); return false;" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50 u-btn-2">Update</a></label>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="u-clearfix u-section-2" id="carousel_adfa">
  <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
    <h3 class="u-text u-text-default u-text-1">Change Password</h3>
    <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
    <div class="u-container-style u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-palette-5-light-3 u-radius-10 u-shape-round u-group-1">
      <div class="u-container-layout u-container-layout-1">
        <div class="u-form u-form-1">
          <form id="passwordform" action="/medbot/public/update/password" method="POST" class="u-clearfix u-form-spacing-30 u-form-vertical u-inner-form" source="email" name="form-1" style="padding: 10px;">
          @csrf  
            <div class="u-form-group u-form-name u-form-partition-factor-3 u-label-top">
              <label for="current-password" class="u-label">Current Password</label>
              <input type="password" placeholder="Enter your current password" id="current-password" name="current_password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="true">
            </div>
            <div class="u-form-group u-form-partition-factor-3 u-label-top u-form-group-2">
              <label for="new-password" class="u-label">New Password</label>
              <input type="password" placeholder="Enter new password" id="new-password" name="new_password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="true">
            </div>
            <div class="u-form-email u-form-group u-form-partition-factor-3 u-label-top">
              <label for="confirm-password" class="u-label">Confirm Password</label>
              <input type="password" placeholder="Confirm your new password" id="password-confirmation" name="password_confirmation" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-15 u-white" required="true">
            </div>
            <div class="u-align-center u-form-group u-form-submit u-label-top">
              <input type="submit" value="submit" class="u-form-control-hidden">
              <a href="#" onclick="validatePassword()" id="submitpassword" class="u-btn u-btn-round u-btn-submit u-button-style u-radius-25">Change Password</a>
            </div>
          </form>
        </div>
        <blockquote class="u-text u-text-2"> Please remember your password upon changing. The devs are so lazy to provide any reset password links</blockquote>
        <span class="u-file-icon u-icon u-icon-1">
          <img src="{{ asset('images/warning.png') }}" alt="">
        </span>
      </div>
    </div>
  </div>
</section>

<script>
  function validatePassword(){
    var currentPassword = document.getElementById('current-password').value;
    var newPassword = document.getElementById('new-password').value;
    var confirmPassword = document.getElementById('password-confirmation').value;
    if(currentPassword!='' && newPassword!='' && confirmPassword!=''){
      document.getElementById('passwordform').submit();
    }
  }

  function defaultDropdownValue(dropdownId, value){
    var temp = value;
    var mySelect = document.getElementById(dropdownId);
    for(var i, j = 0; i = mySelect.options[j]; j++) {
      if(i.value == temp) {
        mySelect.selectedIndex = j;
        break;
      }
    }
  }

  function defaultBio(){
    document.getElementById('bio').innerHTML = {{Js::from($user_bio)}}
  }

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
        option.value = baranggay_buenavista[i];
        option.text = baranggay_buenavista[i];
        baranggay_dropdown.appendChild(option);
      }
    }
  }

  defaultDropdownValue('municipality', {{Js::from($user_municipality)}});
  change_baranggay_dropdown()
  defaultDropdownValue('baranggay', {{Js::from($user_baranggay)}});
  defaultDropdownValue('gender',{{Js::from($user_gender)}});
  defaultBio();
</script>
@endsection