@extends('layouts.app')

@section('template_title')
    {{ $room->name ?? 'Show Room' }}
@endsection

@section('content')
    <section class="content container">
        <div class="row">
            <div class="col-md-12 center">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Room</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rooms.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $room->name }}
                        </div>
                        <div class="form-group">
                            <strong>Max Guest:</strong>
                            {{ $room->max_guest }} <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="form-group">
                            <strong>Floor:</strong>
                            {{ $room->floor }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            @if ($room->status)
                                <span class="btn btn-danger">Occupied</span>
                            @else
                                <span class="btn btn-success">Empty</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Hotel:</strong>
                            <a href="{{ route('hotels.index').'/'.$room->hotel_id }}"> {{ $room->hotel->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
