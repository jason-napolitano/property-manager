<?php

namespace App\Http\Controllers {
    use App\Http\Requests;
    use App\Models\Building;
    use App\Models\Property;
    use Illuminate\Http;
    use Inertia\Response;

    class BuildingController extends Controller
    {
        public function index(): Response
        {
            $buildings = Building::withTrashed()->paginate(env('APP_DEFAULT_PAGINATION'));
            $properties = Property::withoutTrashed()->get();

            foreach ($buildings as $building) {
                $building['property'] = $building->property;
            }

            return inertia('dashboard/buildings/index', [
                'properties' => $properties,
                'buildings'  => $buildings,
            ]);
        }

        public function show(Building $building): Response
        {
            $building['property'] = $building->property;
            return inertia('dashboard/buildings/show', [
                'building' => $building
            ]);
        }

        public function store(Requests\CreateBuildingRequest $request): Http\RedirectResponse
        {
            $request->validated();

            //            dd($request);

            Building::create([
                'name'        => $request['name'],
                'units'       => $request['units'],
                'description' => $request['description'],
                'property_id' => $request['property_id'],
            ]);

            return back();
        }

        public function update(Requests\UpdateBuildingRequest $request, Building $building): Http\RedirectResponse
        {
            return back();
        }

        public function destroy(Building $building): Http\RedirectResponse
        {
            $building->delete();
            return back();
        }

        public function restore(Building $building): Http\RedirectResponse
        {
            $building->restore();
            return back();
        }

        public function projects(Building $building): Http\Response
        {
            $projects = $building->projects()->withoutTrashed()->paginate(5);

            return response($projects);
        }
    }
}
