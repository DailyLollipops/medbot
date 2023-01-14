<?php

namespace App\Http\Controllers;

require $_SERVER['DOCUMENT_ROOT'] . '/medbot/vendor/autoload.php';

use Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Reading;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    // Credentials specific functions
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
                ->margin(1)
                ->format('png')
                ->generate($data);
        $path = 'qrcodes/' . $user_id . '.png';
        Storage::disk('local')->put($path, $image);
        return $path;
    }

    // For User Dashboard
    private function getLowPulseRate($age){
        if($age <= 1){
            $low = 100;
        }
        else if($age <= 3){
            $low = 80;
        }
        else if($age <= 5){
            $low = 80;
        }
        else if($age <= 10){
            $low = 70;
        }
        else if($age <= 14){
            $low = 60;
        }
        else{
            $low = 60;
        }
        return $low;
    }

    private function getHighPulseRate($age){
        if($age <= 1){
            $high = 160;
        }
        else if($age <= 3){
            $high = 130;
        }
        else if($age <= 5){
            $high = 120;
        }
        else if($age <= 10){
            $high = 110;
        }
        else if($age <= 14){
            $high = 105;
        }
        else{
            $high = 100;
        }
        return $high;
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
            return 0;
          }
          else if($pulse_rate < $high){
            return 1;
          }
          else{
            return 2;
          }
    }

    // American Heart Association
    private function determineBloodPressure($systolic, $diastolic){
        if($systolic < 120 && $diastolic < 80){
            $rating = 0;
        }
        else if($systolic <= 129 && $diastolic < 80){
            $rating = 1;
        }
        else if($systolic <= 139 || $diastolic <= 89){
            $rating = 2;
        }
        else if($systolic <= 180 || $diastolic <= 120){
            $rating = 3;
        }
        else{
            $rating = 4;
        }
        return $rating;
    }
    
    private function determineBloodSaturation($blood_saturation){
        if($blood_saturation < 95){
            $rating = 0;
        }
        else if($blood_saturation <= 100){
            $rating = 1;
        }
        else{
            $rating = 2;
        }
        return $rating;
    }

    private function getLatestReading($user_id){
        $latest_reading = Reading::where('user_id',$user_id)->latest('created_at')->first();
        return $latest_reading;
    }

    private function getPreviousRecentReading($user_id){
        $readings = Reading::where('user_id',$user_id)->latest('created_at')->get();
        if(count($readings)>1){
            $previous_recent_reading = $readings[1];
        }
        else{
            $previous_recent_reading = 'null';
        }
        return $previous_recent_reading;
    }

    private function getThisMonthReadings($user_id){
        $this_month_readings = Reading::where('user_id',$user_id)->whereYear('created_at',date('Y'))->whereMonth('created_at',date('m'))->oldest()->get();
        return $this_month_readings;
    }
    
    private function getPreviousMonthReadings($user_id){
        $previous_month_readings = Reading::where('user_id', $user_id)->where('created_at','>', Carbon::now()->subMonths(2))->where('created_at','<', Carbon::now()->subMonths(1))->oldest()->get();
        return $previous_month_readings;
    }

    private function getThisYearReadings($user_id){
        $this_year_readings = Reading::where('user_id',$user_id)->whereYear('created_at',date('Y'))->oldest()->get();
        return $this_year_readings;
    }

    private function getAllTimeReadings($user_id){
        $all_time_readings = Reading::where('user_id', $user_id)->oldest()->get();
        return $all_time_readings;
    }

    private function getMonthlyPerYearReadings($user_id){
        $per_month_readings = array();
        for($month = 1; $month <= 12; $month++){
            $per_month_readings_curr = Reading::where('user_id',$user_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->oldest()->get();
            array_push($per_month_readings, $per_month_readings_curr);
        }
        return $per_month_readings;
    }

    private function getDailyThisMonthReading($user_id){
        $daily_per_month_readings = array();
        $with_31 = [1,3,5,7,8,10,12];
        if(in_array(date('m'), $with_31)){
            $days = 31;
        }
        else{
            $days = 30;
        }
        for($day = 1; $day <= $days; $day++){
            $daily_readings = Reading::where('user_id',$user_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->whereDay('created_at', $day)->get();  
            array_push($daily_per_month_readings, $daily_readings);
        }
        return $daily_per_month_readings;
    }

    private function getDailyPerMonthReadings($user_id, $month){
        $daily_per_month_readings = array();
        $with_31 = [1,3,5,7,8,10,12];
        if(in_array($month, $with_31)){
            $days = 31;
        }
        else{
            $days = 30;
        }
        for($day = 1; $day <= $days; $day++){
            $daily_readings = Reading::where('user_id',$user_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->whereDay('created_at', $day)->get();  
            array_push($daily_per_month_readings, $daily_readings);
        }
        return $daily_per_month_readings;
    }

    private function getDailyPerMonthYearReadings($user_id, $month, $year){
        $daily_per_month_readings = array();
        $with_31 = [1,3,5,7,8,10,12];
        if(in_array($month, $with_31)){
            $days = 31;
        }
        else{
            $days = 30;
        }
        for($day = 1; $day <= $days; $day++){
            $daily_readings = Reading::where('user_id',$user_id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDay('created_at', $day)->get();  
            array_push($daily_per_month_readings, $daily_readings);
        }
        return $daily_per_month_readings;
    }

    private function getDailyPerMonthYearlyReadings($user_id){
        $daily_per_month_yearly_readings = array();
        for($month = 1; $month <= 12; $month++){
            $daily_per_month_readings = $this->getDailyPerMonthReadings($user_id, $month);
            array_push($daily_per_month_yearly_readings, $daily_per_month_readings);
        }
        return $daily_per_month_yearly_readings;
    }

    private function getDailyReadings($user_id){
        $readings = Reading::where('user_id', $user_id)->get()->groupBy(function($item){
            return $item->created_at->format('Y-m-d');
        });
        return $readings;
    }

    private function getPastMonthsReadings($user_id){
        $daily_past_month_readings = array();
        for($month = 11; $month >= 0; $month--){
            $temp_month = Carbon::now()->subMonths($month)->month;
            $temp_year = Carbon::now()->subMonths($month)->year;
            $daily_per_month_readings = $this->getDailyPerMonthYearReadings($user_id, $temp_month, $temp_year);
            array_push($daily_past_month_readings, $daily_per_month_readings);
        }
        return $daily_past_month_readings;
    }

    private function getReadingsFromRange($user_id, $from, $to){
        $start_date = Carbon::createFromFormat('Y-m-d', $from);
        $end_date = Carbon::createFromFormat('Y-m-d', $to);
        $readings = Reading::where('user_id',$user_id)->whereBetween('created_at', [$start_date, $end_date])->oldest()->get();
        return $readings;
    }

    private function getDailyReadingsFromRange($user_id, $from, $to){
        $daily_readings_by_date_range = array();
        $start_date = Carbon::createFromFormat('Y-m-d', $from);
        $end_date = Carbon::createFromFormat('Y-m-d', $to);
        $period = CarbonPeriod::create($start_date, $end_date);
        $dates = $period->toArray();
        foreach($dates as $date){
            $daily_readings = Reading::where('user_id', $user_id)->whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->whereDay('created_at', $date->day)->oldest()->get();
            array_push($daily_readings_by_date_range, $daily_readings);
        }
        return $daily_readings_by_date_range;
    }

    private function getUsersByAge($age){
        $from = Carbon::today()->subYears($age);
        $to = Carbon::today()->subYears($age + 1);
        $users = User::where('type', 'normal')->whereBetween('birthday', [$to, $from])->get();
        return $users;
    }

    private function getUsersByAgeRange($from_age, $to_age){
        $from = Carbon::today()->subYears($from_age);
        $to = Carbon::today()->subYears($to_age);
        $users = User::where('type', 'normal')->whereBetween('birthday', [$to, $from])->get();
        return $users;    
    }

    private function getUsersByMunicipality($municipality){
        $users = User::where('type', 'normal')->where('municipality', $municipality);
        return $users;
    }

    private function getUsersByBaranggay($municipality, $baranggay){
        $users = User::where('type', 'normal')->where('municipality', $municipality)->where('baranggay', $baranggay);
        return $users;
    }

    private function sortUsersByMunicipality(){
        $municipalities = ['Boac', 'Buenavista', 'Gasan', 'Mogpog', 'Sta.Cruz', 'Torrijos'];
        $users = array();
        foreach($municipalities as $municipality){
            $temp_users = $this->getUsersByMunicipality($municipality);
            array_push($users, $temp_users);
        }
        return $users;
    }

    private function getUserOverallRatings($user_id){
        $daily_readings = $this->getDailyReadings($user_id);
        $user = User::find($user_id);
        $user_pulse_rate_ratings = [0, 0, 0];
        $user_blood_pressure_ratings = [0, 0, 0, 0, 0];
        $user_blood_saturation_ratings = [0, 0, 0];
        foreach($daily_readings as $daily_reading){
            $pr_temp = [0, 0, 0];
            $bp_temp = [0, 0, 0, 0, 0];
            $sp_temp = [0, 0, 0];
            foreach($daily_reading as $reading){
                $pr_rating = $this->determinePulseRate(Carbon::parse($user->birthday)->age, $reading->pulse_rate);
                if($pr_rating == 0){
                    $pr_temp[0]++;
                }
                else if($pr_rating == 1){
                    $pr_temp[1]++;
                }
                else if($pr_rating == 2){
                    $pr_temp[2]++;
                }
                $bp_rating = $this->determineBloodPressure($reading->systolic, $reading->diastolic);
                if($bp_rating == 0){
                    $bp_temp[0]++;
                }
                else if($bp_rating == 1){
                    $bp_temp[1]++;
                }
                else if($bp_rating == 2){
                    $bp_temp[2]++;
                }
                else if($bp_rating == 3){
                    $bp_temp[3]++;
                }
                else if($bp_rating == 4){
                    $bp_temp[4]++;
                }
                $sp_rating = $this->determineBloodSaturation($reading->blood_saturation);
                if($sp_rating == 0){
                    $sp_temp[0]++;
                }
                else if($sp_rating == 1){
                    $sp_temp[1]++;
                }
                else if($sp_rating == 2){
                    $sp_temp[2]++;
                }
            }
            if($pr_temp[2] > 0){
                $user_pulse_rate_ratings[2]++;
            }
            else if($pr_temp[0] > 0){
                $user_pulse_rate_ratings[0]++;
            }
            else{
                $user_pulse_rate_ratings[1]++;
            }
            if($bp_temp[4] > 0){
                $user_blood_pressure_ratings[4]++;
            }
            else if($bp_temp[3] > 0){
                $user_blood_pressure_ratings[3]++;
            }
            else if($bp_temp[2] > 0){
                $user_blood_pressure_ratings[2]++;
            }
            else if($bp_temp[1] > 0){
                $user_blood_pressure_ratings[1]++;
            }
            else{
                $user_blood_pressure_ratings[0]++;
            }
            if($sp_temp[2] > 0){
                $user_blood_saturation_ratings[2]++;
            }
            else if($sp_temp[0] > 0){
                $user_blood_saturation_ratings[0]++;
            }
            else{
                $user_blood_saturation_ratings[1]++;
            }
        }
        if($user_pulse_rate_ratings[2] > 0){
            $pulse_rate_rating = 2;
        }
        else if($user_pulse_rate_ratings[0] > 0){
            $pulse_rate_rating = 0;
        }
        else{
            $pulse_rate_rating = 1;
        }
        if($user_blood_pressure_ratings[4] > 0){
            $blood_pressure_rating = 4;
        }
        else if($user_blood_pressure_ratings[3] > 0){
            $blood_pressure_rating = 3;
        }
        else if($user_blood_pressure_ratings[2] > 0){
            $blood_pressure_rating = 2;
        }
        else if($user_blood_pressure_ratings[1] > 0){
            $blood_pressure_rating = 1;
        }
        else{
            $blood_pressure_rating = 0;
        }
        if($user_blood_saturation_ratings[2] > 0){
            $blood_saturation_rating = 2;
        }
        else if($user_blood_saturation_ratings[0] > 0){
            $blood_saturation_rating = 0;
        }
        else{
            $blood_saturation_rating = 1;
        }
        $ratings = [
            'pulse_rate' => $pulse_rate_rating,
            'blood_pressure' => $blood_pressure_rating,
            'blood_saturation' => $blood_saturation_rating
        ];
        return $ratings;
    }

    private function getUsersRatings(){
        $users = $this->getAllUsers();
        $user_ratings = array();
        foreach($users as $user){
            $user_rating = $this->getUserOverallRatings($user->id);
            array_push($user_ratings, $user_rating);
        }
        return $user_ratings;
    }

    private function getUsersRatingsByAge($age){
        $users = $this->getUsersByAge($age);
        $user_ratings = array();
        foreach($users as $user){
            $user_rating = $this->getUserOverallRatings($user->id);
            array_push($user_ratings, $user_rating);
        }
        return $user_ratings;
    }

    private function sortUsersRatings(){
        $users_by_municipality = $this->sortUsersByMunicipality();
        $users_rating_by_municipality = array();
        foreach($users_by_municipality as $user_by_municipality){
            $users_rating = array();
            foreach($user_by_municipality as $users){
                foreach($users as $user){
                    $user_rating = $this->getUserOverallRatings($user->id);
                    array_push($user_ratings, $user_rating);
                }    
            }
            array_push($users_rating_by_municipality, $users_rating);
        }
    }

    private function getUsersRatingsByMunicipality($municipality){
        $users = $this->getUsersByMunicipality($municipality);
        $user_ratings = array();
        foreach($users as $user){
            $user_rating = $this->getUserOverallRatings($user->id);
            array_push($user_ratings, $user_rating);
        }
        return $user_ratings;
    }

    private function getUsersRatingsByBaranggay($municipality, $baranggay){
        $users = $this->getUsersByBaranggay($municipality, $baranggay);
        $user_ratings = array();
        foreach($users as $user){
            $user_rating = $this->getUserOverallRatings($user->id);
            array_push($user_ratings, $user_rating);
        }
        return $user_ratings;    
    }

    private function getUserRatingsCountByGender(){
        $males = User::where('type', 'normal')->where('gender', 'male')->get();
        $females = User::where('type', 'normal')->where('gender', 'female')->get();
        $male_pulse_rate_ratings = [0, 0, 0];
        $male_blood_pressure_ratings = [0, 0, 0, 0, 0];
        $male_blood_saturation_ratings = [0, 0, 0];
        foreach($males as $user){
            $rating = $this->getUserOverallRatings($user->id);
            $male_pulse_rate_ratings[$rating['pulse_rate']]++;
            $male_blood_pressure_ratings[$rating['blood_pressure']]++;
            $male_blood_saturation_ratings[$rating['blood_saturation']]++;
        }
        $female_pulse_rate_ratings = [0, 0, 0];
        $female_blood_pressure_ratings = [0, 0, 0, 0, 0];
        $female_blood_saturation_ratings = [0, 0, 0];
        foreach($females as $user){
            $rating = $this->getUserOverallRatings($user->id);
            $female_pulse_rate_ratings[$rating['pulse_rate']]++;
            $female_blood_pressure_ratings[$rating['blood_pressure']]++;
            $female_blood_saturation_ratings[$rating['blood_saturation']]++;
        }
        $male_ratings = [
            'pulse_rate' => $male_pulse_rate_ratings, 
            'blood_pressure' => $male_blood_pressure_ratings, 
            'blood_saturation' => $male_blood_saturation_ratings
        ];
        $female_ratings = [
            'pulse_rate' => $female_pulse_rate_ratings, 
            'blood_pressure' => $female_blood_pressure_ratings,
            'blood_saturation' => $female_blood_saturation_ratings
        ];
        $ratings = [
            'male' => $male_ratings,
            'female' => $female_ratings,
        ];
        return $ratings;
    }

    private function getUsersRatingsCountByAge(){
        $users_0_to_19 = $this->getUsersByAgeRange(0, 19);
        $users_20_to_39 = $this->getUsersByAgeRange(19, 39);
        $users_40_to_59 = $this->getUsersByAgeRange(39, 59);
        $users_60_to_79 = $this->getUsersByAgeRange(59, 79);
        $users_80_above = $this->getUsersByAgeRange(79, 200);
        $users_0_to_19_pulse_rate_ratings = [0, 0, 0];
        $users_0_to_19_blood_pressure_ratings = [0, 0, 0, 0, 0];
        $users_0_to_19_blood_saturation_ratings = [0, 0, 0];
        foreach($users_0_to_19 as $user){
            $rating = $this->getUserOverallRatings($user->id);
            $users_0_to_19_pulse_rate_ratings[$rating['pulse_rate']]++;
            $users_0_to_19_blood_pressure_ratings[$rating['blood_pressure']]++;
            $users_0_to_19_blood_saturation_ratings[$rating['blood_saturation']]++;    
        }
        $users_20_to_39_pulse_rate_ratings = [0, 0, 0];
        $users_20_to_39_blood_pressure_ratings = [0, 0, 0, 0, 0];
        $users_20_to_39_blood_saturation_ratings = [0, 0, 0];
        foreach($users_20_to_39 as $user){
            $rating = $this->getUserOverallRatings($user->id);
            $users_20_to_39_pulse_rate_ratings[$rating['pulse_rate']]++;
            $users_20_to_39_blood_pressure_ratings[$rating['blood_pressure']]++;
            $users_20_to_39_blood_saturation_ratings[$rating['blood_saturation']]++;    
        }
        $users_40_to_59_pulse_rate_ratings = [0, 0, 0];
        $users_40_to_59_blood_pressure_ratings = [0, 0, 0, 0, 0];
        $users_40_to_59_blood_saturation_ratings = [0, 0, 0];
        foreach($users_40_to_59 as $user){
            $rating = $this->getUserOverallRatings($user->id);
            $users_40_to_59_pulse_rate_ratings[$rating['pulse_rate']]++;
            $users_40_to_59_blood_pressure_ratings[$rating['blood_pressure']]++;
            $users_40_to_59_blood_saturation_ratings[$rating['blood_saturation']]++;    
        }
        $users_60_to_79_pulse_rate_ratings = [0, 0, 0];
        $users_60_to_79_blood_pressure_ratings = [0, 0, 0, 0, 0];
        $users_60_to_79_blood_saturation_ratings = [0, 0, 0];
        foreach($users_60_to_79 as $user){
            $rating = $this->getUserOverallRatings($user->id);
            $users_60_to_79_pulse_rate_ratings[$rating['pulse_rate']]++;
            $users_60_to_79_blood_pressure_ratings[$rating['blood_pressure']]++;
            $users_60_to_79_blood_saturation_ratings[$rating['blood_saturation']]++;    
        }
        $users_80_above_pulse_rate_ratings = [0, 0, 0];
        $users_80_above_blood_pressure_ratings = [0, 0, 0, 0, 0];
        $users_80_above_blood_saturation_ratings = [0, 0, 0];
        foreach($users_80_above as $user){
            $rating = $this->getUserOverallRatings($user->id);
            $users_80_above_pulse_rate_ratings[$rating['pulse_rate']]++;
            $users_80_above_blood_pressure_ratings[$rating['blood_pressure']]++;
            $users_80_above_blood_saturation_ratings[$rating['blood_saturation']]++;    
        }
        $users_0_to_19_ratings = [
            'pulse_rate' => $users_0_to_19_pulse_rate_ratings, 
            'blood_pressure' => $users_0_to_19_blood_pressure_ratings, 
            'blood_saturation' => $users_0_to_19_blood_saturation_ratings
        ];
        $users_20_to_39_ratings = [
            'pulse_rate' => $users_20_to_39_pulse_rate_ratings, 
            'blood_pressure' => $users_20_to_39_blood_pressure_ratings, 
            'blood_saturation' => $users_20_to_39_blood_saturation_ratings
        ];
        $users_40_to_59_ratings = [
            'pulse_rate' => $users_40_to_59_pulse_rate_ratings, 
            'blood_pressure' => $users_40_to_59_blood_pressure_ratings, 
            'blood_saturation' => $users_40_to_59_blood_saturation_ratings
        ];
        $users_60_to_79_ratings = [
            'pulse_rate' => $users_60_to_79_pulse_rate_ratings, 
            'blood_pressure' => $users_60_to_79_blood_pressure_ratings, 
            'blood_saturation' => $users_60_to_79_blood_saturation_ratings
        ];
        $users_80_above_ratings = [
            'pulse_rate' => $users_80_above_pulse_rate_ratings, 
            'blood_pressure' => $users_80_above_blood_pressure_ratings, 
            'blood_saturation' => $users_80_above_blood_saturation_ratings
        ];
        $ratings = [
            '0-19' => $users_0_to_19_ratings, 
            '20-39' => $users_20_to_39_ratings,
            '40-59' => $users_40_to_59_ratings,
            '60-79' => $users_60_to_79_ratings,
            '80-above' => $users_80_above_ratings
        ];
        return $ratings;
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
            $average_pulse_rate_curr = $this->getThisMonthAveragePulseRate($user_id);
            $pulse_rate_diff = round((($average_pulse_rate_curr - $average_pulse_rate_prev)/abs($average_pulse_rate_prev)) * 100);
        }
        else {
            $pulse_rate_diff = 0;
        }
        return $pulse_rate_diff;
    }

    private function getThisMonthAverageBloodPressureDifference($user_id){
        $blood_pressure_prev = $this->getPreviousMonthReadings($user_id)->pluck('blood_pressure')->toArray();
        if(count($blood_pressure_prev) != 0){
            $average_blood_pressure_prev = round(array_sum($blood_pressure_prev)/count($blood_pressure_prev));
            $average_blood_pressure_curr = $this->getThisMonthAverageBloodPressure($user_id);
            $blood_pressure_diff = round((($average_blood_pressure_curr - $average_blood_pressure_prev)/abs($average_blood_pressure_prev)) * 100);
        }
        else{
            $blood_pressure_diff = 0;
        }
        return $blood_pressure_diff;
    }

    private function getThisMonthAverageBloodSaturationDifference($user_id){
        $blood_saturations_prev = $this->getPreviousMonthReadings($user_id)->pluck('blood_saturation')->toArray();
        if(count($blood_saturations_prev) != 0){
            $average_blood_saturation_prev = round(array_sum($blood_saturations_prev)/count($blood_saturations_prev));
            $average_blood_saturation_curr = $this->getThisMonthAverageBloodSaturation($user_id);
            $blood_saturation_diff = round((($average_blood_saturation_curr - $average_blood_saturation_prev)/abs($average_blood_saturation_prev)) * 100);
        }
        else{
            $blood_saturation_diff = 0;
        }
        return $blood_saturation_diff;
    }

    private function getThisMonthPulseRateRatings($user_id){
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $pulse_rates = $this->getThisMonthPulseRates($user_id);
        $pulse_rate_ratings = array(0,0,0);
        foreach($pulse_rates as $pulse_rate){
            $rating = $this->determinePulseRate($user_age, $pulse_rate);
            $pulse_rate_ratings[$rating] = $pulse_rate_ratings[$rating] + 1;
        }
        return $pulse_rate_ratings;
    }

    private function getThisMonthBloodPressureRatings($user_id){
        $systolics = $this->getThisMonthSystolics($user_id);
        $diastolics = $this->getThisMonthDiastolics($user_id);
        $blood_pressure_ratings = array(0,0,0,0,0);
        foreach(array_combine($systolics, $diastolics) as $systolic => $diastolic){
            $rating = $this->determineBloodPressure($systolic, $diastolic);
            $blood_pressure_ratings[$rating] = $blood_pressure_ratings[$rating] + 1;
        }
        return $blood_pressure_ratings;
    }

    private function getThisMonthBloodSaturationRatings($user_id){
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $blood_saturations = $this->getThisMonthBloodSaturations($user_id);
        $blood_saturation_ratings = array(0,0,0);
        foreach($blood_saturations as $blood_saturation){
            $rating = $this->determineBloodSaturation($blood_saturation);
            $blood_saturation_ratings[$rating] = $blood_saturation_ratings[$rating] + 1;
        }
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
        $all_time_pulse_rates = $this->getAllTimeReadings($user_id)->pluck('pulse_rate')->toArray();
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $all_time_pulse_rate_ratings = array(0,0,0);
        foreach($all_time_pulse_rates as $pulse_rate){
            $rating = $this->determinePulseRate($user_age, $pulse_rate);
            $all_time_pulse_rate_ratings[$rating] = $all_time_pulse_rate_ratings[$rating] + 1;
        }
        return $all_time_pulse_rate_ratings;
    }

    private function getallTimeBloodPressureRatings($user_id){
        $all_time_systolics = $this->getAllTimeReadings($user_id)->pluck('systolic')->toArray();
        $all_time_diastolics = $this->getAllTimeReadings($user_id)->pluck('diastolic')->toArray();
        $all_time_blood_pressure_ratings = array(0,0,0,0,0);
        foreach(array_combine($all_time_systolics, $all_time_diastolics) as $systolic => $diastolic){
            $rating = $this->determineBloodPressure($systolic, $diastolic);
            $all_time_blood_pressure_ratings[$rating] =  $all_time_blood_pressure_ratings[$rating] + 1;
        }
        return $all_time_blood_pressure_ratings;
    }

    private function getallTimeBloodSaturationRatings($user_id){
        $all_time_blood_saturations = $this->getAllTimeReadings($user_id)->pluck('blood_saturation')->toArray();
        $user_age = Carbon::parse(User::find($user_id)->birthday)->age;
        $all_time_blood_saturation_ratings = array(0,0,0);
        foreach($all_time_blood_saturations as $blood_saturation){
            $rating = $this->determineBloodSaturation($user_age, $blood_saturation);
            $all_time_blood_saturation_ratings[$rating] = $all_time_blood_saturation_ratings[$rating] + 1;
        }
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
        $first_monthly_users = User::where('type','normal')->whereYear('created_at', $first_year)->whereMonth('created_at', $first_month)->pluck('id')->toArray();
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
        for($month = 11; $month >= 0; $month--){
            $temp_month = Carbon::now()->subMonths($month)->month;
            $temp_year = Carbon::now()->subMonths($month)->year;
            $new_monthly_users = User::whereYear('created_at', $temp_year)->whereMonth('created_at', $temp_month)->where('type','normal')->get();
            $per_month_users = count($new_monthly_users);
            array_push($monthly_new_users_per_month,$per_month_users);
        }
        return $monthly_new_users_per_month;
    }

    private function getUsersAge($users){
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

    private function getUsersGenderCount($users){
        $male_users_count = 0;
        $female_users_count = 0;
        foreach($users as $user){
            if($user->gender == 'male'){
                $male_users_count = $male_users_count + 1;
            }
            else{
                $female_users_count = $female_users_count + 1;
            }
        }
        $users_per_gender = array();
        $users_per_gender['male'] = $male_users_count;
        $users_per_gender['female'] = $female_users_count;
        return $users_per_gender;
    }

    private function getUserByAddress($municipality, $baranggay){
        if($municipality == 'All'){
            $users = User::where('type','normal')->get();
        }
        else if($baranggay == 'All'){
            $users = User::where('type','normal')->where('municipality',$municipality)->get();
        }
        else{
            $users = User::where('type','normal')->where('municipality',$municipality)->where('baranggay',$baranggay)->get();
        }
        return $users;
    }

    private function getAllUsers(){
        $users = User::where('type','normal')->get();
        return $users;
    }

    private function getAllReadings($user_id){
        $readings = Reading::where('user_id', $user_id)->get();
        return $readings;
    }

    private function getUsersAveragePulseRate($users){
        $users_pulse_rate = array();
        if(count($users) != 0){
            foreach($users as $user){
                $user_pulse_rate = $this->getAllReadings($user->id)->pluck('pulse_rate')->toArray();
                if(count($user_pulse_rate) != 0){
                    $user_pulse_rates = array();
                    foreach($user_pulse_rate as $pulse_rate){
                        array_push($user_pulse_rates, $pulse_rate);
                    }
                    $user_average_pulse_rate = round(array_sum($user_pulse_rate)/count($user_pulse_rate));
                    array_push($users_pulse_rate, $user_average_pulse_rate);
                }
            }
           $users_average_pulse_rate = round(array_sum($users_pulse_rate)/count($users_pulse_rate));
        }
        else{
            $users_average_pulse_rate = 0;
        }
        return $users_average_pulse_rate;
    }

    private function getUsersAverageSystolic($users){
        $users_systolic = array();
        if(count($users) != 0){
            foreach($users as $user){
                $user_systolic = $this->getAllReadings($user->id)->pluck('systolic')->toArray();
                if(count($user_systolic) != 0){
                    $user_systolics = array();
                    foreach($user_systolic as $systolic){
                        array_push($user_systolics, $systolic);
                    }
                    $user_average_systolic = round(array_sum($user_systolic)/count($user_systolic));
                    array_push($users_systolic, $user_average_systolic);
                }
            }
           $users_average_systolic = round(array_sum($users_systolic)/count($users_systolic));
        }
        else{
            $users_average_systolic = 0;
        }
        return $users_average_systolic;
    }

    private function getUsersAverageDiastolic($users){
        $users_diastolic = array();
        if(count($users) != 0){
            foreach($users as $user){
                $user_diastolic = $this->getAllReadings($user->id)->pluck('diastolic')->toArray();
                if(count($user_diastolic) != 0){
                    $user_diastolics = array();
                    foreach($user_diastolic as $diastolic){
                        array_push($user_diastolics, $diastolic);
                    }
                    $user_average_diastolic = round(array_sum($user_diastolic)/count($user_diastolic));
                    array_push($users_diastolic, $user_average_diastolic);
                }
            }
           $users_average_diastolic = round(array_sum($users_diastolic)/count($users_diastolic));
        }
        else{
            $users_average_diastolic = 0;
        }
        return $users_average_diastolic;
    }

    private function getUsersAverageBloodSaturation($users){
        $users_blood_saturation = array();
        if(count($users) != 0){
            foreach($users as $user){
                $user_blood_saturation = $this->getAllReadings($user->id)->pluck('blood_saturation')->toArray();
                if(count($user_blood_saturation) != 0){
                    $user_blood_saturations = array();
                    foreach($user_blood_saturation as $blood_saturation){
                        array_push($user_blood_saturations, $blood_saturation);
                    }
                    $user_average_blood_saturation = round(array_sum($user_blood_saturation)/count($user_blood_saturation));
                    array_push($users_blood_saturation, $user_average_blood_saturation);
                }
            }
           $users_average_blood_saturation = round(array_sum($users_blood_saturation)/count($users_blood_saturation));
        }
        else{
            $users_average_blood_saturation = 0;
        }
        return $users_average_blood_saturation;
    }

    // **-- User Registration Function --** //

    public function registerUser(Request $request){
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'middle_initial' => 'required',
            'last_name' => 'required',
            'gender' => 'required|different:null',
            'birthday' => 'required|before:now',
            'phone_number' => 'required',
            'email' => 'required|unique:users|email',
            'municipality' => 'required|different:null',
            'baranggay' => 'required|different:null',
            'password' => 'required|regex:/^.*(?=[^A-Z\n]*[A-Z]).{8,}.*$/',
            'password_confirmation' => 'required|same:password',
            'profile_picture' => 'mimes:jpeg,bmp,png'
        ],
        [
            'first_name.required' => 'First Name is required',
            'middle_initial.required' => 'Middle Initial is required',
            'last_name.required' => 'Last Name is required',
            'gender.different' => 'Please select your gender',
            'birthday.required' => 'Birthday field is required',
            'birthday.before' => 'Birthday field has invalid value',
            'phone_number.required' => 'Phone number field is required',
            'email.required' => 'Email address field is required',
            'email.unique' => 'Email address is already registered',
            'municipality.required' => 'Municipality / Address field is required',
            'municipality.different' => 'Please select your municipality',
            'baranggay.required' => 'Please select your baranggay',
            'baranggay.different' => 'Please select your baranggay',
            'password.required' => 'Password field is required',
            'password.regex' => 'Password should be at least 8 characters long and contain at least one uppercase letter',
            'password_confirmation.required' => 'Please confirm your password',
            'password_confirmation.same' => 'Passwords does not match',
            'profile_picture.mime' => 'The file is not an image file'
        ]);
        if($validator->fails()){
            foreach($validator->messages()->all() as $message){
                flash()->addError($message);
            }
            return back()->withInput();
        }
        $register_form = $request->all();
        if(!str_contains($register_form['middle_initial'], '.')){
            $register_form['middle_initial'] = $register_form['middle_initial'].'.';
        }
        $name = $register_form['first_name'] . ' ' . $register_form['middle_initial'] . ' ' . $register_form['last_name'];
        $name = ucwords($name);
        $register_form['name'] = $name;
        $register_form['password'] = bcrypt($register_form['password']);
        $register_form['type'] = 'normal';
        $user = User::create($register_form);
        if($request->has('profile_picture')){
            $profile_picture = $request->file('profile_picture');
            $extension = $profile_picture->getClientOriginalExtension();
            $file_name = $user->id.'.'.$extension;
            $profile_picture_path = $profile_picture->storeAs('profiles',$file_name,'public');
            $user->profile_picture_path = $profile_picture_path;
            $user->update();
        }
        Auth::login($user);
        flash()->addInfo('Registration completed');
        flash()->addInfo('Welcome '.$user->name);
        $path = $this->generateQRCode($user->id,$request->password);
        return redirect('/manage/update/password/download')->with('link',$user->id);
    }

    // **-- User Normal Type Specific Functions --** //

    // Redirect to User Dashboard
    public function redirectToUserDashboard(Request $request) {
        if(Auth::user()->type != 'normal'){
            abort(403);
        }
        $user = User::find(Auth::id());
        if(count($this->getAllTimeReadings($user->id)) == 0){
            return view('user.noreadings');
        }
        $user_age = Carbon::parse($user->birthday)->age;
        if($request->has('from') && $request->has('to')){
            $from = $request->from;
            $validator = Validator::make($request->all(),[
                'to' => 'after:from'
            ],[
                'to.after' => 'Invalid Date Range'
            ]);
            if($validator->fails()){
                foreach($validator->messages()->all() as $message){
                    flash()->addError($message);
                }
                return back();
            }
            $to = $request->to;
            $readings_from_range = $this->getReadingsFromRange($user->id, $from, $to);
            $daily_readings_from_range = $this->getDailyReadingsFromRange($user->id, $from, $to);
        }
        else{
            $from = Carbon::now()->subMonths(1)->isoFormat('YYYY-MM-DD');
            $to = Carbon::now()->isoFormat('YYYY-MM-DD');
            $readings_from_range = $this->getReadingsFromRange($user->id, $from, $to);
            $daily_readings_from_range = $this->getDailyReadingsFromRange($user->id, $from, $to);
        }
        return view('user.dashboard',[
            'user_age' => $user_age,
            'from' => $from,
            'to' => $to,
            'latest_reading' => $this->getLatestReading($user->id),
            'previous_recent_reading' => $this->getPreviousRecentReading($user->id),
            'daily_per_month_readings' => $this->getDailyThisMonthReading($user->id),
            'this_month_readings' => $this->getThisMonthReadings($user->id),
            'daily_readings_from_range' => $daily_readings_from_range,
            'readings_from_range' => $readings_from_range,
            'daily_past_month_readings' => $this->getPastMonthsReadings($user->id)
        ]);
    }

    // Redirect to Reading List Page
    public function redirectToReadingListPage(Request $request){
        if(Auth::user()->type != 'normal'){
            abort(403);
        }
        $user = User::find(Auth::id());
        if(count($this->getAllTimeReadings($user->id)) == 0){
            return view('user.noreadings');
        }
        if($request->has('filter')){
            $filter = explode('-',$request['filter']);
            $readings = Reading::where('user_id',Auth::id())->orderBy($filter[0],$filter[1])->paginate(9);
            if($filter[0] == 'created_at'){
                $filter_string = 'Date';
            }
            else{
                $filter_string = ucfirst(str_replace('_', ' ', $filter[0]));
            }
            $order_string = ucfirst($filter[1].'ending');
            flash()->addInfo('Sorted by '.$filter_string.' ('.$order_string.')');
        }
        else{
            $readings =Reading::where('user_id',Auth::id())->orderBy('created_at','desc')->paginate(9);
            $filter_string = 'Date';
            $order_string = 'Descending';
        }
        return view('user.readinglist',[
            'readings' => $readings,
            'filter' => $filter_string,
            'order' => $order_string,
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
    public function redirectToDoctorDashboard(Request $request){
        if(Auth::user()->type != 'doctor'){
            abort(403);
        }
        if($request->has('municipality') && $request->has('baranggay')){
            $municipality = $request->municipality;
            $baranggay = $request->baranggay;
            $users = $this->getUserByAddress($municipality, $baranggay);
            if($municipality == 'All'){
                $address = 'Whole Province';
            }
            else if($baranggay == 'All'){
                $address = 'Town of '.$municipality;
            }
            else{
                $address = $baranggay.', '.$municipality;
            }
        }
        else{
            $users = $this->getAllUsers();
            $address = 'Whole Province';
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
            'current_users' => count($users),
            'total_users' => count($this->getAllUsers()),
            'users_by_age' => $this->getUsersAge($users),
            'users_gender_count' => $this->getUsersGenderCount($users),
            'users_average_pulse_rate' => $this->getUsersAveragePulseRate($users),
            'users_average_systolic' => $this->getUsersAverageSystolic($users),
            'users_average_diastolic' => $this->getUsersAverageDiastolic($users),
            'users_average_blood_saturation' => $this->getUsersAverageBloodSaturation($users),
            'address' => $address,
            'users_ratings_count_by_gender' => $this->getUserRatingsCountByGender(),
            'users_ratings_count_by_age' => $this->getUsersRatingsCountByAge()
        ]);
    }

    // Redirect to User List
    public function redirectToUserListPage(Request $request){
        if(Auth::user()->type != 'doctor'){
            abort(403);
        }
        $filter_string = "Name";
        $order_string = "Descending";
        if($request->has('search')){
            if($request->order != null){
                $order = explode('-',$request['order']);
                $users = User::where('type','normal')->where($request->filter, 'like', '%'.$request->search.'%')->orderBy($order[0],$order[1])->paginate(10);
                if($order[0] == 'birthday'){
                    $filter_string = 'Age';
                }
                else{
                    $filter_string = ucfirst(str_replace('_', ' ', $order[0])); 
                }
                $order_string = ucfirst($order[1].'ending');
                flash()->addInfo('Sorted by '.$filter_string.' ('.$order_string.')');
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
            'filter' => $filter_string,
            'order' => $order_string
        ]);
    }
    
    // Redirect to User Info Page
    public function redirectToUserInfoPage($user_id){
        if(Auth::user()->type != 'doctor'){
            abort(403);
        }
        $user = User::find($user_id);
        $latest_reading = Reading::where('user_id',$user->id)->latest()->first();
        if($latest_reading == null){
            $latest_reading_date = 'No Readings Yet';
            $latest_pulse_rate = 'N/A';
            $latest_systolic = 'N';
            $latest_diastolic = 'A';
            $latest_blood_saturation = 'N/A';
            $average_pulse_rate = 'N/A';
            $average_systolic = 'N';
            $average_diastolic = 'A';
            $average_blood_saturation = 'N/A';
        }
        else{
            $latest_reading_date = Carbon::parse($latest_reading->created_at)->format('M d, Y');
            $latest_pulse_rate = $latest_reading->pulse_rate;
            $latest_systolic = $latest_reading->systolic;
            $latest_diastolic = $latest_reading->diastolic;
            $latest_blood_saturation = $latest_reading->blood_saturation;
            $average_pulse_rate = $this->getAllTimeAveragePulseRate($user->id);
            $average_systolic = $this->getAllTimeAverageSystolic($user->id);
            $average_diastolic = $this->getallTimeAverageDiastolic($user->id);
            $average_blood_saturation = $this->getAllTimeAverageBloodSaturation($user->id);
        }
        $address = $user->baranggay.', '.$user->municipality;
        return view('doctor.userinfo',[
            'id' => $user->id,
            'profile' => $user->profile_picture_path,
            'name' => $user->name,
            'joined' => Carbon::parse($user->created_at)->format('M d, Y'),
            'age' => Carbon::parse($user->birthday)->age,
            'gender' => ucfirst($user->gender),
            'phone' => $user->phone_number,
            'birthday' => Carbon::parse($user->birthday)->format('M d, Y'),
            'email' => $user->email,
            'address' => $address,
            'bio' => $user->bio,
            'latest_reading' => $latest_reading_date,
            'latest_pulse_rate' => $latest_pulse_rate,
            'latest_systolic' => $latest_systolic,
            'latest_diastolic' => $latest_diastolic,
            'latest_blood_saturation' => $latest_blood_saturation,
            'average_pulse_rate' => $average_pulse_rate,
            'average_systolic' => $average_systolic,
            'average_diastolic' => $average_diastolic,
            'average_blood_saturation' => $average_blood_saturation
        ]);
    }

    public function redirectToUserReportPage(Request $request, $user_id){
        if(Auth::user()->type != 'doctor'){
            abort(403);
        }
        $user = User::find($user_id);
        if($request->has('from') && $request->has('to')){
            $from = $request->from;
            $validator = Validator::make($request->all(),[
                'to' => 'after:from'
            ],[
                'to.after' => 'Invalid Date Range'
            ]);
            if($validator->fails()){
                foreach($validator->messages()->all() as $message){
                    flash()->addError($message);
                }
                return back();
            }
            $to = $request->to;
            $readings_from_range = $this->getReadingsFromRange($user->id, $from, $to);
            $daily_readings_from_range = $this->getDailyReadingsFromRange($user->id, $from, $to);
        }
        else{
            $from = Carbon::now()->subMonths(1)->isoFormat('YYYY-MM-DD');
            $to = Carbon::now()->isoFormat('YYYY-MM-DD');
            $readings_from_range = $this->getReadingsFromRange($user->id, $from, $to);
            $daily_readings_from_range = $this->getDailyReadingsFromRange($user->id, $from, $to);
        }
        if(count($this->getAllTimeReadings($user->id)) == 0){
            return view('doctor.noreport', [
                'user_id' => $user->id,
                'user_profile' => $user->profile_picture_path,
                'user_name' => $user->name,
                'user_age' => Carbon::parse($user->birthday)->age,
                'user_joined' => Carbon::parse($user->created_at)->format('M d, Y'),
            ]);
        }
        return view('doctor.userreport',[
            'user_id' => $user->id,
            'user_profile' => $user->profile_picture_path,
            'user_name' => $user->name,
            'user_age' => Carbon::parse($user->birthday)->age,
            'user_joined' => Carbon::parse($user->created_at)->format('M d, Y'),
            'from' => $from,
            'to' => $to,
            'latest_reading' => $this->getLatestReading($user->id),
            'previous_recent_reading' => $this->getPreviousRecentReading($user->id),
            'daily_per_month_readings' => $this->getDailyThisMonthReading($user->id),
            'this_month_readings' => $this->getThisMonthReadings($user->id),
            'daily_readings_from_range' => $daily_readings_from_range,
            'readings_from_range' => $readings_from_range,
            'daily_past_month_readings' => $this->getPastMonthsReadings($user->id)
        ]);
    }

    public function redirectToUserReadingPage(Request $request, $user_id){
        if(Auth::user()->type != 'doctor'){
            abort(403);
        }
        $user = User::find($user_id);
        if(count($this->getAllTimeReadings($user->id)) == 0){
            return view('doctor.noreading', [
                'user_id' => $user->id,
                'user_profile' => $user->profile_picture_path,
                'user_name' => $user->name,
                'user_age' => Carbon::parse($user->birthday)->age,
                'user_joined' => Carbon::parse($user->created_at)->format('M d, Y'),
            ]);
        }
        if($request->has('order')){
            $filter = explode('-',$request['order']);
            $readings = Reading::where('user_id',$user->id)->orderBy($filter[0],$filter[1])->get();
            if($filter[0] == 'created_at'){
                $filter_string = 'Date';
            }
            else{
                $filter_string = ucfirst(str_replace('_', ' ', $filter[0]));
            }
            $order_string = ucfirst($filter[1].'ending');
            flash()->addInfo('Sorted by '.$filter_string.' ('.$order_string.')');
        }
        else{
            $readings =Reading::where('user_id',$user->id)->orderBy('created_at','desc')->get();
            $filter_string = 'Date';
            $order_string = 'Descending';
        }
        return view('doctor.userreading',[
            'user_id' => $user->id,
            'user_profile' => $user->profile_picture_path,
            'user_name' => $user->name,
            'user_age' => Carbon::parse($user->birthday)->age,
            'user_joined' => Carbon::parse($user->created_at)->format('M d, Y'),
            'readings' => $readings,
            'filter' => $filter_string,
            'order' => $order_string
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
            'user_baranggay' => $user->baranggay,
            'user_municipality' => $user->municipality,
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
        $user->municipality = $request->municipality;
        $user->baranggay = $request->baranggay;
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
