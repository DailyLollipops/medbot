<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private function getMonthlyNewUserCount(){
        $users = User::where('created_at','>',Carbon::now()->subMonths(1))->pluck('id')->toArray();
        $monthly_new_users_count = count($users);
        return $monthly_new_users_count;
    }

    private function getAllUserCount(){
        $all_users = User::all()->pluck('id')->toArray();
        $all_users_count = count($all_users);
        return $all_users_count;
    }

    private function getMonthlyNewUserDifference(){
        $monthly_new_users = $this->getMonthlyNewUserCount();
        $previous_monthly_new_users = User::where('created_at','>', Carbon::now()->subMonths(2))
            ->where('created_at','<', Carbon::now()->subMonths(1))->pluck('pulse_rate');
        $monthly_new_users_difference = round((($monthly_new_users - $previous_monthly_new_users)/abs($previous_monthly_new_users)) * 100);
        return $monthly_new_users_difference;
    }

    private function getMonthlyUserGrowthRate(){
        $first_month = User::oldest()->get()->first()->created_at->format('m');
        $first_year = User::oldest()->get()->first()->created_at->format('Y');
        $first_monthly_users = User::whereYear('created_at', date('Y'))->whereMonth('created_at', $first_month)->pluck('id')->toArray();
        $first_monthly_users_count = count($first_monthly_users);
        $first_date = date_create($first_year.'-'. $first_month .'-01');
        $today = date_create(Carbon::now());
        $months_elapsed = date_diff($first_date, $today);
        $months_passed = $months_elapsed->m + ($months_elapsed->y*12);
        $all_users_count = $this->getAllUserCount();
        if($months_passed != 0){
            $growth_rate = (($all_users_count - $first_monthly_users_count)/$months_passed)*100;
        }
        else{
            $growth_rate = 0;
        }
        return $growth_rate;
    }

    //Redirect to Dashboard
    public function redirectToDoctorDashboard(){
        $this->getMonthlyUserGrowthRate();
        return view('doctor.dashboard');
    }
}
