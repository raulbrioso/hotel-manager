@extends('layouts.app')

@section('template_title')
    User Reservations
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Reservations') }}
                            </span>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Room</th>
                                        <th>Hotel</th>
										<th>CheckIn</th>
										<th>CheckOut</th>
										<th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $r)
                                        <tr>
                                            <td><a href="{{ route('rooms.show',$r->id)}}"> {{ $r->name }}</a></td>
                                            <td><a href="{{ route('hotels.show',$r->hotel_id)}}"> {{ $r->hotel->name }}</a></td>
											<td>{{ Carbon\Carbon::parse($r->pivot->checkin)->format('d-m-Y') }}</td>
											<td>{{ Carbon\Carbon::parse($r->pivot->checkout)->format('d-m-Y') }}</td>
											<td>
                                                @if(Carbon\Carbon::parse($r->pivot->checkout)->format('d-m-Y')<Carbon\Carbon::now()->format('d-m-Y'))
                                                    <span class="btn btn-danger">Expired</span>
                                                @else
                                                    <span class="btn btn-success">Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
