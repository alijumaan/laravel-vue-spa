<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class AuthController extends ApiController
{
    public function login(LoginRequest $request)
    {
        if (! Auth::attempt(["username" => $request->username, "password" => $request->password])) {
            throw ValidationException::withMessages(['username' => 'معلومات إدخال خاطئة']);
        }

        $user = Auth::user();

        $token =  $this->getRefreshedToken($user->email, $request->password);

        return $this->respond([
            "user" => $user,
            'token' => $token
        ]);
    }

    public function getRefreshedToken($email, $password)
    {
        $response = Http::asForm()->post(config('app.url') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => config('passport.personal_access_client.id'),
            'client_secret' => config('passport.personal_access_client.secret'),
            'username' => $email,
            'password' => $password,
            'scope' => '*',
        ]);

        return $response->json();
    }

    public function refresh_token(Request $request)
    {
        $refresh_token = $request->header('RefreshTokenCode');

        try {
            $response = Http::asForm()->post(config('app.url') . '/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => config('passport.personal_access_client.id'),
                'client_secret' => config('passport.personal_access_client.secret'),
                'scope' => '*',
            ]);

            return $response->json();
        } catch (\Exception $exception) {
            return response()->json(['Unauthorized'], 200);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
    }
}
