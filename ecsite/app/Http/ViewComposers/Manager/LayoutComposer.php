<?php
namespace App\Http\ViewComposers\Manager;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class LayoutComposer
 * @package App\Http\ViewComposers\Manager
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