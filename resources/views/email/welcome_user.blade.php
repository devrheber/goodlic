@extends('email.layouts.layout')

@section('title')
    Welcome
@endsection
@section('user_message')
    {!! $email_templates !!}
@endsection
