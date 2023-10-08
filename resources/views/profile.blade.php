@extends('layout')
@section('content')
    @extends('components.header')
        {{ $get_dev_profile->id }}
        {{ $get_dev_profile->name }}
        {{ $get_dev_profile->email }}
        {{ $get_dev_profile->phone }}
        {{ $get_dev_profile->location }}
        {{ $get_dev_profile->profile_picture }}
        {{ $get_dev_profile->price_per_hour }}
        {{ $get_dev_profile->technology }}
        {!! $get_dev_profile->description !!}
        {{ $get_dev_profile->years_of_experience }}
        {{ $get_dev_profile->native_language }}
        {{ $get_dev_profile->linkedin_profile_link }}
    @extends('components.footer')
@endsection
