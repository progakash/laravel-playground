<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    /**
     * register new user
     */
    public function register(array $data)
    {
        return DB::transaction(function () use ($data) {
            //Hash the password
            $data['password'] = bcrypt($data['password']);

            //create the user through the repository
            $user = $this->userRepository->createUser($data);

            return $user;
        });
    }
    //talk with business logic
}
