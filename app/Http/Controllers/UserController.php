<?php

namespace App\Http\Controllers;

require $_SERVER['DOCUMENT_ROOT'] . '\medbot\\vendor\autoload.php';

use Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    private function encrypt($decrypted) {
        $password = 'MedbotPRBPM';
        $encrypted=openssl_encrypt($decrypted,'AES-128-ECB',$password);
        return $encrypted;
    }

    private function generateQRCode($user_id,$password){
        $data = $this->encrypt('Medbot:'.$user_id.':'.$password);
        $headers = array(
            'Content-Type' => 'image/png'
        );
        $image = QrCode::size(1023)
                ->format('png')
                ->generate($data);
        $path = 'qrcodes/' . $user_id . '.png';
        Storage::disk('local')->put($path, $image);
        return $path;
    }

    // For User Dashboard
    private function determinePulseRate($age, $pulse_rate){
        if($age <= 1){
            $low = 100;
            $high = 160;
        }
        else if($age <= 3){
            $low = 80;
            $high = 130;
        }
        else if($age <= 5){
            $low = 80;
            $high = 120;
        }
        else if($age <= 10){
            $low = 70;
            $high = 110;
        }
        else if($age <= 14){
            $low = 60;
            $high = 105;
        }
        else{
            $low = 60;
            $high = 100;
        }
        if($pulse_rate < $low){
            $rating = 'Below Normal';
        }
        else if($pulse_rate < $high){
            $rating = 'Normal';
        }
        else{
            $rating = 'Above Normal';
        }
        return $rating;
    }

    private function determineBloodPressure($age, $systolic, $diastolic){
        if($age <= 2){
            if($systolic < 80 && $diastolic < 40){
                $rating = 'Below Normal';
            }
            else if($systolic <= 100 && $diastolic <= 70){
                $rating = 'Normal';
            }
            else if($systolic > 100 && $diastolic > 70){
                $rating = 'Above Normal';
            }
            else{
                $rating = 'Null';
            }
        }
        else if($age <= 13){
            if($systolic < 80 && $diastolic < 40){
                $rating = 'Below Normal';
            }
            else if($systolic <= 120 && $diastolic <= 80){
                $rating = 'Normal';
            }
            else if($systolic > 120 && $diastolic > 80){
                $rating = 'Above Normal';
            }
            else{
                $rating = 'Null';
            }
        }
        else if($age <= 18){
            if($systolic < 90 && $diastolic < 50){
                $rating = 'Below Normal';
            }
            else if($systolic <= 120 && $diastolic <= 80){
                $rating = 'Normal';
            }
            else if($systolic > 120 && $diastolic > 80){
                $rating = 'Above Normal';
            }
            else{
                $rating = 'Null';
            }
        }
        else if($age <= 40){
            if($systolic < 95 && $diastolic < 60){
                $rating = 'Below Normal';
            }
            else if($systolic <= 135 && $diastolic <= 80){
                $rating = 'Normal';
            }
            else if($systolic > 135 && $diastolic > 80){
                $rating = 'Above Normal';
            }
            else{
                $rating = 'Null';
            }
        }
        else if($age <= 60){
            if($systolic < 110 && $diastolic < 70){
                $rating = 'Below Normal';
            }
            else if($systolic <= 145 && $diastolic <= 90){
                $rating = 'Normal';
            }
            else if($systolic > 145 && $diastolic > 90){
                $rating = 'Above Normal';
            }
            else{
                $rating = 'Null';
            }
        }
        else if($age > 60){
            if($systolic < 95 && $diastolic < 70){
                $rating = 'Below Normal';
            }
            else if($systolic <= 145 && $diastolic <= 90){
                $rating = 'Normal';
            }
            else if($systolic > 145 && $diastolic > 90){
                $rating = 'Above Normal';
            }
            else{
                $rating = 'Null';
            }
        }
        return $rating;
    }
    
    private function determineBloodSaturation($blood_saturation){
        if($blood_saturation < 95){
            $rating = 'Below Normal';
        }
        else if($blood_saturation <= 100){
            $rating = 'Normal';
        }
        else{
            $rating = 'Above Normal';
        }
        return $rating;
    }

    private function getThisMonthReadings($user_id){
        $this_month_readings = Reading::where('user_id',$user_id)->whereYear('created_at',date('Y'))->whereMonth('created_at',date('m'))->oldest()->get();
        return $this_month_readings;
    }
    
    private function getPreviousMonthReadings($user_id){
        $previous_month_readings = Reading::where('user_id', $user_id)->where('created_at','>', Carbon::now()->subMonths(2))->where('created_at','<', Carbon::now()->subMonths(1))->oldest()->get();
        return $previous_month_readings;
    }
    
    private function getAllTimeReadings($user_id){
        $all_time_readings = Reading::where('user_id', $user_id)->oldest()->get();
        return $all_time_readings;
    }

    private function getThisMonthReadingDates($user_id){
        $this_month_readings = $this->getThisMonthReadings($user_id);
        $dates = array();
        foreach($this_month_readings as $reading){
            array_push($dates,date('M d Y', strtotime($reading->created_at)));
        }
        return $dates;
    }

    private function getThisMonthReadingTimes($user_id){
        $this_month_readings = $this->getThisMonthReadings($user_id);
        $times = array();
        foreach($this_month_readings as $reading){
            array_push($times,date('H:i:s', strtotime($reading->created_at)));
        }
        return $times;
    }

    private function getThisMonthPulseRates($user_id){
        $this_month_pulse_rates = $this->getThisMonthReadings($user_id)->pluck('pulse_rate')->toArray();
        return $this_month_pulse_rates;
    }

    private function getThisMonthBloodPressures($user_id){
        $this_month_blood_pressures = $this->getThisMonthReadings($user_id)->pluck('blood_pressure')->toArray();
        return $this_month_blood_pressures;
    }

    private function getThisMonthSystolics($user_id){
        $this_month_systolics = $this->getThisMonthReadings($user_id)->pluck('systolic')->toArray();
        return $this_month_systolics;
    }

    private function getThisMonthDiastolics($user_id){
        $this_month_diastolics = $this->getThisMonthReadings($user_id)->pluck('diastolic')->toArray();
        return $this_month_diastolics;
    }

    private function getThisMonthBloodSaturations($user_id){
        $this_month_blood_saturations = $this->getThisMonthReadings($user_id)->pluck('blood_saturation')->toArray();
        return $this_month_blood_saturations;
    }

    private function getThisMonthAveragePulseRate($user_id){
        $this_month_pulse_rates = $this->getThisMonthPulseRates($user_id);
        if(count($this_month_pulse_rates) != 0){
            $this_month_average_pulse_rate = round(array_sum($this_month_pulse_rates)/count($this_month_pulse_rates));
        }
        else{
            $this_month_average_pulse_rate = 0;
        }
        return $this_month_average_pulse_rate;
    }

    private function getThisMonthAverageBloodPressure($user_id){
        $this_month_blood_pressures = $this->getThisMonthBloodPressures($user_id);
        if(count($this_month_blood_pressures) != 0){
            $this_month_average_blood_pressure = round(array_sum($this_month_blood_pressures)/count($this_month_blood_pressures));
        }
        else{
            $this_month_average_blood_pressure = 0;
        }
        return $this_month_average_blood_pressure;
    }

    private function getThisMonthAverageSystolic($user_id){
        $this_month_systolics = $this->getThisMonthSystolics($user_id);
        if(count($this_month_systolics) != 0){
            $this_month_average_systolic = round(array_sum($this_month_systolics)/count($this_month_systolics));
        }
        else{
            $this_month_average_systolic = 0;
        }
        return $this_month_average_systolic;
    }

    private function getThisMonthAverageDiastolic($user_id){     
        $this_month_diastolics = $this->getThisMonthDiastolics($user_id);
        if(count($this_month_diastolics) != 0){
            $this_month_average_diastolic = round(array_sum($this_month_diastolics)/count($this_month_diastolics));
        }
        else{
            $this_month_average_diastolic = 0;
        }
        return $this_month_average_diastolic;
    }

    private function getThisMonthAverageBloodSaturation($user_id){
        $this_month_blood_saturations = $this->getThisMonthBloodSaturations($user_id);
        if(count($this_month_blood_saturations) != 0){
            $this_month_average_blood_saturation = round(array_sum($this_month_blood_saturations)/count($this_month_blood_saturations));
        }
        else{
            $this_month_average_blood_saturation = 0;
        }
        return $this_month_average_blood_saturation;
    }

    private function getThisMonthAveragePulseRateDifference($user_id){
        $pulse_rates_prev = $this->getPreviousMonthReadings($user_id)->pluck('pulse_rate')->toArray();
        if(count($pulse_rates_prev) != 0){
            $average_pulse_rate_prev = round(array_sum($pulse_rates_prev)/count($pulse_rates_prev));
        }
        else {
            $average_pulse_rate_prev = 0;
        }
        $average_pulse_rate_curr = $this->getThisMonthAveragePulseRate($user_id);
        $pulse_rate_diff = round((($average_pulse_rate_curr - $average_pulse_rate_prev)/abs($average_pulse_rate_prev)) * 100);
        return $pulse_rate_diff;
    }

    private function getThisMonthAverageBloodPressureDifference($user_id){
        $blood_pressure_prev = $this->getPreviousMonthReadings($user_id)->pluck('blood_pressure')->toArray();
        if(count($blood_pressure_prev) != 0){
            $average_blood_pressure_prev = round(array_sum($blood_pressure_prev)/count($blood_pressure_prev));
        }
        else{
            $average_blood_pressure_prev = 0;
        }
        $average_blood_pressure_curr = $this->getThisMonthAverageBloodPressure($user_id);
        $blood_pressure_diff = round((($average_blood_pressure_curr - $average_blood_pressure_prev)/abs($average_blood_pressure_prev)) * 100);
        return $blood_pressure_diff;
    }

    private function getThisMonthAverageBloodSaturationDifference($user_id){
        $blood_saturations_prev = $this->getPreviousMonthReadings($user_id)->pluck('blood_saturation')->toArray();
        if(count($blood_saturations_prev) != 0){
            $average_blood_saturation_prev = round(array_sum($blood_saturations_prev)/count($blood_saturations_prev));
        }
        else{
            $average_blood_saturation_prev = 0;
        }
        $average_blood_saturation_curr = $this->getThisMonthAverageBloodSaturation($user_id);
        $blood_saturation_diff = round((($average_blood_saturation_curr - $average_blood_saturation_prev)/abs($average_blood_saturation_prev)) * 100);
        return $blood_saturation_diff;
    }

    private function getThisMonthPulseRateRatings($user_id){
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $pulse_rates = $this->getThisMonthPulseRates($user_id);
        $pulse_rate_ratings = array();
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach($pulse_rates as $pulse_rate){
            $rating = $this->determinePulseRate($user_age, $pulse_rate);
            if($rating == 'Below Normal'){
                $below_normal++;
            }
            else if($rating == 'Normal'){
                $normal++;
            }
            else{
                $above_normal++;
            }
        }
        array_push($pulse_rate_ratings, $below_normal, $normal, $above_normal);
        return $pulse_rate_ratings;
    }

    private function getThisMonthBloodPressureRatings($user_id){
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $systolics = $this->getThisMonthSystolics($user_id);
        $diastolics = $this->getThisMonthDiastolics($user_id);
        $blood_pressure_ratings = array();
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach(array_combine($systolics, $diastolics) as $systolic => $diastolic){
            $rating = $this->determineBloodPressure($user_age, $systolic, $diastolic);
            if($rating == 'Below Normal'){
                $below_normal++;
            }
            else if($rating == 'Normal'){
                $normal++;
            }
            else if($rating == 'Above Normal'){
                $above_normal++;
            }
            else{
                dd($user_id.' '.$user_age.' '.$rating.' '.$systolic.' '.$diastolic);
            }
        }
        array_push($blood_pressure_ratings, $below_normal, $normal, $above_normal);
        return $blood_pressure_ratings;
    }

    private function getThisMonthBloodSaturationRatings($user_id){
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $blood_saturations = $this->getThisMonthBloodSaturations($user_id);
        $blood_saturation_ratings = array();
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach($blood_saturations as $blood_saturation){
            $rating = $this->determineBloodSaturation($blood_saturation);
            if($rating == 'Below Normal'){
                $below_normal++;
            }
            else if($rating == 'Normal'){
                $normal++;
            }
            else if($rating == 'Above Normal'){
                $above_normal++;
            }
            else{
                //
            }
        }
        array_push($blood_saturation_ratings, $below_normal, $normal, $above_normal);
        return $blood_saturation_ratings;
    }

    private function getAllTimeAveragePulseRate($user_id){
        $all_time_pulse_rates = Reading::where('user_id',$user_id)->pluck('pulse_rate')->toArray();
        if(count($all_time_pulse_rates) != 0){
            $all_time_average_pulse_rate = round(array_sum($all_time_pulse_rates)/count($all_time_pulse_rates));
        }
        else{
            $all_time_average_pulse_rate = 0;
        }
        return $all_time_average_pulse_rate;
    }

    private function getAllTimeAverageSystolic($user_id){
        $all_time_systolics = Reading::where('user_id',$user_id)->pluck('systolic')->toArray();
        if(count($all_time_systolics) != 0){
            $all_time_average_systolic = round(array_sum($all_time_systolics)/count($all_time_systolics));
        }
        else{
            $all_time_average_systolic = 0;
        }
        return $all_time_average_systolic;
    }

    private function getAllTimeAverageDiastolic($user_id){
        $all_time_diastolics = Reading::where('user_id',$user_id)->pluck('diastolic')->toArray();
        if(count($all_time_diastolics) != 0){
            $all_time_average_diastolic = round(array_sum($all_time_diastolics)/count($all_time_diastolics));
        }
        else{
            $all_time_average_diastolic = 0;
        }
        return $all_time_average_diastolic;
    }

    private function getAllTimeAverageBloodSaturation($user_id){
        $all_time_blood_saturations = Reading::where('user_id',$user_id)->pluck('blood_saturation')->toArray();
        if(count($all_time_blood_saturations) != 0){
            $all_time_average_blood_saturation = round(array_sum($all_time_blood_saturations)/count($all_time_blood_saturations));
        }
        else{
            $all_time_average_blood_saturation = 0;
        }
        return $all_time_average_blood_saturation;
    }

    private function getYearlyPulseRates($user_id){
        $yearly_pulse_rates = array();
        for($month = 1; $month <= 12; $month++){
            $pulse_rates_curr = Reading::where('user_id',$user_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('pulse_rate')->toArray();
            if(count($pulse_rates_curr) != 0){
                $average_pulse_rates_curr = round(array_sum($pulse_rates_curr)/count($pulse_rates_curr));
            }
            else{
                $average_pulse_rates_curr = 0;
            }
            array_push($yearly_pulse_rates, $average_pulse_rates_curr);
        }
        return $yearly_pulse_rates;
    }

    private function getYearlyBloodPressures($user_id){
        $yearly_blood_pressures = array();
        for($month = 1; $month <= 12; $month++){
            $blood_pressures_curr = Reading::where('user_id',$user_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('blood_pressure')->toArray();
            if(count($blood_pressures_curr) != 0){
                $average_blood_pressures_curr = round(array_sum($blood_pressures_curr)/count($blood_pressures_curr));
            }
            else{
                $average_blood_pressures_curr = 0;
            }
            array_push($yearly_blood_pressures, $average_blood_pressures_curr);
        }
        return $yearly_blood_pressures;
    }

    private function getYearlySystolics($user_id){
        $yearly_systolics = array();
        for($month = 1; $month <= 12; $month++){
            $systolics_curr = Reading::where('user_id',$user_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('systolic')->toArray();
            if(count($systolics_curr) != 0){
                $average_systolics_curr = round(array_sum($systolics_curr)/count($systolics_curr));
            }
            else{
                $average_systolics_curr = 0;
            }
            array_push($yearly_systolics, $average_systolics_curr);
        }
        return $yearly_systolics;
    }

    private function getYearlyDiastolics($user_id){
        $yearly_diastolics = array();
        for($month = 1; $month <= 12; $month++){
            $diastolics_curr = Reading::where('user_id',$user_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('diastolic')->toArray();
            if(count($diastolics_curr) != 0){
                $average_diastolics_curr = round(array_sum($diastolics_curr)/count($diastolics_curr));
            }
            else{
                $average_diastolics_curr = 0;
            }
            array_push($yearly_diastolics, $average_diastolics_curr);
        }
        return $yearly_diastolics;
    }

    private function getYearlyBloodSaturations($user_id){
        $yearly_blood_saturations = array();
        for($month = 1; $month <= 12; $month++){
            $blood_saturations_curr = Reading::where('user_id',$user_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('blood_saturation')->toArray();
            if(count($blood_saturations_curr) != 0){
                $average_blood_saturations_curr = round(array_sum($blood_saturations_curr)/count($blood_saturations_curr));
            }
            else{
                $average_blood_saturations_curr = 0;
            }
            array_push($yearly_blood_saturations, $average_blood_saturations_curr);
        }
        return $yearly_blood_saturations;
    }

    private function getAllReadingCount($user_id){
        $count = count($this->getAllTimeReadings($user_id));
        return $count;
    }

    private function getallTimePulseRateRatings($user_id){
        $all_time_pulse_rate_ratings = array();
        $all_time_pulse_rates = $this->getAllTimeReadings($user_id)->pluck('pulse_rate')->toArray();
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach($all_time_pulse_rates as $pulse_rate){
            $rating = $this->determinePulseRate($user_age, $pulse_rate);
            if($rating == 'Below Normal'){
                $below_normal++;
            }
            else if($rating == 'Normal'){
                $normal++;
            }
            else{
                $above_normal++;
            }
        }
        array_push($all_time_pulse_rate_ratings, $below_normal, $normal, $above_normal);
        return $all_time_pulse_rate_ratings;
    }

    private function getallTimeBloodPressureRatings($user_id){
        $all_time_systolics = $this->getAllTimeReadings($user_id)->pluck('systolic')->toArray();
        $all_time_diastolics = $this->getAllTimeReadings($user_id)->pluck('diastolic')->toArray();
        $all_time_blood_pressure_ratings = array();
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach(array_combine($all_time_systolics, $all_time_diastolics) as $systolic => $diastolic){
            $rating = $this->determineBloodPressure($user_age, $systolic, $diastolic);
            if($rating == 'Below Normal'){
                $below_normal++;
            }
            else if($rating == 'Normal'){
                $normal++;
            }
            else if($rating == 'Above Normal'){
                $above_normal++;
            }
            else{
                dd($user_id.' '.$user_age.' '.$rating.' '.$systolic.' '.$diastolic);
            }
        }
        array_push($all_time_blood_pressure_ratings, $below_normal, $normal, $above_normal);
        return $all_time_blood_pressure_ratings;
    }

    private function getallTimeBloodSaturationRatings($user_id){
        $all_time_blood_saturation_ratings = array();
        $all_time_blood_saturations = $this->getAllTimeReadings($user_id)->pluck('blood_saturation')->toArray();
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach($all_time_blood_saturations as $blood_saturation){
            $rating = $this->determineBloodSaturation($user_age, $blood_saturation);
            if($rating == 'Below Normal'){
                $below_normal++;
            }
            else if($rating == 'Normal'){
                $normal++;
            }
            else{
                $above_normal++;
            }
        }
        array_push($all_time_blood_saturation_ratings, $below_normal, $normal, $above_normal);
        return $all_time_blood_saturation_ratings;
    }

    // For Doctor Dashboard
    private function getAllReadingId($user_id){
        $ids = Reading::where('user_id',$user_id)->pluck('id');
        return $ids;
    }

    private function getThisMonthNewUserCount(){
        $users = User::where('type','normal')->where('created_at','>',Carbon::now()->subMonths(1))->pluck('id')->toArray();
        $this_month_new_users_count = count($users);
        return $this_month_new_users_count;
    }

    private function getAllUserCount(){
        $all_users = User::where('type','normal')->pluck('id')->toArray();
        $all_users_count = count($all_users);
        return $all_users_count;
    }

    private function getOldUserCount(){
        $all_users = $this->getAllUserCount();
        $new_users = $this->getThisMonthNewUserCount();
        $old_users = $all_users - $new_users;
        return $old_users;
    }
    
    private function getPreviousMonthUserCount(){
        $previous_monthly_new_users = User::where('type','normal')->where('created_at','>', Carbon::now()->subMonths(2))->where('created_at','<', Carbon::now()->subMonths(1))->pluck('id');
        $previous_monthly_new_users_count = count($previous_monthly_new_users);
        return $previous_monthly_new_users_count;
    }

    private function getThisMonthNewUserDifference(){
        $this_month_new_users = $this->getThisMonthNewUserCount();
        $previous_month_new_users = $this->getPreviousMonthUserCount();
        if($previous_month_new_users != 0){
            $this_month_new_users_difference = round((($this_month_new_users - $previous_month_new_users)/abs($previous_month_new_users)) * 100);
        }
        else{
            $this_month_new_users_difference = 0;
        }
        return $this_month_new_users_difference;
    }

    private function getFirstRecord(){
        $first_month = User::oldest()->get()->first()->created_at->format('M Y');
        return $first_month;
    }

    private function getMonthlyUserGrowthRate(){
        $first_month = User::where('type','normal')->oldest()->get()->first()->created_at->format('m');
        $first_year = User::where('type','normal')->oldest()->get()->first()->created_at->format('Y');
        $first_monthly_users = User::where('type','normal')->whereYear('created_at', date('Y'))->whereMonth('created_at', $first_month)->pluck('id')->toArray();
        $first_monthly_users_count = count($first_monthly_users);
        $first_date = Carbon::createFromFormat('Y-m', $first_year.'-'.$first_month);
        $today = Carbon::now();
        $months_elapsed = $today->diffInMonths($first_date);
        $previous_monthly_new_users = $this->getPreviousMonthUserCount();
        if($months_elapsed != 0){
            $growth_rate = round(pow($previous_monthly_new_users/$first_monthly_users_count,1/$months_elapsed));
        }
        else{
            $growth_rate = 0;
        }
        return $growth_rate;
    }

    private function getThisMonthNewUsers(){
        $this_month_new_users = User::where('created_at','>',Carbon::now()->subMonths(1))->where('type','normal')->get();
        return $this_month_new_users;
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
        $female_users = User::where('type','normal')->where('gender','female')->get('id');
        $male_users = User::where('type','normal')->where('gender','male')->get('id');
        $female_users_count = count($female_users);
        $male_users_count = count($male_users);
        $users_per_gender = array();
        $users_per_gender['male'] = $male_users_count;
        $users_per_gender['female'] = $female_users_count;
        return $users_per_gender;
    }

    // **-- User Normal Type Specific Functions --** //

    // Redirect to User Dashboard
    public function redirectToUserDashboard() {
        if(Auth::user()->type != 'normal'){
            abort(403);
        }
        $user_id = Auth::id();
        return view('user.dashboard',[
            'this_month_average_pulse_rate' => $this->getThisMonthAveragePulseRate($user_id),
            'this_month_average_systolic' => $this->getThisMonthAverageSystolic($user_id),
            'this_month_average_diastolic' => $this->getThisMonthAverageDiastolic($user_id),
            'this_month_average_blood_saturation' => $this->getThisMonthAverageBloodSaturation($user_id),
            'this_month_average_pulse_rate_difference' => $this->getThisMonthAveragePulseRateDifference($user_id),
            'this_month_average_blood_pressure_difference' => $this->getThisMonthAverageBloodPressureDifference($user_id),
            'this_month_average_blood_saturation_difference' => $this->getThisMonthAverageBloodSaturationDifference($user_id),
            'this_month_pulse_rates' => $this->getThisMonthPulseRates($user_id), 
            'this_month_systolics' => $this->getThisMonthSystolics($user_id), 
            'this_month_diastolics' => $this->getThisMonthDiastolics($user_id), 
            'this_month_blood_pressures' => $this->getThisMonthBloodPressures($user_id), 
            'this_month_blood_saturations' => $this->getThisMonthBloodSaturations($user_id), 
            'this_month_dates' => $this->getThisMonthReadingDates($user_id), 
            'this_month_times' => $this->getThisMonthReadingTimes($user_id),
            'this_month_pulse_rate_ratings' => $this->getThisMonthPulseRateRatings($user_id),
            'this_month_blood_pressure_ratings' => $this->getThisMonthBloodPressureRatings($user_id),
            'this_month_blood_saturation_ratings' => $this->getThisMonthBloodSaturationRatings($user_id),
            'all_reading_count' => $this->getAllReadingCount($user_id),
            'all_time_average_pulse_rate' => $this->getAllTimeAveragePulseRate($user_id),
            'all_time_average_systolic' => $this->getAllTimeAverageSystolic($user_id),
            'all_time_average_diastolic' => $this->getAllTimeAverageDiastolic($user_id),
            'all_time_average_blood_saturation' => $this->getAllTimeAverageBloodSaturation($user_id),
            'yearly_pulse_rates' => $this->getYearlyPulseRates($user_id),
            'yearly_systolics' => $this->getYearlySystolics($user_id),
            'yearly_diastolics' => $this->getYearlyDiastolics($user_id),
            'yearly_blood_pressures' => $this->getYearlyBloodPressures($user_id),
            'yearly_blood_saturations' => $this->getYearlyBloodSaturations($user_id),
            'all_time_pulse_rate_ratings' => $this->getallTimePulseRateRatings($user_id),
            'all_time_blood_pressure_ratings' => $this->getallTimeBloodPressureRatings($user_id),
            'all_time_blood_saturation_ratings' => $this->getallTimeBloodSaturationRatings($user_id)
        ]);
    }

    // Redirect to Reading List Page
    public function redirectToReadingListPage(){
        if(Auth::user()->type != 'normal'){
            abort(403);
        }
        $filterString = 'Date';
        $orderString = 'Descending';
        $readings =Reading::where('user_id',Auth::id())->orderBy('created_at','desc')->paginate(9);
        return view('user.readinglist',[
            'readings' => $readings,
            'filter' => $filterString,
            'order' => $orderString,
        ]);
    }

    // Redirect to Manage Page
    public function redirectToManagePage(){
        if(Auth::user()->type != 'normal'){
            abort(403);
        }
        $user = Auth::user();
        $user_id = $user->id;
        return view('user.manage',[
            'user_profile' => $user->profile_picture_path,
            'ids' => $this->getAllReadingId($user_id),
            'user_name' => $user->name,
            'user_age' => $user_age = Carbon::parse($user->birthday)->age
        ]);
    }

    // **-- User Doctor Type Specific Functions --** //
    
    //Redirect to Doctor Dashboard
    public function redirectToDoctorDashboard(){
        if(Auth::user()->type != 'doctor'){
            abort(403);
        }
        return view('doctor.dashboard',[
            'this_month_new_user_count' => $this->getThisMonthNewUserCount(),
            'old_user_count' => $this->getOldUserCount(),
            'all_user_count' => $this->getAllUserCount(),
            'this_month_new_user_difference' => $this->getThisMonthNewUserDifference(),
            'first_record' => $this->getFirstRecord(),
            'monthly_user_growth_rate' => $this->getMonthlyUserGrowthRate(),
            'this_month_new_users' => $this->getThisMonthNewUsers(),
            'monthly_new_users_per_month' => $this->getMonthlyNewUsersPerMonth(),
            'users_by_age' => $this->getUsersByAge(),
            'user_gender_count' => $this->getUserGenderCount()
        ]);
    }

    // Redirect to User List
    public function redirectToUserListPage(Request $request){
        if(Auth::user()->type != 'doctor'){
            abort(403);
        }
        $filterString = "Name";
        $orderString = "Descending";
        if($request->has('search')){
            if($request->order != null){
                $order = explode('-',$request['order']);
                $users = User::where('type','normal')->where($request->filter, 'like', '%'.$request->search.'%')->orderBy($order[0],$order[1])->paginate(10);
                if($order[0] == 'birthday'){
                    $filterString = 'Age';
                }
                else{
                    $filterString = ucfirst(str_replace('_', ' ', $order[0])); 
                }
                $orderString = ucfirst($order[1].'ending');
                flash()->addInfo('Sorted by '.$filterString.' ('.$orderString.')');
            }
            else{
                $users = User::where('type','normal')->where($request->filter, 'like', '%'.$request->search.'%')->orderBy($request->filter,'asc')->paginate(10);
            }
            if(count($users) == 0){
                // Nothing found
                return view('doctor.nothingfound',[
                    'search' => $request->search
                ]);
            }
        }
        if(!$request->has('search') && !$request->has('order')){
            $users = User::where('type','normal')->orderBy('name','asc')->paginate(10);
        }
        return view('doctor.userlist',[
            'users' => $users,
            'filter' => $filterString,
            'order' => $orderString
        ]);
    }
    
    // Redirect to User Info Page
    public function redirectToUserInfoPage($user_id){
        if(Auth::user()->type != 'doctor'){
            abort(403);
        }
        $user = User::find($user_id);
        $latest_reading = Reading::where('user_id',$user->id)->latest()->first();
        return view('doctor.userinfo',[
            'id' => $user->id,
            'profile' => $user->profile_picture_path,
            'name' => $user->name,
            'joined' => Carbon::parse($user->created_at)->format('M d, Y'),
            'latest_reading' => Carbon::parse($latest_reading->created_at)->format('M d, Y'),
            'age' => Carbon::parse($user->birthday)->age,
            'gender' => ucfirst($user->gender),
            'phone' => $user->phone_number,
            'birthday' => Carbon::parse($user->birthday)->format('M d, Y'),
            'email' => $user->email,
            'address' => $user->address,
            'bio' => $user->bio,
            'latest_pulse_rate' => $latest_reading->pulse_rate,
            'average_pulse_rate' => $this->getAllTimeAveragePulseRate($user->id),
            'latest_systolic' => $latest_reading->systolic,
            'latest_diastolic' => $latest_reading->diastolic,
            'average_systolic' => $this->getAllTimeAverageSystolic($user->id),
            'average_diastolic' => $this->getallTimeAverageDiastolic($user->id),
            'latest_blood_saturation' => $latest_reading->blood_saturation,
            'average_blood_saturation' => $this->getAllTimeAverageBloodSaturation($user->id)
        ]);
    }

    public function redirectToUserReportPage($user_id){
        if(Auth::user()->type != 'doctor'){
            abort(403);
        }
        $user = User::find($user_id);
        return view('doctor.userreport',[
            'id' => $user->id,
            'profile' => $user->profile_picture_path,
            'name' => $user->name,
            'age' => Carbon::parse($user->birthday)->age,
            'joined' => Carbon::parse($user->created_at)->format('M d, Y'),
            'this_month_average_pulse_rate' => $this->getThisMonthAveragePulseRate($user_id),
            'this_month_average_systolic' => $this->getThisMonthAverageSystolic($user_id),
            'this_month_average_diastolic' => $this->getThisMonthAverageDiastolic($user_id),
            'this_month_average_blood_saturation' => $this->getThisMonthAverageBloodSaturation($user_id),
            'this_month_average_pulse_rate_difference' => $this->getThisMonthAveragePulseRateDifference($user_id),
            'this_month_average_blood_pressure_difference' => $this->getThisMonthAverageBloodPressureDifference($user_id),
            'this_month_average_blood_saturation_difference' => $this->getThisMonthAverageBloodSaturationDifference($user_id),
            'this_month_pulse_rates' => $this->getThisMonthPulseRates($user_id), 
            'this_month_systolics' => $this->getThisMonthSystolics($user_id), 
            'this_month_diastolics' => $this->getThisMonthDiastolics($user_id), 
            'this_month_blood_pressures' => $this->getThisMonthBloodPressures($user_id), 
            'this_month_blood_saturations' => $this->getThisMonthBloodSaturations($user_id), 
            'this_month_dates' => $this->getThisMonthReadingDates($user_id), 
            'this_month_times' => $this->getThisMonthReadingTimes($user_id),
            'this_month_pulse_rate_ratings' => $this->getThisMonthPulseRateRatings($user_id),
            'this_month_blood_pressure_ratings' => $this->getThisMonthBloodPressureRatings($user_id),
            'this_month_blood_saturation_ratings' => $this->getThisMonthBloodSaturationRatings($user_id),
            'all_reading_count' => $this->getAllReadingCount($user_id),
            'all_time_average_pulse_rate' => $this->getAllTimeAveragePulseRate($user_id),
            'all_time_average_systolic' => $this->getAllTimeAverageSystolic($user_id),
            'all_time_average_diastolic' => $this->getAllTimeAverageDiastolic($user_id),
            'all_time_average_blood_saturation' => $this->getAllTimeAverageBloodSaturation($user_id),
            'yearly_pulse_rates' => $this->getYearlyPulseRates($user_id),
            'yearly_systolics' => $this->getYearlySystolics($user_id),
            'yearly_diastolics' => $this->getYearlyDiastolics($user_id),
            'yearly_blood_pressures' => $this->getYearlyBloodPressures($user_id),
            'yearly_blood_saturations' => $this->getYearlyBloodSaturations($user_id),
            'all_time_pulse_rate_ratings' => $this->getallTimePulseRateRatings($user_id),
            'all_time_blood_pressure_ratings' => $this->getallTimeBloodPressureRatings($user_id),
            'all_time_blood_saturation_ratings' => $this->getallTimeBloodSaturationRatings($user_id)
        ]);
    }

    // **-- General User Type Specific Functions --** //

    // Redirect to Update Info Page
    public function redirectToUpdateInformationPage(){
        $user = Auth::user();
        if($user->type == 'doctor'){
            $view = 'doctor';
        }
        else{
            $view = 'user';
        }
        return view($view.'.update',[
            'user_profile' => $user->profile_picture_path,
            'user_name' => $user->name,
            'user_gender' => $user->gender,
            'user_phone' => $user->phone_number,
            'user_birthday' => date('Y-m-d',strtotime($user->birthday)),
            'user_address' => $user->address,
            'user_email' => $user->email,
            'user_bio' => $user->bio,
        ]);
    }

    // Update user profile picture
    public function updateProfilePicture(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'profile_picture' => 'required|mimes:jpeg,bmp,png'
        ],
        [
            'profile_picture.required' => 'Please upload a file',
            'profile_picture.mime' => 'The file is not an image file'
        ]);
        if ($validator->fails()){
            return redirect()->back()->withError($validator->messages()->all());
        }
        $profile_picture = $request->file('profile_picture');
        $extension = $profile_picture->getClientOriginalExtension();
        $file_name = Auth::id().'.'.$extension;
        $path = $profile_picture->storeAs('profiles',$file_name,'public');
        $user->profile_picture_path = $path;
        $user->update();
        return redirect()->back()->with('success','Profile Picture Update Successfully');
    }

    // Update user information
    public function updateInfo(Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->update();
        return redirect()->back()->with('success','User Information Changed Successfully');
    }

    // Update password
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|current_password',
            'new_password' => 'required|regex:/^.*(?=[^A-Z\n]*[A-Z]).{8,}.*$/',
            'password_confirmation' => 'required|same:new_password'
        ],
        [
            'current_password.required' => 'Current Password field is required',
            'current_password.password' => 'Does not match current password',
            'new_password.required' => 'New Password field is required',
            'new_password.regex' => 'Password should be at least 8 characters long and contain at least one uppercase letter',
            'password_confirmation.required' => 'Confirm Password field is required',
            'password_confirmation.same' => 'Passwords does not match'
        ]);
        if ($validator->fails()){
            return redirect()->back()->withError($validator->messages()->all());
        }
        $new_password = $request->new_password;
        $user = Auth::user();
        $user->password = bcrypt($new_password);
        $user->update();
        if($user->type == 'doctor'){
            return redirect()->back()->with('success','Password Changed Successfully');
        }
        else{
            $path = $this->generateQRCode($user->id,$new_password);
            return redirect('/manage/update/password/download')->with('link',$user->id);
        }

    }

    // Redirect to Download New QR Code Page
    public function redirectToQRCodeDownloadPage(){
        return view('user.qrcode');
    }
}
