@extends('layouts.app')

@section('home')
<section class="home">
    <div id="articles-container" class="px-8">
        @foreach($posts as $post)
        <x-article :post="$post" />
        @endforeach
    </div>
</section>
<x-sidebar :following="$following" :suggestions="$suggestions" />
@endsection