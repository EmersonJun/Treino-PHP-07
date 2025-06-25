    <?php
    session_start();

    require_once 'config/Banco.php';
    require_once 'models/Model.php';

    // Auto load de todos os models e controllers
    foreach (glob("models/*.php") as $filename) require_once $filename;
    foreach (glob("controller/*.php") as $filename) require_once $filename;

    $page = $_GET['page'] ?? 'login';
    $action = $_GET['action'] ?? 'index';

    switch ($page) {
        case 'login':
            $controller = new AuthController();
            break;
        case 'logout':
            session_destroy();
            header("Location: index.php?page=login");
        exit;
        default:
            echo "Página não encontrada.";
        exit;
    }

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Ação não encontrada.";
    }
