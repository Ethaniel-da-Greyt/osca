<?php

namespace App\Controllers;

use App\Models\BarangayListModel;
use App\Models\MasterListModel;

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
            $search = $this->request->getGet('search');

            $perPage = 15;

            $list = $records->where('isDelete', 0);

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
}
