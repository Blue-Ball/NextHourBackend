@php
    if (!isset($actionBtnIcon)) {
        $actionBtnIcon = null;
    } else {
        $actionBtnIcon = $actionBtnIcon . ' fa-fw';
    }
    if (!isset($modalClass)) {
        $modalClass = null;
    }
    if (!isset($btnSubmitText)) {
        $btnSubmitText = trans('laravelblocker::laravelblocker.modals.btnConfirm');
    }
@endphp
<div class="modal fade modal delete-modal" id="{{$formTrigger}}" role="dialog" aria-labelledby="{{$formTrigger}}Label" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header {{$modalClass}}">
                {{-- <h5 class="modal-title">
                    Confirm
                </h5> --}}

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="delete-icon"></div>
            </div>
            <div class="modal-body">
                <h5 class="modal-title modal-heading">
                    {{__('adminstaticwords.AreYouSure')}}
                </h5>
                <p>
                   
                   {{__('adminstaticwords.DeleteWarrning')}}
                </p>
            </div>
            <div class="modal-footer">
                {!! Form::button('<i aria-hidden="true"></i> ' . trans('laravelblocker::laravelblocker.modals.btnCancel'), array('class' => 'btn btn-gray translate-y-3', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
                {!! Form::button('<i aria-hidden="true"></i> ' . $btnSubmitText, array('class' => 'btn btn-danger ', 'type' => 'button', 'id' => 'confirm' )) !!}
            </div>
        </div>
    </div>
</div>
