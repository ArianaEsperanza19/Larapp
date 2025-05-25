<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    @vite('resources/css/styles.css')
    @vite('resources/css/dashboard.css')
    <div class="info-profile-box">
        <div>
            <div class="big-avatar">
                @if ($user->image == '/images/default.jpg' || $user->image == null)
                    <img src="{{ route('user.getDefaultAvatar') }}" class="rounded-circle img-thumbnail me-3 mt-1"
                        width="60">
                @else
                    <img src="{{ route('user.getImage', ['fileName' => $user->image]) }}"
                        class="rounded-circle img-thumbnail me-3 mt-1" width="60">
                @endif
            </div>
            <div class="info-container">
                <div class="User"><?php echo '@'; ?>{{ $user->name }} {{ $user->surname }}</div>
                <div class="Email">{{ $user->email }}</div>
                <div>Se unió: {{ $user->created_at->diffForHumans() }}</div>
            </div>
        </div>
    </div>

    <!-- Imágenes del usuario -->
    <div class="user-images">
        @foreach ($user->images as $image)
            <div class="container py-4">
                <div class="card shadow-sm bg-white dark:bg-gray-800">
                    <div class="card-body text-gray-900 dark:text-gray-100">
                        <h5 class="card-title fw-bold">Descripción</h5>
                        <p class="card-text">{{ $image->description }}</p>


                        @if (asset('storage/image/' . $image->image_path) != null)
                            <a href="{{ route('img.details', ['id_img' => $image->id]) }}" class="d-block text-center">
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
                        <x-btn-blue>Likes <span class="badge bg-primary">{{ count($image->likes) }}</span></x-btn-blue>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Paginacion -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <div class='pag'>
        {{ $images->links() }}
    </div>

</x-app-layout>
