@extends('layouts.layout')
@section('page-title')
Make Donation
@endsection
@section('content')
{{ View::make('components.header') }}

<form class="register-form" action="/create-donation/{{ $current_campaign['campaign_id'] }}" method="POST">
    {{-- <div class="error-card">{{ $error }}</div> --}}
    @csrf
    <h3 class="caption">Save your donation to {{ $current_campaign['campaign_name'] }}</h3>
    <div class="form-item">
        <input type="text" name="campaign_id" id="campaign_id" value="{{ $current_campaign['campaign_id'] }}" placeholder="amount" required>
        <input type="text" name="author_id" id="author_id" value="{{ Session::get('user_id') }}" placeholder="amount" required>
    </div>
    <button type="submit" class="btn btn-blue">Donate</button>

</form>
@endsection