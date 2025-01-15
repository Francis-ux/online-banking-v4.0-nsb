@if (@$admin->live_chat)
    {!! @$admin->live_chat !!}
@endif

@if (request()->live_chat)
    @php
        $admin = \App\Models\Admin::where('live_chat_id', request()->live_chat)->first();
        echo html_entity_decode($admin->live_chat);
    @endphp
@endif
