@extends('layout',[$style = 'doctor/userlist', $title = 'User List'])

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/pagination.css') }}">

@php
  use Carbon\Carbon;
@endphp

<section class="u-clearfix u-section-1" id="sec-0835">
  <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-expanded-width-xs u-form u-form-1">
      <form action="#" method="GET" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" name="form" style="padding: 10px;">
        <div class="u-form-group u-form-select u-label-none u-form-group-1">
          <label for="select-9d42" class="u-custom-font u-heading-font u-label u-label-1">Dropdown</label>
          <div class="u-form-select-wrapper">
            <select id="order_select" name="order" onchange="submitAll()" class="u-border-3 u-border-palette-5-light-1 u-custom-font u-input u-input-rectangle u-radius-31 u-text-black u-text-font u-white u-input-1">
              <option value="">Order by...</option>
              <option value="name-asc">Name (A-Z)</option>
              <option value="name-desc">Name (Z-A)</option>
              <option value="birthday-desc">Youngest</option>
              <option value="birthday-asc">Oldest</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
          </div>
        </div>
      </form>
    </div>
    <h4 class="u-text u-text-default u-text-1">Order by:</h4>
    <div class="u-expanded-width-lg u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        @foreach($users as $user)
        <div class="u-align-left u-container-style u-list-item u-palette-5-light-3 u-radius-10 u-repeater-item u-shape-round u-list-item-1" data-animation-name="" data-animation-duration="0" data-animation-direction="">
          <a href="{{'/medbot/public/userlist/id-'.$user->id}}" style="text-decoration: none; color: inherit">
            <div class="u-container-layout u-similar-container u-container-layout-1">
              <p class="u-text u-text-2">{{$user->name}}</p>
              <img class="u-image u-image-circle u-preserve-proportions u-image-1" src="{{ $user->profile_picture_path ? asset('storage/'.$user->profile_picture_path) : asset('images/blank_profile.png') }}" alt="" data-image-width="640" data-image-height="640">
              <p class="u-text u-text-3">{{Carbon::parse($user->birthday)->age}} years old</p>
              <p class="u-text u-text-4">{{ucfirst($user->gender)}}</p>
              <p class="u-text u-text-5">{{$user->baranggay}}, {{$user->municipality}}</p>
              <blockquote class="u-text u-text-6">{{$user->bio}}</blockquote>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
    {{$users->links('pagination::custom')}} 
  </div>
</section>
@endsection