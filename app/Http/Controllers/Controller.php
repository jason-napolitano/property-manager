<?php

namespace App\Http\Controllers {
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Gate;
    use Inertia\Response;

    class Controller extends BaseController
    {
        use AuthorizesRequests;
        use ValidatesRequests;

        public function render(string $page, mixed $data = [], string $can = null): Response|RedirectResponse
        {
            if ($can !== null) {
                if (Gate::allows($can)) {
                    return inertia($page, $data);
                }
                return to_route('home.index');
            }
            return inertia($page, $data);
        }
    }
}
