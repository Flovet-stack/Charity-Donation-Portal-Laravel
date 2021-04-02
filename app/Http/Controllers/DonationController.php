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
        $current_campaign = (array)DB::table('campaigns')->where('campaign_id', $id)->get()[0];

    
        return view('make-donation', ['current_campaign' => $current_campaign]);
    }

    public function donate(Request $request) {

        $myPayment = new PayUnit(
            "51f319a7fe052fbb4be7aa13483f617209944253",
            "01b3b5a0-a608-4e0b-9dff-b34b46665595",
            "payunit_sand_xUo2SWcG5",
            "http://127.0.0.1:8000/donations-response",
            "http://127.0.0.1:8000/donations",
            "test",
            "description",
            "purchaseRef",
            "XAF",
            "name"
        );

        $myPayment->makePayment($request->input("amount"));

        return '';
        
    }

    public function donationResponse(Request $request) {

        $transaction_id = app('request')->input('transaction_id');
        $transaction_amount = app('request')->input('transaction_amount');
        $transaction_status = app('request')->input('transaction_status');

        $donation = new Donation;
        $donation->donation_amount = $transaction_amount;
        $donation->transaction_id = $transaction_id;
        $donation->transaction_id = $transaction_id;
        $donation->status = $transaction_status;
        $donation->save();



        return view('/successful-donation', ['donationInfo' => $donation]);
    }

    public function saveDonation(Request $request, $transaction_id) {
        $donation = (array)DB::table('donations')->where('transaction_id', $transaction_id)->get()[0];

        // $donation->donation_author_id = $request->author_id;
        // $donation->save();
        // return $donation;

        // return view('/my-donations', ['myDonations' => $donation]);
        return redirect('/my-campaigns');
    }
}
