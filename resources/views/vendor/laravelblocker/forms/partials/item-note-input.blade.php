<div class="form-group row">
   
    <div class="col-md-12">
        {{-- <div class="input-group"> --}}
             {!! Form::label('note', trans('laravelblocker::laravelblocker.forms.blockedNoteLabel'), array('class' => 'control-label')); !!}
            @isset($item)
                {!! Form::textarea('note', $item->note, array('id' => 'note', 'class' => $errors->has('note') ? 'form-control is-invalid ' : 'form-control', 'placeholder' => trans('laravelblocker::laravelblocker.forms.blockedNotePH'))) !!}
            @else
                {!! Form::textarea('note', NULL, array('id' => 'note', 'class' => $errors->has('note') ? 'form-control is-invalid ' : 'form-control', 'placeholder' => trans('laravelblocker::laravelblocker.forms.blockedNotePH'))) !!}
            @endisset
           {{--  <div class="input-group-append">
                <label class="input-group-text" for="note">
                    <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                </label>
            </div> --}}
        {{-- </div> --}}
        @if ($errors->has('note'))
            <span class="help-block">
                <strong>{{ $errors->first('note') }}</strong>
            </span>
        @endif
    </div>
</div>
