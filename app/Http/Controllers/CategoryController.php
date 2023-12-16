<?php

namespace App\Http\Controllers {
    use App\Http\Requests;
    use App\Models\Category;
    use Illuminate\Http;
    use Inertia\Response;

    class CategoryController extends Controller
    {
        public function index(): Response
        {
            $categories = Category::withTrashed()->paginate(env('APP_DEFAULT_PAGINATION'));

            return inertia('dashboard/categories/index', [
                'categories' => $categories
            ]);
        }

        public function store(Requests\CreateCategoryRequest $request): Http\RedirectResponse
        {
            $request->validated();

            Category::create([
                'description' => $request['description'],
                'name'        => $request['name'],
            ]);

            return back();
        }

        public function show(Category $category): Response
        {
            return inertia('dashboard/categories/show', [
                'category' => $category
            ]);
        }

        public function update(Requests\UpdateCategoryRequest $request, Category $record): Http\RedirectResponse
        {
            return back();
        }

        public function destroy(Category $category): Http\RedirectResponse
        {
            $category->delete();
            return back();
        }

        public function restore(Category $category): Http\RedirectResponse
        {
            $category->restore();
            return back();
        }
    }
}
