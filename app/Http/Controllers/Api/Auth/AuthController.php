<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|string|min:8',
        ]);
        
        if ($validator->fails()) {
            return $this->apiResponse([], 422, $validator->errors()->first());
        }

        $credentials = $request->only(['email' , 'password']);

        if(! $token = auth('api')->attempt($credentials)){
            return $this->apiResponse([], 401, 'Unauthorized');
        }

        return $this->apiResponse(['token' => $token]);
    }


    public function destroy()
    {
        auth('api')->logout();

        return $this->apiResponse([]);
    }

}
