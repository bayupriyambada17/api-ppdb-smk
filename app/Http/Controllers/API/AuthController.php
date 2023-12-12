<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationStatus;
use App\Http\Helpers\ValidatorMessageHelper;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email'    => 'required|email',
                'password' => 'required',
            ], ValidatorMessageHelper::validator());

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $credentials = $request->only('email', 'password');

            if (!$token = auth()->guard('ppdb')->setTTl(604800)->attempt($credentials)) {

                return response()->json(['success' => false,
                    'message' => 'Email or Password is incorrect'
                ], 401);
            }

            return response()->json(['success' => true,
                'user'    => auth()->guard('ppdb')->user(),
                'token'   => $token
            ], 200);
        } catch (\Exception $e) {
            return NotificationStatus::notifError(
                false,
                $e->getMessage(),
                null,
                500
            );
        }
    }

    public function getMe(Request $request)
    {
        return response()->json([
            'success' => true,
            'user'    => auth()->guard('ppdb')->user()
        ], 200);

    }

    public function refreshToken(Request $request)
    {
        $refreshToken = JWTAuth::refresh(JWTAuth::getToken());

        $user = JWTAuth::setToken($refreshToken)->toUser();

        $request->headers->set('Authorization', 'Bearer ' . $refreshToken);

        return response()->json([
            'success' => true,
            'user'    => $user,
            'token'   => $refreshToken,
        ], 200);
    }
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'success' => true,
        ], 200);

    }
}
