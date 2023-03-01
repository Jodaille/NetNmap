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

    public function update(Request $request)
    {
        $user = Auth::user();
        $params = json_decode($request->getContent());
        $host = Host::find($params->id);
        if ($host) {
            $host->name = $params->name;
            $host->save();
        }
        return response()->json([
            'status' => strtolower('Success'),
            'host' => $host,
            'id' => $params->id,
        ]);
    }
}
