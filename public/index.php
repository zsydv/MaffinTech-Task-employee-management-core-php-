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

function checkID($id) {
    return filter_var($id, FILTER_VALIDATE_INT) && $id > 0;
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
    $id = checkID($_GET['id'] ?? null) ? (int)$_GET['id'] : null;
    if (!$id) {
        render('errors/404');
        exit;
    }

    $employee = $controller->edit($id);
    if (!$employee) {
        render('errors/404');
        exit;
    }
    render('employees/edit', compact('employee'));
}
elseif ($uri === '/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = checkID($_POST['id'] ?? null) ? (int)$_POST['id'] : null;
    if (!$id) 
        { header("Location: /"); exit; }

    $controller->update($id, $_POST);
    header("Location: /");
    exit;
}

elseif ($uri === '/delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = checkID($_POST['id'] ?? null) ? (int)$_POST['id'] : null;
    if (!$id) 
        { header("Location: /"); exit; }

    $controller->delete($id);
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