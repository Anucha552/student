<?php
// ส่วนจัดการ Model ต่างๆ สำหรับจัดการข้อมูลที่เกี่ยวข้องกับนักเรียน
class Students
{

    // ฟังก์ชันสำหรับบันทึกข้อมูลนักเรียน
    public function save($data)
    {
        // อ่านข้อมูล JSON จากไฟล์
        $jsonFile = __DIR__ . '/data/student.json'; // กำหนดเส้นทางไฟล์ JSON
        $jsonStr = file_get_contents($jsonFile); // อ่านไฟล์ JSON
        $dataJson = json_decode($jsonStr, true); // แปลง JSON เป็นอาร์เรย์
        
        // บันทึกรูปภาพนักเรียน
        $file = $_FILES['image']; // ดึงข้อมูลไฟล์รูปภาพจากฟอร์ม
        $targetFile = __DIR__ . '/../../public/images/' . basename($file['name']); // กำหนดเส้นทางที่จะบันทึกรูปภาพ
        $saveFile = move_uploaded_file($file['tmp_name'], $targetFile); // ย้ายไฟล์รูปภาพไปยังเส้นทางที่กำหนด   
        if (!$saveFile) {
            die("ไม่สามารถบันทึกรูปภาพได้");
        }

        // เพิ่ม id ใหม่ให้กับนักเรียน
        if (!empty($dataJson)) {
            $lastStudent = end($dataJson); // ดึงข้อมูลนักเรียนคนสุดท้ายในอาร์เรย์
            $lastID = $lastStudent['id'] + 1; // เพิ่ม id ขึ้นทีละ 1
        } else {
            $lastID = 1; // ถ้าไม่มีข้อมูลนักเรียน ให้เริ่มต้น id ที่ 1
            $dataJson = []; // กำหนดค่าเริ่มต้นเป็นอาร์เรย์ว่างๆ
        }

        // ตรวจสอบและจัดการกับค่า email
        if (empty($data['email'])) {
            $email = "-"; // ถ้า email ว่าง ให้กำหนดค่าเป็น -
        } else {
            $email = $data['email']; // ถ้า email ไม่ว่าง ให้ใช้ค่าที่ส่งมา
        }

        // สร้างอาร์เรย์สำหรับเก็บข้อมูลนักเรียนใหม่         
        $data_studend = [
            "id" => $lastID,
            "title" => $data['title'] ?? '',
            "fname" => $data['fname'] ?? '',
            "lname" => $data['lname'] ?? '',
            "nickname" => $data['nickname'] ?? '',
            "date-of-birth" => $data['date-of-birth'] ?? '',
            "gender" => $data['gender'] ?? '',
            "nationality" => $data['nationality'] ?? '',
            "religion" => $data['religion'] ?? '',
            "id-card-number" => $data['id-card-number'] ?? '',
            "image" => '/public/images/' . basename($file['name']) ?? '', 
            "address" => $data['address'] ?? '',
            "phone-number" => $data['phone-number'] ?? '',
            "email" => $email,
            "guardian" => $data['guardian'] ?? '',
            "guardian-phone-number" => $data['guardian-phone-number'] ?? '',
            "class" => $data['class'] ?? '',
            "classroom" => $data['alassroom'] ?? '',
            "academic-year" => $data['academic-year'] ?? '',
            "room-number" => $data['room-number'] ?? '',
            "status" => "กำลังศึกษา",
            "created_at" => date('Y-m-d'), // บันทึกวันที่และเวลาปัจจุบัน
        ];

        // เพิ่มข้อมูลนักเรียนใหม่เข้าไปในไฟล์ JSON
        array_push($dataJson, $data_studend); // เพิ่มข้อมูลนักเรียนใหม่เข้าไปในอาร์เรย์
        $studantJson = json_encode($dataJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // แปลงข้อมูลนักเรียนใหม่เป็น JSON
        $result = file_put_contents($jsonFile, $studantJson); // เขียนข้อมูล JSON กลับไปยังไฟล์

        // ตรวจสอบว่าการเขียนข้อมูลสำเร็จหรือไม่
        if ($result !== false) {
            return true; // ถ้าสำเร็จ คืนค่า true
        } else {
            return false; // ถ้าไม่สำเร็จ คืนค่า false
        }
    }

    // ฟังก์ชันสำหรับดึงข้อมูลนักเรียนทั้งหมด
    public function getAllStudents() {
        $jsonFile = __DIR__ . '/data/student.json'; // กำหนดเส้นทางไฟล์ JSON
        if (!file_exists($jsonFile)) {
            return []; // ถ้าไฟล์ไม่พบ ให้คืนค่าอาร์เรย์ว่าง
        }

        $jsonStr = file_get_contents($jsonFile); // อ่านไฟล์ JSON
        $dataJson = json_decode($jsonStr, true); // แปลง JSON เป็นอาร์เรย์

        return $dataJson ?: []; // คืนค่าอาร์เรย์ข้อมูลนักเรียน หรืออาร์เรย์ว่างถ้าไม่มีข้อมูล
    }

    // ฟังก์ชันสำหรับอัพเดทข้อมูลนักเรียน
    public function update($id, $data) {
        $jsonFile = __DIR__ . '/data/student.json'; // กำหนดเส้นทางไฟล์ JSON
        if (!file_exists($jsonFile)) {
            return false; // ถ้าไฟล์ไม่พบ ให้คืนค่า false
        }

        $jsonStr = file_get_contents($jsonFile); // อ่านไฟล์ JSON
        $dataJson = json_decode($jsonStr, true); // แปลง JSON เป็นอาร์เรย์

        // ค้นหานักเรียนตาม ID และอัพเดทข้อมูล
        foreach ($dataJson as &$student) { // ใช้ & เพื่อให้สามารถแก้ไขข้อมูลในอาร์เรย์ต้นฉบับได้
            if ($student['id'] == $id) {

                // อัพเดทข้อมูลนักเรียน
                foreach ($data as $key => $value) {
                    if (array_key_exists($key, $student)) { // ตรวจสอบว่าคีย์มีอยู่ในข้อมูลนักเรียนหรือไม่
                        if ($key !== 'image') { // ข้ามการอัพเดทคีย์ 'image' ในส่วนนี้
                            $student[$key] = $value; // อัพเดทค่าของคีย์ที่มีอยู่
                        }
                    }
                }

                // บันทึกรูปภาพนักเรียนถ้ามีการอัพโหลดใหม่
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $file = $_FILES['image']; // ดึงข้อมูลไฟล์รูปภาพจากฟอร์ม
                    $targetFile = __DIR__ . '/../../public/images/' . basename($file['name']); // กำหนดเส้นทางที่จะบันทึกรูปภาพ
                    $removeFile = __DIR__ . '/../../' . ltrim($student['image'], '/'); // กำหนดเส้นทางไฟล์รูปภาพเก่า
                    if (file_exists($removeFile)) { // ตรวจสอบว่าไฟล์รูปภาพเก่ามีอยู่หรือไม่
                        unlink($removeFile); // ลบไฟล์รูปภาพเก่า
                    } else {
                        return false; // ถ้าไฟล์รูปภาพเก่าไม่พบ ให้คืนค่า false
                    }
                    $saveFile = move_uploaded_file($file['tmp_name'], $targetFile); // ย้ายไฟล์รูปภาพไปยังเส้นทางที่กำหนด   
                    if ($saveFile) {
                        $student['image'] = '/public/images/' . basename($file['name']); // อัพเดทเส้นทางรูปภาพในข้อมูลนักเรียน
                    }
                }

                break; // ออกจากลูปเมื่อพบและอัพเดทข้อมูลแล้ว
            }
        }

        unset($student); // ป้องกันการอ้างอิงที่ไม่จำเป็น

        $studantJson = json_encode($dataJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // แปลงข้อมูลนักเรียนใหม่เป็น JSON
        $result = file_put_contents($jsonFile, $studantJson); // เขียนข้อมูล JSON กลับไปยังไฟล์
        return $result !== false; // คืนค่า true ถ้าการเขียนข้อมูลสำเร็จ หรือ false ถ้าไม่สำเร็จ
    }
}
