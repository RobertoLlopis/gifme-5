@extends('layouts.app')

@section('home')
<section class="home">
    <div id="articles-container" class="px-8">

        <x-article :post="['id'=> '12', 'description' => 'lorem dsjkfhsdkhfds dhsjkfhksdhf dskhgfkdjhgdkhsk dsjghsdjk', 'gif'=> 'https://i.imgur.com/70Iayvu.gif', 'likes' => '23', 'user' => ['name'=> 'voldemort', 'picture'=> 'https://i.imgur.com/XGadgeX.jpeg']]"/>
    </div>
</section>
@endsection