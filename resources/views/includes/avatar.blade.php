@if (Auth::user()->image == '/images/default.jpg')
    <img style="height: 200px" src="{{ route('user.getDefaultAvatar') }}">
@else
    <img style="height: 200px" src="{{ route('user.getImage', Auth::user()->image) }}">
@endif
