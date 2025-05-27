<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'     => 'required|string|max:255',
            'phone'         => 'required|string|max:15|unique:users,phone',
            'country_id'    => 'required|exists:countries,id',
            'email'         => 'required|email|unique:users,email',
            'age'           => 'required|integer|min:15|max:80',
            'gender'        => 'required|in:' . implode(',', User::$GENDER),
            'password'      => 'required|string|min:8|confirmed',
            'type'          => 'required|in:' . implode(',', User::$TYPE),
        ]);
        
        if ($validator->fails()) {
            return $this->apiResponse([], 422, $validator->errors()->first());
        }

        $user = User::create($validator->validated());

        $code = rand(100000, 999999);

        $otp = $user->otp()->create([
            'code' => $code,
        ]);
        
        // send otp here

        return $this->apiResponse([], 201, 'we send Otp to your phone number, please check it...' . 'developer code: ' . $otp->code);
    }


    public function verifyAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|integer|exists:otp,code',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse([] , 422 , $validator->errors()->first());
        }

        $otp = OTP::where('code', $request->otp)->first();

        if(!$otp){
            return $this->apiResponse([] , 422 , 'this token not vaild');
        }

        if($otp->expired()){
            return $this->apiResponse([] , 422 , 'this token is expired');
        }

        $otp->user->update([
            'phone_verified' => true,
        ]);

        $otp->delete();

        return $this->apiResponse([], 200, 'Successfuly your register completed');
    }

}
