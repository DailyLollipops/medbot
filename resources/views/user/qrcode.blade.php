<html>
  <head>
      @if(Session::has('link'))
         <meta http-equiv="refresh" content="1;url={{ '/manage/update/password/download/'.Session::get('link') }}">
      @endif
   <head>
   <body>
      Downloading please wait...
      <script>
         setTimeout(function(){
            window.location.href = '/';
         }, 2000);
      </script>
   </body>
</html>