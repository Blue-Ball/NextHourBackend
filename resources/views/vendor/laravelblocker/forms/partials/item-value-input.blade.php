<div class="form-group row">
    
    <div class="col-md-12">
        
       {{--  <div class="input-group"> --}}
            {!! Form::label('value', trans('laravelblocker::laravelblocker.forms.blockedValueLabel'), array('class' => ' control-label', 'id' => 'blockerValueLabel1')); !!}
            @isset($item)
                {!! Form::text('value', $item->value, array('id' => 'value', 'class' => $errors->has('value') ? 'form-control is-invalid ' : 'form-control', 'placeholder' => trans('laravelblocker::laravelblocker.forms.blockedValuePH'))) !!}
            @else
                {!! Form::text('value', NULL, array('id' => 'value', 'class' => $errors->has('value') ? 'form-control is-invalid ' : 'form-control', 'placeholder' => trans('laravelblocker::laravelblocker.forms.blockedValuePH'))) !!}
            @endisset
            {{-- <div class="input-group-append">
                <label class="input-group-text" for="value" id="blockerValueLabel2">
                    <i class="fa fa-fw fa-key fa-rotate-90" aria-hidden="true"></i>
                </label>
            </div> --}}
        {{-- </div> --}}
        @if ($errors->has('value'))
            <span class="help-block">
                <strong>{{ $errors->first('value') }}</strong>
            </span>
        @endif
    </div>
</div>
