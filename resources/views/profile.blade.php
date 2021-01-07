@extends('layouts.app')

@section('profile')

<section id="profile" class="bg-purple-100 ">

    <div class="container mx-auto flex items-center flex-wrap py-8 pb-12">

        <header id="profile-info" class="w-full flex top-0 px-12 pt-4 pb-8">
            <div class="flex-shrink-0 w-40 h-40 xl:h-60 xl:w-60">
                <img class="h-40 w-40 xl:h-60 xl:w-60 rounded-full border-purple-900 border-2" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
            </div>
            <div id="user-info-container" class="w-auto px-7">
                <div class="user-info-row w-full | text-3xl text-purple-900 font-bold | py-2">$user_name</div>
                <div class="user-info-row | w-full px-10 flex justify-around items-center | text-xl text-purple-900 font-semibold | py-1"><span>$gifs gifs</span><span>$followers followers</span><span>$following following</span></div>
                <div class="user-info-row w-full pt-3">
                    <h2 class="text-xl text-purple-900 font-semibold">$profile_title | Lorem ipsum dolor sit amet conse</h2>
                    <p class="text-md text-purple-900">$profile_description | Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime voluptate corporis esse ratione, voluptatum officia eos iure ducimus praesentium necessitatibus expedita vero est aspernatur! Deleniti dignissimos quo quis a dolore!
                        Quo sint neque quae nihil quod quaerat aliquam </p>
                </div>
            </div>
        </header>
        <div id="profile-posts-container" class="w-full h-full bg-gray-50 flex items-center flex-wrap">
            <div class="profile-post w-full md:w-1/3 xl:w-1/4 p-3 flex flex-col">
                <a href="#" class="relative hover:shadow-lg hover:grow">
                    <img class="hover:grow" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=400&amp;h=400&amp;q=80">
                    <div class="icon-layer hidden transition hover-layer bg-gray-500 bg-opacity-50 absolute h-full w-full top-0 left-0 flex justify-center items-center">
                        <i class="fas fa-heart text-yellow-300 text-3xl"></i><span class="px-2 text-xl font-semibold">125</span>
                        <i class="far fa-dizzy text-yellow-300 text-3xl"></i><span class="px-2 text-xl font-semibold">1</span>
                        <i class="fas fa-comments text-yellow-300 text-3xl"></i><span class="pl-2 text-xl font-semibold">21</span>
                    </div>
                </a>
            </div>
            <div class="profile-post w-full md:w-1/3 xl:w-1/4 p-3 flex flex-col">
                <a href="#" class="relative hover:shadow-lg hover:grow">
                    <img class="hover:grow" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=400&amp;h=400&amp;q=80">
                    <div class="icon-layer hidden transition hover-layer bg-gray-500 bg-opacity-50 absolute h-full w-full top-0 left-0 flex justify-center items-center">
                        <i class="fas fa-heart text-yellow-300 text-3xl"></i><span class="px-2 text-xl font-semibold">125</span>
                        <i class="far fa-dizzy text-yellow-300 text-3xl"></i><span class="px-2 text-xl font-semibold">1</span>
                        <i class="fas fa-comments text-yellow-300 text-3xl"></i><span class="pl-2 text-xl font-semibold">21</span>
                    </div>
                </a>
            </div>
            <div class="profile-post w-full md:w-1/3 xl:w-1/4 p-3 flex flex-col">
                <a href="#" class="relative hover:shadow-lg hover:grow">
                    <img class="hover:grow" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=400&amp;h=400&amp;q=80">
                    <div class="icon-layer hidden transition hover-layer bg-gray-500 bg-opacity-50 absolute h-full w-full top-0 left-0 flex justify-center items-center">
                        <i class="fas fa-heart text-yellow-300 text-3xl"></i><span class="px-2 text-xl font-semibold">125</span>
                        <i class="far fa-dizzy text-yellow-300 text-3xl"></i><span class="px-2 text-xl font-semibold">1</span>
                        <i class="fas fa-comments text-yellow-300 text-3xl"></i><span class="pl-2 text-xl font-semibold">21</span>
                    </div>
                </a>
            </div>
            <div class="profile-post w-full md:w-1/3 xl:w-1/4 p-3 flex flex-col">
                <a href="#" class="relative hover:shadow-lg hover:grow">
                    <img class="hover:grow" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=400&amp;h=400&amp;q=80">
                    <div class="icon-layer hidden transition bg-gray-500 bg-opacity-50 absolute h-full w-full top-0 left-0 justify-center items-center">
                        <i class="fas fa-heart text-yellow-300 text-3xl"></i><span class="px-2 text-xl font-semibold">125</span>
                        <i class="far fa-dizzy text-yellow-300 text-3xl"></i><span class="px-2 text-xl font-semibold">1</span>
                        <i class="fas fa-comments text-yellow-300 text-3xl"></i><span class="pl-2 text-xl font-semibold">21</span>
                    </div>
                </a>
            </div>

            <div class="w-full md:w-1/3 xl:w-1/4 p-3 flex flex-col">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1508423134147-addf71308178?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=400&amp;h=400&amp;q=80">
                    <div class="pt-3 flex items-center justify-between">
                        <p class="">Product Name</p>
                        <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z"></path>
                        </svg>
                    </div>
                    <p class="pt-1 text-gray-900">£9.99</p>
                </a>
            </div>
        </div>
    </div>

</section>

@endsection