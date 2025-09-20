<?php

// ส่วนจัดการ Patch URL หรือกำหนดเส้นทาง URL

require_once __DIR__ . '/app/core/Router.php';

// สร้าง อ็อบเจกต์ของ Router
$router = new Router();

// ตัวอย่างกำหนดเส้นทาง URL
// กำหนด route ที่รองรับ GET เท่านั้น
// $router->add('/', 'HomeController@homePage', 'GET');
// กำหนด route ที่รองรับ POST เท่านั้น
// $router->add('/submit', 'FormController@submitForm', 'POST');
// กำหนด route ที่รองรับทั้ง GET และ POST
// $router->add('/profile', 'UserController@profile', ['GET', 'POST']);
// กำหนดเส้นทาง URL ที่จะส่ง หรือ กำหนดเส้นทาง Route

// จัดการหน้า Page
$router->add('/', 'HomeController@form', 'GET');
$router->add('/data', 'HomeController@data', 'GET');

// จัดการ API
$router->add('/api/student', 'HomeController@APIStudent', 'POST');
$router->add('/api/getstudent', 'HomeController@APIGetstudent', 'GET');
$router->add('/api/updatestudent', 'HomeController@APIUpdatestudent', 'POST');

// ดึง URL ที่ผู้ใช้กรอกเข้ามา แล้วส่งไปให้ Router จัดการ
$url = $_GET['url'] ?? '/';
$router->dispatch(htmlspecialchars($url));

?>