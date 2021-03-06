{!! Form::open([
    'route' => ['laravelblocker::blocker.update', $item->id],
    'method' => 'PUT',
    'role' => 'form',
    'class' => 'needs-validation'
]) !!}
    {!! csrf_field() !!}
    @include('laravelblocker::forms.partials.item-type-select')
    @include('laravelblocker::forms.partials.item-value-input')
    @include('laravelblocker::forms.partials.item-blocked-user-select')
    @include('laravelblocker::forms.partials.item-note-input')
    <div class="row">
        <div class="btn-group pull-right">
            {!! Form::button(trans('laravelblocker::laravelblocker.buttons.save-larger'), array('class' => 'btn btn-success pull-right','type' => 'submit' )) !!}
        </div>
    </div>
{!! Form::close() !!}
{{-- <div class="row">
    <div class="col-sm-6 mt-2 mt-sm-0">
        @include('laravelblocker::forms.delete-full')
    </div>
</div> --}}
