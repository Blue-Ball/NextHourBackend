{!! Form::open([
    'route' => ['laravelblocker::blocker-item-destroy', $blockedItem->id],
    'method' => 'DELETE',
    'accept-charset' => 'UTF-8',
    'data-toggle' => 'tooltip',
    'title' => trans("laravelblocker::laravelblocker.tooltips.destroy_blocked_tooltip")
]) !!}
    {!! Form::hidden("_method", "DELETE") !!}
    {!! csrf_field() !!}
    <button class="btn-danger btn-floating" type="button"  data-toggle="modal" data-target="#confirmDelete" data-title="{{ trans("laravelblocker::laravelblocker.modals.destroy_blocked_title") }}" data-message="{!! trans("laravelblocker::laravelblocker.modals.destroy_blocked_message", ["blocked" => $blockedItem->value]) !!}">
        {!! trans("laravelblocker::laravelblocker.buttons.destroy") !!}
    </button>
{!! Form::close() !!}
