    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SocialDash') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <link rel="stylesheet" href="resources/css/styles.css"> -->


    <div class="font-sans antialiased">
        @vite('resources/css/styles.css')


        @if (isset($images) && count($images) > 0)
            @foreach ($images as $image)
                <div class="container py-4">
                    <div class="card shadow-sm bg-white dark:bg-gray-800">
                        <div class="card-body text-gray-900 dark:text-gray-100">
                            <h5 class="card-title fw-bold">Descripción</h5>
                            <p class="card-text">{{ $image->description }}</p>


                            @if (asset('storage/image/' . $image->image_path) != null)
                                <a href="{{ route('img.details', ['id_img' => $image->id]) }}"
                                    class="d-block text-center">
                                    <div class="text-center d-flex justify-content-center">
                                        <img class="img-fluid rounded"
                                            src="{{ asset('storage/image/' . $image->image_path) }}" alt="Imagen">
                                    </div>
                                </a>
                            @endif

                            <div class="text-muted mt-2"><b>Creado hace:</b>
                                {{ $image->created_at->diffForHumans() }}
                            </div>
                            <p class="text-muted"><b>Actualizado hace:</b> {{ $image->updated_at->diffForHumans() }}
                            </p>
                        </div>

                        <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                @if (count($image->comments) == 0 || count($image->comments) > 1)
                                    Comentarios {{ count($image->comments) }}
                                @else
                                    Comentario {{ count($image->comments) }}
                                @endif
                            </span>
                            <x-btn-blue>Likes <span
                                    class="badge bg-primary">{{ count($image->likes) }}</span></x-btn-blue>
                            <a
                                href="{{ route('img.delete', ['id_img' => $image->id, 'id_user' => $image->user_id]) }}">Eliminar</a>
                            <a href="{{ route('img.form.edit', ['id_img' => $image->id]) }}">Editar</a>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Paginacion -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
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
