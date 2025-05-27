<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function sendResetPhonePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|exists:users,email',
        ]);
        
        if ($validator->fails()) {
            return $this->apiResponse([], 422, $validator->errors()->first());
        }

        $user = User::where('email', $request->email)->first();

        $code = rand(100000, 999999);

        $otp = $user->otp()->create([
            'code' => $code,
        ]);
        
        // send otp here

        return $this->apiResponse([], 201, 'we send Otp to your phone number, please check it...' . 'developer code: ' . $otp->code);
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|integer|exists:otp,code',
            'password' => 'required|string|min:8|confirmed',
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
            'password' => Hash::make($request->password),
        ]);

        $otp->delete();

        return $this->apiResponse([], 200, 'Successfuly your Password has been changed');
    }

}
