<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Fouladgar\OTP\Exceptions\InvalidOTPTokenException;
use Fouladgar\OTP\OTPBroker as OTPService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Throwable;
use Update_Mobile_Verify;

class AuthController
{
    public function __construct(private OTPService $OTPService)
    {
    }

    public function sendOTP(Request $request)
    {
        // validate incoming requets.
        if(Auth::user()) {
            try {
                /** @var User $user */
                //$request->get('phone')
                //$request->user()->get('mobile')
                $userInfo = Auth::user();
                $user = $this->OTPService->send($userInfo->mobile);
            } catch (Throwable $ex) {
                // or return a view.
                //return response()->json(['message' => 'An Occurred unexpected error.' . $ex], 500);
                return redirect()->route('verify')->with(['error_msg' => 'An Occurred unexpected error.']);
            }

            //return response()->json(['message' => 'A token sent to:' . $user->mobile]);
            return redirect()->route('verifyOTP')->with(['success' => 'A token sent to:' . $user->mobile]);
        }else{
            return redirect('login');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyOTPAndLogin(Request $request)
    {
        // Validate incoming requests.
        if (Auth::user()) {
            try {
                /** @var User $user */
                //$request->get('token')
                //$request->user()->get('mobile')
                $userInfo = Auth::user();
                $user = $this->OTPService->validate($userInfo->mobile, $request->verify_code );
                $userInfo->forceFill([
                    'mobile_verified_at' => Carbon::now()->timestamp
                ])->save();
                // and do login actions (session base or token base) ...


            } catch (InvalidOTPTokenException $exception) {
                return redirect()->route('verify')->with(['error_msg' => $exception->getMessage(). ' || ' . $exception->getCode()]);//response()->json(['error' => $exception->getMessage()], $exception->getCode());
            } catch (Throwable $ex) {
                return Redirect::back()->with(['error_msg' => 'An Occurred unexpected error.' . $ex]);// return response()->json(['message' => 'An Occurred unexpected error.' . $ex], 500);
            }

            //return response()->json(['message' => 'verify has been successfully.']);
            return redirect()->route('dashboard')->with(['success' => 'verify has been successfully.']);
        }else{
            return redirect('login');
        }
    }
}
