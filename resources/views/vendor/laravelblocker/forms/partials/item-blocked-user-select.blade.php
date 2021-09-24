<div class="form-group row">
   
    <div class="col-md-12">
             {!! Form::label('userId', trans('laravelblocker::laravelblocker.forms.blockedUserLabel'), array('class' => 'control-label disabled', 'id' => 'blockerUserLabel1')); !!}
            <select class="{{ $errors->has('userId') ? 'custom-select form-control select2 is-invalid disabled' : 'custom-select form-control select2 disabled' }}" name="userId" id="userId">
                <option value="">
                    {{ trans('laravelblocker::laravelblocker.forms.blockedUserSelect') }}
                </option>
                @if($users)
                    @foreach($users as $aUser)
                        <option value="{{ $aUser->id }}" data-email="{{ $aUser->email }}" @isset($item->userId) {{ $item->userId == $aUser->id ? 'selected="selected"' : '' }} @endisset >
                            {{ $aUser->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            {{-- <div class="input-group-append">
                <label class="input-group-text disabled" for="userId" id="blockerUserLabel2">
                    <i class="fa fas fa-fw fa-shield" aria-hidden="true"></i>
                </label>
            </div> --}}
       
        @if ($errors->has('userId'))
            <span class="help-block">
                <strong>{{ $errors->first('userId') }}</strong>
            </span>
        @endif
    </div>
</div>
