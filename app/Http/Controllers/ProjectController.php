<?php

namespace App\Http\Controllers {
    use App\Models\Property;
    use App\Models\Project;
    use App\Http\Requests;
    use Illuminate\Http;
    use Inertia\Response;

    class ProjectController extends Controller
    {
        public function index(): Response
        {
            $projects = Project::withTrashed()->paginate(env('APP_DEFAULT_PAGINATION'));
            $properties = Property::withoutTrashed()->get();

            foreach ($projects as $project) {
                $project['property'] = $project->property;
            }

            return inertia('dashboard/projects/index', [
                'projects'   => $projects,
                'properties' => $properties
            ]);
        }

        public function create(): Response
        {
            return inertia('dashboard/projects/show');
        }

        public function store(Requests\CreateProjectRequest $request): Http\RedirectResponse
        {
            $request->validated();

            Project::create([
                'name'         => $request['name'],
                'description'  => $request['description'],
                'scheduled_at' => $request['scheduled_at'],
                'building_id'  => $request['building_id'],
                'property_id'  => $request['property_id'],
            ]);

            return back();
        }

        public function show(Project $project): Response
        {
            return inertia('projects/show', [
                'project' => $project
            ]);
        }

        public function update(Requests\UpdateProjectRequest $request, Project $project): Http\RedirectResponse
        {
            return back();
        }

        public function destroy(Project $project): Http\RedirectResponse
        {
            $project->delete();
            return back();
        }

        public function restore(Project $project): Http\RedirectResponse
        {
            $project->restore();
            return back();
        }
    }
}
