<div class="user-information">
    <div class="user-img">
        <a href="#">
            <img id="user-avatar" src="@if($avatar){{ $base }}/avatars/{{ $avatar }}@else/images/uploads/user-img.png @endif" alt="">
            <br>
        </a>
    </div>
    <div class="user-fav">
        <p>Account Details</p>
        <ul>
            <li @if($active === "profile") class="active" @endif><a href="/profile">Profile</a></li>
            <li @if($active === "favorite") class="active" @endif><a href="/profile/favorite">Favorite movies</a></li>
            <li @if($active === "rated") class="active" @endif><a href="/profile/rated">Rated movies</a></li>
        </ul>
    </div>
    <div class="user-fav">
        <p>Others</p>
        <ul>
            <li @if($active === "password") class="active" @endif><a href="/profile/password">Change password</a></li>
            <li><a href="/logout">Log out</a></li>
        </ul>
    </div>
</div>