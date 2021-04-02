@extends('layouts.layout')
@section('page-title')
Home
@endsection
@section('content')
<header id="home-header">
    <div class="header-sub-1">
        <div class="logo"><a href="/">O-Donate</a></div>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/all-campaigns">All Campaigns</a></li>
                @if (Session::has('user'))
                <li><a href="\my-campaigns">My Campaigns</a></li>
                <li><a href="/user-profile/{{ session('user_id') }}">My Profile</a></li>
                @endif
            </ul>
        </nav>
    </div>
    <div class="header-sub-2">
        <a class="btn btn-blue" href="/create-campaign">Create Campaign</a>
        @if (!Session::has('user'))
        <a class="btn btn-red" href="/register">Register</a>
        @else 
        <div class="user-menu">
            <button class="user-card"><img src="" alt=""> {{ session('user')['username'] }}</button>
            <ul>
                <li><a href="/user-profile/{{ session('user')['username'] }}">Profile</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
        @endif
    </div>
</header>
<div id="hero">
    <h1>Donate And Change Lives</h1>
    <p>We build strength, stability and self-reliance through shelter</p>
    <span>
        <a href="\all-campaigns" class="btn btn-blue">Act Now</a>
        @if(!Session::has('user'))
        <a href="/login" class="btn btn-red">Login</a>
        @endif
    </span>
</div>
<div class="intro">
    <div class="intro-1">
        <p>The long journey to end poverty begins with a child.</p>
        <a href="" class="btn-border">Donate Now</a>
    </div>
    <div class="intro-2">
        <p>Want to lunch a new campaign ?</p>
        <a href="/create-campaign" class="btn-border">Create Campaign</a>
    </div>
    <div class="intro-3"></div>
</div>
@endsection