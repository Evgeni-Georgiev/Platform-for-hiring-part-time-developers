@extends('layout')
@section('title', 'Hire Developer(s)')
@section('content')
    @extends('components.header')

    <div class="form-group col-12">
        <form class="col-6 container" method="POST" action="{{ route('hire.store') }}" enctype="multipart/form-data">
            @csrf
            <h4>Hire Available Developers</h4>
            Start Date: <label for="start_date">
                <input type="date" name="start_date" id="start_date"
                       value="{{ is_null(old('start_date')) ? today()->format("Y-m-d") : old('start_date') }}"
                       min="{{today()->format("Y-m-d")}}"/>
            </label>
            End Date: <label for="end_date">
                <input type="date" name="end_date" id="end_date"
                       value="{{ is_null(old('end_date')) ? date("Y-m-d", strtotime("+ 1 day")) : old('end_date') }}"
                       min="{{date("Y-m-d", strtotime("+ 1 day"))}}"/>
            </label>
            @if ($errors->has('start_date'))
                <span class="text-danger">{{ $errors->first('start_date') }}</span>
            @endif
            @if ($errors->has('end_date'))
                <span class="text-danger">{{ $errors->first('end_date') }}</span>
            @endif
            @if ($errors->has('hire_error'))
                <span class="text-danger">{{ $errors->first('hire_error') }}</span>
            @endif
            <div class="row">
                <!--Show all existing developers from db in a select field-->
                <select name="ids[]" class="form-control" multiple="multiple"
                        aria-label="multiple select">
                    @foreach ($list_developers_for_hire as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                    {{--                @extends('components.hired_dev')--}}
                    {{--            </select>--}}
                    <input class="form-group col-12" type="submit" name="submit"
                           value="Submit" {{count($list_developers_for_hire) == 0 ? "disabled" : ""}}>
                    @if ($errors->has('ids'))
                        <span class="text-danger">{{ $errors->first('ids') }}</span>
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
                <td><img
                        src="{{empty($hired_developer->profile_picture) ? asset('images/default.png') : asset("storage/developer/$hired_developer->profile_picture")}}"
                        style="height: 100px; width: 150px;" alt="Profile image of the hired developer"></td>
                <td> {{ $hired_developer->start_date }} </td>
                <td> {{ $hired_developer->end_date }} </td>
                <td>
                    <form action="{{ route('hire.destroy', $hired_developer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>
            </tbody>
        @endforeach

    </table>

    <script>
        function addDays(date, days) {
            let result = new Date(date);
            result.setDate(result.getDate() + days);
            return result;
        }

        document.getElementById("start_date").addEventListener("change", function () {
            let endDateSelector = document.getElementById("end_date");
            let selectedDate = this.value === "" ? new Date() : new Date(this.value);
            let minDate = addDays(selectedDate, 1);
            endDateSelector.setAttribute("min", minDate.toISOString().split("T")[0]);
            endDateSelector.valueAsDate = selectedDate >= endDateSelector.valueAsDate ? minDate : endDateSelector.valueAsDate;
        });
    </script>
@endsection
