@extends('layouts.bootstrap')
@section('content')
    <h2 class="mt-5">Participants</h2>
    <a href="/participant/create?event={{ request()->event }}" class="btn btn-primary btn-sm">Add New Participant</a>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="">
                <div class="input-group">
                    <span class="input-group-text text-primary">Filter</span>
                    <select class="form-control" name="event" id="event">
                        <option value="">All Event</option>
                        @foreach ($events as $item)
                            <option value="{{ $item->id }}" @selected($item->id == request()->event)>{{ $item->event_name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" aria-label="Search" name="key" value="{{ request()->key }}"
                        class="form-control">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                    <a href="/participant" class="btn btn-outline-dark" type="reset">Clear</a>
                </div>
            </form>
        </div>

    </div>
    <div class="card mt-2 mb-2">
        <div class="card-body">
            <div class="responsive">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            @if (!request()->event)
                                <th scope="col">Event</th>
                            @endif
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col" class="w-25">Address</th>
                            <th scope="col">Arrived</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($participants as $item)
                            <tr>
                                <th scope="row">{{ $participants->firstItem() + $loop->index }}</th>
                                @if (!request()->event)
                                    <td>{{ $item->event->event_name }}</td>
                                @endif

                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}
                                    <br>
                                    {{ $item->phone }}
                                </td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->have_arrived ? 'Yes' : 'Not yet' }}</td>
                                <td>
                                    <a href="/participant/{{ $item->id }}" class="btn btn-info btn-sm">QR</a>

                                    <form action="/participant/{{ $item->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-dark btn-sm"
                                            onclick="return confirm('Are you sure you want delete?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            {{ $participants->links() }}
        </div>
    </div>
@endsection
