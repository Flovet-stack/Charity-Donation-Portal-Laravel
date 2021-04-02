@extends('layouts.layout')
@section('page-title')
Campaigns
@endsection
@section('content')
{{ View::make('components.header') }}

<div class="page-start">
    <div class="con">
        <h1 class="large-heading">All Campaigns</h1>
        <div class="all-campaigns">
            @if($campaigns->count() == 0)
            <h3>No Campaigns to show</h3>
            @else
                @foreach ($campaigns as $campaign)
                    <div class="campaign-card">
                        <img src="{{ asset('images/img/boy.jpg') }}" alt="">
                        <div class="campaign-info">
                            <h1>{{ $campaign->campaign_name }}</h1>
                            <h4><span>By</span> {{ $campaign->author }}</h4>
                            <div class="donated-amount">12,080.00FCFA</div>
                            <input type="range" name="percentage" id="percentage" value="50" disabled>
                            <div class="card-flex">
                                <div class="percentage">50% Donated</div>
                                <div class="goal">Goal: {{ $campaign->goal_amount }}FCFA</div>
                            </div>
                            <p>{{ $campaign->description }}</p>
                            <a href="\donate\{{ $campaign->campaign_id }}" class="btn btn-blue">Donate Now</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection