<?php
 
namespace App\Models;
 
use CodeIgniter\Model;

class StafModels extends Model
{
    protected $table = 'staf';
    protected $primaryKey = 'id_staf';
    protected $allowedFields = ['id_staf', 'nama', 'nip'];
}