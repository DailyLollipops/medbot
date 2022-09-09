<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reading;

class FilterController extends Controller
{
    //Get order of readings
    public function getSelector(Request $request) {
        $filter = explode('-',$request['filter']);

        return redirect('/list/order-by-'.$filter[0].'-'.$filter[1]);
    }

    //Order the readings
    public function order($filter, $order) {
        if($order == 'asc'){
            $readings = Reading::where('user_id',Auth::id())->paginate(9)->sortBy($filter);
        }
        else {
            $readings = Reading::where('user_id',Auth::id())->paginate(9)->sortByDesc($filter);
        }

        $filterString = ucfirst(str_replace("_", " ", $filter));
        $orderString = ucfirst($order."ending");

        return view('user.readinglist',[
            'readings' => $readings,
            'filter' => $filterString,
            'order' => $orderString,
        ]);
    }
}
