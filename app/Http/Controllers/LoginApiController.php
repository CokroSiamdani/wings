<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginApiController extends Controller
{
    public function loginCheck(Request $request)
    {
        Log::info($request);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $result = Hash::check($request->password, $user->password);
            if ($result == "true") {
                $res = "true";
            } else {
                $res = "false";
            }
        } else {
            $res = "false";
        }

        return response()->json($res);
    }

    public function userData()
    {
        $user = User::get();

        return $user;
    }
}
