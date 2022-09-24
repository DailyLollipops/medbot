<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reading;

class FilterController extends Controller
{
    //Get order of readings
    public function getReadingSelector(Request $request) {
        $filter = explode('-',$request['filter']);

        return redirect('/readinglist/order-by-'.$filter[0].'-'.$filter[1]);
    }

    //Order the readings
    public function orderReading($filter, $order) {
        $readings = Reading::where('user_id',Auth::id())->orderBy($filter,$order)->paginate(9);
        if($filter == 'created_at'){
            $filterString = 'Date';
        }
        else{
            $filterString = ucfirst(str_replace('_', ' ', $filter));
        }
        $orderString = ucfirst($order.'ending');
        flash()->addInfo('Sorted by '.$filterString.' ('.$orderString.')');
        return view('user.readinglist',[
            'readings' => $readings,
            'filter' => $filterString,
            'order' => $orderString,
        ]);
    }

    //Get order of users
    public function getUserSelector(Request $request) {
        $filter = explode('-',$request['filter']);

        return redirect('/userlist/order-by-'.$filter[0].'-'.$filter[1]);
    }

    // Order the users
    public function orderUser($filter, $order) {
        $users = User::where('type','normal')->orderBy($filter,$order)->paginate(10);
        if($filter == 'birthday'){
            $filterString = 'Age';
        }
        else{
            $filterString = ucfirst(str_replace('_', ' ', $filter));
        }
        $orderString = ucfirst($order.'ending');
        flash()->addInfo('Sorted by '.$filterString.' ('.$orderString.')');
        return view('doctor.userlist',[
            'users' => $users,
            'filter' => $filterString,
            'order' => $orderString,
        ]);
    }
}
