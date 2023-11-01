@extends('email.layouts.layout')

@section('title')
    Booked Appointment
@endsection


@section('user_message')
{!! $email_templates !!}
@endsection
