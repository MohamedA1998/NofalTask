<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth('api')->user()->load('follower');

        return $this->apiResponse(new UserResource($user));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'         => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'height'       => 'sometimes|numeric|min:0|max:300',
            'weight'        => 'sometimes|numeric|min:0|max:500',
            'job_title'    => 'sometimes|string|max:255',
            'blood_pressure' => 'sometimes|boolean',
            'diabetes'      => 'sometimes|boolean',
            'cholesterol'      => 'sometimes|boolean',
            'genetic_disease'      => 'sometimes|string|max:255',
            'heart_defects'      => 'sometimes|boolean',
            'smoking'      => 'sometimes|boolean',
        ]);
        
        if ($validator->fails()) {
            return $this->apiResponse([], 422, $validator->errors()->first());
        }

        $user = auth('api')->user();

        $data = [...$validator->validated()];

        if(request()->hasFile('image')) {
            $image = request()->file('image');
            $imagePath = $image->store('profile_images', 'public');
            $data['image'] = $imagePath;
        }

        $user->follower()->update($data);

        return $this->apiResponse(new UserResource($user->load('follower')));
    }
    

}
