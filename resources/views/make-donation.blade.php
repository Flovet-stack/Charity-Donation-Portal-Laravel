@extends('layouts.layout')
@section('page-title')
Make Donation
@endsection
@section('content')
{{ View::make('components.header') }}

<form class="register-form" action="/create-donation/{{ $current_campaign['id'] }}" method="POST">
    {{-- <div class="error-card">{{ $error }}</div> --}}
    @csrf
    <h3 class="caption">You are making a donation to {{ $current_campaign['campaign_name'] }}</h3>
    <div class="form-item">
        <label for="amount">Enter Amount To Donate</label>
        <input type="amount" name="amount" id="amount" placeholder="amount" required>
    </div>
    <a href="./my-donations" type="submit" class="btn btn-blue">Donate</a>

</form>
@endsection

