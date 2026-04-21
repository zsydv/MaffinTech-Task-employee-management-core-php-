<?php

class Employee {
    private $conn;
    private $table = "employees";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
    $stmt = $this->conn->prepare("
        INSERT INTO {$this->table}
        (first_name, last_name, email, phone, position, salary)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $data['first_name'],
        $data['last_name'],
        $data['email'],
        $data['phone'],
        $data['position'],
        $data['salary']
    ]);
    }

    public function find($id) {
    $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
    $stmt = $this->conn->prepare("
        UPDATE {$this->table}
        SET first_name=?, last_name=?, email=?, phone=?, position=?, salary=?
        WHERE id=?
    ");

    return $stmt->execute([
        $data['first_name'],
        $data['last_name'],
        $data['email'],
        $data['phone'],
        $data['position'],
        $data['salary'],
        $id
    ]);
    }

    public function delete($id) {
    $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
    return $stmt->execute([$id]);
    }

    public function search($term) {
    $stmt = $this->conn->prepare("
        SELECT * FROM {$this->table}
        WHERE first_name LIKE ? OR email LIKE ?
        ORDER BY id DESC
    ");

    $like = "%$term%";
    $stmt->execute([$like, $like]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function paginate($limit, $offset) {
    $stmt = $this->conn->prepare("
        SELECT * FROM {$this->table}
        ORDER BY id DESC
        LIMIT ? OFFSET ?
    ");

    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count() {
    $stmt = $this->conn->query("SELECT COUNT(*) as total FROM {$this->table}");
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}