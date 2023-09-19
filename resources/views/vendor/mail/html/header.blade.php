@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'TerraMoni')
<img src="https://portal.datacraftgarage.com/landing/assets/images/tsp-logo.png" class="logo" alt="TerraMoni Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
