<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function index()
    {
        $csrf_token = csrf_token();

        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
        . view('news/index')
        . view('templates/footer');
        }

    public function show($slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view');
    }

    public function new()
    {
        helper('form');

        return view('news/create', ['title' => 'Create a news item']);
    }

    public function create()
    {
        helper('form');
        
        // Retrieve form data
        $data = $this->request->getPost(['title', 'body']);
        
        // Validate form data
        if (! $this->validateData($data, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // Validation failed
            $errors = $this->validator->getErrors();
            return $this->response->setJSON(['status' => 'error', 'errors' => $errors]);
        }
        
        // Validation passed, insert data
        $post = $this->validator->getValidated();
        $model = model(NewsModel::class);
        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);
        
        // Return success response
        return $this->response->setJSON(['status' => 'success']);
    }

    
}