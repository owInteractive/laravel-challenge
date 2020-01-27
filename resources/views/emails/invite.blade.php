<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <style type="text/css" rel="stylesheet" media="all">

    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
      }
    }
  </style>
</head>

<?php

$style = [

  //
  'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
  'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

  //
  'email-masthead' => 'padding: 25px 0; text-align: center;',
  'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

  //
  'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
  'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
  'email-body_cell' => 'padding: 35px;',

  //
  'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
  'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<body style="{{ $style['body'] }}">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td style="{{ $style['email-wrapper'] }}" align="center">
        <table width="100%" cellpadding="0" cellspacing="0">

          <tr>
            <td style="{{ $style['email-masthead'] }}">
              <a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}" href="{{ url('/event') }}" target="_blank">
                Calendar App
              </a>
            </td>
          </tr>

          <tr>
            <td style="{{ $style['email-body'] }}" width="100%">
              <table style="{{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">

                    <h1 style="{{ $style['header-1'] }}">
                      Hello,
                    </h1>
                    <br>
                    <p style="{{ $style['paragraph'] }}">
                      Your are being invited by {{$user->name}} to an event. <br><br>
                      <strong>Titile: {{$event->title}}</strong><br>
                      From:<br>
                      {{\Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y')}}<br>
                      To:<br>
                      {{\Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y')}}<br>
                      Description: {{$event->description}}
                    </p>

                    <p style="{{ $style['paragraph'] }}">
                      Let {{$user->name}} know if you accpet!
                      Have a great day!
                    </p>

                    <p style="{{ $style['paragraph'] }}">
                      Dearly,<br> Calendar App
                    </p>

                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>