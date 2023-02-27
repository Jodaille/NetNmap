<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Host;
use App\Models\User;

class HostController extends Controller
{
    public function list(Request $request)
    {
        $user = Auth::user();
        $hosts = Host::orderBy('lastUp', 'DESC')->get();
        return view('hosts.list',
        [
            'hosts' => $hosts,
            'user' => $user,
        ]);
    }
}
