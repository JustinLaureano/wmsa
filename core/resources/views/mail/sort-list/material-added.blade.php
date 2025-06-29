@component('mail::message')
# {{ __('notifications.sort_list_material_added.header', ['part_number' => $sortList->material->part_number]) }}

{{ __('notifications.greeting', ['name' => $notifiable->domainAccount->first_name ?? __('frontend.user')]) }},

{{ __('notifications.sort_list_material_added.subheader') }}

- **{{ __('frontend.customer') }}**: {{ $sortList->customer->name }}
- **{{ __('frontend.part_number') }}**: {{ $sortList->material->part_number }}
- **{{ __('frontend.list_date') }}**: {{ $sortList->list_date }}
- **{{ __('frontend.reason') }}**: {{ $sortList->reason }}

@if($sortList->line_side_sort === 1)
- {{ __('notifications.sort_list_material_added.line_side_sort_disclaimer') }}
@endif

@if($sortList->percent === 200)
- {{ __('notifications.sort_list_material_added.percent_200_disclaimer') }}
@endif

{{-- @component('mail::button', ['url' => route('sort-lists.show', $sortList->uuid)])
View Sort List
@endcomponent --}}

{{ __('notifications.thank_you') }},<br>
{{ __('notifications.signature') }}
@endcomponent