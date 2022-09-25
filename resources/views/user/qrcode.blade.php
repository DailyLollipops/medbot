<html>
  <head>
      @if(Session::has('link'))
         <meta http-equiv="refresh" content="1;url={{ '/medbot/public/manage/user/update/password/download/'.Session::get('link') }}">
      @endif
   <head>
   <body>
      Downloading please wait...
      <script>
         setTimeout(function(){
            window.location.href = '/medbot/public/manage/user/update';
         }, 2000);
      </script>
   </body>
</html>