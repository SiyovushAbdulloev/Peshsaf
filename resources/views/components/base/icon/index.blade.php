@props(['icon' => null])

<i
    {{ $attributes->class(merge(["w-4 h-4 leading-4 text-base fa " . uncamelize($icon, '-'),
    $attributes->whereStartsWith
    ('class')
    ->first()]))->merge($attributes->whereDoesntStartWith('class')->getAttributes()) }}
></i>
