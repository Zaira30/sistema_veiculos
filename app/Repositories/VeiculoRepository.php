<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 14/01/20
 * Time: 01:33
 */

namespace App\Repositories;

use App\Base\BaseRepository;
use App\Http\Resources\VeiculoResource;
use App\Models\Veiculo;

class VeiculoRepository extends  BaseRepository
{
    public function getModel()
    {
        $this->model = new Veiculo();
    }

    public function getByFilter(string $search = null, string $status = null)
    {

        $query = $this->model;

        if($search != null) {
            $query =
                $query->whereRaw("nome like  '%$search%'");
                $query->whereRaw("ano_fabricacao like  '%$search%'");
                $query->whereRaw("ano_modelo like  '%$search%'");
                $query->whereRaw("chassi like  '%$search%'");
                $query->whereRaw("nome like  '%$search%'");
        }

        if ($status != null) {
            $query =
                $query->where("staus", $status);
        }


        return VeiculoResource::collection($query
            ->take(9)
            ->get()
        );
    }

}