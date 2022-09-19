<?php

namespace App\Http\Controllers;

use File;
use Response;
use PDF;
use Carbon\Carbon;
use App\Models\User;

use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Export CSV Data
    public function exportCsv(Request $request){
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required|after:start_date'
        ],
        [
            'start_date.required' => 'This field is required',
            'end_date.after' => 'The end date must be after '.$request->start_date
        ]);
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        $readings = Reading::select('id','pulse_rate','systolic','diastolic','blood_saturation','created_at')->where('user_id',Auth::id())->whereBetween('created_at',[$start_date,$end_date])->get();
        $headers = array(
            'Content-Type' => 'text/csv'
        );
        if (!File::exists(public_path().'/files')) {
            File::makeDirectory(public_path().'/files');
        }
        $filename =  public_path('files/download.csv');
        $handle = fopen($filename, 'w');
        fputcsv($handle, [
            'No.',
            'Reading ID',
            'Pulse Rate',
            'Systolic',
            'Diastolic',
            'Blood Saturation',
            'Date Taken'
        ]);
        $number = 0;
        foreach($readings as $reading){
            fputcsv($handle, [
                $number++,
                $reading->id,
                $reading->pulse_rate,
                $reading->systolic,
                $reading->diastolic,
                $reading->blood_saturation,
                $reading->created_at
            ]);
        }
        fclose($handle);
        return Response::download($filename, $start_date.'-'.$end_date.'.csv', $headers);
    }

    public function generateReport(Request $request){
        $user_id = Auth::id();
        $request->validate([
            'text' => 'required_if:select,null|nullable|exists:readings,id,user_id,'.$user_id
        ],
        [
            'text.required_if' => 'This field is required if no ID is selected above',
            'text.exists' => 'The ID does not match any of your readings'
        ]);
        if($request->select != 'null'){
            $requested_id = $request->select;
        }
        else{
            $requested_id = $request->text;
        }
        $reading = Reading::where('id',$requested_id)->first();
        $user = User::find(Auth::id())->first();
        $data = [
            'id' => $reading->id,
            'date' => $reading->created_at,
            'name' => $user->name,
            'age' => $user->age,
            'pulse_rate' => $reading->pulse_rate,
            'systolic' => $reading->systolic,
            'diastolic' => $reading->diastolic,
            'blood_saturation' => $reading->blood_saturation
        ];
        $report = PDF::loadView('user.report', $data);

        return $report->download('report.pdf');
    }
}
