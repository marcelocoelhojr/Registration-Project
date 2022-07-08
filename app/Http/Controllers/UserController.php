<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Traits\LogsTrait;
use App\Traits\Sanitize;

class UserController extends Controller
{
    use LogsTrait;
    use Sanitize;

    public function __construct()
    {
        $this->model = new Users();
    }

    public function create(Request $request)
    {
        try {
            if (isset($request->request) && !empty($request->request)) {
                $user = $request->except(['_token']);
                if ($user['password'] == $user['passwordConfirme']) {
                    unset($user['passwordConfirme']);
                    $user['password'] = md5($user['password']);
                    $this->removeCharacters($user);
                    $this->model->create($user);
                    $data = [
                        'status' => 'success',
                        'message' => 'Usuário cadastrado com sucesso.'
                    ];
                } else {
                    $data = [
                        'status' => 'error',
                        'message' => 'Erro ao cadastrar usuário, por favor verifique as informações.',
                        'user' => [
                            'name' => $user['name'],
                            'email' => $user['email']
                        ]
                     ];
                }
            }
            return view('userRegistration', $data);
        } catch (\Exception $e) {
            $this->saveLog($e->getMessage(), $e->getLine(), $e->getCode(), 'RegistrationController@update');
            $data = [
                'status' => 'error',
                'message' => 'Erro inesperado, por favor contate o suporte.'
            ];
            return view('userRegistration', $data);
        }
    }
    

}
