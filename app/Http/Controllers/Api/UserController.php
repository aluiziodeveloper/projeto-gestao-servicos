<?php

namespace GestaoServicos\Http\Controllers\Api;

use GestaoServicos\Common\OnlyTrashed;
use GestaoServicos\Events\UserCreatedEvent;
use GestaoServicos\Http\Controllers\Controller;
use GestaoServicos\Http\Filters\UserFilter;
use GestaoServicos\Http\Requests\UserRequest;
use GestaoServicos\Http\Resources\UserResource;
use GestaoServicos\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use OnlyTrashed;

    public function index(Request $request)
    {
        /** @var UserFilter $filter */
        $filter = app(UserFilter::class);
        $query = User::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        /** @var Builder $filterQuery */
        $filterQuery = $query->filtered($filter);
        $users = $filter->hasFilterParameter() ? $filterQuery->get() : $filterQuery->paginate(10);
        return UserResource::collection($users);
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        event(new UserCreatedEvent($user));
        $user->refresh();
        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([], 204);
    }

    public function restore(User $user)
    {
        $user->restore();
        return response()->json([], 204);
    }
}
