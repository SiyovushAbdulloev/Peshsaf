@props(['status' => ''])

<div @class([
    'text-primary' => in_array($status, ['new', 'used']),
    'text-warning' => in_array($status, ['on_approval', 'approving', 'pending']),
    'text-success' => in_array($status, ['approved', 'finished', 'sold']),
    'text-danger' => in_array($status, ['rejected', 'draft', 'utilized']),
])>
    {{ __($status) }}
</div>
