<article id="{{$post['id']}}" class="article">
            <div class="article-header">
                <div class="user-picture" style="background-image: url({{$post['user']['picture']}});"></div>
                <div class="article-user-name">{{$post['user']['name']}}</div>
            </div>
            <div class="article-gif-container">
                <img class="gif" src="{{$post['gif']}}">
            </div>
            <div class="article-interactive">
                <div class="interaction-row">
                    <div class="likes-comments"><i class="far fa-heart mr-10"></i><i class="far fa-comment scale-x-100"></i></div>
                    <i class="far fa-bookmark"></i>
                </div>
                <div class="likes-info">{{$post['likes']}} Likes</div>
                <div class="article-description"><span class="description-user-name">{{$post['user']['name']}}</span> ipsum dolor sit, amet consectetur adipisicing elit. Earum repudiandae voluptatum corporis iure at cum, voluptate distinctio, quaerat non porro a eos doloremque deserunt eaque! Rerum quidem ratione eum quasi.</div>
                <div class="article-comments-cnt">
                    <p class="mt-2 text-gray-500 underline cursor-pointer">See the <span class="number-of-comments">34</span> comments </p>
                    <!-- @foreach($post['comments'] as $comment)
                    <x-comment :comment="$comment" />
                    @endforeach -->
                </div>
            </div>
            <form class="article-add-comment px-8">
                <input type="text" name="add-comment" placeholder="Add a comment...">
            </form>   
        </article>