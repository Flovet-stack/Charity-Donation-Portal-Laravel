<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use Session;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function index() {
        $campaigns = Campaign::all();

        return view('campaigns', ['campaigns' => $campaigns]);
    }

    public function create(Request $request) {
        $campaign = new Campaign;
        $campaign->campaign_name = $request->name;
        $campaign->goal_amount = $request->goal_amount;
        $campaign->author = session::get('user')->username;
        $campaign->author_id = session::get('user')->id;
        $campaign->description = $request->description;
        $campaign->image = $request->file('image')->getClientOriginalName();
        $campaign->save();

        $imageName = $request->file('image')->getClientOriginalName();
        $destinationPath = 'public/img';

        $request->file('image')->move($destinationPath, $imageName);

        return redirect('/my-campaigns/'.session()->get('user')->username);
    }

    public function myCampaigns() {
        $campaigns = DB::table('campaigns')->where('author_id', session()->get('user')->id)->get();

        return view('my-campaigns', ['campaigns' => $campaigns]);
    }

    public function editCampaign($id) {
        {
            $current_campaign = (array)DB::table('campaigns')->find($id);

            return view('edit-campaign', ['current_campaign' => $current_campaign]);
        }
    }

    public function updateCampaign(Request $request, $id) {
        {
            $current_campaign = Campaign::find($id);

            $current_campaign->campaign_name = $request->campaign_name;
            $current_campaign->goal_amount = $request->goal_amount;
            $current_campaign->description = $request->description;
            $current_campaign->image = $request->file('image')->getClientOriginalName();
            $current_campaign->save();

            $imageName = $request->file('image')->getClientOriginalName();
            $destinationPath = 'public/img';
    
            $request->file('image')->move($destinationPath, $imageName);

            return redirect('/my-campaigns/'.session()->get('user')->username);
        }
    }

    public function deleteCampaign($id) {
        $current_campaign = Campaign::find($id);
        $current_campaign_donation = Donation::where('campaign_id', $id)->get();
        if(file_exists(public_path()."/public/img/".$current_campaign->image)) {
            unlink(public_path()."/public/img/".$current_campaign->image);
        }
        foreach($current_campaign_donation as $campaign_donation){
            $campaign_donation->delete();
        };
        $current_campaign->delete();

        // return $current_campaign_donation;
        // return ($current_campaign_donation[0]);
        return redirect('/my-campaigns/'.session()->get('user')->username);
    }
}



