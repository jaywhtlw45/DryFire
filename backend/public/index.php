<?php
// public/index.php - Main entry point

// Remove any existing headers first
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit(0);
}

// Basic routing
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$path = str_replace('/index.php', '', $path);
$method = $_SERVER['REQUEST_METHOD'];

// Remove leading slash
$path = ltrim($path, '/');
$segments = explode('/', $path);

// Basic API routes
switch ($segments[0]) {
    case 'api':
        handleApiRequest($segments, $method);
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
        break;
}


// function handleApiRequest($segments, $method){
//     // Remove 'api' from segments
//     array_shift($segments);
//     $resouce = $segments[0] ?? '';
//     $id = $segments[1] ?? null;
    
// }

function handleApiRequest($segments, $method) {
    // Remove 'api' from segments
    array_shift($segments);
    
    $resource = $segments[0] ?? '';
    $id = $segments[1] ?? null;
    
    switch ($resource) {
        case 'health':
            echo json_encode(['status' => 'ok', 'timestamp' => time()]);
            break;
        case 'users':
            handleUsersRequest($method, $id);
            break;
        case 'uploadFile':
            uploadFile($method);
            break;
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Resource not found']);
            break;
    }
}

function handleUsersRequest($method, $id) {
    switch ($method) {
        case 'GET':
            if ($id) {
                echo json_encode(['user' => ['id' => $id, 'name' => 'Sample User']]);
            } else {
                echo json_encode(['users' => [['id' => 1, 'name' => 'User 1']]]);
            }
            break;
        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            echo json_encode(['message' => 'User created', 'data' => $input]);
            break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
}

function uploadFile($method){
    switch($method){
        case 'POST':
            
    }
}

?>