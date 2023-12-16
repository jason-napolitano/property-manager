<?php

namespace App\Http\Controllers;

use Inertia\Response;

class FrontendController extends Controller
{
    public function home(): Response
    {
        return inertia('frontend/home/index');
    }

    public function about(): Response
    {
        return inertia('frontend/about/index');
    }

    public function contact(): Response
    {
        return inertia('frontend/contact/index');
    }

    public function services(): Response
    {
        return inertia('frontend/services/index');
    }

    public function charity(): Response
    {
        return inertia('frontend/charity/index');
    }

    public function legal(): Response
    {
        return inertia('frontend/legal/index');
    }
}
