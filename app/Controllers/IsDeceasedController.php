<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MasterListModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class IsDeceasedController extends BaseController
{
    public function IsDeceased($id)
    {
        try {
            $model = new MasterListModel();
            $record = $model->where("osca_id", $id)->first();

            if ($record === null) {
                return redirect()->back()->with('error', 'Record not found.');
            }

            // Get value from form (1 if checked, 0 if unchecked)
            $isDeceased = $this->request->getPost('is_deceased') ? 1 : 0;

            $model->update($record['id'], ['isDeceased' => $isDeceased]);

            return redirect()->back()->with('success', 'Status updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}