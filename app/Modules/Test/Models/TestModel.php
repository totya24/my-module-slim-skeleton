<?php
namespace App\Modules\Test\Models;

class TestModel extends \App\Models\BaseModel
{
    public function getAllItem(){
        $data = $this->db->select('test','*');
        return $data;
    }
}