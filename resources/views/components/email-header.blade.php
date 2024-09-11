<!-- resources/views/components/email-header.blade.php -->
@component('mail::header', ['url' => config('app.url')])
    <img src="{{ asset('assets/images/crm-profile.jpg') }}" alt="{{ config('app.name') }}" style="max-width: 200px;">
@endcomponent
