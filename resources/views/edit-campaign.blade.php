@extends('layouts.layout')
@section('page-title')
Edit Campaign
@endsection
@section('content')
{{ View::make('components.header') }}
<form class="register-form" action="/update-campaign/{{ $current_campaign['campaign_id'] }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h3 class="caption">Create Campaign</h3>
    <div class="form-item">
        <label for="name">Campaign Name</label>
        <input type="text" name="name" id="name" placeholder="name" value="{{ $current_campaign['campaign_name'] }}" required>
    </div>
    <div class="form-item">
        <label for="goal_amount">Goal Amount</label>
        <input type="text" name="goal_amount" id="goal_amount" value="{{ $current_campaign['goal_amount'] }}" placeholder="amount" required>
    </div>
    <div class="form-item">
        <label for="description">Description</label>
        <textarea type="description" name="description" id="description" required>
            {{ $current_campaign['description'] }}
        </textarea>
    </div>
    <div class="form-item">
        <label for="image">Profle Image</label>
        <input type="file" name="image" value="{{ $current_campaign['image'] }}" id="image">
    </div>

    <button type="submit" class="btn btn-blue">Create Your Campaign</button>
</form>
@endsection