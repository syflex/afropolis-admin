<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\AuthNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signUp(Request $request)
    {

        $messages = [
            'name.required'    => 'Enter full name!',
            'email.required' => 'Enter an e-mail address!',
            'email' => 'E-mail address exist!',
            'password.required'    => 'Password is required',
            'password_confirmation' => 'The :password and :password_confirmation must match.'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ], $messages);

        $user = User::where('email', $request->get('email'))->first();


        if ($user) {
            return response()->json([
                'status' => 'exist',
                'message' => 'User already exist. please login',
            ], 409);
        } elseif ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 406);
        } else {

            // insert new record
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            // $input['activation_token'] = str_random(60);

            $user = User::create($input);


        try {
            //code...

            Mail::to($user)->send(new WelcomeMail($user));

            // $title = 'Signup Notification';
            // $body = 'Welcome to Afropolis ';
            // $user->notify(new AuthNotification($user, $title, $body));

        } catch (\Throwable $th) {
            //throw $th;
        }

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'status' => 'successful',
                'message' => 'Account created successfully',
                'accessToken' => $tokenResult->accessToken,
            ]);
        }
    }


    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;

        if (!Auth::attempt($credentials))
            return response()->json([
                'status' => 'failed',
                'message' => 'Email and/or Password is invalid'
            ], 401);

        if (!Auth::user()->active)
            return response()->json([
                'status' => 'failed',
                'message' => 'Your account is under review'
            ], 401);

        // $user = User::where('id', Auth::user()->id)->first();
        $user = User::where('email', $request->get('email'))->first();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Login successfully',
            'access_token' => $tokenResult->accessToken,
        ]);
    }

     /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user ob
     *
     */
    public function user(Request $request)
    {
        $user = User::with('followers','interest')
            //  ->with('userInterest')
        ->where('id', Auth::user()->id)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'user fetched',
            'user' => $user
        ]);
    }


    /**
     * Fetching all users
     */
    public function allUsers(Request $request)
    {
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'message' => 'users fetched',
            'users' => $users
        ]);
    }

    /**
     * user edit profile
     */
    public function editProfile(Request $request)
    {

        $user = User::where('id', Auth::user()->id)->first();
        $user->slug = $request->input('slug');
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->website = $request->input('website');
        $user->profession = $request->input('profession');
        $user->save();
        return response()->json([
            'user' => $user,
            'message' => 'Profile updated successfully',
            'status' => true
        ], 201);
    }

    public function getUser($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'user' => $user
            ], 200);
        }
            catch(\Exception $e){
                return response()->json([
                    'message' => 'not found'
                ], 404);
        }
    }
    /**
     * Update user details
     *
     * @param  [string] name
     * @param  [string] email
     * @return [string] message
     */
    public function get_featured_users(Request $request)
    {
        $users = User::where('active', 1)->where('deleted_at', null)->where('id', '!=', Auth::user()->id)->limit(10)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'users fetched',
            'data' => $users
        ]);
    }


    /**
     * change password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string',
            'password_confirmation' => 'required|same:newPassword',
        ]);

        $id = Auth::user()->id;
        $hashPassword = Auth::user()->password;
        //echo ($hashPassword);
        if(!Hash::check($request->currentPassword, $hashPassword)) {
            return response()->json(['error' => 'Current Password is not correct', 'status' => false], 403);
        }
        if(Hash::check($request->newPassword, $hashPassword)) {
            return response()->json(['error' => 'Current Password cannot be the same with new password', 'status' => false], 400);
        }
         try {
            $user = User::findOrFail($id);
            $user->password = bcrypt($request->input('newPassword'));

            $user->save();
            return response()->json(['user' => $user, 'message' => 'Password changed successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'.$e, 'status' => false], 500);
        }

    }


    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $email = $request->input('email');
        $user = User::where('email', $email)->get();
        if($user) {
        return response()->json(['user' => $user], 200);
        }

        return response()->json(['error' => 'Not found'], 404);

    }

    public function avatar(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->avatar = $request->avatar;
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'avatar updated successfully',
            'user' => $user
        ]);
    }

}
