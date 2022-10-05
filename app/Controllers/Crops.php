<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Crop;
use App\Models\CropCycle;
use App\Models\CropType;

class Crops extends Controller
{
    public $dataResult;
    public function index()
    {
        $crop = new Crop();
        $cropCycle = new CropCycle();
        $cropType = new CropType();
        $data['crops_type'] = $cropType->orderBy('id_crop_type', 'ASC')->findAll();
        $data['crops_cycle'] = $cropCycle->orderBy('crop_cycle_id', 'ASC')->findAll();
        $data['crop'] = $crop->orderBy('crop_id', 'ASC')->findAll();
        $data['crops'] = $crop->select_all_crop();
        $data['title'] = TITLE;
        $data['css'] = view('template/css');
        $data['script'] = view('template/script');
        $data['header'] = view('template/header');
        $data['leftSidebar'] = view('template/sidebar');
        $data['footer'] = view('template/footer');

        return view('crop/to_list', $data);
    }
    public function create()
    {
        $crop = new Crop();
        $data = [
            'crop_id' => NULL,
            'crop_name' => $this->request->getVar('crop_name'),
            'crop_scientific_name' => $this->request->getVar('crop_scientific_name'),
            'crop_img' => $this->request->getVar('crop_img'),
            'crop_description' => $this->request->getVar('crop_description'),
            'crop_harvest_time' => $this->request->getVar('crop_harvest_time'),
            'id_crop_type' => $this->request->getVar('id_crop_type'),
            'crop_cycle_id' => $this->request->getVar('crop_cycle_id')
        ];
        $crop->insert($data);
        echo json_encode($data);
    }
    public function editCrop()
    {
        $crop = new Crop();
        $id = $this->request->getVar('crop_id');
        $data['crop'] = $crop->where('crop_id', $id)->first();
        echo json_encode($data);
    }

    public function delete()
    {
        try {
            $crop = new Crop();
            $id = $this->request->getVar('crop_id');
            $dataCrop = $crop->where('crop_id', $id)->first();

            if (IMG_DEFAULT != $dataCrop['crop_img']) {
                $rute = (ROUTE_FILE_UPLOADS . $dataCrop['crop_img']);
                if (is_file($rute)) {
                    unlink($rute);
                }
            }
            $crop->where('crop_id', $id)->delete($id);
            $dataResult = ['data_result' => 'ok'];
        } catch (\Exception $e) {
            $dataResult = ['data_result' => $e];
        }
        echo json_encode($dataResult);
    }
    public function edit($id = null)
    {
        $crop = new Crop();
        $data['crop'] = $crop->where('crop_id', $id)->first();
        $data['header'] = view('template/header');
        $data['footer'] = view('template/footer');
        return view('crop/edit', $data);
    }

    public function update()
    {
        try {
            $crop = new Crop();
            $nameImage = "";
            $id = $this->request->getVar('crop_id');
            $dataCrop = $crop->where('crop_id', $id)->first();
            if ($this->request->getVar('crop_img') == $dataCrop['crop_img']) {
                $nameImage = $dataCrop['crop_img'];
            } else {

                $nameImage = $this->request->getVar('crop_img');
                if (IMG_DEFAULT != $dataCrop['crop_img']) {
                    $rute = (ROUTE_FILE_UPLOADS . $dataCrop['crop_img']);
                    if (is_file($rute)) {
                        unlink($rute);
                    }
                }
            }
            $data = [
                'crop_name' => $this->request->getVar('crop_name'),
                'crop_img' => $nameImage,
                'crop_scientific_name' => $this->request->getVar('crop_scientific_name'),
                'crop_description' => $this->request->getVar('crop_description'),
                'crop_harvest_time' => $this->request->getVar('crop_harvest_time'),
                'id_crop_type' => $this->request->getVar('id_crop_type'),
                'crop_cycle_id' => $this->request->getVar('crop_cycle_id')
            ];
            $crop->update($id, $data);
            $dataResult = ['data_result' => "ok"];
        } catch (\Exception $e) {
            $dataResult = ['data_result' => $e];
        }
        echo json_encode($dataResult);
        //return $this->response->redirect(site_url('crop/to_list'));
    }
    function uploadImg()
    {
        $crop = new Crop();
        $validationRule = [
            'crop_img' => [
                'label' => 'Image File',
                'rules' => 'uploaded[crop_img]'
                    . '|is_image[crop_img]'
                    . '|mime_in[crop_img,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[crop_img,1024]'
                    . '|max_dims[crop_img,1104,1104]',
            ],
        ];
        if (!$this->validate($validationRule)) {

            $data = ['crop_result' => 'Error validate'];
        } else {
            if ($image = $this->request->getFile('crop_img')) {
                $newNameImg = $image->getRandomName();
                $image->move(ROUTE_FILE_UPLOADS, $newNameImg);

                $data = ['crop_img_url' => $newNameImg, 'crop_result' => 'ok'];
            }
        }
        echo json_encode($data);
    }
    public function save()
    {
        $crop = new Crop();
        $validationRule = [
            'crop_name' => 'required|min_length[3]',
            'crop_img' => [
                'label' => 'Image File',
                'rules' => 'uploaded[crop_img]'
                    . '|is_image[crop_img]'
                    . '|mime_in[crop_img,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[crop_img,1024]'
                    . '|max_dims[crop_img,1104,1104]',
            ],
        ];
        if (!$this->validate($validationRule)) {
            $session = session();
            $session->setFlashdata('message', 'validate the information');
            return redirect()->back()->withInput();
        }
        if ($image = $this->request->getFile('crop_img')) {
            $newNameImg = $image->getRandomName();
            $image->move(ROUTE_FILE_UPLOADS, $newNameImg);
            $data = [
                'crop_id' => NULL,
                'crop_name' => $this->request->getVar('crop_name'),
                'crop_scientific_name' => $this->request->getVar('crop_scientific_name'),
                'crop_img' => $newNameImg,
                'crop_description' => $this->request->getVar('crop_description'),
                'crop_harvest_time' => $this->request->getVar('crop_harvest_time'),
                'id_crop_type' => $this->request->getVar('id_crop_type'),
                'crop_cycle_id' => $this->request->getVar('crop_cycle_id')
            ];
            $crop->insert($data);
        }
        return $this->response->redirect(site_url('crop/to_list'));
    }
}
