<?php

require_once "../core/Database.php";
require_once "../controllers/EmployeeController.php";

$db = (new Database())->connect();
$controller = new EmployeeController($db);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function render(string $view, array $data = []): void {
    extract($data);
    include "../views/layout/header.php";
    include "../views/{$view}.php";
    include "../views/layout/footer.php";
}

if ($uri === '/' || $uri === '/employee-system/public/') {
    $page   = $_GET['page']   ?? 1;
    $search = $_GET['search'] ?? '';

    if (!empty($search)) {
        $employees  = $controller->search($search);
        $totalPages = 1;
    } else {
        $result     = $controller->paginate($page);
        $employees  = $result['data'];
        $totalPages = ceil($result['total'] / $result['limit']);
    }

    render('employees/index', compact('employees', 'totalPages'));
}
elseif ($uri === '/create') {
    render('employees/create');
}
elseif ($uri === '/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST);
    header("Location: /");
    exit;
}
elseif ($uri === '/edit') {
    $employee = $controller->edit($_GET['id']);
    render('employees/edit', compact('employee'));
}
elseif ($uri === '/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($_POST['id'], $_POST);
    header("Location: /");
    exit;
}
elseif ($uri === '/delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->delete($_POST['id']);
    header("Location: /");
    exit;
}
elseif ($uri === '/search' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $term    = $_GET['q'] ?? '';
    $results = $controller->search($term);
    header('Content-Type: application/json');
    echo json_encode($results);
    exit;
}
else {
    render('errors/404');
}
?>