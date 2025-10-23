<?php

namespace App\Controllers;

use App\Models\BarangayListModel;
use App\Models\MasterListModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function loginPage()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function index()
    {

        try {
            $record = new MasterListModel();
            $perPage = 15;

            // Define start and end of month
            $startOfMonth = date('Y-m-01');
            $endOfMonth   = date('Y-m-t');

            // Paginate only current month's records
            $list = $record
                ->where('created_at >=', $startOfMonth)
                ->where('created_at <=', $endOfMonth)
                ->orderBy('created_at', 'DESC')
                ->paginate($perPage);

            // Get pager instance
            $pager = $record->pager;

            // Count per unit (use clone to prevent builder reset)
            $unitCounts = [];
            for ($i = 1; $i <= 5; $i++) {
                $countModel = new MasterListModel(); // create a new instance each loop
                $unitCounts[$i] = $countModel->where('unit', $i)->countAllResults();
            }

            $units = [
                'Unit 1' => $unitCounts[1],
                'Unit 2' => $unitCounts[2],
                'Unit 3' => $unitCounts[3],
                'Unit 4' => $unitCounts[4],
                'Unit 5' => $unitCounts[5]
            ];

            return view('index', [
                'new_add' => $list,
                'units' => $units,
                'pager' => $pager // Pass the pager to view
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function scList()
    {
        try {
            $records = new MasterListModel();
            $barangay = new BarangayListModel();

            $barangaylist = $barangay->orderBy('barangay', 'ASC')->findAll();
            $filter = $this->request->getGet('filter');

            $perPage = 15;

            $list = $records->where('isDelete', 0);

            $search = $this->request->getGet('search');
            if (!empty($search)) {
                $list = $list->groupStart()
                    ->like('lastname', $search)
                    ->orLike('firstname', $search)
                    ->orLike('middle_name', $search)
                    ->orLike('osca_id', $search)
                    ->groupEnd();
            }

            if (!empty($filter)) {
                $list = $list->where('barangay', $filter);
            }

            $query = $list->orderBy('lastname', 'ASC')
                ->paginate($perPage);

            $pager = $records->pager;

            return view('contents/sclist', [
                'lists' => $query,
                'barangay' => $barangaylist,
                'filter' => $filter,
                'pager' => $pager,
                'search' => $search,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function manageRecord($id)
    {
        try {
            $records = new MasterListModel();
            $barangay = new BarangayListModel();

            $barangaylist = $barangay->findAll();

            $list = $records->where('isDelete', 0)->where('id', $id)->first();

            return view('contents/manage_record', [
                'n' => $list,
                'barangay' => $barangaylist,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function addrecord()
    {
        try {
            $barangay = new BarangayListModel();

            $barangaylist = $barangay->findAll();

            return view('contents/add_record', ['barangay' => $barangaylist]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function exportView()
    {
        try {
            $barangay = new BarangayListModel();

            $barangaylist = $barangay->orderBy('barangay', 'ASC')->findAll();
            return view('contents/export_print', ['barangay' => $barangaylist]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function users()
    {
        try {
            $model = new UsersModel();
            $session = session();
            $get = $session->get('isLoggedIn');
            $user = $session->get('user');

            if (!$get || $user['role'] !== 'admin') {
                return redirect()->to('/login')->with('error', 'You must login as admin first.');
            }

            $search = $this->request->getGet('search');
            $roleFilter = $this->request->getGet('role');
            $statusFilter = $this->request->getGet('status');

            if (!empty($search)) {
                $model->groupStart()
                    ->like('lastname', $search)
                    ->orLike('firstname', $search)
                    ->orLike('username', $search)
                    ->groupEnd();
            }

            if (!empty($roleFilter) && $roleFilter !== 'all') {
                $model->where('role', $roleFilter);
            }

            if ($statusFilter === 'active') {
                $model->where('isDelete', 0);
            } elseif ($statusFilter === 'inactive') {
                $model->where('isDelete', 1);
            }

            $users = $model->findAll();

            return view('contents/users', [
                'users' => $users,
                'search' => $search,
                'roleFilter' => $roleFilter,
                'statusFilter' => $statusFilter
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function manageUser($id)
    {
        try {
            $user = new UsersModel();


            $userInfo = $user->where('id', $id)->first();

            return view('contents/manage_user', [
                'n' => $userInfo,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
