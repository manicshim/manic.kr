<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsContoroller extends Controller
{

    public function index()
    {
        return veiw('projects.index');
    }
}
