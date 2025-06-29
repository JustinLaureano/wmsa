@component('mail::message')
# {{ __('notifications.sort_list_material_added.header', ['part_number' => $sortList->material->part_number]) }}

{{ __('notifications.greeting', ['name' => $notifiable->domainAccount->first_name ?? __('frontend.user')]) }},

{{ __('notifications.sort_list_material_added.subheader') }}

- **{{ __('frontend.customer') }}**: {{ $sortList->customer->name }}
- **{{ __('frontend.part_number') }}**: {{ $sortList->material->part_number }}
- **{{ __('frontend.list_date') }}**: {{ $sortList->list_date }}
- **{{ __('frontend.reason') }}**: {{ $sortList->reason }}

{{-- @component('mail::button', ['url' => route('sort-lists.show', $sortList->uuid)])
View Sort List
@endcomponent --}}

{{ __('notifications.thank_you') }},<br>
{{ __('notifications.signature') }}
@endcomponent