@php
   $general_settings= DB::table('general_setting')->find(1);
   $settings= DB::table('settings')->where('name' , 'login_type')->first();
   $login_type = $settings->value;
@endphp
@extends('Frontend.layouts.loginlayout')
@section('content')
    @if(isset($fbEmail))
        <signup-page url={{$url}} login_type={{$login_type}} logo={{$general_settings->logo }} fbemail={{$fbEmail}} fbid={{$fbId}}> </signup-page>
    @else
        <signup-page url={{$url}} login_type={{$login_type}} logo={{$general_settings->logo }}> </signup-page>
    @endif


@endsection
