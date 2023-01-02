@extends('layouts.app')

@section('template_title')
    {{ $hotel->name ?? 'Show Hotel' }}
@endsection

@section('content')
    <section class="content container">
        <div class="row">
            <div class="col-md-12 center">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Hotel</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('hotels.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $hotel->name }}
                        </div>
                        <div class="form-group">
                            <strong>Street:</strong>
                            {{ $hotel->street }}
                        </div>
                        <div class="form-group">
                            <strong>Postal Code:</strong>
                            {{ $hotel->postal_code }}
                        </div>
                        <div class="form-group">
                            <strong>City:</strong>
                            {{ $hotel->city }}
                        </div>
                        <div class="form-group">
                            <strong>Country:</strong>
                            {{ $hotel->country->name }}
                        </div>
                        <div class="form-group">
                            <strong>Province:</strong>
                            {{ $hotel->province->name  }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
