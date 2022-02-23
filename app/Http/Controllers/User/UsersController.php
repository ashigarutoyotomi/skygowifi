<?php

namespace App\Http\Controllers\User;
use App\Domains\User\DTO\UserDTO\UpdateUserData;
use Illuminate\Support\Facades\DB;
use App\Domains\User\Actions\UserAction;
use App\Domains\User\DTO\UserDTO\CreateUserData;
use App\Domains\User\Gateways\UserGateway;
use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
class UsersController extends Controller
{
    /**
     * Get all users
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $query = User::query();
        
        $filters = json_decode($request->get('filters'),true);
        if(!empty($request->filters)){
                $query = UserGateway::appendFilters($filters,$query);
        }
        if(!empty($request->keywords)){
                $query = UserGateway::setSearch($request->keywords,['first_name','last_name']);                
                   
        } 
        $users = $query->get();
        return $users;
    }

    public function store(CreateUserRequest $request)
    {
        
        
        $data = CreateUserData::fromRequest(($request));

        $user = (new UserAction)->create($data);

        return $user;
    }

    public function show($userId)
    {
        $user = UserGateway::show($userId);
        abort_unless((bool)$user, 404, 'user not found');
        return $user;
    }

    public function edit( $userId)
    {
        $user = UserGateway::edit($userId);
        abort_unless((bool)$user, 404, 'User not found');
        return $user;        
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $user = UserAction::find($userId);        

        $data = (UpdateUserData::fromRequest($request));

        $user = (new UserAction)->update($data,$userId);

        return $user;
    }

    public function delete($userId)
    {
        $user = UserAction::delete($userId);
        return $user;
    }
}
