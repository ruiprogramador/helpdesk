<x-mail::message>
# Introducting the email message.

The body of my message.

<x-mail::button :url="''">
Button XPTO
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
