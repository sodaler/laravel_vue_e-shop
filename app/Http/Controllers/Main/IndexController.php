<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use function view;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('main.index');
    }
}
