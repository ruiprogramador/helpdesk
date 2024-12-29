<x-mail::message>
# Ticket Notification : {{ $ticket->title }}

Dear {{ $ticket->first_name }},
<br>
{!! $ticket->introduction !!}
<br>
Here are the details:
<br>
Ticket #: {{ $ticket->ticket_id }}
<br>
Title: {{ $ticket->title }}
<br>
Priority: {{ $ticket->priority }}
<br>
Status: {{ $ticket->status }}
<br>
Description: {{ $ticket->description }}

<x-mail::button :url="$ticket->url">
View Ticket
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
