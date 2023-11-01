@php
$general_settings= DB::table('general_setting')->find(1);
$pusher_channel_name = config('services.pusher.channel_name');
$pusher_event_name = config('services.pusher.pusher_event_name');
@endphp
@extends('Frontend.layouts.master')
@section('content')
    <appointment-mentee-log-detail-page url={{$url}} appointment_id={{$appointment_id}} currency_symbol={{$general_settings->currency_symbol }} pusher_channel_name={{$pusher_channel_name}} pusher_event_name={{$pusher_event_name}} > </appointment-mentee-log-detail-page>
@endsection
