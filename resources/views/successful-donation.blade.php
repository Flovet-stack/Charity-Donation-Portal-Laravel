@extends('layouts.layout')
@section('page-title')
Successful Donation
@endsection
@section('content')
{{ View::make('components.header') }}
<div class="page-start">
    <div class="con">
        <div class="success-card">
            <h1>Successfull Donation</h1>
            <div class="donation-info">
                <p>Transaction Status:</p><span>{{ $donationInfo->status }}</span>
            </div>
            <div class="donation-info">
                <p>Amount:</p><span>{{ $donationInfo->donation_amount }}FCFA</span>
            </div>
            <div class="donation-info">
                <p>Transaction ID:</p><span>{{ $donationInfo->transaction_id }}</span>
            </div>
            <form action="/save-donation/{{ $donationInfo->transaction_id }}" method="POST">
                @csrf
                {{-- <input type="text" name="campaign_id" id="campaign_id" value="{{ $current_campaign['campaign_id'] }}" placeholder="amount" required> --}}
                <input type="hidden" name="author_id" id="author_id" value="{{ Session::get('user_id') }}" placeholder="amount" required>
                <button type="submit" href="" class="btn btn-red">Continue and Save Donation</button>
            </form>
        </div>

    </div>
</div>
@endsection