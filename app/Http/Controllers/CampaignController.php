<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
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
        $campaign->author = session::get('username');
        $campaign->author_id = session::get('user_id');
        $campaign->description = $request->description;
        $campaign->image = $request->image;
        $campaign->save();

        return redirect('/all-campaigns');
    }

    public function myCampaigns() {
        $campaigns = DB::table('campaigns')->where('author_id', session::get('user_id'))->get();

        return view('my-campaigns', ['campaigns' => $campaigns]);
    }

    public function editCampaign($id) {
        {
            $current_campaign = (array)DB::table('campaigns')->where('campaign_id', $id)->get()[0];

            return view('edit-campaign', ['current_campaign' => $current_campaign]);
            // return $current_campaign;
        }
    }

    public function updateCampaign(Request $request, $id) {
        {
            $current_campaign = Campaign::find($id);

            // return view('edit-campaign', ['current_campaign' => $current_campaign]);
            return $current_campaign;
        }
    }
}
