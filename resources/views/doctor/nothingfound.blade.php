@extends('layout',[$style = 'doctor/nothingfound', $title = 'Users List'])

@section('content')
<section class="u-clearfix u-section-1" id="sec-c134">
  <div class="u-clearfix u-sheet u-sheet-1">
    <img class="u-image u-image-contain u-image-default u-image-1" src="images/nothing_found.png" alt="" data-image-width="411" data-image-height="250">
    <h4 class="u-text u-text-default-lg u-text-default-md u-text-default-xl u-text-1">Your search for <span style="font-weight: 700;">"{{$search}}"</span> did not match any results
    </h4>
    <h4 class="u-text u-text-default u-text-2">Suggestions:</h4>
    <ul class="u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-3">
      <li>
        <span style="font-size: 1.5rem;">Make sure the word is spelled correctly</span>
      </li>
      <li>
        <span style="font-size: 24px;">Try a different keyword</span>
      </li>
      <li>
        <span style="font-size: 24px;">Use a different search filter</span>
      </li>
    </ul>
  </div>
</section>
@endsection