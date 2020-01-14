<?php namespace App\Base;

use Illuminate\Support\Facades\Auth;

abstract class BaseRepository
{

    public $model;

    public function __construct()
    {
        $this->getModel();
    }

    abstract public function getModel();


    public function all($data = [])
    {
        return $this->model;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        return $this->model->where($column, $operator , $value , $boolean );
    }
    public function orderBy($column, $direction = 'asc')
    {
        return $this->model->orderby($column, $direction);
    }
    public function get($columns = ['*'])
    {
        return $this->model->get($columns);
    }
    public function update($id,$data)
    {
        $object = $this->model->find($id);
        $object->fill($data);
        $object->save();
        return $object;
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();
        return $model;
    }

    public function find($id, $with = [])
    {
        return $this->model->with($with)->findOrFail($id);
    }

    public function first()
    {
        return $this->model->first();
    }

    public function findBy($column, $value, $with = [], $operator = '=')
    {
        return $this->model->with($with)->where($column, $operator, $value);
    }

    public function findByUser($column, $value, $with = [], $operator = '=')
    {
        return $this->model->with($with)
            ->where('user_id',Auth::user()->id)
            ->where($column, $operator, $value);
    }

    public function paginate($value)
    {
        return $this->model->paginate($value);
    }

   
    public function count() {
        return $this->model->count();
    }


     public function mask($type,$str)
     {
        $mask = '';

        switch($type){
            case 'cnpj':
                $mask = '##.###.###/####-##';
            break;
            case 'cpf':
                $mask = '###.###.###-##';
            break;
            case 'telefone':
                $mask = '(##) ####-####';
            break;
            case 'celular':
                $mask = '(##) #####-####';
            break;
            case 'cep':
                $mask = '#####-###';
            break;
        }
        $str = str_replace(" ","",$str);

        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }

        return $mask;

    }

    public function replace($array,$rm,$data)
    {
        $str = $data;
        foreach ($array as $remove) {
            $str = str_replace($remove,$rm,$str);
        }
        return $str;

    }

//    public function getByFilter(string $status_field, array $search_fields, $resourceFunction = null, string $search = null, string $status = null)
//    {
//
//        $query = $this->model;
//
//        if($search != null and $search_fields != null) {
//            $query =
//                $query->where(function ($nested) use ($search, $search_fields) {
//                    foreach($search_fields as $search_field)
//                    {
//                        $nested->orWhereRaw("$search_field like  '%$search%' COLLATE Latin1_General_CI_AI");
//                    }
//                });
//        }
//
//        if ($status != null and $status_field != null) {
//            $query =
//                $query->where($status_field, $status);
//        }
//
//
//        if($resourceFunction != null) {
//            return $resourceFunction($query->get());
//        }
//
//        return $query->get();
//    }

    public function moneyFormat($money)
    {
        $money = str_replace(',','.',str_replace('R$ ','',$money));;
        return $money!=''?$money:null;

    }

    public function clearMaskMoney($money)
    {
        $money    = str_replace('.','', $money);
        $money    = str_replace(',','.',$money);          
        return $money!=''?$money:null;

    }    
}
