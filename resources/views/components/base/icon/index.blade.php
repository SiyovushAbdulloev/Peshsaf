@props(['icon' => null, 'width' => 24, 'height' => 24])

<i
    class="fas {{ uncamelize($icon, '-') }}"
    {{ $attributes->class(merge(['stroke-1.5 w-5 h-5', $attributes->whereStartsWith('class')->first()]))->merge($attributes->whereDoesntStartWith('class')->getAttributes()) }}
></i>
