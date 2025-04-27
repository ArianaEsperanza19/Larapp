        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>
            @vite('resources/css/styles.css')
            @include('includes.avatar')

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("You're logged in!") }}
                        </div>
                    </div>
                </div>
                @if (isset($images) && count($images) > 0)
                    @foreach ($images as $image)
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900 dark:text-gray-100">
                                        <p><b>Description:</b> {{ $image->description }}</p>
                                        <p><b>Name:</b> {{ $image->image_path }}</p>
                                        @if (asset('storage/image/' . $image->image_path) != null)
                                            <img class='formImg'
                                                src="{{ asset('storage/image/' . $image->image_path) }}">
                                        @endif
                                        <p><b>Created at:</b> {{ $image->created_at->diffForHumans() }}</p>
                                        <p><b>Updated at:</b> {{ $image->updated_at->diffForHumans() }}</p>
                                    </div>
                                    <!-- link de comentarios -->
                                    <button class='btn' href=''>Comentarios</button>
                                    <!-- Likes -->
                                    <button class='btn' style='margin-left: 0px'>Like <span
                                            class='likes'>1</span></button>
                                </div>
                            </div>
                    @endforeach
                    <!-- Paginacion -->
                    <div class="clearfix"></div>
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
