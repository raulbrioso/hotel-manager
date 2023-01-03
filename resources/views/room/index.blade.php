@extends('layouts.app')

@section('template_title')
    Room
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Room') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                        <span id="success_message" class="alert alert-success text-success" style="display: none;">Hola</span> 

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Name</th>
										<th>Max Guest</th>
										<th>Floor</th>
										<th>Status</th>
										<th>Hotel</th>

                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $room->name }}</td>
											<td>{{ $room->max_guest }}</td>
											<td>{{ $room->floor }}</td>
											<td class="status">
                                                @if ($room->status)
                                                    <span class="btn btn-danger occupied">Occupied</span>
                                                @else
                                                    <span class="btn btn-success empty">Empty</span>
                                                @endif
                                            </td>
											<td><a href="{{ route('hotels.index',$room->hotel_id).'/'.$room->hotel_id }}"> {{ $room->hotel->name }}

                                            <td> </td>
                                            <td>
                                                
                                                @if (!$room->status)
                                                    <a class="btn btn-sm btn-primary " href="{{ route('rooms.reservation',$room->id) }}">Checkin</a>
                                                @else
                                                    @foreach ($room->users as $user)
                                                        @if ($user->id == auth()->user()->id && $user->pivot->checkout>\Carbon\Carbon::now()->format('Y-m-d'))
                                                        @php
                                                        $checkout_btn = 1
                                                        @endphp
                                                        @endif 
                                                    @endforeach
                                                    @if (isset($checkout_btn) && $checkout_btn)
                                                    @endif
                                                    <button class="btn btn-warning checkout" id="{{ $room->id }}">Checkout</button>
                                                @endif
                                                
                                            </td>
											
                                            </a></td>
                                            <td>
                                                <form action="{{ route('rooms.destroy',$room->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('rooms.show',$room->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('rooms.edit',$room->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <div id="error_message" class="ajax_response" style="float:left"></div>
	                                <div id="success_message" class="ajax_response" style="float:left"></div>
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
                {!! $rooms->links() !!}
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $( ".checkout" ).click(function(ev) {
                ev.preventDefault();
                let $this = $(this);
                console.log($(this).html());
                $(this).html('<div class="spinner-border spinner-border-sm" role="status"></div>');
                $.ajax({
                    url: "{{ route('rooms.checkout')}}",
                    type: "POST",
                    data: {
                        _token:$("input[name=_token]").val(),
                        room_id:$this.attr('id')
                    },
                    success: function (response) {
                        changeStatusDt($this);
                        $('#success_message').fadeIn().html('CheckOut succesfully!');  
                          setTimeout(function(){  
                               $('#success_message').fadeOut("Slow");  
                          }, 2000);  
                    }
                });
                
            });
        });

        function changeStatusDt(btn){
            let td = btn.parent();
            let url = "{{ route('rooms.reservation',0) }}";
            url = url.replace('0', btn.attr('id'));
            td.html('<a class="btn btn-sm btn-primary " href="'+url+'">Checkin</a>');
            td.parent().find('.status').html('<span class="btn btn-success empty">Empty</span>');
        }
    </script>
@endsection

