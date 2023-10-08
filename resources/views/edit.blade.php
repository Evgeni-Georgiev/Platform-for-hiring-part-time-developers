@extends('layout')
@section('title', 'Edit Developer')
@section('content')
    @extends('components.header')
    <br><h3 class="text-center">Edit data:</h3><br>
    <form class="col-6 container" name="form" method="POST" enctype="multipart/form-data"
          action="{{ route('developers.update', $developers->id ) }}">
        <br>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col-12">
                <label for="name" class="form-label">Edit Developer name:</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{$developers->name}}"
                       placeholder="Edit Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group col-12">
                <label for="email" class="form-label">Edit Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$developers->email}}"
                       placeholder="Edit Email">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group col-12">
                <label for="phone" class="form-label">Edit Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{$developers->phone}}"
                       placeholder="Edit Phone">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="form-group col-12">
                <label for="location" class="form-label">Edit Location:</label>
                <input type="text" class="form-control" id="location" name="location"
                       value="{{$developers->location}}" placeholder="Edit Location">
            </div>
            <div class="form-group col-12">
                <label for="profile_picture" class="form-label">Edit Profile Picture:</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                       value="{{$developers->profile_picture ?? 0}}"/>
                <img id="profile_picture"
                     src="{{empty($developers->profile_picture) ? asset('/images/default.png') : asset("storage/developer/$developers->profile_picture")}}"
                     width="150px" height="100px"
                     alt="Profile image of the developer"
                     class="img-thumbnail m-1"/>
            </div>
            <div class="form-group col-12">
                <label for="price_per_hour" class="form-label">Edit Price Per Hour:</label>
                <input type="number" class="form-control" id="price_per_hour" name="price_per_hour"
                       value="{{$developers->price_per_hour}}" placeholder="Edit Price Per Hour">
            </div>
            <div class="form-group col-12">
                <label for="inputState">Edit Technology:</label>
                <select name="technology" class="form-control">
                    @foreach (["JavaScript", "Java", ".NET", "Flutter", "Python", "PHP"] as $data)
                        @if ($data == $developers->technology)
                            <option value="{{$data}}" selected>{{$data}}</option>
                        @else
                            <option value="{{$data}}">{{$data}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <label for="description" class="form-label">Edit Description:</label>
                <textarea id="article-ckeditor" name="description" class="form-control" rows="10"
                          cols="70">{{$developers->description}}</textarea>
            </div>
            <div class="form-group col-12">
                <label for="years_of_experience" class="form-label">Edit Years of experience:</label>
                <input type="text" class="form-control" id="years_of_experience" name="years_of_experience"
                       value="{{$developers->years_of_experience}}" placeholder="Edit Years of experience">
            </div>
            <div class="form-group col-12">
                <label for="inputState">Edit selected Native Language:</label>
                <select id="inputState" name="native_language" class="form-control">
                    @foreach (["English", "Serbian", "Bulgarian"] as $data)
                        @if ($data == $developers->native_language)
                            <option value="{{$data}}" selected>{{$data}}</option>
                        @else
                            <option value="{{$data}}">{{$data}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <label for="linkedin_profile_link" class="form-label">Edit LinkdedIn profile link:</label>
                <input type="text" class="form-control" id="linkedin_profile_link" name="linkedin_profile_link"
                       value="{{$developers->linkedin_profile_link}}" placeholder="Edit Linkedin Profile Link">
            </div>
            <div class="col-12 text-center">
                <button type="submit" name="update" value="Update" class="btn btn-primary ">Update</button>
            </div>
        </div>
    </form>
@endsection
