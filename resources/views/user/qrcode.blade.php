<html>
  <head>
      @if(Session::has('link'))
         <meta http-equiv="refresh" content="5;url={{ '/medbot/public/manage/update/password/download/'.Session::get('link') }}">
      @endif
   <head>

   <body>
      ...
   </body>
</html>