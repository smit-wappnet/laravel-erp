@component('mail::message')
    Welcome, {{ $body['name'] }}

    This Mail is Welcome to Our Company {{ $body['company'] }}.

    @component('mail::button', ['url' => $body['url']])
        Visit ERP Site
    @endcomponent

    Thanks,<br>
    {{-- {{ config('app.name') }} --}}
@endcomponent
