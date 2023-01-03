@extends('layouts.app')

@section('template_title')
    Hotel
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Hotel') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('hotels.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
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
                                        <th>No</th>
                                        
										<th>Name</th>
										<th>Street</th>
										<th>Postal Code</th>
										<th>City</th>
										<th>Province</th>
                                        <th>Country</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hotels as $hotel)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $hotel->name }}</td>
											<td>{{ $hotel->street }}</td>
											<td>{{ $hotel->postal_code }}</td>
											<td>{{ $hotel->city }}</td>
											<td>{{ $hotel->province->name }}</td>
											<td>{{ $hotel->country->name }}</td>

                                            <td>
                                                <form action="{{ route('hotels.destroy',$hotel->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('hotels.show',$hotel->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('hotels.edit',$hotel->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $hotels->links() !!}
            </div>
        </div>
    </div>
@endsection
