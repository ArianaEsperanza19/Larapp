        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Details') }}
                </h2>
            </x-slot>
            @vite('resources/css/styles.css')
            @if (isset($image))
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <!-- Likes -->
                                <button class='btn' style='margin-left: 0px'>Like <span
                                        class='likes'>{{ count($image->likes) }}</span></button>
                                <p><b>Description:</b> {{ $image->description }}</p>
                                <p><b>Name:</b> {{ $image->image_path }}</p>
                                @if (asset('storage/image/' . $image->image_path) != null)
                                    <img class='formImg' src="{{ asset('storage/image/' . $image->image_path) }}">
                                @endif
                                <p><b>Created at:</b> {{ $image->created_at->diffForHumans() }}</p>
                                <p><b>Updated at:</b> {{ $image->updated_at->diffForHumans() }}</p>
                            </div>

                        </div>
                    </div>
            @endif

            @if (session('message'))
                <br>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            @endif
            <!-- Comentarios -->
            @if (count($image->comments) == 0 || count($image->comments) > 1)
                <h2>Comentarios {{ count($image->comments) }}
                </h2>
            @endif
            @if (count($image->comments) == 1)
                <h2>Comentario {{ count($image->comments) }}</h2>
            @endif
            @foreach ($image->comments as $comment)
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="comment">
                                <p><b>User:</b> {{ $image->user->name }}</p>
                                <p><b>Created at:</b> {{ $comment->created_at->diffForHumans() }}<br>
                                <p><b>Updated at:</b> {{ $comment->updated_at->diffForHumans() }}<br>
                                    {{ $comment->content }}<br>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>
            </div>
        </x-app-layout>
