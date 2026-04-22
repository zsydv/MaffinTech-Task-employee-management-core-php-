<?php

require_once "../models/Employee.php";

class EmployeeController {
    private $model;

    public function __construct($db) {
        $this->model = new Employee($db);
    }

    public function index() {
        return $this->model->getAll();
    }

    public function store($data) {

    if (empty($data['first_name']) || empty($data['last_name'])) {
        die("Ad və soyad boş ola bilməz");
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        die("Email düzgün deyil");
    }

    if (!is_numeric($data['salary'])) {
        die("Maaş rəqəm olmalıdır");
    }

    return $this->model->create($data);
    }

    public function edit($id) {
    return $this->model->find($id);
    }

    public function update($id, $data) {
    if (empty($data['first_name']) || empty($data['last_name'])) {
        die("Ad və soyad boş ola bilməz");
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        die("Email düzgün deyil");
    }

    if (!is_numeric($data['salary'])) {
        die("Maaş rəqəm olmalıdır");
    }

    return $this->model->update($id, $data);
    }

    public function delete($id) {
    return $this->model->delete($id);
    }

    public function search($term) {
    return $this->model->search($term);
    }

    public function paginate($page) {
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = $this->model->paginate($limit, $offset);
    $total = $this->model->count();

    return [
        'data' => $data,
        'total' => $total,
        'limit' => $limit
    ];
    }
}