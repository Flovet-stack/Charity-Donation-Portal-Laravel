<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\PayUnit;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Session;

class DonationController extends Controller
{

    public function makeDonation(Request $request, $id) {
        $current_campaign = (array)DB::table('campaigns')->where('id', $id)->get()[0];
        $request->session()->put('donatedCampaign', $current_campaign);

    
        return view('make-donation', ['current_campaign' => $current_campaign]);
    }

    public function donate(Request $request) {
        $user_id = Session::get('user')->id;

        $myPayment = new PayUnit(
            "51f319a7fe052fbb4be7aa13483f617209944253",
            "01b3b5a0-a608-4e0b-9dff-b34b46665595",
            "payunit_sand_xUo2SWcG5",
            "http://127.0.0.1:8000/donations-response/$user_id/$request->id",
            "http://127.0.0.1:8000/donations",
            "test",
            "description",
            "purchaseRef",
            "XAF",
            "name"
        );

        $myPayment->makePayment($request->input("amount"));

        
    }

    public function donationResponse(Request $request, $user_id, $id) {
        $current_campaign = Campaign::find($id);

        $transaction_id = app('request')->input('transaction_id');
        $transaction_amount = app('request')->input('transaction_amount');
        $transaction_status = app('request')->input('transaction_status');

        // Saving sum of donated amount to the campaign table
        $current_campaign->donated_amount += $transaction_amount;
        $current_campaign->save();

        $donation = new Donation;
        $donation->author_id = $user_id;
        $donation->campaign_id = $id;
        $donation->donation_amount = $transaction_amount;
        $donation->transaction_id = $transaction_id;
        $donation->status = $transaction_status;
        $donation->save();

        return view('successful-donation', ['donationInfo' => $donation]);
        // return $request;
    }

    public function myDonations(Request $request) {
        $donations = Donation::where('author_id', Session::get('user')->id)->get();

        // return $donations;
        return view('my-donations', ['donations' => $donations,]);
        // return Session::get('user');
    }
}
        