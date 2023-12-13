@component('mail::message')
# New Incident Report

Dear Admin,

A new incident has been reported. Here are the details:

- **Reporter:** {{ $data['name'] }}
- **Description:** {{ $data['description'] }}
- **Date of Occurrence:** {{ $data['date_of_occurence'] }}
- **Category:** {{ optional(\App\Models\Category::find($data['category_id']))->name }}

Please review the incident and take appropriate action.

@component('mail::button', ['url' => '/all-complaints'])
View Incident
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
