<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class Product extends ResourceController
{
    use ResponseTrait;
    //get all product
    //localhost:8080/products
    public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model -> orderBy('_id', 'DESC') -> findAll();
        return $this -> respond($data);
    }

    //get product by id
    //http://localhost:8080/products/
    public function getProduct($id = null)
    {
        $model = new ProductModel();
        $data = $model -> where('_id',$id) -> first();
        if($data){
            return $this -> respond($data);
        }
        else {
            return $this -> failNotFound('No product found');
        }
    }

    //insert new Product
    //http://localhost:8080/products
    public function create()
    {
        $model = new ProductModel();
        $data = [
            'name' => $this -> request -> getVar('name'),
            'category' => $this -> request -> getVar('category'),
            'price' => $this -> request -> getVar('price'),
            'tags' => $this -> request -> getVar('tags')
        ];
        $model -> insert($data);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => 'Product created successfully'
        ];
        return $this -> respond($response);
        //if this xampp. you shoud 'return $this -> responseCreated($response);'
    }
    //update product
    //http://localhost:8080/products/
    public function update($id = null){
        $model = new ProductModel();
        $data = [
            'name' => $this -> request -> getVar('name'),
            'category' => $this -> request -> getVar('category'),
            'price' => $this -> request -> getVar('price'),
            'tags' => $this -> request -> getVar('tags')
        ];
        //$model -> where('_id', $id) -> set($data) -> update(); (เวอร์ชั่นเต็ม)
        $model -> update($id, $data);   //(เวอร์ชั่นย่อ)
        $response = [
            'status' => 201,
            'error' => null,
            'message' => 'Product updated successfully'
        ];
        return $this -> respond($response);
    }

    //delete product
    //http://localhost:8080/products/
    public function delete($id = null){
        $model = new ProductModel();
        //$data = $model -> where('_id', $id) -> delete($id);
        $data = $model -> find($id);
        if($data){
            $model -> delete($id);
            $response = [
                'status' => 201,
                'error' => null,
                'message' => [
                    'success' => 'Product successfully deleted'
                ]
            ];
                return $this -> respond($response);
        }
        else{
            return $this -> failNotFound('No product found');
        }
    }
}