@extends('layouts.system')

@section('title')
    <span>
        MANAGE ROOMS
    </span>
@endsection

@section('content')
    <a href ="{{ route('admin.room.create') }}" class="btn btn-primary">Add Room</a>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Capacity</th>
            <th>Photo</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @php($i = 0)
        @foreach ($rooms as $room)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $room->name }}</td>
                <td>{{ $room->description }}</td>
                <td>{{ $room->size }}</td>
                <td>
                    @if ($room->photo)
                        <img src="{{ asset('uploads/photos/' . $room->photo) }}" style="width: 100px;">
                    @endif
                </td>
                <td>{{ $room->status }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.room.destroy', $room->id) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <a href="{{ route('admin.room.edit', $room->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
