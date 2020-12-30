<div id='modal-background-layer'>
    <div id="modal-new-post">
        <div class="max-w-md mx-auto bg-purple-300 rounded-lg overflow-hidden md:max-w-lg">
            <form class="w-full h-full px-4 py-6 flex flex-col justify-around">
                <h2 class="mb-0 text-center font-semibold text-3xl text-purple-900">Hit that gif up!</h2>
                <div class="mb-1"> <span class="text-m font-semibold text-purple-900">Description</span> <textarea type="text" class="h-12 py-1 px-3 w-full border-2 border-yellow-300 rounded focus:outline-none focus:border-purple-600 resize-none"></textarea> </div>
                <div class="mb-1"> <span class="text-m font-semibold text-purple-900 ">Browse your .gif here</span>
                    <div class="relative border-dotted h-32 rounded-lg border-dashed border-2 border-yellow-300 bg-white flex justify-center items-center">
                        <div class="absolute">
                            <div class="flex flex-col items-center"> <i class="far fa-file-image fa-3x text-yellow-300"></i> <span class="block text-purple-900 font-extrabold">Click here</span> </div>
                        </div> <input type="file" accept=".gif" class="h-full w-full opacity-0" name="">
                    </div>
                </div>
                <div class="mt-3 text-right"> <a id="cancel-new-post" class="text-purple-900"href="#">Cancel</a> <button type="submit" class="ml-2 h-10 w-32 bg-yellow-300 rounded text-purple-900 font-bold hover:bg-blue-700 hover:text-white">Create</button> </div>
            </form>
        </div>
    </div>
    <div id="modal-post-details"></div>
    <div id="modal-post-likes"></div>
</div>