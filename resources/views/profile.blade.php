@extends('layouts.app')

@section('profile')

<section id="profile" class="bg-purple-100 ">

    <div class="container mx-auto flex items-center flex-wrap py-8 pb-12">

        <header id="profile-info" data-user-id="{{$profile['profile_info']['id']}}" class="w-full flex top-0 px-12 pt-4 pb-8">
            <div class="flex-shrink-0 w-40 h-40 xl:h-60 xl:w-60">
                <img class="h-40 w-40 xl:h-60 xl:w-60 rounded-full border-purple-900 border-2" src="{{$profile['profile_info']['profile_photo_url']}}" alt="">
            </div>
            <div id="user-info-container" class="w-auto px-7">
                <div class="user-info-row w-full | text-3xl text-purple-900 font-bold | py-2">
                    <h2 class="w-min inline-block">{{$profile['profile_info']['user_name']}}</h2>
                    <button id="profile-follow" type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{$following_status == 0 ? 'bg-yellow-300 hover:bg-purple-900' : 'bg-purple-900 hover:bg-yellow-300' }}  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        @if($following_status == 0)
                        <i class="fas fa-plus mr-3"></i>
                        Follow
                        @else
                        <i class="fas fa-minus mr-3"></i>
                        Unfollow
                        @endif
                    </button>
                </div>
                <div class="user-info-row | w-full px-10 flex justify-around items-center | text-xl text-purple-900 font-semibold | py-1"><span>{{$profile['gifs_count']}} gifs</span><span>{{$profile['followers']}} followers</span><span>{{$profile['following']}} following</span></div>
                <div class="user-info-row w-full pt-3">
                    <h2 class="text-xl text-purple-900 font-semibold">{{$profile['profile_info']['title']}}</h2>
                    <p class="text-md text-purple-900">{{$profile['profile_info']['description']}}</p>
                </div>
            </div>
        </header>

        <div id="profile-posts-container" class="w-full h-full bg-gray-50 flex items-center flex-wrap">
            @foreach($posts as $post)
            <div data-post-id="{{$post['id']}}" class="profile-post w-full md:w-1/3 xl:w-1/4 p-3 flex flex-col">
                <a href="#" class="relative hover:shadow-lg hover:grow">
                    <img class="hover:grow" src="{{$post['gif']}}">
                    <div class="icon-layer hidden transition hover-layer bg-gray-500 bg-opacity-50 absolute h-full w-full top-0 left-0 flex justify-center items-center">
                        <i class="interactive-icon {{$post['like_status'] == 1 ? 'fas' : 'far'}} fa-heart text-yellow-300 text-3xl"></i><span class="likes-count px-2 text-xl font-semibold">{{$post['likes_count']}}</span>
                        <i class="interactive-icon {{$post['like_status'] == 2 ? 'fas' : 'far'}} fa-dizzy text-yellow-300 text-3xl"></i><span class="dislikes-count px-2 text-xl font-semibold">{{$post['dislikes_count']}}</span>
                        <i class="interactive-icon fas fa-comments text-yellow-300 text-3xl"></i><span class="comment-count pl-2 text-xl font-semibold">{{$post['comments_count']}}</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</section>

@endsection