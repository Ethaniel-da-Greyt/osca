<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MasterListModel;
use CodeIgniter\HTTP\ResponseInterface;

class ScController extends BaseController
{
    public function test1()
    {
        return view('test');
    }

    public function addRecord()
    {
        try {
            $model = new MasterListModel();

            // Compute age automatically based on birthdate
            $birthdate = $this->request->getPost('birthdate');
            $age = $this->calculateAge($birthdate);

            $data = [
                'lastname'     => $this->request->getPost('lastname'),
                'firstname'    => $this->request->getPost('firstname'),
                'middle_name'  => $this->request->getPost('middle_name'),
                'suffix'       => $this->request->getPost('suffix'),
                'sex'          => $this->request->getPost('sex'),
                'barangay'     => $this->request->getPost('barangay'),
                'unit'         => $this->request->getPost('unit'),
                'birthdate'    => $birthdate,
                'age'          => $age, // auto computed
                'osca_id'      => $this->request->getPost('osca_id'),
                'date_issued'  => $this->request->getPost('date_issued') ?: null,
                'date_applied' => $this->request->getPost('date_applied') ?: null,
                'remarks'      => $this->request->getPost('remarks'),
            ];

            $model->insert($data);

            return redirect()->back()->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Helper function to compute age
    private function calculateAge($birthdate)
    {
        $dob = new \DateTime($birthdate);
        $today = new \DateTime('today');
        return $dob->diff($today)->y;
    }
}
