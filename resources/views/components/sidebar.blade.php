<aside class="sidebar">

    <div id="following-container" class="w-full mb-3">
        <h1 class="w-full text-xl text-purple-600 mb-5 text-left">Following</h1>

        @foreach($following as $follow)
        <div data-user-id="{{$follow['user_following_id']}}" class="follow flex items-center mb-2">
            <div class="follow-avatar cursor-pointer flex-shrink-0 h-20 w-20">
                <img class="h-20 w-20 rounded-full border-purple-900 border-2" src="{{$follow['following_user']['profile_photo_url']}}" alt="">
            </div>
            <div class="ml-4">
                <div class="follow-name cursor-pointer text-lg font-medium text-purple-900">
                    {{$follow['following_user']['user_name']}}
                </div>
                <div class="text-md text-gray-500">
                    {{$follow['following_user']['name']}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div id="follow-suggestion-container" class="w-full">
        <h1 class="w-full text-xl text-purple-600 mb-5 text-left">Suggestions for you</h1>
        @foreach($suggestions as $suggestion)
        <div data-user-id="{{$suggestion['id']}}" class="follow w-full flex items-center mb-2 transition-opacity">
            <div class="follow-avatar cursor pointer flex-shrink-0 h-20 w-20">
                <img class="h-20 w-20 rounded-full border-purple-900 border-2" src="{{$suggestion['profile_photo_url']}}" alt="">
            </div>
            <div class="ml-4">
                <div class="follow-name cursor-pointer text-lg font-medium text-purple-900">
                    {{$suggestion['user_name']}}
                </div>
                <button type="button" class="follow-button border border-purple-500 text-purple-500 rounded-md px-4 py-0 m-2 transition duration-500 ease select-none hover:text-black hover:border-black hover:bg-yellow-300 focus:outline-none focus:shadow-outline">
                    Follow
                </button>
            </div>
        </div>
        @endforeach
    </div>

</aside>