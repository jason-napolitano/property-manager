<?php

namespace App\Http\Controllers {
    use Illuminate\Http\Request;
    use Spatie\Permission\Models\Role;
    use Illuminate\Support;
    use App\Http\Requests;
    use Inertia\Response;
    use App\Models\User;
    use Illuminate\Http;

    class UserController extends Controller
    {
        public function index(): Response
        {
            $users = User::withTrashed()->paginate(env('APP_DEFAULT_PAGINATION'));
            $roles = Role::all();

            return inertia('dashboard/users/index', [
                'roles' => $roles,
                'users' => $users,
            ]);
        }

        public function show(User $user): Response
        {
            $user['properties'] = $user->properties()->withoutTrashed()->get();
            $roles = Role::all();
            return inertia('dashboard/users/show', [
                'roles' => $roles,
                'user' => $user
            ]);
        }

        /**
         * Handle an incoming registration request.
         *
         * @param Requests\CreateUserRequest $request
         *
         * @return Http\RedirectResponse
         */
        public function store(Requests\CreateUserRequest $request): Http\RedirectResponse
        {
            $request->validated();

            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name'  => $request['last_name'],
                'email'      => $request['email'],
                'phone'      => $request['phone'],
                'password'   => Support\Facades\Hash::make($request['password']),
            ]);

            $user->assignRole($request['role_id'] ?? env('APP_DEFAULT_ROLE'));

            $users = User::paginate(env('APP_DEFAULT_PAGINATION'));

            return to_route('users.index', [
                'page' => $users->lastPage()
            ]);
        }

        /**
         * Handle an incoming registration request.
         *
         * @param Requests\UpdateUserRequest $request
         * @param User                       $user
         *
         * @return Http\RedirectResponse
         */
        public function update(Requests\UpdateUserRequest $request, User $user): Http\RedirectResponse
        {
            $request->validated();

            $user->update([
                'first_name' => $request['first_name'] ?? $user['first_name'],
                'last_name'  => $request['last_name'] ?? $user['last_name'],
                'email'      => $request['email'] ?? $user['email'],
                'phone'      => $request['phone'] ?? $user['phone'],
                'password'   => Support\Facades\Hash::make($request['password']) ?? $user['password'],
            ]);
            return back();
        }

        public function destroy(User $user): Http\RedirectResponse
        {
            $user->delete();
            return back();
        }

        public function restore(User $user): Http\RedirectResponse
        {
            $user->restore();
            return back();
        }

        public function properties(User $user): Http\Response
        {
            $data = $user->properties()->withoutTrashed()->paginate(5);
            return response($data, 200);
        }
    }
}
