<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Details') }}
        </h2>
    </x-slot>

    @vite('resources/css/styles.css')

    @if (isset($image))
        <div class="container py-4">
            <div class="card shadow-sm bg-white dark:bg-gray-800">
                <div class="card-body text-gray-900 dark:text-gray-100">
                    <h5 class="card-title fw-bold">Descripción</h5>
                    <p class="card-text">{{ $image->description }}</p>
                    <h6 class="card-subtitle mb-2 text-muted">Nombre de archivo: <span
                            class="card-text">{{ $image->image_path }}</span>
                    </h6>
                    <br>
                    @if (asset('storage/image/' . $image->image_path) != null)
                        <div class="text-center">
                            <div class="text-center d-flex justify-content-center">
                                <img class="img-fluid rounded shadow-sm"
                                    src="{{ asset('storage/image/' . $image->image_path) }}" alt="Imagen">
                            </div>

                        </div>
                    @endif
                </div>

                <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <p class="mb-0"><b>Creado hace:</b> {{ $image->created_at->diffForHumans() }}</p>
                        <p class="mb-0"><b>Actualizado hace:</b> {{ $image->updated_at->diffForHumans() }}</p>
                    </div>

                    <button class="btn btn-outline-primary">Like
                        <span class="badge bg-primary">{{ count($image->likes) }}</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    <!-- Comentarios de la imagen -->
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5>Comentarios</h5>
            </div>
            <div class="card-body">
                @if (isset($comments) && count($comments) > 0)
                    @foreach ($comments as $comment)
                        <div class="d-flex align-items-start mb-0">
                            <!-- Imagen de perfil -->
                            @if (Auth::user()->image == '/images/default.jpg')
                                <img class="rounded-circle img-thumbnail me-3 mt-2" width="60" alt="Avatar"
                                    src="{{ route('user.getDefaultAvatar') }}">
                            @else
                                <img class="rounded-circle img-thumbnail me-3 mt-2" width="60" alt="Avatar"
                                    src="{{ route('user.getImage', Auth::user()->image) }}">
                            @endif

                            <!-- Contenido del comentario -->
                            <div class="alert alert-light border flex-grow-1">
                                <p class="mb-0"><strong>Nombre:</strong> {{ $comment->user->name }}</p>
                                <p class="mb-0"><strong>Comentario:</strong> {{ $comment->content }}</p>
                                <p class="mb-0"><strong>Created at:</strong>
                                    {{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-end mb-3">
                            <x-btn-blue>Editar</x-btn-blue>
                            <x-btn-delete>Eliminar</x-btn-delete>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No hay comentarios aún.</p>
                @endif
            </div>

        </div>
    </div>

    <!-- Caja de comentarios -->
    <x-commentBox>
        {{ $image->id }}
    </x-commentBox>
    <!-- Errores -->
</x-app-layout>
