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
</x-app-layout>
