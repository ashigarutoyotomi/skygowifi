<?php

namespace App\Http\Controllers\User;
use App\Domains\User\DTO\UserDTO\UpdateUserData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Domains\User\Actions\UserAction;
use App\Domains\User\DTO\UserDTO\CreateUserData;
use App\Domains\User\Gateways\UserGateway;
use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
class UsersController extends Controller
{
    /**
     * Get all users
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $gateway = new UserGateway();

        $filters = json_decode($request->get('filters'),true);

        if(!empty($filters)){
            $gateway->setFilters($filters);
        }

        $keywords =$request->get('keywords');

        if($keywords){
            $gateway->setSearch($keywords,['first_name','last_name','email']);
        }

        return $gateway->paginate(20)->all();
    }

    public function create()
    {
        $user = Auth::user();

        $fields = [
            'first_name' => [
                'key' => 'first_name',
                'title' => "First name",
                'type' => "text",
                'value' => '',
            ],
            'last_name' => [
                'key' => 'last_name',
                'title' => "Last name",
                'type' => "text",
                'value' => '',
            ],
            'email' => [
                'key' => 'email',
                'title' => "Email",
                'type' => "email",
                'value' => '',
            ],
            'role' => [
                'key' => 'role',
                'title' => "Role",
                'type' => "select",
                'options' => [
                    ['id' => User::USER_ROLE_USER, 'name' => 'User'],
                    ['id' => User::USER_ROLE_DEALER, 'name' => 'Dealer'],
                ],
                'value' => '',
            ],
            'address' => [
                'key' => 'address',
                'title' => "Address",
                'type' => "text",
                'value' => '',
            ],
            'phone_number' => [
                'key' => 'phone_number',
                'title' => "Phone number",
                'type' => "text",
                'value' => '',
            ],
            'password' => [
                'key' => 'password',
                'title' => "Password",
                'type' => "password",
                'value' => '',
            ],
        ];

        if ($user->role === User::USER_ROLE_SUPERADMIN) {
            $fields['role']['options'][] = ['id' => User::USER_ROLE_ADMIN, 'name' => 'Admin'];
        }

        return $fields;
    }

    public function store(CreateUserRequest $request)
    {
        $data = CreateUserData::fromRequest(($request));

        $user = (new UserAction)->create($data);

        return $user;
    }

    public function show($userId)
    {
        $user = (new UserGateway)->find($userId);
        abort_unless((bool)$user, 404, 'User not found');
        return $user;
    }

    public function edit( $userId)
    {
        $user = (new UserGateway)->edit($userId);
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
