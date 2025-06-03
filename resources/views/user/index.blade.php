    @vite('resources/css/styles.css')
    @vite('resources/css/dashboard.css')
    @vite('resources/js/main.js')
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
    </head>

    <body>
        <!-- Contenido aquí -->
    </body>

    </html>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Index') }}
            </h2>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="{{ asset('js/main.js') }}"></script>
            <form method="get" action="{{ route('user.index') }}" class="space-y-6 mt-2" id="searcher">
                <input type="text" name="search" id="search" placeholder="Busca un usuario">
                <a type="submit" class="btn btn-outline-primary" value="Buscar" id="submit">Buscar</a>
            </form>
        </x-slot>
        <br>
        <x-box-layout>
            @foreach ($users as $user)
                <div class="info-index-box">
                    <div>
                        @if ($user->image == '/images/default.jpg' || $user->image == null)
                            <img class="avatar-index" src="{{ route('user.getDefaultAvatar') }}"
                                class="rounded-circle img-thumbnail me-3 mt-1" width="60">
                        @else
                            <img class="avatar-index" src="{{ route('user.getImage', ['fileName' => $user->image]) }}"
                                class="rounded-circle img-thumbnail me-3 mt-1" width="60">
                        @endif
                        <div class="info-container">
                            <div class="User"><?php echo '@'; ?>{{ $user->name }} {{ $user->surname }}</div>
                            <div>Se unió: {{ $user->created_at->diffForHumans() }}</div>
                            <div class="Email">{{ $user->email }}</div>
                            <a href="{{ route('profile.info', ['id' => $user->id]) }}">Ver perfil</a>
                        </div>
                    </div>
                </div>
                <div style="clear: both"></div>
                <br>
            @endforeach
        </x-box-layout>

    </x-app-layout>
