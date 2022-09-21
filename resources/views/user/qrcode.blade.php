<html>
  <head>
      @if(Session::has('link'))
         <meta http-equiv="refresh" content="1;url={{ '/medbot/public/manage/update/password/download/'.Session::get('link') }}">
      @else
         <meta http-equiv="refresh" content="5;url='/medbot/public/manage/update">
      @endif
   <head>

   <body>
      ...
      <script>
         @php
            flash()->addSuccess('Password Changed Successfully');
         @endphp
         setTimeout(function(){
            window.location.href = '/medbot/public/manage/update';
         }, 1000);
      </script>
   </body>
</html>