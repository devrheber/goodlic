@extends('email.layouts.layout')

@section('title')
    Reminder for Appointment Time
@endsection
@section('user_message')
{!! $email_templates !!}
@endsection
