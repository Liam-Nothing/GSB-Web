<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;


class User extends ResourceController
{
    use ResponseTrait;

    // all users
    public function index(){
      $model = new UserModel();
      $data['users'] = $model->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }

    // create
    public function create() {
        $model = new UserModel();
        $data = [
            'first_name' => $this->request->getVar('first_name'),
            'email'  => $this->request->getVar('email'),
        ];
        $model->insert($data);
        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'User created successfully'
          ]
      ];
      return $this->respondCreated($response);
    }

    // single user
    public function show($id = null){
        $model = new UserModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No user found');
        }
    }

    // update
    public function update($id = null){
        $model = new UserModel();
        $id = $this->request->getVar('id');
        $data = [
            'first_name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $model->update($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'User updated successfully'
          ]
      ];
      return $this->respond($response);
    }

    // delete
    public function delete($id = null){
        $model = new UserModel();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'User successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No user found');
        }
    }

}