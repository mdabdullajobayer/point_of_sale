<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Illuminate\View\View;


class UserController extends Controller
{
    // Return Users Auth all View 
    public function UserLogin(): View
    {
        return view('pages.auth.login-page');
    }
    public function UserResgister(): View
    {
        return view('pages.auth.register-page');
    }
    public function ResetPass(): View
    {
        return view('pages.auth.reset-pass');
    }
    public function Sendotp(): View
    {
        return view('pages.auth.send-otp');
    }
    public function Verifyotp(): View
    {
        return view('pages.auth.verify-otp');
    }
    public function home(): View
    {
        return view('pages.home.index');
    }
    public function UserProfileViews(): View
    {
        return view('pages.dashboard.profile');
    }


    // Actions methods 
    public function register(Request $request)
    {
        try {
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => Hash::make($request->input('password')),
            ]);
            return response()->json([
                'status' => 'success',
                'massage' => 'Registation Successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'massage' => 'Registation Faild!'
            ]);
        }
    }
    // User Login 
    public function login(Request $request)
    {
        $check = User::where('email', $request->input())->first();
        if ($check && Hash::check($request->input('password'), $check->password)) {
            if ($check !== null) {
                $token = JWTToken::CreateToken($check->email, $check->id);
                return response()->json([
                    'status' => 'success',
                    'massage' => 'Login Successful',
                    'token' => $token
                ], 200)->cookie('token', $token, time() + 60 * 24 * 38);
            } else {
                return response()->json([
                    'status' => 'error',
                    'massage' => 'Login Failed. Invalid credentials.',
                ], 401);
            }
        }
    }
    // Logout
    public function logout()
    {
        return redirect('login')->cookie('token', '', -1);
    }

    // reset-password
    public function sentotp(Request $request)
    {
        $email = $request->input('email');
        $opt = rand(1000, 9999);
        $check = User::where('email', $email)->count();
        if ($check == 1) {
            Mail::to($email)->send(new OTPMail($opt));
            User::where('email', '=', $email)->update(['otp' => $opt]);
            return response()->json([
                'status' => 'success',
                'massage' => 'Please Check Your Mail'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'massage' => 'Email Not Send'
            ]);
        }
    }
    // verify-otp
    public function otpverify(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');

        $check = User::where('email', '=', $email)->where('otp', '=', $otp)->count();
        if ($check == 1) {
            User::where('email', '=', $email)->update(['otp' => 0]);
            $token = JWTToken::CreateTokenForSetPassword($email);
            return response()->json([
                'status' => 'success',
                'massage' => 'OTP Verify Successfull',
                'token' => $token,
            ])->cookie('token', $token, time() + 60 * 24 * 36);
        } else {
            return response()->json([
                'status' => 'error',
                'massage' => 'OTP Verify Faild'
            ]);
        }
    }
    // Password Reset
    public function resetpassword(Request $request)
    {
        $email = $request->header('email');
        if (!$email) {
            return response()->json([
                'status' => 'error',
                'massage' => 'Email Not Found!'
            ]);
        }
        $password = $request->input('password');

        $getdata = User::where('email', '=', $email);
        if ($getdata) {
            User::where('email', '=', $email)->update(['password' => Hash::make($password)]);
            return response()->json([
                'status' => 'success',
                'massage' => 'Password Reset Sucessfully!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'massage' => 'Password Reset Faild!'
            ]);
        }
    }
    // User Profile

    public function UserProfile(Request $request)
    {
        $email = $request->header('email');
        $resutl = User::where('email', '=', $email)->first();

        return response()->json([
            'status' => 'success',
            'massage' => ' User Profile',
            'data' => $resutl,
        ]);
    }

    // UdateProfile
    public function UdateProfile(Request $request)
    {
        $email = $request->header('email');
        $resutl = User::where('email', '=', $email)->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password)
        ]);
        if ($resutl) {
            return response()->json([
                'status' => 'success',
                'massage' => 'User Updated Sucessfully!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'massage' => 'Update Faild'
            ]);
        }
    }
    // UdateProfile
}
