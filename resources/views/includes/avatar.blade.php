@if (Auth::user()->image == '/images/default.jpg' || Auth::user()->image == null)
    <img class='avatar' src="{{ route('user.getDefaultAvatar') }}">
@else
    <img class='avatar' src="{{ route('user.getImage', Auth::user()->image) }}">
@endif
