<?php

namespace App\Http\Controllers\Api;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;

class ResourceController extends Controller
{
    protected $model;

    public function __construct(Resource $resource)
    {
        $this->model = $resource;
    }

    public function index()
    {
        $resources = $this->model->with('permissions')->get();

        return MenuResource::collection($resources);
    }
}
