<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Domains\User\Actions\UserAction;
use App\Domains\User\DTO\UserDTO\CreateUserData;
use App\Domains\User\DTO\UserDTO\UpdateUserData;
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
        // $gateway = new UserGateway;
        $filters = json_decode($request->get('filters'), true);

        $query = User::query();

        if (!empty($request->get('filters'))) {
            if (!empty($filters['role'])) {
                $query->where('role', $filters['role']);
            }
            if (!empty($filters['start_created_date'])) {
                $query->where('created_at', '>=', $filters['start_created_date']);
            }
            if (!empty($filters['end_created_date'])) {
                $query->where('created_at', '<=', $filters['end_created_date']);
            }
        }

        if (!empty($request->get('keywords'))) {
            $query->where('name', 'like', '%' . $request->get('keywords') . '%')
                ->orWhere('email', 'like', '%' . $request->get('keywords') . '%');
        }

        $users = $query->get();
        return $users;
    }

    public function store(UserRequest $request)
    {
$validated = $request->validated();
        // $validated = $request->validate([
        //     'name' => 'required|string|max:100',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string|max:50',
        //     'role' => 'required|int'
        // ]);

        $data = new CreateUserData([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'last_name' => $request->last_name,
            'role' => (int)$request->role,
            'phone_number'=>$request->phone_number,
            'address' => $request->address
        ]);

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
        // return response()->json([
        //     'id' => $user->id,
        //     'first_name' => $user->first_name,
        //     'email' => $user->email,
        //     'role' => $user->role,
        //     'address'=>$user->address,
        //     'last_name'=>$user->last_name,
        //     'phone_number'=>$user->phone_number,
        // ]);
    }

    public function update(UserRequest $request, $userId)
    {
        // $validated = $request->validate([
        //     'name' => 'required|string',
        //     'password' => 'nullable|string',
        //     'email' => 'required|email|unique:users,email,' . $userId,
        //     'role' => 'required|integer'
        // ]);
        $validated = $request->validated();
        $oldUser = User::find($userId);
        abort_unless((bool)$oldUser, 404, 'user not found');

        $data = new UpdateUserData([
            'first_name' => $request->first_name,            
            'email' => $request->email,
            'role' => (int)$request->role,
            'id' => (int)$userId,
            'last_name'=>$request->last_name,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address
        ]);

        $user = (new UserAction)->update($data);
        return $user;
    }

    public function delete($userId)
    {
        $user = User::find($userId);
        abort_unless((bool)$user, 404, 'user not found');
        $user->delete();
        return $user;
    }

    // public function getChartLineCustomersData()
    // {
    //     $data = [];

    //     $data['labels'] = [
    //         "January",
    //         "February",
    //         "March",
    //         "April",
    //         "May",
    //         "June",
    //         "July",
    //         "August",
    //         "September",
    //         "October",
    //         "November",
    //         "December",
    //     ];

    //     $data['datasets'][0] = [];
    //     $data['datasets'][0]['label'] = 'Customers';
    //     $data['datasets'][0]['borderColor'] = '#00D8FF';
    //     $data['datasets'][0]['backgroundColor'] = 'blue';

    //     $date = Carbon::now();
    //     $startJanuary = $date->copy()->startOfYear();
    //     $startFebruary = $startJanuary->copy()->addMonth();
    //     $startMarch = $startFebruary->copy()->addMonth();
    //     $startApril = $startMarch->copy()->addMonth();
    //     $startMay = $startApril->copy()->addMonth();
    //     $startJune = $startMay->copy()->addMonth();
    //     $startJuly = $startJune->copy()->addMonth();
    //     $startAugust = $startJuly->copy()->addMonth();
    //     $startSeptember = $startAugust->copy()->addMonth();
    //     $startOctober = $startSeptember->copy()->addMonth();
    //     $startNovember = $startOctober->copy()->addMonth();
    //     $startDecember = $startNovember->copy()->addMonth();

    //     $customers = User::where([
    //         'role' => User::USER_ROLE_CUSTOMER,
    //         ['created_at', '>=', $startJanuary]
    //     ])->get();

    //     $data['datasets'][0]['data'] = [
    //         $customers
    //             ->where('created_at', '>=', $startJanuary)
    //             ->where('created_at', '<', $startFebruary)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startFebruary)
    //             ->where('created_at', '<', $startMarch)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startMarch)
    //             ->where('created_at', '<', $startApril)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startApril)
    //             ->where('created_at', '<', $startMay)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startMay)
    //             ->where('created_at', '<', $startJune)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startJune)
    //             ->where('created_at', '<', $startJuly)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startJuly)
    //             ->where('created_at', '<', $startAugust)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startAugust)
    //             ->where('created_at', '<', $startSeptember)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startSeptember)
    //             ->where('created_at', '<', $startOctober)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startOctober)
    //             ->where('created_at', '<', $startNovember)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startNovember)
    //             ->where('created_at', '<', $startDecember)
    //             ->count(),
    //         $customers
    //             ->where('created_at', '>=', $startDecember)
    //             ->where('created_at', '<', $startJanuary)
    //             ->count(),
    //     ];

    //     return $data;
    // }
}
