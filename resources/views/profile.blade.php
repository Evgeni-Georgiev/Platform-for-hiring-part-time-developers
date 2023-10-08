@extends('layout')
@section('title', 'Developer Profile')
@section('content')
    @extends('components.header')
    <br><h3 class="text-center">{{$get_dev_profile->name}}</h3><br>

    <div class="row">
        <div class="form-group col-12">
            <label for="name" class="form-label">Developer name:</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{$get_dev_profile->name}}"
                   readonly>
        </div>
        <div class="form-group col-12">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$get_dev_profile->email}}"
                   readonly>
        </div>
        <div class="form-group col-12">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{$get_dev_profile->phone}}"
                   readonly>
        </div>
        <div class="form-group col-12">
            <label for="location" class="form-label">Location:</label>
            <input type="text" class="form-control" id="location" name="location"
                   value="{{$get_dev_profile->location}}" readonly>
        </div>
        <div class="form-group col-12">
            <label for="profile_picture" class="form-label">Profile Picture:</label>
            <img id="profile_picture"
                 src="{{empty($get_dev_profile->profile_picture) ? asset('/images/default.png') : asset("storage/developer/$get_dev_profile->profile_picture")}}"
                 width="150px" height="100px"
                 alt="Developer profile picture"
                 class="img-thumbnail m-1"/>
        </div>
        <div class="form-group col-12">
            <label for="price_per_hour" class="form-label">Price Per Hour:</label>
            <input type="text" class="form-control" id="price_per_hour" name="price_per_hour"
                   value="{{$get_dev_profile->price_per_hour}}" readonly>
        </div>
        <div class="form-group col-12">
            <label for="inputState">Technology:</label>
            <input type="text" class="form-control" id="location" name="location"
                   value="{{$get_dev_profile->technology}}" readonly>
        </div>
        <div class="form-group col-12">
            <label for="article-ckeditor" class="form-label">Description:</label>
            <textarea id="article-ckeditor" name="description" class="form-control" rows="10"
                      cols="70" readonly>{{$get_dev_profile->description}}</textarea>
        </div>
        <div class="form-group col-12">
            <label for="years_of_experience" class="form-label">Years of experience:</label>
            <input type="text" class="form-control" id="years_of_experience" name="years_of_experience"
                   value="{{$get_dev_profile->years_of_experience}}" readonly>
        </div>
        <div class="form-group col-12">
            <label for="native_language">Selected Native Language:</label>
            <input type="text" class="form-control" id="native_language" name="native_language"
                   value="{{$get_dev_profile->native_language}}" readonly>
        </div>
        <div class="form-group col-12">
            <label for="linkedin_profile_link" class="form-label">LinkedIn profile link:</label>
            <input type="text" class="form-control" id="linkedin_profile_link" name="linkedin_profile_link"
                   value="{{$get_dev_profile->linkedin_profile_link}}" readonly>
        </div>
@endsection
