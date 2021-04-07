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
                @if($donationInfo->status == 'SUCCESS')
                <p>Transaction Status:</p><span class="green">{{ $donationInfo->status }}</span>
                @else
                <p>Transaction Status:</p><span class="red">{{ $donationInfo->status }}</span>
                @endif
            </div>
            <div class="donation-info">
                <p>Amount:</p><span>{{ $donationInfo->donation_amount }}FCFA</span>
            </div>
            <div class="donation-info">
                <p>Transaction ID:</p><span>{{ $donationInfo->transaction_id }}</span>
            </div>
            <form action="/my-donations" method="POST">
                @csrf
                {{-- <input type="hidden" value="{{ $donationInfo->campaign_id}}" name="campaign_id" id=""> --}}
                <button type="submit" href="" class="btn btn-red">Continue and Save Donation</button>
            </form>
        </div>

    </div>
</div>
@endsection

