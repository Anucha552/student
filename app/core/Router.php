<?php

// ส่วนจัดการ Router
// โค้ดนี้คือคลาส Router ที่ใช้สำหรับจัดการเส้นทาง URL Routing ของเว็บแอปพลิเคชัน 
// โดยจับคู่ URL กับ Controller และ Method ที่จะเรียกใช้งาน จากนั้นเรียกใช้ 
// Controller นั้น ๆ ตามคำขอของผู้ใช้

// Class Router สำหรับจัดการเส้นทางการเข้าถึง หรือ เส้นทาง URL
class Router{

    // property $routes เป็นอาร์เรย์เก็บข้อมูลเส้นทาง ที่แม็ป URL กับ Controller@Method
    private $routes = []; 

    // method add() รับพารามิเตอร์สามตัว $route $action และ $methods 
    // เพื่อจัดเก็บข้อมูลนี้ลงใน porperty $routes ค่า default GET
    public function add($route, $action, $methods = 'GET') {

        // แปลง $methods ให้เป็น array เสมอ
        if (is_string($methods)) {
            $methods = [$methods];
        }

        $this->routes[$route] = [
            'action' => $action,
            'methods' => array_map('strtoupper', $methods) // method ให้เป็นตัวพิมพ์ใหญ่
        ];
    }

    // method dispatch() รับ URL ที่ผู้ใช้กรอกเข้ามาเพื่อส่งต่อไปยัง Controller และ Method ที่กำหนด
    public function dispatch($url) {

        // ถ้า URL ไม่ใช่ root หรือ / จะตัดเครื่องหมาย / URL ด้านท้ายออก
        if ($url != '/') {
            $url = '/' . rtrim($url, '/'); 
        }

        // เช็คว่า URL ที่กรอกเข้ามามีอยู่ใน property $routes หรือไม่
        if (!isset($this->routes[$url])) {
            http_response_code(404);
            require_once __DIR__ . '/../../public/errors/404.php';
            return;
        }

        // ดึงค่า HTTP Method ของคำขอปัจจุบัน
        // และ นำข้อมูลเส้นทางที่ตรงกับ URL ที่ร้องขอมาเก็บไว้ในตัวแปร $route
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $route = $this->routes[$url];

        // ตรวจสอบว่า HTTP Method ตรงกับที่กำหนดไหม
        if (!in_array($requestMethod, $route['methods'])) {
            http_response_code(405); 
            header('Allow: ' . implode(', ', $route['methods'])); // กำหนด Allow Header ให้กับ HTTP Response
            require_once __DIR__ . '/../../public/errors/405.php';
            return;
        }

        // ดึงชื่อ Controller กับชื่อ Method จากค่าที่เก็บใน property $routes มาเก็บไว้ในตัวแปร
        // $controllerName และ $method และกำหนดเส้นทางไฟล์ไปที่โฟลเดอร์ controllers 
        list($controllerName, $method) = explode('@', $route['action']);
        $controllerFile = __DIR__ . "/../controllers/{$controllerName}.php";        

        // ตรวจสอบว่าไฟล์ Controller มีจริงหรือไม่
        if (!file_exists($controllerFile)) {
            echo "Controller file not found!";
            return;
        }

        // โหลดไฟล์ใน Controller เข้ามา และสร้าง object ตามชื่อคลาส Controler
        require_once $controllerFile;
        $controller = new $controllerName; 

        // ตรวจสอบว่า Controller ที่สร้างขึ้นมี Method ที่ต้องการเรียกหรือไม่
        if (!method_exists($controller, $method)) {
            echo "Method Controler not found!";
            return;
        }

        // เรียก method ของ controler
        $controller->$method();
    }
}

?>