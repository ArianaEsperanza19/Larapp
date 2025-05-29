<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>
    @vite('resources/css/styles.css')
    @vite('resources/css/dashboard.css')
    <br>
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
        <hr>
        <div style="clear: both"></div>
    @endforeach

</x-app-layout>
