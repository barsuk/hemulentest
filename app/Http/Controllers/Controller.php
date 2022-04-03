<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function list()
    {
        $user_id = Auth::id();
        $lists = DB::select('select id, `name` from files where user_id = ?', [$user_id]);
//        var_dump($lists);die;

        foreach ($lists as $list) {
            $entries = DB::select('select lastname, firstname, middlename from people where user_id = ?
and file_id = ?', [$user_id, $list->id]);
            $list->entries = $entries;
        }

        return view('list')->with('lists', $lists);
    }
}
