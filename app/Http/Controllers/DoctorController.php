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

    private function getOldUserCount(){
        $all_users = $this->getAllUserCount();
        $new_users = $this->getMonthlyNewUserCount();
        $old_users = $all_users - $new_users;
        return $old_users;
    }
    
    private function getMonthlyNewUserDifference(){
        $monthly_new_users = $this->getMonthlyNewUserCount();
        $previous_monthly_new_users = count(User::where('created_at','>', Carbon::now()->subMonths(2))->where('created_at','<', Carbon::now()->subMonths(1))->pluck('id'));
        if($previous_monthly_new_users != 0){
            $monthly_new_users_difference = round((($monthly_new_users - $previous_monthly_new_users)/abs($previous_monthly_new_users)) * 100);
        }
        else{
            $monthly_new_users_difference = 0;
        }
        return $monthly_new_users_difference;
    }

    private function getFirstRecord(){
        $first_month = User::oldest()->get()->first()->created_at->format('M Y');
        return $first_month;
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

    private function getMonthlyNewUsers(){
        $new_monthly_users = User::where('created_at','>',Carbon::now()->subMonths(1))->where('type','normal')->get();
        return $new_monthly_users;
    }

    private function getMonthlyNewUsersPerMonth(){
        $monthly_new_users_per_month = array();
        for($month = 1; $month <= 12; $month++){
            $new_monthly_users = User::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->where('type','normal')->get();
            $per_month_users = count($new_monthly_users);
            array_push($monthly_new_users_per_month,$per_month_users);
        }
        return $monthly_new_users_per_month;
    }

    private function getUsersByAge(){
        $users = User::where('type','normal')->select('birthday')->distinct()->get();
        $ages = array(0,0,0,0,0,0,0,0,0);
        foreach($users as $user){
            $age = Carbon::parse($user->birthday)->age;
            if($age <= 20){
                $ages[0] = $ages[0] + 1;
            }
            else if($age <= 30){
                $ages[1] = $ages[1] + 1;
            }
            else if($age <= 40){
                $ages[2] = $ages[2] + 1;
            }
            else if($age <= 50){
                $ages[3] = $ages[3] + 1;
            }
            else if($age <= 60){
                $ages[4] = $ages[4] + 1;
            }
            else if($age <= 70){
                $ages[5] = $ages[5] + 1;
            }
            else if($age <= 80){
                $ages[6] = $ages[6] + 1;
            }
            else if($age <= 90){
                $ages[7] = $ages[7] + 1;
            }
            else{
                $ages[8] = $ages[8] + 1;
            }
        }
        return $ages;
    }

    private function getUserGenderCount(){
        $female_users = User::where('type','normal')->where('gender','female')->get();
        $male_users = User::where('type','normal')->where('gender','female')->get();
        $female_users_count = count($female_users);
        $male_users_count = count($male_users);
        $users_per_gender = array();
        $users_per_gender['male'] = $male_users_count;
        $users_per_gender['female'] = $female_users_count;
        return $users_per_gender;
    }

    //Redirect to Dashboard
    public function redirectToDoctorDashboard(){
        return view('doctor.dashboard',[
            'monthly_new_user_count' => $this->getMonthlyNewUserCount(),
            'old_user_count' => $this->getOldUserCount(),
            'all_user_count' => $this->getAllUserCount(),
            'monthly_new_user_difference' => $this->getMonthlyNewUserDifference(),
            'first_record' => $this->getFirstRecord(),
            'monthly_user_growth_rate' => $this->getMonthlyUserGrowthRate(),
            'monthly_new_users' => $this->getMonthlyNewUsers(),
            'monthly_new_users_per_month' => $this->getMonthlyNewUsersPerMonth(),
            'users_by_age' => $this->getUsersByAge(),
            'user_gender_count' => $this->getUserGenderCount()
        ]);
    }
}