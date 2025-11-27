<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLogModel;
use CodeIgniter\HTTP\ResponseInterface;

class ActivityLogController extends BaseController
{
    public function makeLog($userId, $resource_id, $action, $description)
    {
        try {
            $model = new ActivityLogModel();

            $data = [
                'user_id' => $userId,
                'resource_id' => $resource_id,
                'action' => $action,
                'description' => $description,
            ];

            if ($model->insert($data)) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
