@if (Auth::user()->image == '/images/default.jpg')
    <img class='avatar' src="{{ route('user.getDefaultAvatar') }}">
@else
    <img class='avatar' src="{{ route('user.getImage', Auth::user()->image) }}">
@endif
