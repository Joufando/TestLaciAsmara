<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email'
    ];

    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->paginate(10);
        $data['pager'] = $model->pager;

        return view('user_view', $data);
    }

    public function create()
    {
        $data = [];
        if (session()->getFlashdata('validation')) {
            $data['validation'] = session()->getFlashdata('validation');
            $data['old'] = session()->getFlashdata('old');
        }
        return view('user_create', $data);
    }

    public function store()
    {
        $model = new UserModel();

        if (!$this->validate($this->validationRules)) {
            // Validation failed, return with errors
            session()->setFlashdata('validation', $this->validator);
            session()->setFlashdata('old', $this->request->getPost());
            return redirect()->to('/user/create')->withInput();
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];
        $model->save($data);
        return redirect()->to('/user');
    }


    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('user_edit', $data);
    }

    public function update()
    {
        $model = new UserModel();
        $id = $this->request->getPost('id');

        if (!$this->validate($this->validationRules)) {
            // Validation failed, return with errors and old data
            session()->setFlashdata('validation', $this->validator);
            session()->setFlashdata('old', $this->request->getPost());
            return redirect()->to('/user/edit/' . $id)->withInput();
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];
        $model->update($id, $data);
        return redirect()->to('/user');
    }


    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/user');
    }
}
