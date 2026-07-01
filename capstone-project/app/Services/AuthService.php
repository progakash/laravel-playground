<?php
namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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

    /**
     * @throws ValidationException
     */
    public function login(array $credentials): array
    {
        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' => $token
        ];
    }

    //talk with business logic

}
