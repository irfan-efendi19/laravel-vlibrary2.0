<?php

namespace App\Http\Controllers;

use App\Models\Loans;
use Illuminate\Http\Request;

class LoanRequestsController extends Controller
{
    public function index() {
        return view("dashboard.request.index", [
            "loans" => Loans::all()
        ]);
    }

    public function accept(Loans $loans) {
        Loans::where("id", $loans->id)->update(["acceptance_status" => 1]);
        return redirect("/dashboard/requests")->with("success", "A request was accepted !");
    }

    public function reject(Loans $loans) {
        Loans::where("id", $loans->id)->update(["acceptance_status" => 0]);
        return redirect("/dashboard/requests")->with("success", "A request was rejected !");
    }

    public function cancel(Loans $loans) {
        $loan_limit = Loans::where("user_id", $loans->user->id)->where('acceptance_status', '!=' , 0)->orWhereNull('acceptance_status')->get()->count();
        
        if($loans->acceptance_status === 0) {
            if($loan_limit < 2) {
                Loans::where("id", $loans->id)->update(["acceptance_status" => NULL]);
                return redirect("/dashboard/requests")->with("success", "A request was cancelled !");
            }
            return redirect("/dashboard/requests")->with("failed", "The user has selected another book !");
        }

        Loans::where("id", $loans->id)->update(["acceptance_status" => NULL]);
        return redirect("/dashboard/requests")->with("success", "A request was cancelled !");
    }
}
