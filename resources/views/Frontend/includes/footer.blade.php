@php
$url = URL::to('/');
$general_settings= DB::table('general_setting')->find(1);
$content_pages= DB::table('content_pages')->where('is_active',1)->get();

@endphp
<site-footer url={{$url}}
address="{{$general_settings->address}}"
phone="{{$general_settings->phone}}"
email="{{$general_settings->company_email}}"
facebook_link="{{$general_settings->facebook_link}}"
twitter_link="{{$general_settings->twitter_link}}"
linkden_link="{{$general_settings->linkden_link}}"
about_company="{{$general_settings->about_company}}"
content_pages="{{$content_pages}}"
> </site-footer>
