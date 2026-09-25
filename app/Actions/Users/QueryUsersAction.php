<?php

namespace App\Actions\Users;

use App\Http\Requests\Users\QueryUsersRequest;
use App\Models\User;
use Illuminate\Support\Collection;

class QueryUsersAction
{
    public static function do(QueryUsersRequest $request): Collection
    {
        return User::query()
            ->when($request->username, function ($query, $username) {
                $query->where('username', 'ILIKE' , "%$username%");
            })->when($request->id, function ($query, $id) {
                $query->where('id', '=', $id);
            })->when($request->before, function ($query, $before) {
                $query->where('created_at', '<=', $before);
            })->when($request->after, function ($query, $after) {
                $query->where('created_at', '>=', $after);
            })
            ->get();
    }
}
