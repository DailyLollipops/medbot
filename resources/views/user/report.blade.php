<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reading #{{$id}} Report</title>
    <link href="{{ asset('css/user/report.css') }}" rel="stylesheet">
  </head>
  <body>
    <div id="wb_Text1" style="position:absolute;left:197px;top:49px;width:384px;height:36px;z-index:1;">
      <span style="color:#000000;font-family:Arial;font-size:32px;">
        <strong>Med-bot Reading Report</strong>
      </span>
    </div>
    <hr id="Line1" style="position:absolute;left:75px;top:93px;width:582px;z-index:2;">
    <div id="wb_Text2" style="position:absolute;left:75px;top:127px;width:256px;height:24px;z-index:3;">
      <span style="color:#000000;font-family:Arial;font-size:21px;">
        <strong>Date Taken: {{$date}}</strong>
      </span>
    </div>
    <div id="wb_Image1" style="position:absolute;left:152px;top:41px;width:45px;height:44px;z-index:4;">
      <img src="images/logo.png" id="Image1" alt="" width="45" height="43">
    </div>
    <div id="wb_Text3" style="position:absolute;left:75px;top:151px;width:250px;height:120px;z-index:5;">
      <span style="color:#000000;font-family:Georgia;font-size:13px;line-height:24px;">
        Name: {{$name}}<br>
        Age: {{$age}} years old<br>
        Pulse Rate: {{$pulse_rate}} bpm<br>
        Blood Pressure: {{$systolic}}/{{$diastolic}} mmHg<br>
        Blood Saturation: {{$blood_saturation}}%
      </span>
    </div>
    <div id="wb_Text4" style="position:absolute;left:403px;top:271px;width:254px;height:15px;text-align:right;z-index:6;">
      <span style="color:#000000;font-family:Arial;font-size:13px;">
        &quot;Your Partner in Health&quot;
      </span>
    </div>
    <hr id="Line2" style="position:absolute;left:75px;top:310px;width:582px;z-index:7;">
  </body>
</html>