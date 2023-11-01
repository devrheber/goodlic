@php
$general_settings= DB::table('general_setting')->find(1);
@endphp

@extends('Frontend.layouts.master')
@section('content')
    <generate-schedule url={{$url}} currency_symbol={{$general_settings->currency_symbol }} minimum_appointment_fee={{$general_settings->minimum_appointment_fee ?? 0 }}> </generate-schedule>

@endsection
