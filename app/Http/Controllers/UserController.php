<?php

namespace App\Http\Controllers;

require $_SERVER['DOCUMENT_ROOT'] . "\medbot\\vendor\autoload.php";

use Carbon\Carbon;
use App\Models\User;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private function encrypt($decrypted) {
        $password = "MedbotPRBPM";
        $encrypted=openssl_encrypt($decrypted,"AES-128-ECB",$password);
        return $encrypted;
    }

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
            $rating = 'Above Normal';;
        }
        return $rating;
    }

    private function getAllReadingCount($user_id){
        $count = count(Reading::where('user_id', $user_id)->pluck('id')->toArray());
        return $count;
    }

    private function getMonthlyReadingLabels($user_id){
        $labels = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('id');
        return $labels;
    }
    
    private function getMonthlyReadingDates($user_id){
        $timestamps = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('created_at')->toArray();
        $dates = array();
        foreach($timestamps as $timestamp){
            array_push($dates,date('Y-m-d', strtotime($timestamp)));
        }
        return $dates;
    }

    private function getMonthlyReadingTimes($user_id){
        $timestamps = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('created_at')->toArray();
        $times = array();
        foreach($timestamps as $timestamp){
            array_push($times,date('H:i:s', strtotime($timestamp)));
        }
        return $times;
    }

    private function getMonthlyPulseRates($user_id){
        $monthly_pulse_rates = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('pulse_rate')->toArray();
        return $monthly_pulse_rates;
    }

    private function getMonthlyBloodPressures($user_id){
        $monthly_blood_pressures = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('blood_pressure')->toArray();
        return $monthly_blood_pressures;
    }

    private function getMonthlySystolics($user_id){
        $monthly_systolics = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('systolic')->toArray();
        return $monthly_systolics;
    }

    private function getMonthlyDiastolics($user_id){
        $monthly_diastolics = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('diastolic')->toArray();
        return $monthly_diastolics;
    }

    private function getMonthlyBloodSaturations($user_id){
        $monthly_blood_saturations = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('blood_saturation')->toArray();
        return $monthly_blood_saturations;
    }

    private function getMonthlyAveragePulseRate($user_id){
        $pulse_rates = $this->getMonthlyPulseRates($user_id);
        if(count($pulse_rates) != 0){
            $monthly_average_pulse_rate = round(array_sum($pulse_rates)/count($pulse_rates));
        }
        else{
            $monthly_average_pulse_rate = 0;
        }
        return $monthly_average_pulse_rate;
    }

    private function getMonthlyAverageBloodPressure($user_id){
        $blood_pressures = $this->getMonthlyBloodPressures($user_id);
        if(count($blood_pressures) != 0){
            $monthly_average_blood_pressure = round(array_sum($blood_pressures)/count($blood_pressures));
        }
        else{
            $monthly_average_blood_pressure = 0;
        }
        return $monthly_average_blood_pressure;
    }

    private function getMonthlyAverageSystolic($user_id){
        $systolics = $this->getMonthlySystolics($user_id);
        if(count($systolics) != 0){
            $month_average_systolic = round(array_sum($systolics)/count($systolics));
        }
        else{
            $month_average_systolic = 0;
        }
        return $month_average_systolic;
    }

    private function getMonthlyAverageDiastolic($user_id){     
        $diastolics = $this->getMonthlyDiastolics($user_id);
        if(count($diastolics) != 0){
            $monthly_average_diastolic = round(array_sum($diastolics)/count($diastolics));
        }
        else{
            $monthly_average_diastolic = 0;
        }
        return $monthly_average_diastolic;
    }

    private function getMonthlyAverageBloodSaturation($user_id){
        $blood_saturations = $this->getMonthlyBloodSaturations($user_id);
        if(count($blood_saturations) != 0){
            $monthly_average_blood_saturation = round(array_sum($blood_saturations)/count($blood_saturations));
        }
        else{
            $monthly_average_blood_saturation = 0;
        }
        return $monthly_average_blood_saturation;
    }

    private function getMonthlyAveragePulseRateDifference($user_id){
        $pulse_rates_prev = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(2))->where("created_at","<", Carbon::now()->subMonths(1))->pluck('pulse_rate')->toArray();
        if(count($pulse_rates_prev) != 0){
            $average_pulse_rate_prev = round(array_sum($pulse_rates_prev)/count($pulse_rates_prev));
        }
        else {
            $average_pulse_rate_prev = 0;
        }
        $average_pulse_rate_curr = $this->getMonthlyAveragePulseRate($user_id);
        $pulse_rate_diff = round((($average_pulse_rate_curr - $average_pulse_rate_prev)/abs($average_pulse_rate_prev)) * 100);
        return $pulse_rate_diff;
    }

    private function getMonthlyAverageBloodPressureDifference($user_id){
        $blood_pressure_prev = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(2))->where("created_at","<", Carbon::now()->subMonths(1))->pluck('blood_pressure')->toArray();
        if(count($blood_pressure_prev) != 0){
            $average_blood_pressure_prev = round(array_sum($blood_pressure_prev)/count($blood_pressure_prev));
        }
        else{
            $average_blood_pressure_prev = 0;
        }
        $average_blood_pressure_curr = $this->getMonthlyAverageBloodPressure($user_id);
        $blood_pressure_diff = round((($average_blood_pressure_curr - $average_blood_pressure_prev)/abs($average_blood_pressure_prev)) * 100);
        return $blood_pressure_diff;
    }

    private function getMonthlyAverageBloodSaturationDifference($user_id){
        $blood_saturations_prev = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(2))->where("created_at","<", Carbon::now()->subMonths(1))->pluck('blood_saturation')->toArray();
        if(count($blood_saturations_prev) != 0){
            $average_blood_saturation_prev = round(array_sum($blood_saturations_prev)/count($blood_saturations_prev));
        }
        else{
            $average_blood_saturation_prev = 0;
        }
        $average_blood_saturation_curr = $this->getMonthlyAverageBloodSaturation($user_id);
        $blood_saturation_diff = round((($average_blood_saturation_curr - $average_blood_saturation_prev)/abs($average_blood_saturation_prev)) * 100);
        return $blood_saturation_diff;
    }

    private function getMonthlyPulseRateRatings($user_id){
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $pulse_rates = $this->getMonthlyPulseRates($user_id);
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

    private function getMonthlyBloodPressureRatings($user_id){
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $systolics = $this->getMonthlySystolics($user_id);
        $diastolics = $this->getMonthlyDiastolics($user_id);
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

    private function getMonthlyBloodSaturationRatings($user_id){
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $blood_saturations = $this->getMonthlyBloodSaturations($user_id);
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

    private function getallTimePulseRateRatings($user_id){
        $all_time_pulse_rate_ratings = array();
        $all_time_pulse_rates = Reading::where('user_id',$user_id)->pluck('pulse_rate')->toArray();
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
        $all_time_systolics = Reading::where('user_id',$user_id)->pluck('systolic')->toArray();
        $all_time_diastolics = Reading::where('user_id',$user_id)->pluck('diastolic')->toArray();
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
        $all_time_blood_saturations = Reading::where('user_id',$user_id)->pluck('blood_saturation')->toArray();
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

    private function getAllReadingId($user_id){
        $ids = Reading::where('user_id',$user_id)->pluck('id');
        return $ids;
    }

    public function redirectToReadingList(){
        $filter = 'date';
        $filterString = 'Date';
        $orderString = "Descending";

        $readings = Reading::where('user_id',Auth::id())->paginate(9);
        $readings->setCollection(
            collect(
                collect($readings->items())->sortByDesc($filter)
            )->values()
        );
        
        return view('user.readinglist',[
            'readings' => $readings,
            'filter' => $filterString,
            'order' => $orderString,
        ]);
    }

    public function redirectToUserDashboard() {
        $user_id = Auth::id();
        return view('user.dashboard',[
            'average_pulse_rate_month' => $this->getMonthlyAveragePulseRate($user_id),
            'average_systolic_month' => $this->getMonthlyAverageSystolic($user_id),
            'average_diastolic_month' => $this->getMonthlyAverageDiastolic($user_id),
            'average_blood_saturation_month' => $this->getMonthlyAverageBloodSaturation($user_id),
            'pulse_rate_diff' => $this->getMonthlyAveragePulseRateDifference($user_id),
            'blood_pressure_diff' => $this->getMonthlyAverageBloodPressureDifference($user_id),
            'blood_saturation_diff' => $this->getMonthlyAverageBloodSaturationDifference($user_id),
            'labels' => $this->getMonthlyReadingLabels($user_id), 
            'pulse_rates' => $this->getMonthlyPulseRates($user_id), 
            'systolics' => $this->getMonthlySystolics($user_id), 
            'diastolics' => $this->getMonthlyDiastolics($user_id), 
            'blood_pressures' => $this->getMonthlyBloodPressures($user_id), 
            'blood_saturations' => $this->getMonthlyBloodSaturations($user_id), 
            'dates' => $this->getMonthlyReadingDates($user_id), 
            'times' => $this->getMonthlyReadingTimes($user_id),
            'pulse_rate_ratings' => $this->getMonthlyPulseRateRatings($user_id),
            'blood_pressure_ratings' => $this->getMonthlyBloodPressureRatings($user_id),
            'blood_saturation_ratings' => $this->getMonthlyBloodSaturationRatings($user_id),
            'count' => $this->getAllReadingCount($user_id),
            'average_pulse_rate_all' => $this->getAllTimeAveragePulseRate($user_id),
            'average_systolic_all' => $this->getAllTimeAverageSystolic($user_id),
            'average_diastolic_all' => $this->getAllTimeAverageDiastolic($user_id),
            'average_blood_saturation_all' => $this->getAllTimeAverageBloodSaturation($user_id),
            'pulse_rates_year' => $this->getYearlyPulseRates($user_id),
            'systolics_year' => $this->getYearlySystolics($user_id),
            'diastolics_year' => $this->getYearlyDiastolics($user_id),
            'blood_pressures_year' => $this->getYearlyBloodPressures($user_id),
            'blood_saturations_year' => $this->getYearlyBloodSaturations($user_id),
            'all_pulse_rate_ratings' => $this->getallTimePulseRateRatings($user_id),
            'all_blood_pressure_ratings' => $this->getallTimeBloodPressureRatings($user_id),
            'all_blood_saturation_ratings' => $this->getallTimeBloodSaturationRatings($user_id)
        ]);
    }

    public function redirectToManagePage(){
        $user = User::find(Auth::id())->first();
        $user_id = $user->id;
        $user_name = $user->name;
        $user_age = Carbon::parse($user->birthday)->age;
        return view('user.manage',[
            'ids' => $this->getAllReadingId($user_id),
            'user_name' => $user_name,
            'user_age' => $user_age
        ]);
    }

    public function redirectToUpdateInformationPage(){
        $user = User::find(Auth::id())->first();
        $user_profile_picture_path = $user->profile_picture_path;
        return view('user.update');
    }
}
