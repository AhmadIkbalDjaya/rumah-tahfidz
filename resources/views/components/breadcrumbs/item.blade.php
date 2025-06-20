@props([
  "label" => null,
  "href" => null,
])

<li>
  @if ($href)
    <a href="{{ $href }}">{{ $label ? __($label) : $slot }}</a>
  @else
    {{ $label ? __($label) : $slot }}
  @endif
</li>
