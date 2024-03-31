@extends('layouts/sidebar')

@section('head')
    <title>Список товаров</title>
@endsection

@section('content')
    <div class="mt-5">
        <livewire:admin.dictionaries.categories.index :$categories/>
    </div>
@endsection
