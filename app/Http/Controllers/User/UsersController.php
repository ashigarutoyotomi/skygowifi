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
use App\Http\Requests\UserRequest;
class UsersController extends Controller
{
    /**
     * Get all users
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        if(empty($request->filters)&& empty($request->keywords)){
            $users = UserGateway::all();
            return $users;
        }
        else{
            $filters = json_decode($request->get('filters'),true);  
            $query = User::query();   ;      
            if(!empty($request->filters)){
                if (!empty($filters['start_created_date'])) {
                    $query->where('created_at', '>=', $filters['start_created_date']);
                }
                if (!empty($filters['end_created_date'])) {
                    $query->where('created_at', '<=',  $filters['end_created_date']);
                }
            }
            if(!empty($request->keywords)){
                $query->where('first_name', '%LIKE%', $filters['first_name'])->where('last_name', '%LIKE%', $filters['last_name']);
            }            
        } 
        $users = $query->get();
        return $users;
    }

    public function store(UserRequest $request)
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
        abort_unless((bool)$user, 404, 'user not found');
        return $user;        
    }

    public function update(UserRequest $request, $userId)
    {
        $user = User::find($userId);
        abort_unless((bool)$user, 404, 'user not found');

        $data = (UpdateUserData::fromRequest($request));

        $user = (new UserAction)->update($data,$userId);

        return $user;
    }

    public function delete($userId)
    {
        $user = UserGateway::find($userId);
        abort_unless((bool)$user,404,'User not found');
        $user->delete();
        return $user;
    }
}
