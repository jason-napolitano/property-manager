<?php

namespace App\Http\Controllers\Auth {
    use Illuminate\Http\RedirectResponse;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use App\Http\Requests;
    use Inertia\Response;

    class AuthenticatedSessionController extends Controller
    {
        public function index(): Response
        {
            return inertia('auth/login');
        }

        public function store(Requests\Auth\AuthenticatedSessionRequest $request): RedirectResponse
        {
            $request->validated();

            $request->authenticate();

            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        public function destroy(Request $request): RedirectResponse
        {
            Auth::guard('web')->logout();

            $request->session()->regenerateToken();

            return to_route('login.index');
        }
    }
}
