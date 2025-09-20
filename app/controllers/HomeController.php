<?php

require_once __DIR__ . '/../models/ManageSudent.php';

class HomeController{

    // ฟังก์ชันสำหรับจัดการหน้า form
    public function form(){
        $actionHome = ['action', ''];
        require_once __DIR__ . '/../views/pages/home/form.php';
    }

    // ฟังก์ชันสำหรับจัดการหน้า data
    public function data(){
        $actionHome = ['', 'action'];
        require_once __DIR__ . '/../views/pages/home/data.php';
    }

    // ฟังก์ชันสำหรับจัดการหน้า API Save Student
    public function APIStudent(){
        $student = new Students(); // สร้างอ็อบเจกต์ของคลาส Student

        // ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
        if (isset($_POST['form']) && $_POST['form'] == 'form-student') {

            $result = $student->save($_POST); // เรียกใช้ฟังก์ชัน save ของคลาส Students เพื่อบันทึกข้อมูลนักเรียน
            
            // response ที่จะส่งกลับไปยังผู้ใช้เพื่อแจ้งผลการบันทึกข้อมูล
            if ($result === true) {
                $response = [
                    "status" => "success", // สถานะการบันทึกข้อมูล
                    "message" => "บันทึกข้อมูลนักเรียนสำเร็จ", // ข้อความแจ้งเตือนเมื่อบันทึกข้อมูลสำเร็จ
                ];
            } else {
                $response = [
                    "status" => "error", // สถานะการบันทึกข้อมูล
                    "message" => "ไม่สามารถบันทึกข้อมูลนักเรียนได้", // ข้อความแจ้งเตือนเมื่อบันทึกข้อมูลไม่สำเร็จ
                ];
            }

        } else {
            http_response_code(400); // กำหนด HTTP Response Code เป็น 400
            return;
        }

        http_response_code(200); // กำหนด HTTP Response Code เป็น 200
        header('Content-Type: application/json; charset=UTF-8'); // กำหนด Content-Type เป็น JSON ตอนส่องข้อมูลกลับไปยังผู้ใช้
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // แปลงข้อมูลเป็น JSON และส่งกลับไปยังผู้ใช้
    }

    // ฟังก์ชันสำหรับจัดการหน้า API Get Student
    public function APIGetstudent(){
        $student = new Students();  // สร้างอ็อบเจกต์ของคลาส Student
        
        // ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ID = $_GET['id'] ?? null; // ดึงค่า ID จากพารามิเตอร์ URL
            $ID_Student = false; // ตัวแปรสำหรับตรวจสอบว่าพบ ID นักเรียนหรือไม่
            $one_student = []; // ตัวแปรสำหรับเก็บข้อมูลนักเรียนที่พบ
            
            // ตรวจสอบว่ามีการส่ง ID และเป็นตัวเลขหรือไม่
            if ($ID === null || !is_numeric($ID)) {
                http_response_code(400); // กำหนด HTTP Response Code เป็น 400
                return;
            }

            // ส่งข้อมูลนักเรียนกลับไปยังผู้ใช้ตาม ID ที่ส่งมา
            foreach ($student->getAllStudents() as $stud) {
                if ($stud['id'] == $ID) {
                    $ID_Student = true; // ถ้าพบ ID นักเรียนที่ตรงกัน ให้ตั้งค่าเป็น true
                    $one_student = $stud; // เก็บข้อมูลนักเรียนที่พบ
                    break; 

                }
            }

            // ส่งข้อมูลนักเรียนถ้ามี ID ที่ตรงกัน ถ้าไม่พบข้อมูลนักเรรียนส่ง Not Found
            if ($ID_Student) {
                //http_response_code(200); // กำหนด HTTP Response Code เป็น 200
                header('Content-Type: application/json; charset=UTF-8'); // กำหนด Content-Type เป็น JSON ตอนส่องข้อมูลกลับไปยังผู้ใช้
                echo json_encode($one_student, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // แปลงข้อมูลเป็น JSON และส่งกลับไปยังผู้ใช้
                return;
            } else {
                http_response_code(404); // กำหนด HTTP Response Code เป็น 404
                header('Content-Type: application/json; charset=UTF-8'); // กำหนด Content-Type เป็น JSON ตอนส่องข้อมูลกลับไปยังผู้ใช้
                echo json_encode(['status' => 'unsuccessful', 'message' => 'Not Found'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // ส่งข้อความ Not Found กลับไปยังผู้ใช้
                return;
            }
        }
    }

    // ฟังก์ชันสำหรับจัดการหน้า API Update Student
    public function APIUpdatestudent(){
        $student = new Students(); // สร้างอ็อบเจกต์ของคลาส Student

        // ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form']) && $_POST['form'] == 'data-student-show-edit') {
            $id = $_POST['id'] ?? null; // ดึงค่า ID จากข้อมูลที่ส่งมา
            
            // ตรวจสอบว่ามีการส่ง ID และเป็นตัวเลขหรือไม่
            if ($id === null || !is_numeric($id)) {
                http_response_code(400); // กำหนด HTTP Response Code เป็น 400
                return;
            }

            $result = $student->update($id, $_POST); // เรียกใช้ฟังก์ชัน update ของคลาส Students เพื่ออัพเดทข้อมูลนักเรียน
            
            // response ที่จะส่งกลับไปยังผู้ใช้เพื่อแจ้งผลการอัพเดทข้อมูล
            if ($result === true) {
                $response = [
                    "status" => "success", // สถานะการอัพเดทข้อมูล
                    "message" => "อัพเดทข้อมูลนักเรียนสำเร็จ", // ข้อความแจ้งเตือนเมื่ออัพเดทข้อมูลสำเร็จ
                ];
            } else {
                $response = [
                    "status" => "error", // สถานะการอัพเดทข้อมูล
                    "message" => "ไม่สามารถอัพเดทข้อมูลนักเรียนได้", // ข้อความแจ้งเตือนเมื่ออัพเดทข้อมูลไม่สำเร็จ
                ];
            }

            http_response_code(200); // กำหนด HTTP Response Code เป็น 200
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // แปลงข้อมูลเป็น JSON และส่งกลับไปยังผู้ใช้

        } else {
            http_response_code(400); // กำหนด HTTP Response Code เป็น 400
            return;
        }
    }
}

?>