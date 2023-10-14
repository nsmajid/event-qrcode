@extends('layouts.bootstrap')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h3 class="mt-5">Add Participant</h3>
            <div class="card mb-2 mt-2">
                <div class="card-body">
                    <form method="POST" action="/participant">
                        @csrf
                        <div class="mb-3">
                            <label for="event" class="form-label">Event</label>
                            <select class="form-control  @error('event') is-invalid @enderror" name="event"
                                id="event">
                                <option value="">--Choose Event--</option>
                                @foreach ($events as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('event', request()->event) == $item->id ? 'selected' : null }}>
                                        {{ $item->event_name }}</option>
                                @endforeach
                            </select>
                            @error('event')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                placeholder="Address" rows="5">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Participant</button>
                            <a href="/participant" type="reset" class="btn btn-dark">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
