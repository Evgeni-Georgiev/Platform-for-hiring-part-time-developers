@extends('layout')
@section('content')
    @extends('components.header')
    {{ $getDeveloperProfileById->id }}
    {{ $getDeveloperProfileById->name }}
    {{ $getDeveloperProfileById->email }}
    {{ $getDeveloperProfileById->phone }}
    {{ $getDeveloperProfileById->location }}
    {{ $getDeveloperProfileById->profile_picture }}
    {{ $getDeveloperProfileById->price_per_hour }}
    {{ $getDeveloperProfileById->technology }}
    {!! $getDeveloperProfileById->description !!}
    {{ $getDeveloperProfileById->years_of_experience }}
    {{ $getDeveloperProfileById->native_language }}
    {{ $getDeveloperProfileById->linkedin_profile_link }}
    @extends('components.footer')
@endsection
