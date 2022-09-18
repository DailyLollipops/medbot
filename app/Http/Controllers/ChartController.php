<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    //Controller for passing data to render charts

    //Render Charts
    public function renderCharts(){
        $user_id = Auth::id();
        $user_age = User::find($user_id)->age;
        
        // For Readings Chart
        $labels = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('id');
        $pulse_rates = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('pulse_rate')->toArray();
        $systolics = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('systolic')->toArray();
        $diastolics = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('diastolic')->toArray();
        $blood_pressures = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('blood_pressure')->toArray();
        $blood_saturations = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('blood_saturation')->toArray();
        $timestamps = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(1))->pluck('created_at')->toArray();
        $dates = array();
        $times = array();
        foreach($timestamps as $timestamp){
            array_push($dates,date('Y-m-d', strtotime($timestamp)));
            array_push($times,date('H:i:s', strtotime($timestamp)));
        }

        // Return Average This Month
        if(count($pulse_rates) != 0){
            $average_pulse_rate_month = round(array_sum($pulse_rates)/count($pulse_rates));
        }
        else{
            $average_pulse_rate_month = 0;
        }
        if(count($systolics) != 0){
            $average_systolic_month = round(array_sum($systolics)/count($systolics));
        }
        else{
            $average_systolic_month = 0;
        }
        if(count($diastolics) != 0){
            $average_diastolic_month = round(array_sum($diastolics)/count($diastolics));
        }
        else{
            $average_diastolic_month = 0;
        }
        if(count($blood_pressures) != 0){
            $average_blood_pressure_month = round(array_sum($blood_pressures)/count($blood_pressures));
        }
        else{
            $average_blood_pressure_month = 0;
        }
        if(count($blood_saturations)){
            $average_blood_saturation_month = round(array_sum($blood_saturations)/count($blood_saturations));
        }
        else{
            $average_blood_saturation_month = 0;
        }
        

        // Average Last Previous Months
        $pulse_rates_prev = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(2))->where("created_at","<", Carbon::now()->subMonths(1))->pluck('pulse_rate')->toArray();
        $blood_pressure_prev = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(2))->where("created_at","<", Carbon::now()->subMonths(1))->pluck('blood_pressure')->toArray();
        $blood_saturations_prev = Reading::where('user_id', $user_id)->where("created_at",">", Carbon::now()->subMonths(2))->where("created_at","<", Carbon::now()->subMonths(1))->pluck('blood_saturation')->toArray();
        if(count($pulse_rates_prev) != 0){
            $average_pulse_rate_prev = round(array_sum($pulse_rates_prev)/count($pulse_rates_prev));
        }
        else {
            $average_pulse_rate_prev = 0;
        }
        if(count($blood_pressure_prev) != 0){
            $average_blood_pressure_prev = round(array_sum($blood_pressure_prev)/count($blood_pressure_prev));
        }
        else{
            $average_blood_pressure_prev = 0;
        }
        if(count($blood_saturations_prev) != 0){
            $average_blood_saturation_prev = round(array_sum($blood_saturations_prev)/count($blood_saturations_prev));
        }
        else{
            $average_blood_saturation_prev = 0;
        }

        //Return Difference this - prev
        $pulse_rate_diff = round((($average_pulse_rate_month - $average_pulse_rate_prev)/abs($average_pulse_rate_prev)) * 100);
        $blood_pressure_diff = round((($average_blood_pressure_month - $average_blood_pressure_prev)/abs($average_blood_pressure_prev)) * 100);
        $blood_saturation_diff = round((($average_blood_saturation_month - $average_blood_saturation_prev)/abs($average_blood_saturation_prev)) * 100);


        // Pulse Rates Ratings
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

        // Blood Pressure Ratings
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

        // Blood Saturation
        $blood_saturation_ratings = array();
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach($blood_saturations as $blood_saturation){
            if($blood_saturation < 100){
                $above_normal++;
            }
            else if($blood_saturation <= 95){
                $normal++;
            }
            else{
                $below_normal++;
            }
        }
        array_push($blood_saturation_ratings, $below_normal, $normal, $above_normal);


        // For All Time Report
        $count = count(Reading::where('user_id',$user_id)->pluck('id'));
        $all_pulse_rates = Reading::where('user_id',$user_id)->pluck('pulse_rate')->toArray();
        $all_systolics = Reading::where('user_id',$user_id)->pluck('systolic')->toArray();
        $all_diastolics = Reading::where('user_id',$user_id)->pluck('diastolic')->toArray();
        $all_blood_saturations = Reading::where('user_id',$user_id)->pluck('blood_saturation')->toArray();
        if(count($all_pulse_rates)){
            $average_pulse_rate_all = round(array_sum($all_pulse_rates)/count($all_pulse_rates));
        }
        else{
            $average_pulse_rate_all = 0;
        }
        if(count($all_systolics)){
            $average_systolic_all = round(array_sum($all_systolics)/count($all_systolics));
        }
        else{
            $average_systolic_all = 0;
        }
        if(count($all_diastolics)){
            $average_diastolic_all = round(array_sum($all_diastolics)/count($all_diastolics));
        }
        else{
            $average_diastolic_all = 0;
        }
        if(count($all_blood_saturations)){
            $average_blood_saturation_all = round(array_sum($all_blood_saturations)/count($all_blood_saturations));
        }
        else{
            $average_blood_saturation_all = 0;
        }
        

        // For Year Readings Chart
        $pulse_rates_year = array();
        $systolics_year = array();
        $diastolics_year = array();
        $blood_pressures_year = array();
        $blood_saturations_year = array();
        for($month = 1; $month <= 12; $month++){
            $pulse_rates_curr = Reading::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('pulse_rate')->toArray();
            if(count($pulse_rates_curr) != 0){
                $average_pulse_rates_curr = round(array_sum($pulse_rates_curr)/count($pulse_rates_curr));
            }
            else{
                $average_pulse_rates_curr = 0;
            }
            array_push($pulse_rates_year, $average_pulse_rates_curr);

            $systolics_curr = Reading::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('systolic')->toArray();
            if(count($systolics_curr) != 0){
                $average_systolics_curr = round(array_sum($systolics_curr)/count($systolics_curr));
            }
            else{
                $average_systolics_curr = 0;
            }
            array_push($systolics_year, $average_systolics_curr);

            $diastolics_curr = Reading::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('diastolic')->toArray();
            if(count($diastolics_curr) != 0){
                $average_diastolics_curr = round(array_sum($diastolics_curr)/count($diastolics_curr));
            }
            else{
                $average_diastolics_curr = 0;
            }
            array_push($diastolics_year, $average_diastolics_curr);

            $blood_pressures_curr = Reading::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('blood_pressure')->toArray();
            if(count($blood_pressures_curr) != 0){
                $average_blood_pressures_curr = round(array_sum($blood_pressures_curr)/count($blood_pressures_curr));
            }
            else{
                $average_blood_pressures_curr = 0;
            }
            array_push($blood_pressures_year, $average_blood_pressures_curr);

            $blood_saturations_curr = Reading::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->pluck('blood_saturation')->toArray();
            if(count($blood_saturations_curr) != 0){
                $average_blood_saturations_curr = round(array_sum($blood_saturations_curr)/count($blood_saturations_curr));
            }
            else{
                $average_blood_saturations_curr = 0;
            }
            array_push($blood_saturations_year, $average_blood_saturations_curr);
        }
        
        // For all time ratings chart
        
        // Pulse Rates Ratings
        $all_pulse_rate_ratings = array();
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach($all_pulse_rates as $all_pulse_rate){
            $rating = $this->determinePulseRate($user_age, $all_pulse_rate);
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
        array_push($all_pulse_rate_ratings, $below_normal, $normal, $above_normal);

        // Blood Pressure Ratings
        $all_blood_pressure_ratings = array();
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach(array_combine($all_systolics, $all_diastolics) as $all_systolic => $all_diastolic){
            $rating = $this->determineBloodPressure($user_age, $all_systolic, $all_diastolic);
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
                dd('all rating'.$user_id.' '.$user_age.' '.$rating.' '.$all_systolic.' '.$all_diastolic);
            }
        }
        array_push($all_blood_pressure_ratings, $below_normal, $normal, $above_normal);

        // Blood Saturation
        $all_blood_saturation_ratings = array();
        $below_normal = 0;
        $normal = 0;
        $above_normal = 0;
        foreach($all_blood_saturations as $all_blood_saturation){
            if($all_blood_saturation < 95){
                $below_normal++;
            }
            else if($all_blood_saturation <= 100){
                $normal++;
            }
            else{
                $above_normal++;
            }
        }
        array_push($all_blood_saturation_ratings, $below_normal, $normal, $above_normal);

        return view('user.dashboard',compact(
            'average_pulse_rate_month',
            'average_systolic_month',
            'average_diastolic_month',
            'average_blood_saturation_month',
            'pulse_rate_diff',
            'blood_pressure_diff',
            'blood_saturation_diff',
            'labels', 
            'pulse_rates', 
            'systolics', 
            'diastolics', 
            'blood_pressures', 
            'blood_saturations', 
            'dates', 
            'times',
            'pulse_rate_ratings',
            'blood_pressure_ratings',
            'blood_saturation_ratings',
            'count',
            'average_pulse_rate_all',
            'average_systolic_all',
            'average_diastolic_all',
            'average_blood_saturation_all',
            'pulse_rates_year',
            'systolics_year',
            'diastolics_year',
            'blood_pressures_year',
            'blood_saturations_year',
            'all_pulse_rate_ratings',
            'all_blood_pressure_ratings',
            'all_blood_saturation_ratings',
        ));
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
}
