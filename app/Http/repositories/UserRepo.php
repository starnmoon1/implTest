<?php


namespace App\Http\repositories;


use App\User;

class UserRepo
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function findById($id)
    {
        return $this->user->findOrFail($id);
    }


    public function delete($user)
    {
        $user->delete();
    }


    public function save($obj)
    {
        $obj->save();
    }

}
