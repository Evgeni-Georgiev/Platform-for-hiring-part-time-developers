@extends('layout')
@section('title', 'All Developers')
@section('content')
    @extends('components.header')
    <table class='table center col-10 mt-5 mb-5'>
        <thead>
        <tr>
            <th scope='col'>ID</th>
            <th scope='col'>Name</th>
            <th scope='col'>Email</th>
            <th scope='col'>Profile Picture</th>
            <th scope='col'>Price Per Hour</th>
            <th scope='col'>Technology</th>
            <th scope='col'>Profile</th>
            <th scope='col'>Edit</th>
            <th scope='col'>Delete</th>
        </tr>
        </thead>
        @foreach($developer as $dev)
            <tbody>
            <tr>
                <td>{{ $dev->id }}</td>
                <td>{{ $dev->name }}</td>
                <td>{{ $dev->email }}</td>
                <td>
                    <img
                        src="{{empty($dev->profile_picture) ? asset('images/default.png') : asset("storage/developer/$dev->profile_picture")}}"
                        style="height: 100px; width: 150px;" alt="Developer profile picture"/></td>
                <td>{{ $dev->price_per_hour }}</td>
                <td>{{ $dev->technology }}</td>
                <td><a href="{{route('hire.show', $dev->id)}}" class="btn btn-info"><i
                            class="fa-solid fa-id-badge"></i>Profile</a></td>
                <td><a href="{{ route('developers.edit', $dev->id)}}" class="btn btn-warning"><i
                            class="fa-solid fa-pen"></i>Edit</a>
                </td>
                <td>
                    <form action="{{ route('developers.destroy', $dev->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i>Delete</button>
                    </form>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
    @extends('components.footer')
@endsection
{{--</x-layout>--}}
