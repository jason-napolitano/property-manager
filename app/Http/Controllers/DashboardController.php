<?php

namespace App\Http\Controllers {
    use App\Models;
    use Inertia;

    class DashboardController extends Controller
    {
        public function __invoke(): Inertia\Response
        {
            return inertia('dashboard/index', [
                'properties' => Models\Property::withoutTrashed()->get(),
                'buildings'  => Models\Building::withoutTrashed()->get(),
                'clients'    => Models\User::role('client')->get(),
            ]);
        }
    }
}
