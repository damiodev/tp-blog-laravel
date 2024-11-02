<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\Category;

class Home
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'categories' => Category::has('posts')->get(),
        ]);
    }
}