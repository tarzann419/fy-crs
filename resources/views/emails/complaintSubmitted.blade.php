@component('mail::message')
# Complaint Submitted

Dear {{ $data['name'] }},

Your complaint has been successfully submitted to the admin. Here are the details:

- **Description:** {{ $data['description'] }}
- **Date of Occurrence:** {{ $data['date_of_occurence'] }}
- **Category:** {{ optional(\App\Models\Category::find($data['category_id']))->name }}

Thank you for bringing this to our attention. We will review your complaint and get back to you as soon as possible.

If you have any further questions or concerns, feel free to contact us.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
