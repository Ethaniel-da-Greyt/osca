<?php

namespace App\Controllers;

use App\Models\BarangayListModel;
use App\Models\MasterListModel;

class Home extends BaseController
{
    public function index()
    {

        try {
            $record = new MasterListModel();
            $startOfMonth = date('Y-m-01');
            $endOfMonth   = date('Y-m-t');

            $list = $record->where('created_at >=', $startOfMonth)->where('created_at <=', $endOfMonth)->findAll();

            $unitCounts = [];

            for ($i = 1; $i <= 5; $i++) {
                $unitCounts[$i] = $record->where('unit', $i)->countAllResults();
            }

            $units = [
                'unit 1' => $unitCounts[1],
                'unit 2' => $unitCounts[2],
                'unit 3' => $unitCounts[3],
                'unit 4' => $unitCounts[4],
                'unit 5' => $unitCounts[5]
            ];

            return view('index', [
                'new_add' => $list,
                'units' => $units
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

            $barangaylist = $barangay->findAll();
            $filter = $this->request->getGet('filter');

            $search = $this->request->getGet('search');
            if (!empty($search)) {
                $list = $records->where('isDelete', 0)
                    ->groupStart()
                    ->where('lastname', $search)
                    ->orWhere('firstname', $search)
                    ->orWhere('middle_name', $search)
                    ->orWhere('osca_id', $search)
                    ->groupEnd();
            } elseif (!empty($filter)) {
                $list = $records->where('isDelete', 0)->where('barangay', $filter);
            } else {
                $list = $records->where('isDelete', 0);
            }

            $query = $list->findAll();

            return view('contents/sclist', ['lists' => $query, 'barangay' => $barangaylist, 'filter' => $filter]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
