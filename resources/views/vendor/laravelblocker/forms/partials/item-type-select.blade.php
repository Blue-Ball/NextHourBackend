<div class="form-group row">
    
    <div class="col-md-12">
       
        {{-- <div class="input-group"> --}}
             {!! Form::label('typeId', trans('laravelblocker::laravelblocker.forms.blockedTypeLabel'), array('class' => ' control-label')); !!}
            <select class="{{ $errors->has('typeId') ? 'custom-select form-control select2 is-invalid ' : 'custom-select form-control select2' }}" name="typeId" id="typeId" >
                <option value="">
                    {{ trans('laravelblocker::laravelblocker.forms.blockedTypeSelect') }}
                </option>
                @if($blockedTypes)
                    @foreach($blockedTypes as $blockedType)
                        <option value="{{ $blockedType->id }}" data-type="{{ $blockedType->slug }}" @isset($item) {{ $item->typeId == $blockedType->id ? 'selected="selected"' : '' }} @endisset >
                            {{ $blockedType->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            {{-- <div class="input-group-append">
                <label class="input-group-text" for="typeId">
                    <i class="fa fas fa-fw fa-shield" aria-hidden="true"></i>
                </label>
            </div> --}}
        {{-- </div> --}}
        @if ($errors->has('typeId'))
            <span class="help-block">
                <strong>{{ $errors->first('typeId') }}</strong>
            </span>
        @endif
    </div>
</div>
