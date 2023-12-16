<?php

namespace App\Http\Controllers {
    use App\Http\Requests;
    use App\Models\Property;
    use App\Models\User;
    use Illuminate\Http;
    use Inertia\Response;

    class PropertyController extends Controller
    {
        public function index(): Response
        {
            $properties = Property::withTrashed()->paginate(env('APP_DEFAULT_PAGINATION'));
            $clients = User::role('client')->withoutTrashed()->get();

            foreach ($properties as $property) {
                $property['client'] = $property->client;
            }

            return inertia('dashboard/properties/index', [
                'properties' => $properties,
                'clients'    => $clients
            ]);
        }

        public function show(Property $property): Response
        {
            $property['buildings'] = $property->buildings()->withoutTrashed()->get();
            $property['projects'] = $property->projects()->withoutTrashed()->get();
            $property['clients'] = User::role('client')->orderBy('first_name')->withoutTrashed()->get();
            $property['client'] = $property->client;

            return inertia('dashboard/properties/show', [
                'property' => $property
            ]);
        }

        public function store(Requests\CreatePropertyRequest $request): Http\RedirectResponse
        {
            $request->validated();

            Property::create([
                'description' => $request['description'],
                'client_id'   => $request['client_id'],
                'name'        => $request['name'],
                'address'     => $request['address'],
                'phone'       => $request['phone'],
            ]);

            return back();
        }

        public function update(Requests\UpdatePropertyRequest $request, Property $property): Http\RedirectResponse
        {
            $request->validated();

            $property->update([
                'description' => $request['description'] ?? $property['description'],
                'client_id'   => $request['client_id'] ?? $property['client_id'],
                'name'        => $request['name'] ?? $property['name'],
                'address'     => $request['address'] ?? $property['address'],
                'phone'       => $request['phone'] ?? $property['phone'],
            ]);

            return back();
        }

        public function destroy(Property $property): Http\RedirectResponse
        {
            $property->delete();
            return back();
        }

        public function restore(Property $property): Http\RedirectResponse
        {
            $property->restore();
            return back();
        }

        public function buildings(Property $property)
        {
            $buildings = $property->buildings()->withoutTrashed()->paginate(5);
            return response($buildings);
        }

        public function projects(Property $property)
        {
            $projects = $property->projects()->withoutTrashed()->paginate(5);

            foreach ($projects as $project) {
                $project['building'] = $project->building()->get();
            }

            return response($projects);
        }
    }
}
