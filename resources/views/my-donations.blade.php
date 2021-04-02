@extends('layouts.layout')
@section('page-title')
My Donations
@endsection
@section('content')
{{ View::make('components.header') }}
<div class="page-start">
    <div class="con">
        {{ $myDonations }}
    </div>
</div>
@endsection