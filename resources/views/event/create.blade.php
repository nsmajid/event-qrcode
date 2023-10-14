@extends('layouts.bootstrap')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h3 class="mt-5">Create New Event</h3>
            <div class="card mb-2 mt-2">
                <div class="card-body">
                    <form method="POST" action="/event">
                        @csrf
                        <div class="mb-3">
                            <label for="event_name" class="form-label">Event Name</label>
                            <input type="text" class="form-control  @error('event_name') is-invalid @enderror"
                                name="event_name" id="event_name" placeholder="Event Name" value="{{ old('event_name') }}">
                            @error('event_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="event_location" class="form-label">Event Location</label>
                            <input type="text" class="form-control @error('event_location') is-invalid @enderror" id="event_location" name="event_location" placeholder="Event Location" value="{{ old('event_location') }}">
                              @error('event_location')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date') }}">
                              @error('event_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="event_description" class="form-label">Description</label>
                            <textarea class="form-control @error('event_description') is-invalid @enderror" name="event_description" id="event_description" placeholder="Event Description" rows="10">{{ old('event_description') }}</textarea>
                              @error('event_description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Insert New Event</button>
                            <a href="/event" type="reset" class="btn btn-dark">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
