<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function updateUser($id)
    {
        try {
            $session = session();
            $get = $session->get('isLoggedIn');
            $user = $session->get('user');

            if (!$get || $user['role'] !== 'admin') {
                return redirect()->to('/login')->with('error', 'You must login as admin first.');
            }

            $model = new UsersModel();

            $data = [
                'lastname'  => trim($this->request->getPost('lastname')),
                'firstname' => trim($this->request->getPost('firstname')),
                'username'  => trim($this->request->getPost('username')),
                'role'      => $this->request->getPost('role'),
                'isDelete'  => $this->request->getPost('isDelete') == 1 ? 1 : 0, // Active/Inactive
            ];

            // Optional password update
            $password = trim($this->request->getPost('password'));
            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $model->update($id, $data);

            return redirect()
                ->back()->withInput()
                ->with('success', "User profile updated successfully.");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }


    public function addUser()
    {
        try {
            $session = session();
            $get = $session->get('isLoggedIn');
            $user = $session->get('user');

            if (!$get || $user['role'] !== 'admin') {
                return redirect()->to('/login')->with('error', 'You must login as admin first.');
            }

            $model = new UsersModel();

            $data = [
                'username' => $this->request->getPost('username'),
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'role' => $this->request->getPost('role'),
            ];

            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm_password');

            if ($password !== $confirm_password) {
                return redirect()->back()->withInput()->with('error', "Password Not Match.");
            }

            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $model->insert($data);

            return redirect()->back()->withInput()->with('success', "New User Added.");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
