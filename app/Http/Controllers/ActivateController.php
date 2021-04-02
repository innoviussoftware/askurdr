<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ActivateController extends Controller
{
    /**
     * @param $token
     */
    public function activate($token = null)
    {
        $user = User::where('email_verify_token', $token)->first();
        if (empty($user)) {
            return redirect()->to('/activate-success')
                ->with(['error' => trans('admin.activation_code_expired')]);
        }
        $user->update(['is_verified'=>1,'is_active'=>1,'email_verify_token' => null, 'email_verified_at' => date('Y-m-d h:i:s')]);
        return redirect()->to('/activate-success')
                ->with(['success' => 1]);
    }
}
