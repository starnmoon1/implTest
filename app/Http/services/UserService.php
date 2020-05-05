<?php


namespace App\Http\services;


use App\Http\repositories\UserRepo;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    protected $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAll()
    {
        return $this->userRepo->getAll();
    }

    public function findById($id)
    {
        return $this->userRepo->findById($id);
    }

    public function create($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->pass == $request->passCheck) {
            $user->password = Hash::make($request->pass);
            $user->role = '3';
            $this->userRepo->save($user);
        }
    }

    public function changeRole($request, $id)
    {
        $user = $this->userRepo->findById($id);
        $user->role = $request->role;
        $this->userRepo->save($user);
    }

    public function delete($id)
    {
        $user = $this->userRepo->findById($id);
        $this->userRepo->delete($user);

    }


}
