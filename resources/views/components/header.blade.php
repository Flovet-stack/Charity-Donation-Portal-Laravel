<header class="scroll">
    <div class="header-sub-1">
        <div class="logo"><a href="/">O-Donate</a></div>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="\all-campaigns">All Campaigns</a></li>
                @if (Session::has('user'))
                <li><a href="\my-campaigns">My Campaigns</a></li>
                <li><a href="/user-profile/{{ session('user_id') }}">My Profile</a></li>
                @endif
            </ul>
        </nav>
    </div>
    <div class="header-sub-2">
        
        <a class="btn btn-blue" href="\create-campaign">Create Campaign</a>
        @if (!Session::has('user'))
        @if(!Session::has('user'))
            @if(!Route::has('/register'))
            <a class="btn btn-red" href="/login">Login</a>
            @elseif (Route::has('/login'))
            <a class="btn btn-red" href="/login">Login</a>
            @else
            <a class="btn btn-red" href="/register">Register</a>
            @endif
        @endif
        @else 
        <div class="user-menu">
            <button class="user-card"><img src="" alt=""> {{ session('user')['username'] }}</button>
            <ul>
                <li><a href="/user-profile/{{ session('user_id') }}">Profile</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
        @endif
    </div>
</header>