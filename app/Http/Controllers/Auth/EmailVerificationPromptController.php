<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt or redirect to the user's dashboard if verified.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectBasedOnUserType($request->user());
        }

        return view('auth.verify-email');
    }

    /**
     * Redirect user to their respective dashboard based on user type.
     *
     * @param  \App\Models\User  $user
     * @return RedirectResponse
     */
    protected function redirectBasedOnUserType($user): RedirectResponse
    {
        switch ($user->usertype) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'client':
                return redirect()->route('client.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            case 'ophthal':
                return redirect()->route('ophthal.dashboard');
            default:
                return redirect()->route('landing');
        }
    }
}
