@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'HelpDesk')
<img src="{{ asset('img/helpdesk.png') }}" class="logo" alt="HelpDesk Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
