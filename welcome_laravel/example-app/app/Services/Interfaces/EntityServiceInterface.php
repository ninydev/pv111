<?php

namespace App\Services\Interfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface EntityServiceInterface
{

    /**
     * Получение всех записей сущности
     * @param Request $request
     * @return LengthAwarePaginator
     */
    function index(Request $request)  : LengthAwarePaginator;

    /**
     * Получение 1 записи из базы данных
     * @param int $id
     * @return Model
     */
    function show(int $id) : Model;



}
