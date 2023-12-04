<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Http\Helpers\ValidatorMessageHelper;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'email' => 'required|email',
            //     'password' => 'required|min:6',
            // ]);
            // if ($validator->fails()) {
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'validation error',
            //         'errors' => $validator->errors()
            //     ], 401);
            // }
            // if (!Auth::attempt($request->only(['email', 'password']))) {
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'Email & Password does not match with our record.',
            //     ], 401);
            // }
            // $user = User::where('email', $request->email)->first();

            // return response()->json([
            //     'status' => true,
            //     'message' => 'User Logged In Successfully',
            //     'user' => [
            //         'name' => $user->name,
            //         'email' => $user->email,
            //         'status_login' => $user->status_login,
            //     ],
            //     'token' => $user->createToken("APITOKEN")->plainTextToken
            // ], 200);
            //set validasi
            $validator = Validator::make($request->all(), [
                'email'    => 'required|email',
                'password' => 'required',
            ], ValidatorMessageHelper::validator());

            //response error validasi
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            //get "email" dan "password" dari input
            $credentials = $request->only('email', 'password');

            //check jika "email" dan "password" tidak sesuai
            if (!$token = auth()->guard('ppdb')->attempt($credentials)) {

                //response login "failed"
                return response()->json(['success' => false,
                    'message' => 'Email or Password is incorrect'
                ], 401);
            }

            //response login "success" dengan generate "Token"
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
        // return response()->json([
        //     'status' => true,
        //     'user' => auth()->user()
        // ], 200);

        //response data "user" yang sedang login
        return response()->json([
            'success' => true,
            'user'    => auth()->guard('ppdb')->user()
        ], 200);

        // return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $request->user(), 200);
    }

    public function refreshToken(Request $request)
    {
        //refresh "token"
        $refreshToken = JWTAuth::refresh(JWTAuth::getToken());

        //set user dengan "token" baru
        $user = JWTAuth::setToken($refreshToken)->toUser();

        //set header "Authorization" dengan type Bearer + "token" baru
        $request->headers->set('Authorization', 'Bearer ' . $refreshToken);

        //response data "user" dengan "token" baru
        return response()->json([
            'success' => true,
            'user'    => $user,
            'token'   => $refreshToken,
        ], 200);
    }
    public function logout(Request $request)
    {
        //remove "token" JWT
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        //response "success" logout
        return response()->json([
            'success' => true,
        ], 200);
        // Auth::guard('web')->logout();
        // $request->user()->currentAccessToken()->delete();

        // return response()->json(['message' => 'Successfully logged out']);
    }
}
