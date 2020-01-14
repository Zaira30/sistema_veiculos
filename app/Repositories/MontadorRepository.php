<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 14/01/20
 * Time: 01:09
 */

namespace App\Repositories;

use App\Base\BaseRepository;
use App\Http\Resources\MontadorResource;
use App\Models\Montador;

class MontadorRepository extends  BaseRepository
{
    public function getModel()
    {
        $this->model = new Montador();
    }

    public function getByFilter(string $search = null, string $status = null)
    {

        $query = $this->model;

        if($search != null) {
            $query =
                $query->whereRaw("nome like  '%$search%'");
        }

        if ($status != null) {
            $query =
                $query->where("staus", $status);
        }


        return MontadorResource::collection($query
            ->take(9)
            ->get()
        );
    }
}