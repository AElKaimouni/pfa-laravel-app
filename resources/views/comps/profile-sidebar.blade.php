<div class="user-information">
    <div class="user-img">
        <a href="#"><img src="/images/uploads/user-img.png" alt=""><br></a>
        <a href="#" class="redbtn">Change avatar</a>
    </div>
    <div class="user-fav">
        <p>Account Details</p>
        <ul>
            <li @if($active === "profile") class="active" @endif><a href="userprofile.html">Profile</a></li>
            <li><a href="userfavoritelist.html">Favorite movies</a></li>
            <li><a href="userrate.html">Rated movies</a></li>
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