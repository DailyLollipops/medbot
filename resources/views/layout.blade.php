<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Med-bot, Your Partner in Health">
    <meta name="theme-color" content="#478ac9">

    <title>{{$title}}</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/'.$style.'.css') }}" media="screen">

    <script class="u-script" type="text/javascript" src="{{ asset('js/jquery.js') }}" "="" defer=""></script>
    <script class="u-script" type="text/javascript" src="{{ asset('js/styles.js') }}" "="" defer=""></script>

    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster:400">
    
    <script type="application/ld+json">{
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "",
      "logo": "images/logo.png"
    }
    </script>
  </head>

  <body class="u-body u-xl-mode" data-lang="en">

    @auth
      <x-headerAuth/>
    @else
      <x-header/>
    @endauth
    
    @yield('content')   
    
    <x-footer/>
    
  </body>
</html>