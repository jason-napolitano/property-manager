<?php

namespace App\Http\Controllers\Auth {
    use Illuminate\Http\RedirectResponse;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use App\Http\Requests;
    use Inertia\Response;
    use App\Models\User;

    class RegisteredUserController extends Controller
    {
        /**
         * Display the registration view.
         *
         * @return Response
         */
        public function index(): Response
        {
            return inertia('auth/register');
        }

        /**
         * Handle an incoming registration request.
         *
         * @param \App\Http\Requests\CreateUserRequest $request
         *
         * @return RedirectResponse
         */
        public function store(Requests\CreateUserRequest $request): RedirectResponse
        {
            $request->validated();

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'city'       => $request->username,
                'state'      => $request->state,
                'zip_code'   => $request->zip_code,
                'phone'      => $request->phone,
                'password'   => Hash::make($request->password),
            ]);

            $user->assignRole(env('APP_DEFAULT_ROLE'));

            Auth::login($user);

            return to_route('home.index');
        }
    }
}
