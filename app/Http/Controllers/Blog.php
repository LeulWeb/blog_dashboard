<?php

namespace App\Http\Controllers;

use App\Models\Blog as ModelsBlog;
use Illuminate\Http\Request;

class Blog extends Controller
{
   
    public function index()
    {
       return ModelsBlog::latest()->get();
    }


    public function show(string $id)
    {
        return ModelsBlog::find($id);
    }

}
