<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-purple-600" style=" background: #422057;background: -moz-linear-gradient(top,  #422057 4%, #fcf951 100%);background: -webkit-linear-gradient(top,  #422057 4%,#fcf951 100%); background: linear-gradient(to bottom,  #422057 4%,#fcf951 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#422057', endColorstr='#fcf951',GradientType=0 );">
    <div>
        {{ $logo }}
    </div>

    <h1 class="text-white">You should log in first to enjoy!</h1>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>