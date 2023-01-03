@extends('layouts.app')

@section('template_title')
    Create Room
@endsection

@section('content')
    <section class="content container">
        <div class="row">
            <div class="col-md-12 center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Reservation</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ action('RoomController@reservationstore') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4 form-group">
                                                <strong>Room:</strong>
                                                <a href="{{ route('rooms.index').'/'.$room->id }}"> {{ $room->name }}</a>
                                            </div>
                                            <div class="col-4 form-group">
                                                <strong>Hotel:</strong>
                                                <a href="{{ route('hotels.index').'/'.$room->hotel->id }}"> {{ $room->hotel->name }}</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 form-group">
                                                <strong>Floor:</strong>
                                                {{ $room->floor }}
                                            </div>
                                            <div class="col-4 form-group">
                                                <strong>Street:</strong>
                                                {{ $room->hotel->street }}, {{ $room->hotel->province->name }} {{ $room->hotel->country->name }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 form-group">
                                                <strong>Max guests:</strong>
                                                {{ $room->max_guest }}
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4 form-group">
                                                {{ Form::label('CheckIn') }}
                                                {{ Form::date('checkin', \Carbon\Carbon::now()->format('Y-m-d') , ['class' => 'form-control' . ($errors->has('checkin') ? ' is-invalid' : ''), 'min' => \Carbon\Carbon::now()->format('Y-m-d')]) }}
                                                {!! $errors->first('checkin', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                            <div class="col-4 form-group">
                                                {{ Form::label('CheckOut') }}
                                                {{ Form::date('checkout', $room->max_guest ?: '1', ['class' => 'form-control' . ($errors->has('checkout') ? ' is-invalid' : '')]) }}
                                                {!! $errors->first('checkout', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                            {{ Form::hidden('room_id',$room->id)}}
                                            {{ Form::hidden('user_id',auth()->user()->id)}}
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection