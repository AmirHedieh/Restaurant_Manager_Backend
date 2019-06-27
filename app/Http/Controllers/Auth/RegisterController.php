<?php

namespace App\Http\Controllers\Auth;

use App\Custom\Utils;
use App\Custom\Validators;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
    public function register(Request $request) {
        $user = new User();

        $validator = Validators::registerValidator($request);

        if($validator->fails()){
            return Utils::makeJsonResponse(false, $validator->errors() );
        }

        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = 1;

        try {
            $user->save();
            return Utils::makeJsonResponse(true, $user );
        } catch (\Exception $exception){
            return Utils::makeJsonResponse(false, $exception->getMessage() );
        }
    }
}
