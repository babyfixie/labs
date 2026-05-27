<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExternalTaskService;

class ExternalApiController extends Controller
{
    protected $externalTaskService;

    public function __construct(ExternalTaskService $externalTaskService)
    {
        $this->externalTaskService = $externalTaskService;
    }

    public function posts()
    {
        return response()->json($this->externalTaskService->getPosts());
    }

    public function show($id)
    {
        return response()->json($this->externalTaskService->getPostById($id));
    }

    public function store(Request $request)
    {
        $data = $this->externalTaskService->createPost($request->all());

        return response()->json([
            'message' => 'Запит оброблено',
            'data' => $data
        ]);
    }
}