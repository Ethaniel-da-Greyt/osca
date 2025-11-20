<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MasterListModel;
use CodeIgniter\HTTP\ResponseInterface;

class ScController extends BaseController
{
    // public function test1()
    // {
    //     return view('test');
    // }

    public function addRecord()
    {
        try {
            $model = new MasterListModel();

            // Compute age automatically based on birthdate
            $birthdate = $this->request->getPost('birthdate');
            $age = $this->calculateAge($birthdate);

            //Photo
            $photo = $this->fileUpload($this->request->getFile('photo'), $this->request->getPost('lastname'), $this->request->getPost('osca_id'));

            //QrCode Generator
            $Qr = new QrCodeGenerator();
            $qrcodeHash = md5(SALT . $this->request->getPost('osca_id'));
            $qrcode = $Qr->generateQr($qrcodeHash);

            $data = [
                'lastname' => $this->request->getPost('lastname'),
                'firstname' => $this->request->getPost('firstname'),
                'middle_name' => $this->request->getPost('middle_name'),
                'suffix' => $this->request->getPost('suffix'),
                'sex' => $this->request->getPost('sex'),
                'barangay' => $this->request->getPost('barangay'),
                'unit' => $this->request->getPost('unit'),
                'birthdate' => $birthdate,
                'age' => $age, // auto computed
                'osca_id' => $this->request->getPost('osca_id'),
                'date_issued' => $this->request->getPost('date_issued') ?: null,
                'date_applied' => $this->request->getPost('date_applied') ?: null,
                'photo' => $photo,
                'qrcode' => $qrcodeHash,
                'remarks' => $this->request->getPost('remarks'),
            ];

            if ($model->insert($data)) {

                $idGenerator = new PdfController();
                $name = $data['firstname'] . ' ' . $data['middle_name'] . ' ' . $data['lastname'] . ' ' . $data['suffix'];

                $idGenerator->generate(
                    $name,
                    'Brgy. ' . $data['barangay'],
                    $data['birthdate'],
                    $data['sex'],
                    $data['osca_id'],
                    $photo,
                    $qrcode,
                    $signature = ''
                );
                return redirect()->back()->with('success', 'Record added successfully!');
            }

            return redirect()->back()->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update()
    {
        try {
            
            $model = new MasterListModel();
            $id = $this->request->getPost('id');

            $birthdate = $this->request->getPost('birthdate');
            $age = $this->calculateAge($birthdate);

            // Generate QR code
            $Qr = new QrCodeGenerator();
            $qrcodeHash = md5(SALT . $this->request->getPost('osca_id'));
            $qrcodeFilename = $Qr->generateQr($qrcodeHash);  // Assumes this returns the filename (e.g., 'qrcode_123.png')

            $data = [
                'lastname' => $this->request->getPost('lastname'),
                'firstname' => $this->request->getPost('firstname'),
                'middle_name' => $this->request->getPost('middle_name'),
                'suffix' => $this->request->getPost('suffix'),
                'sex' => $this->request->getPost('sex'),
                'barangay' => $this->request->getPost('barangay'),
                'unit' => $this->request->getPost('unit'),
                'birthdate' => $birthdate,
                'age' => $age,
                'osca_id' => $this->request->getPost('osca_id'),
                'date_issued' => $this->request->getPost('date_issued') ?: null,
                'date_applied' => $this->request->getPost('date_applied') ?: null,
                'remarks' => $this->request->getPost('remarks'),
            ];

            // Perform update
            $updateResult = $model->update($id, $data);  // Update by primary key 'id'
            if ($updateResult > 0) {
                // Fetch updated record safely
                $sc = $model->where('id', $id)->first();
                if (!$sc || !isset($sc['photo'])) {
                    return redirect()->back()->with('error', 'Failed to retrieve updated record or photo.');
                }

                // Regenerate PDF ID using the library
                $name = $data['firstname'] . ' ' . $data['middle_name'] . ' ' . $data['lastname'] . ' ' . $data['suffix'];
                $generator = new PdfController();
                $generator->generate(
                    $name,
                    'Brgy. ' . strtoupper($data['barangay']),  // Match makeNewRecord() format
                    $data['birthdate'],
                    $data['sex'],
                    $data['osca_id'],
                    $sc['photo'],  // Assumes relative path (e.g., 'uploads/photo.jpg')
                    $qrcodeFilename,  // Pass the QR filename
                    $signature = ''
                );

                return redirect()->back()->with('success', 'Record updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to update record. No changes made.');
            }
        } catch (\Exception $e) {
            // Log for debugging: log_message('error', $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    // Helper function to compute age
    private function calculateAge($birthdate)
    {
        $dob = new \DateTime($birthdate);
        $today = new \DateTime('today');
        return $dob->diff($today)->y;
    }


    public function fileUpload($img, $name, $id)
    {
        // Check if a file was uploaded
        if ($img === null || !$img->isValid() || $img->hasMoved()) {
            return false; // No file uploaded or invalid file
        }

        // Create directory if missing
        $uploadPath = WRITEPATH . 'uploads/sc_photo/' . $id . '/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // Recursive mkdir
        }

        // Get original extension
        $ext = $img->getExtension();

        // Sanitize the name to prevent illegal characters
        $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);

        // New filename (with extension)
        $newName = $safeName . '_' . $id . '.' . $ext;

        // Move file to the upload directory
        $img->move($uploadPath, $newName);

        // Return the **absolute path** for safe use with GD or downloads
        return 'uploads/sc_photo/' . $id . '/' . $newName;
    }
}