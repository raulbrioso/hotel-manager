<div class="box box-info padding-1">
    <div class="box-body">
        <div class="container">
            <div class="row">
                <div class="col-6 form-group">
                    {{ Form::label('name') }}
                    {{ Form::text('name', $room->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-2 form-group">
                    {{ Form::label('max_guest') }}
                    {{ Form::text('max_guest', $room->max_guest ?: '1', ['class' => 'form-control' . ($errors->has('max_guest') ? ' is-invalid' : ''), 'placeholder' => 'Max Guest', 'min' => '1']) }}
                    {!! $errors->first('max_guest', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-6 form-group">
                    {{ Form::label('hotel_id') }}
                    {{ Form::select('hotel_id', $hotels, $room->hotel_id, ['class' => 'form-control' . ($errors->has('hotel_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('hotel_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-2 form-group">
                    {{ Form::label('floor') }}
                    {{ Form::text('floor', $room->floor, ['class' => 'form-control' . ($errors->has('floor') ? ' is-invalid' : ''), 'placeholder' => 'Floor']) }}
                    {!! $errors->first('floor', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </div>
</div>