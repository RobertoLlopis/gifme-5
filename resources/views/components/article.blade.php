<article id="{{$post['id']}}" data-status="{{$post['like_status']}}" class="article shadow-xl">
    <div class="article-header">
        <div class="user-picture cursor-pointer" style="background-image: url({{$post['user']['profile_photo_url']}});"></div>
        <div class="article-user-name cursor-pointer">{{$post['user']['name']}}</div>
    </div>
    <div class="article-gif-container">
        <img class="gif" src="{{$post['gif']}}">
    </div>
    <div class="article-interactive">
        <div class="interaction-row">
            <div class="likes mr-10 text-center">
                <i class="interactive-icon {{$post['like_status'] == 1 ? 'fas' : 'far'}} fa-heart inline-block w-full"></i>
                <span class="likes-info">
                    @if($post['likes_count'] > 0)
                    {{$post['likes_count']}} Likes
                    @endif
                </span>
            </div>
            <div class="comments mr-10 text-center">
                <i class="interactive-icon far fa-comment scale-x-100 inline-block w-full"></i>
                <span class="comments-info">
                    @if($post['comments_count'] > 0)
                    {{$post['comments_count']}} comments
                    @endif
                </span>
            </div>
            <div class="dislikes mr-10 text-center">
                <i class="interactive-icon {{$post['like_status'] == 2 ? 'fas' : 'far'}} fa-dizzy inline-block w-full"></i>
                <span class="dislikes-info">
                    @if($post['dislikes_count'] > 0)
                    {{$post['dislikes_count']}} Dislikes
                    @endif
                </span>
            </div>
        </div>
        <div class="article-description"><span class="description-user-name">{{$post['user']['name']}}</span> ipsum dolor sit, amet consectetur adipisicing elit. Earum repudiandae voluptatum corporis iure at cum, voluptate distinctio, quaerat non porro a eos doloremque deserunt eaque! Rerum quidem ratione eum quasi.</div>
        <div class="article-comments-cnt mt-2">
            @if($post['comments_count'] > 2)
            <p class="text-gray-500 underline cursor-pointer">See more comments...</p>
            @endif
            @foreach($post['comments'] as $comment)
            <x-comment :comment="$comment" />
            @endforeach
        </div>
    </div>
    <form class="article-add-comment px-8">
        <input type="text" name="add-comment" placeholder="Add a comment...">
    </form>
</article>