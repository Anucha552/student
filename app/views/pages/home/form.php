<!DOCTYPE html>
<html lang="th-en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/form.css">
    <link rel="stylesheet" href="/public/css/custom.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body class="bg-custom">
    <!-- Navber -->
    <?php include_once __DIR__ . '/../../partials/Navbar.php'; ?>

    <!-- Main Content -->
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-body shadow-sm box-form">
                    <h3 class="p-4 text-title bg-primary rounded-top text-white">Form Student</h3>
                    <div class="p-4 pt-0 rounded">
                        <!-- Form -->
                        <form id="form-student" method="post" enctype="multipart/form-data">

                            <h5 class="text-title py-3 m-0">ข้อมูลส่วนตัว</h5>

                            <!-- คำนำหน้า -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">คำนำหน้า <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="title" id="title" aria-label="Default select example">
                                        <option selected>-- เลือกคำนำหน้า --</option>
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ชื่อ -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">ชื่อ <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="fname" id="fname">
                                </div>
                            </div>

                            <!-- นามสกุล -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">นามสกุล <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="lname" id="lname">
                                </div>
                            </div>

                            <!-- ชื่อเล่น -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">ชื่อเล่น <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nickname" id="nickname">
                                </div>
                            </div>

                            <!-- วัน/เดือน/ปีเกิด -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">วัน/เดือน/ปีเกิด <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" name="date-of-birth" id="date-of-birth">
                                </div>
                            </div>

                            <!-- เพศ -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">เพศ <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-inline-block pe-4">
                                        <input type="radio" class="form-check-input" name="gender" id="man" value="ชาย">
                                        <label for="man" class="form-check-label">ชาย</label>
                                    </div>
                                    <div class="d-inline-block pe-4">
                                        <input type="radio" class="form-check-input" name="gender" id="female" value="หญิง">
                                        <label for="female" class="form-check-label">หญิง</label>
                                    </div>
                                    <div class="d-inline-block pe-4">
                                        <input type="radio" class="form-check-input" name="gender" id="choice" value="ทางเลือก">
                                        <label for="choice" class="form-check-label">ทางเลือก</label>
                                    </div>
                                </div>
                            </div>

                            <!-- สัญชาติ -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">สัญชาติ <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nationality" id="nationality">
                                </div>
                            </div>

                            <!-- ศาสนา -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">ศาสนา <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="religion" id="religion">
                                </div>
                            </div>

                            <!-- เลขประจำตัวประชาชน -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">เลขประจำตัวประชาชน <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="id-card-number" id="id-card-number">
                                </div>
                            </div>

                            <!-- รูปภาพประจำตัวนักเรียน -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">รูปภาพประจำตัวนักเรียน <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                </div>
                            </div>

                            <!-- Preview Image -->
                            <div class="md-3 d-flex justify-content-center py-2 border-box-img">
                                <div id="no-image" style="background-color: #bdbdbd; width: 200px; height: 200px; display: flex; align-items: center; justify-content: center;">
                                    <div class="text-center text-white">No Image</div>
                                </div>
                                <img src="" alt="Imge" id="preview-image" class="img-fluid d-none" style="max-width: 200px; max-height: 200px;">
                            </div>

                            <hr>

                            <h5 class="text-title py-3 m-0">ข้อมูลติดต่อ</h5>

                            <!-- ที่อยู่ปัจจุบัน -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">ที่อยู่ปัจจุบัน <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                                </div>
                            </div>

                            <!-- เบอร์โทรศัพท์ -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">เบอร์โทรศัพท์ <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="number" name="phone-number" id="phone-number">
                                </div>
                            </div>

                            <!-- อีเมล -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">อีเมล </span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="email" name="email" id="email">
                                </div>
                            </div>

                            <!-- ผู้ปกครอง -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">ผู้ปกครอง <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="guardian" id="guardian">
                                </div>
                            </div>

                            <!-- เบอร์โทรผู้ปกครอง -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">เบอร์โทรผู้ปกครอง <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="number" name="guardian-phone-number" id="guardian-phone-number">
                                </div>
                            </div>

                            <hr>

                            <h5 class="text-title py-3 m-0">ข้อมูลการศึกษาปัจจุบัน</h5>

                            <!-- ระดับชั้น -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">ระดับชั้น <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="class" id="class" class="form-control">
                                </div>
                            </div>

                            <!-- ห้องเรียน -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">ห้องเรียน <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="alassroom" id="alassroom" class="form-control">
                                </div>
                            </div>

                            <!-- ปีการศึกษา -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">ปีการศึกษา <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" name="academic-year" id="academic-year" class="form-control">
                                </div>
                            </div>

                            <!-- หมายเลขประจำห้อง -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h-100 d-flex align-items-center">
                                        <span class="text-form">หมายเลขประจำห้อง <span class="text-danger">*</span></span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" name="room-number" id="room-number" class="form-control">
                                </div>
                            </div>

                            <hr>

                            <!-- บันทึกข้อมูล และ ล้างข้อมูลในฟแร์มทั้งหมด -->
                            <div class="box-button text-center pt-2">
                                <button type="submit" class="btn btn-primary me-3">บันทึกข้อมูล</button>
                                <button type="reset" id="reset" class="btn btn-secondary">ล้างข้อมูล</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successAlert" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">บันทึกข้อมูล</h5>
                    <button type="button" id="dismiss1" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                </div>
                <div class="modal-body">
                    <span id="textAlert"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" id="dismiss2" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <?php include_once __DIR__ . '/../../partials/Footer.php'; ?>

    <script src="/public/js/form.js"></script>
</body>

</html>