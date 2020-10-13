<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $data = $request->toArray();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response()->json(['message' => 'Вы успешно зарегистрированы'], 201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if(!auth()->attempt($request->toArray())) {
            return response()->json([
                'errors' => 'Адрес электронной почты или пароль неправильные',
            ], 401);
        }
        $token = auth()->user()->createToken('authToken');

        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token->accessToken,
        ], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->user()->token()->revoke();

        return response()->json([
            'message' => 'Вы успешно вышли',
        ], 200);
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUser(User $user)
    {
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Пользователь успешно удален']);
    }
}
