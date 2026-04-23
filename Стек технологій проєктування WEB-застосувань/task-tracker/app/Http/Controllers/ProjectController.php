<?php

namespace App\Http\Controllers;

// ВОТ ЭТА СТРОКА НУЖНА:
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Project::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Не забудь прописать $fillable в модели Project, 
        // иначе метод create() не сработает.
        return Project::create($request->all());
    }
}