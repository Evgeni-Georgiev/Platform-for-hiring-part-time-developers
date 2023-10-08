@extends('layout')
@section('content')
    @extends('components.header')

    <div class="form-group col-12">
        <form class="col-6 container" method="POST" action="{{ route('hire.store') }}" enctype="multipart/form-data">
            @csrf
            <h4>Hire Available Developers</h4>
            Start Date: <label for="start_date">
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"/>
            </label>
            End Date: <label for="end_date">
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"/>
            </label>
            @if ($errors->has('start_date'))
                <span class="text-danger">{{ $errors->first('start_date') }}</span>
            @endif
            @if ($errors->has('end_date'))
                <span class="text-danger">{{ $errors->first('end_date') }}</span>
            @endif
            <div class="row">
                <!--Show all existing developers from db in a select field-->
                <select name="names[]" class="form-control" multiple="multiple"
                        aria-label="multiple select example">
                    @foreach ($list_developers_for_hire as $row)
                        <option value="{{ $row->name }}">{{ $row->name }}</option>
                    @endforeach
                    {{--                @extends('components.hired_dev')--}}
                    {{--            </select>--}}
                    <input class="form-group col-12" type="submit" name="submit" value="Submit">
                    @if ($errors->has('names'))
                        <span class="text-danger">{{ $errors->first('names') }}</span>
                @endif
            </div>
        </form>
    </div>

    <br>
    <table class='table center col-10 mt-5 mb-5'>
        <thead>
        <tr>
            <th scope='col'>Names</th>
            <th scope='col'>Profile Picture</th>
            <th scope='col'>Start Date</th>
            <th scope='col'>End Date</th>
            <th scope='col'>Delete</th>
        </tr>
        </thead>
        @foreach($hired_developers as $hired_developer)
            <tbody>
            <tr>
                <td> {{ e($hired_developer->names) }} </td>
                <td><img src="{{ asset('storage/developer/'.$hired_developer->profile_picture) }}"
                         style="height: 100px; width: 150px;" alt="Profile image of the hired developer"></td>
                <td> {{ $hired_developer->start_date }} </td>
                <td> {{ $hired_developer->end_date }} </td>
                <td>
                    <form action="{{ route('hire.destroy', $hired_developer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
            </tbody>
        @endforeach

    </table>

@endsection
