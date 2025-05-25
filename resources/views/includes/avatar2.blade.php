@if (Auth::user()->image == '/images/default.jpg' || Auth::user()->image == null)
    <img src="{{ route('user.getDefaultAvatar') }}">
@else
    <img src="{{ route('user.getImage', Auth::user()->image) }}">
@endif
