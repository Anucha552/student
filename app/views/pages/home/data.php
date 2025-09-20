<!DOCTYPE html>
<html lang="th-en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/custom.css">
    <link rel="stylesheet" href="/public/css/data.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>

<body class="bg-custom">
    <!-- Navber -->
    <?php include_once __DIR__ . '/../../partials/Navbar.php'; ?>

    <!-- Main Content -->
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-body shadow-sm box-form">
                    <div class="p-4 bg-primary rounded-top text-white">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="text-title" style="margin: 0;">Data Student</h3>
                            </div>
                            <div class="col-lg-6">
                                <form action="/data" method="get">
                                    <div class="row g-1">
                                        <div class="col-7">
                                            <input type="search" class="form-control" name="search" id="search">
                                        </div>
                                        <div class="col-3">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-info text-white" data-bs-toggle='tooltip' data-bs-placement='top' title='ค้นหานักเรียน'>ค้นหา</button>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="d-grid">
                                                <a href="/data" class="btn btn-danger" data-bs-toggle='tooltip' data-bs-placement='top' title='Refest Titble นักเรียน'><i class="bi bi-arrow-clockwise"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="pt-0 rounded">
                        <!-- รายชื่อข้อมูลนักเรียน -->
                        <div class="table-responsive-lg">
                            <table class="table table-bordered table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col" class="text-center">ลำดับ</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">ปีการศึกษา</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-student">
                                    <?php

                                    // อ่านข้อมูล JSON จากไฟล์
                                    $jsonFile = __DIR__ . '/../../../models/data/student.json'; // กำหนดเส้นทางไฟล์ JSON
                                    $jsonStr = file_get_contents($jsonFile); // อ่านไฟล์ JSON
                                    $dataJson = json_decode($jsonStr, true); // แปลง JSON เป็นอาร์เรย์
                                    $number = 1; // ตัวแปรสำหรับเก็บลำดับ 

                                    // ตรวจสอบการค้นหานักเรียน
                                    if (isset($_GET['search'])) {
                                        $search = $_GET['search'] ?? ''; // ดึงค่าค้นหาที่ส่งมา
                                        $data = []; // กำหนด data ที่จะค้นหา

                                        foreach ($dataJson as $std) {
                                            $nameNoTitle = $std['fname'] . ' ' . $std['lname']; // กำหนดชื่อเต็มแต่ไม่คำนำหน้าชื่อ
                                            $nameTitle = $std['title'] . ' ' . $std['fname'] . ' ' . $std['lname']; // กำหนดชื่อเต็ม

                                            // ค้นหาปีการศึกษา
                                            if ($std['academic-year'] === $search) {
                                                array_push($data, $std); // เพิ่มนักเรียนเข้าไปใน Array Data
                                            }

                                            // ค้นหาสถานะนักเรียน
                                            if ($std['status'] === $search) {
                                                array_push($data, $std); // เพิ่มนักเรียนเข้าไปใน Array Data
                                            }

                                            // ค้นหาตามชื่อจริงนักเรียน
                                            if ($std['fname'] === $search) {
                                                array_push($data, $std); // เพิ่มนักเรียนเข้าไปใน Array Data
                                            }

                                            // ค้นหาตามนามสกุลนักเรียน
                                            if ($std['lname'] === $search) {
                                                array_push($data, $std); // เพิ่มนักเรียนเข้าไปใน Array Data
                                            }

                                            // ค้นหาชื่อเต็มแต่ไม่คำนำหน้าชื่อ
                                            if ($nameNoTitle === $search) {
                                                array_push($data, $std); // เพิ่มนักเรียนเข้าไปใน Array Data
                                            }

                                            // ค้นหาชื่อเต็ม
                                            if ($nameTitle === $search) {
                                                array_push($data, $std); // เพิ่มนักเรียนเข้าไปใน Array Data
                                            }
                                        }

                                        $dataJson = $data; // ส่งนักเรียนที่หาเจอไปแสดงต่อ
                                    }

                                    if (!empty($dataJson)) {
                                        foreach ($dataJson as $student) {
                                            echo "<tr>";
                                            echo "<td class='text-center align-middle'>" . $number . "</td>";
                                            echo "<td class='align-middle'>" . htmlspecialchars($student['title'] . ' ' . $student['fname'] . ' ' . $student['lname']) . "</td>";
                                            echo "<td class='align-middle'>" . htmlspecialchars($student['academic-year']) . "</td>";
                                            echo "<td class='align-middle'>" . htmlspecialchars($student['status']) . "</td>";
                                            echo "<td class='text-center align-middle'>
                                                    <div class='d-flex flex-column flex-sm-row gap-2 justify-content-center'>
                                                        <button type='button' class='btn btn-info btn-sm view' data-bs-toggle='tooltip' data-bs-placement='top' title='ดูข้อมูลนักเรียน' data-userId='" . htmlentities($student['id']) . "'>
                                                            <i class='bi bi-eye'></i>
                                                        </button>
                                                        <button type='button' class='btn btn-primary btn-sm edit' data-bs-toggle='tooltip' data-bs-placement='top' title='แก้ไขข้อมูลนักเรียน' data-userId='" . htmlentities($student['id']) . "'>
                                                            <i class='bi bi-pencil'></i>
                                                        </button>
                                                    </div>
                                                </td>";
                                            echo "</tr>";

                                            $number++; // เพิ่มลำดับ
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center py-5'>ไม่มีข้อมูลนักเรียน</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal View Student -->
    <div class="modal fade" id="viewStudentModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStudentModalLabel">ข้อมูลนักเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <!-- Nav pills Student To Data And Json -->
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#data">Data</a>
                        </li>
                        <li class="nav-item ms-3">
                            <a class="nav-link" data-bs-toggle="pill" href="#json">Json</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <hr class="mt-3 mb-0">
                    <div class="tab-content">
                        <div id="data" class="container tab-pane active" style="padding: 15px">
                            <div class="content-data" id="data-student-show"></div>
                        </div>
                        <div id="json" class="container tab-pane fade">
                            <div class="content-json">
                                <pre class="mt-4" id="textJson"></pre>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type='button' class='btn btn-warning text-white export'>Export To PDF</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Student -->
    <div class="modal fade" id="editStudentModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">แก้ไขข้อมูลนักเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="content-data" id="data-student-show-edit" style="padding: 15px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveChanges">บันทึกการเปลี่ยนแปลง</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Alert -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <!-- Success -->
        <div class="toast bg-success text-white fade" role="alert" aria-live="assertive" aria-atomic="true" id="toastAlert">
            <div class="toast-header">
                <strong class="me-auto header-alert">Alert</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="text-alert">
                Hello, world! This is a toast message.
            </div>
        </div>
        <!-- Error -->
        <div class="toast bg-danger text-white fade" role="alert" aria-live="assertive" aria-atomic="true" id="toastAlertError">
            <div class="toast-header">
                <strong class="me-auto header-alert">Alert</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="text-alert-error">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11"></div>
    
    <!-- Footer -->
    <?php include_once __DIR__ . '/../../partials/Footer.php'; ?>

    <script src="/public/js/data.js"></script>
</body>

</html>