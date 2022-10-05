<?php 
namespace App\Models;

use CodeIgniter\Model;

class Crop extends Model{

    protected $table ='crop';
    protected $primaryKey='crop_id';
    protected $allowedFields=['crop_id','crop_name','crop_harvest_time','crop_description',
    'crop_img','id_crop_type','crop_scientific_name','crop_cycle_id'];

    function select_all_crop() {
		$query = "CALL sp_select_all_crop()";
        $result = $this->db->query($query)->getResult();
        return $result;
	}
    /*function create_crop($name, $email, $phone, $address) {
		$sql = "CALL sp_insert_user(?, ?, ?, ?)";
		$result = $this->db->query($sql, [$name, $email, $phone, $address]);
		
		if ($result) {
			return true;
		}
		
		return false;
	}*/
}