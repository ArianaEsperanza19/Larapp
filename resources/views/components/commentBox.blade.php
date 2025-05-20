<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Deja un comentario</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('comment.register') }}" method="POST">
                @csrf

                <!-- Inputs ocultos corregidos -->
                <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                <input type="hidden" name="image" id="image" value="{{ $slot }}">

                <div class="form-group">
                    <h5>Usuario: {{ Auth::user()->name }}</h5>
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Escribe tu comentario aquí"></textarea>
                    <x-input-error class="alert alert-danger mt-2" :messages="$errors->get('comment')" />
                </div>

                <button type="submit" class="btn btn-primary mt-2">Enviar</button>
            </form>
        </div>
    </div>
</div>
