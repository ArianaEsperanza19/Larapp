        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>
            @vite('resources/css/styles.css')
            @include('includes.avatar')

            <div class="py-12">
                @if (isset($images) && count($images) > 0)
                    @foreach ($images as $image)
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900 dark:text-gray-100">
                                        <p><b>Description:</b> {{ $image->description }}</p>
                                        <p><b>Name:</b> {{ $image->image_path }}</p>
                                        @if (asset('storage/image/' . $image->image_path) != null)
                                            <a href="{{ route('img.details', ['id_img' => $image->id]) }}">
                                                <img class='formImg'
                                                    src="{{ asset('storage/image/' . $image->image_path) }}"></a>
                                        @endif
                                        <p><b>Created at:</b> {{ $image->created_at->diffForHumans() }}</p>
                                        <p><b>Updated at:</b> {{ $image->updated_at->diffForHumans() }}</p>
                                    </div>
                                    <!-- link de comentarios -->
                                    <span class='' href=''>
                                        @if (count($image->comments) == 0 || count($image->comments) > 1)
                                            Comentarios {{ count($image->comments) }}
                                        @endif
                                        @if (count($image->comments) == 1)
                                            Comentario {{ count($image->comments) }}
                                        @endif
                                    </span>

                                    <!-- Likes -->
                                    <button class='btn' style='margin-left: 0px'>Like <span
                                            class='likes'>{{ count($image->likes) }}</span></button>
                                </div>
                            </div>
                    @endforeach
                    <!-- Paginacion -->
                    <link rel="stylesheet"
                        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
                    <div class='pag'>
                        {{ $images->links() }}
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
            </div>
        </x-app-layout>
