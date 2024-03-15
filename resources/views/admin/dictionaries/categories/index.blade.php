@extends('layouts/sidebar')

@section('head')
    <title>Список товаров</title>
@endsection

@section('content')
    <h2 class="intro-y mt-10 mb-4 text-lg font-medium">Список товаров</h2>

    <div class="overflow-x-auto">
        <livewire:admin.dictionaries.categories.index :categories="$categories"/>
    </div>
@endsection
