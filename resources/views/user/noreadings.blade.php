@extends('layout',[$style = 'user/noreadings', $title = 'Dashboard'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-c134">
  <div class="u-clearfix u-sheet u-sheet-1">
    <img class="u-image u-image-contain u-image-default u-image-1" src="{{ asset('images/nothing_found.png') }}" alt="" data-image-width="411" data-image-height="250">
    <h4 class="u-text u-text-default-lg u-text-default-md u-text-default-xl u-text-1">It seems you haven't taken any readings yet that's why we<br>can't display anything here</h4>
    <h4 class="u-text u-text-default u-text-2">Suggestions:</h4>
    <ul class="u-text u-text-3">
      <li>
        <span style="font-size: 24px;">Visit your local Med-bot and start measuring your vital signs</span>
      </li>
    </ul>
  </div>
</section>
@endsection