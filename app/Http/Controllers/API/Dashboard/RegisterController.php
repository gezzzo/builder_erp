<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\API\BaseController;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => bcrypt($validator['password']),
        ]);

        $tenant = Tenant::create([
            'id' => Str::slug($user->name),
            'plan' => 'free',
        ]);
        
       $tenant->domains()->create([
            'domain' => Str::slug($user->name) . '.buildererp.net'
        ]);
        
        $domain = $tenant->domains->first()->fqdn;

        $data = [
            "user" => $user,
            "tenant" => $tenant,
            ];

        
        return $this->respondData($data, 'User Created Successfully');
    }

    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('builder-app-v1')->accessToken;
            $success['name'] = $user->name;

            return $this->respondData($success, 'User login successfully.');
        } else {
            return $this->respondError('UnAuthorized.');
        }
    }
}
