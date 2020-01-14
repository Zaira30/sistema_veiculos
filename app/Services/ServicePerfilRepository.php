<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 04/12/19
 * Time: 15:41
 */

namespace App\Services;


use App\Base\BaseRepository;
use App\Models\Perfil;

class ServicePerfilRepository extends BaseRepository
{
    public function getModel()
    {
        $this->model = new Perfil();
    }


}