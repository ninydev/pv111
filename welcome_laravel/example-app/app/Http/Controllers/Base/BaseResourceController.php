<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Http\Request;

class BaseResourceController extends Controller
{
    protected function __construct()
    {
    }

    protected EntityServiceInterface $entityService;

    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 2);
        $page = $request->input('page', 1);
        return $this->entityService->index($page, $per_page);
    }

    public function show(int $id)
    {
        return $this->entityService->show($id);
    }


}
