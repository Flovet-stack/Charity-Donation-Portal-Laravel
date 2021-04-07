@extends('layouts.layout')
@section('page-title')
My Donations
@endsection
@section('content')
{{ View::make('components.header') }}
<?php 
    use App\Models\Campaign; 

    $totalDonationAmount = 0;
    foreach($donations as $donation) {
        $totalDonationAmount += $donation->donation_amount;
    }
?>
<div class="page-start">
    <div class="con">
        <div class="info-card">
            <div class="sub-info">
                <p>Number of donations:</p><span>{{ $donations->count() }}</span>
            </div>
            <div class="sub-info">
                <p>Total donation amount:</p><span>{{ $totalDonationAmount }}XAF</span>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Transaction ID</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                <tr>
                    <td>{{ Campaign::find($donation->campaign_id)->campaign_name }}</td>
                    <td>{{ $donation->donation_amount }}XAF</td>
                    <td>{{ $donation->transaction_id }}</td>
                    <td>
                        @if($donation->status == 'SUCCESS')
                        <span class="success-pill green">{{ $donation->status }}</span>
                        @else
                        <span class="failure-pill red">{{ $donation->status }}</span>
                        @endif
                    </td>
                    <td>{{ $donation->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection