<div class="box box-info padding-1">
    <div class="box-body">
        <div class="container">
            <div class="row">
                <div class="col-6 form-group">
                    {{ Form::label('name') }}
                    {{ Form::text('name', $hotel->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-6 form-group">
                    {{ Form::label('street') }}
                    {{ Form::text('street', $hotel->street, ['class' => 'form-control' . ($errors->has('street') ? ' is-invalid' : ''), 'placeholder' => 'Street']) }}
                    {!! $errors->first('street', '<div class="invalid-feedback">:message</div>') !!}        
                </div>
            </div>
            <div class="row">
                <div class="col-6 form-group">
                    {{ Form::label('city') }}
                    {{ Form::text('city', $hotel->city, ['class' => 'form-control' . ($errors->has('city') ? ' is-invalid' : ''), 'placeholder' => 'City']) }}
                    {!! $errors->first('city', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-4 form-group">
                    {{ Form::label('postal_code') }}
                    {{ Form::text('postal_code', $hotel->postal_code, ['class' => 'form-control' . ($errors->has('postal_code') ? ' is-invalid' : ''), 'placeholder' => 'Postal Code']) }}
                    {!! $errors->first('postal_code', '<div class="invalid-feedback">:message</div>') !!}   
                </div>
            </div>
            <div class="row">
                <div class="col-5 form-group">
                    {{ Form::label('country') }}
                    {{ Form::select('country_id', $countries, $hotel->country_id, ['class' => 'form-control country' . ($errors->has('country_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('country_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-5 form-group">
                    {{ Form::label('province') }}
                    {{ Form::select('province_id', $provinces, $hotel->province_id, ['class' => 'form-control' . ($errors->has('province_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('province_id', '<div class="invalid-feedback">:message</div>') !!}    
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </div>
</div>
