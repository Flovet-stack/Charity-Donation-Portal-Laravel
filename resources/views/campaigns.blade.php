@extends('layouts.layout')
@section('page-title')
Campaigns
@endsection
@section('content')
{{ View::make('components.header') }}

<div class="page-start">
    <div class="con">
        <h1 class="large-heading">All Campaigns <span>({{ $campaigns->count() }})</span></h1>
        <div class="all-campaigns">
            @if($campaigns->count() == 0)
            <h3>No Campaigns Have been created yet</h3>
            @else
                @foreach ($campaigns as $campaign)
                    <div class="campaign-card">
                        <img src="{{ asset("public/img/$campaign->image") }}" alt="">
                        <div class="campaign-info">
                            <h1>{{ $campaign->campaign_name }} {{ $campaign->id }}</h1>
                            <h4><span>By</span> <a href="/user-profile/{{ $campaign->author }}">{{ $campaign->author }}</a> </h4>
                            <div class="donated-amount"><span class="amount">{{ $campaign->donated_amount }} </span>FCFA</div>
                            <input type="range" name="percentage" id="percentage" value="{{ (($campaign->donated_amount)*100)/$campaign->goal_amount }}" disabled>
                            <div class="card-flex">
                                <div class="percentage">{{ (($campaign->donated_amount)*100)/$campaign->goal_amount }}% Donated</div>
                                <div class="goal">Goal: <span class="amount">{{ $campaign->goal_amount }}</span> FCFA</div>
                            </div>
                            <p>{{ $campaign->description }}</p>
                            @if ($campaign->author_id == session('user')->id)
                            <div class="card-flex">
                                <a href="\edit-campaign\{{ $campaign->id }}" class="btn btn-blue">Edit</a>
                                <button href="" class="btn btn-red delete-btn">Delete</button>
                                <button href="" class="btn btn-red cancel-delete">Cancel</button>
                                <a href="\delete-campaign\{{ $campaign->id }}" class="btn btn-red confirm-delete">Confirm</a>
                            </div>
                            @else 
                            <a href="\donate\{{ $campaign->id }}" class="btn btn-blue">Donate Now</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection







