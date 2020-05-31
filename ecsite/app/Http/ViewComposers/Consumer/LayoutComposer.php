<?php
namespace App\Http\ViewComposers\Consumer;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class LayoutComposer
 * @package App\Http\ViewComposers\Consumer
 */
class LayoutComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'loginUser' => Auth::user(),
        ]);
    }
}
