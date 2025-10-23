<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        //
    }

    public function login()
    {
        try {
            $validation = Services::validation();

            $rules = [
                'username' => 'required|max_length[30]',
                'password' => 'required|max_length[50]|min_length[5]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];

            $model = new UsersModel();

            $check = $model->where('username', $data['username'])->where('isDelete', 0)->first();

            if ($check) {
                $passwordConfirm = password_verify($data['password'], $check['password']);
                if ($passwordConfirm) {
                    session()->set([
                        'user' => $check,
                        'isLoggedIn' => true
                    ]);
                    return redirect()->to('/osca');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Incorrect Password');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Incorrect or Invalid Username');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
