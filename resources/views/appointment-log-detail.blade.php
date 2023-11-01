@php
$pusher_channel_name = config('services.pusher.channel_name');
$pusher_event_name = config('services.pusher.pusher_event_name');
@endphp
@extends('Frontend.layouts.master')
@section('content')
    <appointment-log-detail-page url={{$url}} appointment_id={{$appointment_id}} pusher_channel_name={{$pusher_channel_name}} pusher_event_name={{$pusher_event_name}}> </appointment-log-detail-page>

@endsection
