@extends('layout')
@section('title', 'Create Developer')
@section('content')
    @extends('components.header')
    <form class="col-6 container" action="{{ route('developers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-12">
                <label for="developer_name" class="form-label">Name of Developer:</label>
                <input type="text" class="form-control" name="name" id="developer_name"
                       placeholder="Name of Developer" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group col-12">
                <label for="developer_email" class="form-label">Email of Developer:</label>
                <input type="email" class="form-control" name="email" id="developer_email"
                       placeholder="Email of Developer" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group col-12">
                <label for="phone" class="form-label">Phone of Developer:</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone of Developer" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="form-group col-12">
                <label for="location" class="form-label">Location of Developer:</label>
                <input type="text" class="form-control" name="location" id="location" placeholder="Location of Developer" value="{{ old('location') }}">
            </div>
            <div class="form-group col-12">
                <label for="profile_picture" class="form-label">Profile Picture:</label>
                <input type="file" class="form-control" name="profile_picture" id="profile_picture"
                       placeholder="Profile Picture">
            </div>
            <div class="form-group col-12">
                <label for="price_per_hour" class="form-label">Price Per Hour:</label>
                <input type="number" class="form-control" name="price_per_hour" id="price_per_hour"
                       placeholder="Price Per Hour" value="{{ old('price_per_hour') }}">
            </div>
            <div class="form-group col-12">
                <label for="inputState">Technology:</label>
                <select name="technology" class="form-control">
                    <option value="">---Select Technology---</option>
{{--                    <option value="JavaScript">JavaScript</option>--}}
                    <option value="JavaScript" {{ (old("technology") == "JavaScript" ? "selected":"") }}>JavaScript</option>
                    <option value="Java" {{ (old("technology") == "Java" ? "selected":"") }}>Java</option>
                    <option value=".NET" {{ (old("technology") == ".NET" ? "selected":"") }}>.NET</option>
                    <option value="Flutter" {{ (old("technology") == "Flutter" ? "selected":"") }}>Flutter</option>
                    <option value="Python" {{ (old("technology") == "Python" ? "selected":"") }}>Python</option>
                    <option value="PHP" {{ (old("technology") == "PHP" ? "selected":"") }}>PHP</option>
{{--                    <option value="Java">Java</option>--}}
{{--                    <option value=".NET">.NET</option>--}}
{{--                    <option value="Flutter">Flutter</option>--}}
{{--                    <option value="Python">Python</option>--}}
{{--                    <option value="PHP">PHP</option>--}}
                </select>
            </div>
            <div class="form-group col-12">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="article-ckeditor" class="form-control" rows="10" cols="70">{{ old('description') }}</textarea>
            </div>
            <div class="form-group col-12">
                <label for="years_of_experience" class="form-label">Years of Experience: </label>
                <input type="number" class="form-control" name="years_of_experience" id="years_of_experience"
                       placeholder="Years of Experience" value="{{ old('years_of_experience') }}">
            </div>
            <div class="form-group col-12">
                <label for="native_language" class="form-label">Native Language:</label>
                <select name="native_language" class="form-control">
                    <option value="">---Select Option---</option>
                    <option value="english" {{ (old("native_language") == "english" ? "selected":"") }}>English</option>
                    <option value="serbian" {{ (old("native_language") == "serbian" ? "selected":"") }}>Serbian</option>
                    <option value="bulgarian" {{ (old("native_language") == "bulgarian" ? "selected":"") }}>Bulgarian</option>
{{--                    <option value="english">English</option>--}}
{{--                    <option value="serbian">Serbian</option>--}}
{{--                    <option value="bulgarian">Bulgarian</option>--}}
                </select>
            </div>
            <div class="form-group col-12">
                <label for="linkedin" class="form-label">Linkedin Profile Link:</label>
                <input type="text" class="form-control" name="linkedin_profile_link" id="linkedin" placeholder="Linkedin Profile Link"
                       value="{{ old('linkedin_profile_link') }}">
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <button type="submit" name="submit" value="Submit" class="btn btn-primary">Add</button>
        </div>
        <!--    <br>-->
    </form>
@endsection
