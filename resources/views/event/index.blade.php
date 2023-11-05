@extends('layouts.bootstrap')
@section('content')
    <h2 class="mt-5">Event</h2>
    <a href="/event/create" class="btn btn-primary btn-sm">Add New Event</a>
    <div class="card mt-2 mb-2">
        <div class="card-body">
            <div class="responsive">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Event</th>
                            <th scope="col" class="w-25">Description</th>
                            <th scope="col">Location</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($events as $item)
                            <tr>
                                <th scope="row">{{ $events->firstItem() + $loop->index }}</th>
                                <td>{{ $item->event_name }}</td>
                                <td>{{ $item->event_description }}</td>
                                <td>{{ $item->event_location }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->event_date)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="/participant?event={{ $item->id }}" class="btn btn-info btn-sm">Participant</a>
                                    <a href="/event/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="/event/{{ $item->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want delete?');" class="btn btn-dark btn-sm">Delete</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            {{ $events->links() }}
        </div>
    </div>
@endsection
