@props(['icon' => null, 'width' => 24, 'height' => 24])

<i
    {{ $attributes->class(merge(["stroke-1.6 fa " . uncamelize($icon, '-'), $attributes->whereStartsWith('class')
    ->first()]))->merge($attributes->whereDoesntStartWith('class')->getAttributes()) }}
></i>
