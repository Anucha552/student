// window.onload เป็น Event Listener ที่จะทำงานเมื่อหน้าเว็บโหลดเสร็จ
window.onload = function () {

    // function แสดงข้อมูลนักเรียน
    function showStudentData(IDcontentDtata, data, target) {
        document.getElementById('data-student-show').innerHTML = ''; // เคลียร์ข้อมูลในตารางก่อนแสดงข้อมูลใหม่
        document.getElementById('data-student-show-edit').innerHTML = ''; // เคลียร์ข้อมูลในตารางก่อนแสดงข้อมูลใหม่
        let tableBody = `
                        <div class="row" id="content-student">
                            <div class="col-lg-8">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 45%;">รหัสนักเรียน</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">คำนำหน้า</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ชื่อ</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">นามสกุล</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ชื่อเล่น</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">วัน/เดือน/ปี เกิด</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">เพศ</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">สัญชาติ</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ศาสนา</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">เลขประจำตัวประชาชน</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ที่อยู่ปัจจุบัน</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">เบอร์โทรศัพท์</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">อีเมล</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ผู้ปกครอง</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">เบอร์โทรผู้ปกครอง</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ระดับชั้น</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ห้องเรียน</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ปีการศึกษา</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">หมายเลขประจำห้อง</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">สถานะ</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">วันที่เพิ่มนักเรียน</th>
                                            <td class="text-data-student">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4" id="img-show"></div>
                        </div>
                `;
        document.getElementById(IDcontentDtata).innerHTML = tableBody; // แสดงข้อมูลในตาราง
        const textDataStudent = document.querySelectorAll('.text-data-student'); // เลือกทุกองค์ประกอบที่มีคลาส .text-data-student

        if (target == 'view') {
            document.getElementById('img-show').innerHTML = '<img id="img-std" src="' + data.image + '" alt="" class="img-fluid" width="100%">'; // แสดงรูปภาพนักเรียน
        } else if (target == 'edit') {
            document.getElementById('img-show').innerHTML = '<input type="file" class="form-control" name="image" id="image" accept="image/*" style="margin-top: 8px; margin-bottom: 15px;"><img id="img-std" src="' + data.image + '" alt="" class="img-fluid" width="100%">';

            // แสดงรูปภาพที่เลือกในฟอร์มแก้ไขข้อมูลนักเรียน
            const image = document.getElementById('image');
            const imgStd = document.getElementById('img-std');
            image.addEventListener('change', function (event) {
                const file = event.target.files[0]; // ดึงไฟล์รูปภาพที่เลือก
                const neentadMB = 2; // กำหนดขนาดไฟล์สูงสุดที่อนุญาตเป็น 2 MB
                const KB = 1024;
                const MB = 1024;
                const sizeMB = neentadMB * MB * KB;

                // ตรวจสอบขนาดไฟล์หากเกิน 2 MB
                if (file && file.size > sizeMB) {
                    alert("ไฟล์เกิน 2 MB! กรุณาเลือกไฟล์ทีท่มีขนาดไม่เกิน 2 MB");
                    this.value = "";
                    return
                }

                // แสดงรูปภาพที่เลือก
                imgStd.src = URL.createObjectURL(file); // สร้าง URL ชั่วคราวสำหรับไฟล์ที่เลือกเพื่อแสดงผลภาพ
            });
        }

        delete data.image; // ลบข้อมูล image_path ออก เพราะไม่ต้องการแสดงในตาราง
        const values = Object.values(data); // ดึงค่าทั้งหมดจากออบเจ็กต์ data มาเป็นอาร์เรย์
        const keys = Object.keys(data); // ดึงคีย์ทั้งหมดจากออบเจ็กต์ data มาเป็นอาร์เรย์

        // วนลูปผ่านแต่ละ td และกำหนดค่าที่ดึงมาให้กับแต่ละ td
        textDataStudent.forEach((td, index) => {
            if (target == 'view') {
                document.getElementById('textJson').textContent = JSON.stringify(data, null, 4); // แสดงข้อมูล JSON ในแท็บ JSON
                td.textContent = values[index]; // แสดงค่าที่ดึงมาในแต่ละแถวของตาราง
            } else if (target == 'edit') {
                if (keys[index] === 'id') {
                    td.innerHTML = '<input type="text" class="form-control" value="' + values[index] + '" name="' + keys[index] + '" readonly>'; // แสดงค่าที่ดึงมาในแต่ละแถวของตารางในรูปแบบ input type text และตั้งค่า readonly สำหรับ id
                } else if (keys[index] === 'title') {
                    td.innerHTML = `
                                    <select class="form-select" name="title" required>
                                        <option value="" disabled>-- เลือกคำนำหน้า --</option>
                                        <option value="นาย" ${values[index] === 'นาย' ? 'selected' : ''}>นาย</option>
                                        <option value="นางสาว" ${values[index] === 'นางสาว' ? 'selected' : ''}>นางสาว</option>
                                        <option value="นาง" ${values[index] === 'นาง' ? 'selected' : ''}>นาง</option>
                                    </select>
                                  `; // แสดงค่าที่ดึงมาในแต่ละแถวของตารางในรูปแบบ select สำหรับคำนำหน้า
                } else if (keys[index] === 'date-of-birth') {
                    td.innerHTML = '<input type="date" class="form-control" value="' + values[index] + '" name="' + keys[index] + '" required>'; // แสดงค่าที่ดึงมาในแต่ละแถวของตารางในรูปแบบ input type date
                } else if (keys[index] === 'gender') {
                    td.innerHTML = `<div class="d-inline-block pe-3">
                                        <input type="radio" class="form-check-input" name="gender" id="man" value="ชาย" ${values[index] === 'ชาย' ? 'checked' : ''} required>
                                        <label for="man" class="form-check-label">ชาย</label>
                                    </div>
                                    <div class="d-inline-block pe-3">
                                        <input type="radio" class="form-check-input" name="gender" id="female" value="หญิง" ${values[index] === 'หญิง' ? 'checked' : ''} required>
                                        <label for="female" class="form-check-label">หญิง</label>
                                    </div>
                                    <div class="d-inline-block pe-3">
                                        <input type="radio" class="form-check-input" name="gender" id="choice" value="ทางเลือก" ${values[index] === 'ทางเลือก' ? 'checked' : ''} required>
                                        <label for="choice" class="form-check-label">ทางเลือก</label>
                                    </div>`;
                } else if (keys[index] === 'address') {
                    td.innerHTML = '<textarea class="form-control" name="address" autocomplete="street-address" rows="3" required>' + values[index] + '</textarea>'; // แสดงค่าที่ดึงมาในแต่ละแถวของตารางในรูปแบบ textarea สำหรับที่อยู่
                } else if (keys[index] === 'academic-year') {
                    td.innerHTML = '<input type="number" class="form-control" value="' + values[index] + '" name="' + keys[index] + '" min="2000" max="2099" step="1" required>'; // แสดงค่าที่ดึงมาในแต่ละแถวของตารางในรูปแบบ input type number สำหรับปีการศึกษา
                } else if (keys[index] === 'status') {
                    td.innerHTML = `
                                    <select class="form-select" name="status" required>
                                        <option value="" disabled>-- เลือกสถานะ --</option>
                                        <option value="กำลังศึกษา" ${values[index] === 'กำลังศึกษา' ? 'selected' : ''}>กำลังศึกษา</option>
                                        <option value="สำเร็จการศึกษา" ${values[index] === 'สำเร็จการศึกษา' ? 'selected' : ''}>สำเร็จการศึกษา</option>
                                        <option value="ลาออก" ${values[index] === 'ลาออก' ? 'selected' : ''}>ลาออก</option>
                                        <option value="ย้ายโรงเรียน" ${values[index] === 'ย้ายโรงเรียน' ? 'selected' : ''}>ย้ายโรงเรียน</option>
                                    </select>
                                  `; // แสดงค่าที่ดึงมาในแต่ละแถวของตารางในรูปแบบ select สำหรับสถานะ
                } else if (keys[index] === 'created_at') {
                    td.innerHTML = '<input type="text" class="form-control" value="' + values[index] + '" name="' + keys[index] + '" readonly>'; // แสดงค่าที่ดึงมาในแต่ละแถวของตารางในรูปแบบ input type text และตั้งค่า readonly สำหรับวันที่เพิ่มนักเรียน
                } else {
                    td.innerHTML = '<input type="text" class="form-control" value="' + values[index] + '" name="' + keys[index] + '">'; // แสดงค่าที่ดึงมาในแต่ละแถวของตารางในรูปแบบ input type text
                }
            }
        });
    }

    // modal view student
    const viewStudentModal = new bootstrap.Modal(document.getElementById('viewStudentModal'));
    const viewButtons = document.querySelectorAll('button.view');
    viewButtons.forEach(bottom => {
        bottom.addEventListener('click', function (event) {
            viewStudentModal.show(); // แสดง modal ดูรายละเอียดนักเรียน
            const studentId = this.getAttribute('data-userId'); // ดึงค่า id นักเรียนจาก data-id ของปุ่มที่ถูกคลิก
            fetch('/api/getstudent?id=' + studentId, {
                method: 'GET', // ใช้วิธี GET ในการส่งข้อมูล
            })
                .then(response => response.text()) // แปลงข้อมูลที่ได้รับจากเซิร์ฟเวอร์เป็น JSON แล้วส่งต่อไปยัง data
                .then(data => {
                    let result = JSON.parse(data); // แปลงข้อมูลที่ได้รับจากเซิร์ฟเวอร์เป็น JSON
                    showStudentData('data-student-show', result, 'view'); // แสดงข้อมูลนักเรียนใน modal view
                })
                .catch(error => {
                    console.error('Error:', error); // แสดงข้อผิดพลาดหากมีข้อผิดพลาดในการส่งข้อมูล
                });
        })
    })

    // modal Show Data Edit student
    const editStudentModal = new bootstrap.Modal(document.getElementById('editStudentModal'));
    const editButtons = document.querySelectorAll('button.edit');
    editButtons.forEach(bottom => {
        bottom.addEventListener('click', function (event) {
            editStudentModal.show(); // แสดง modal 
            const studentId = this.getAttribute('data-userId'); // ดึงค่า id นักเรียนจาก data-id ของปุ่มที่ถูกคลิก
            fetch('/api/getstudent?id=' + studentId, {
                method: 'GET', // ใช้วิธี GET ในการส่งข้อมูล
            })
                .then(response => response.text()) // แปลงข้อมูลที่ได้รับจากเซิร์ฟเวอร์เป็น JSON แล้วส่งต่อไปยัง data
                .then(data => {
                    let result = JSON.parse(data); // แปลงข้อมูลที่ได้รับจากเซิร์ฟเวอร์เป็น JSON
                    showStudentData('data-student-show-edit', result, 'edit'); // แสดงข้อมูลนักเรียนใน modal edit
                })
                .catch(error => {
                    console.error('Error:', error); // แสดงข้อผิดพลาดหากมีข้อผิดพลาดในการส่งข้อมูล
                });
        });
    });

    // บันทึกการเปลี่ยนแปลงข้อมูลนักเรียน
    const saveChangesButton = document.getElementById('saveChanges');
    saveChangesButton.addEventListener('click', function () {
        const tableInput = document.getElementById('data-student-show-edit').querySelector('table'); // ดึงข้อมูลฟอร์มจาก modal edit
        const formData = new FormData(); // สร้าง FormData จากฟอร์มที่มีอยู่
        formData.append('form', 'data-student-show-edit'); // เพิ่มข้อมูลเข้าไปใน FormData เพื่อนเอาไว้เช็คว่า form ไหนส่งข้อมูลมา

        const fileInput = document.getElementById('image'); // ดึงข้อมูล input ที่เป็นไฟล์รูปภาพ
        const file = fileInput.files[0]; // ดึงไฟล์รูปภาพที่เลือก
        formData.append('image', file); // เพิ่มไฟล์รูปภาพเข้าไปใน FormData

        tableInput.querySelectorAll('input, select, textarea').forEach(input => {
            formData.append(input.name, input.value); // เพิ่มข้อมูลจาก input, select, textarea เข้าไปใน FormData
        });

        fetch('/api/updatestudent', {
            method: 'POST', // ใช้วิธี POST ในการส่งข้อมูล
            body: formData, // ส่งข้อมูลฟอร์มที่สร้างขึ้น
        })
            .then(response => response.text()) // แปลงข้อมูลที่ได้รับจากเซิร์ฟเวอร์เป็น JSON แล้วส่งต่อไปยัง data
            .then(data => {
                let result = JSON.parse(data); // แปลงข้อมูลที่ได้รับจากเซิร์ฟเวอร์เป็น JSON
                const modalAlert = bootstrap.Modal.getOrCreateInstance(document.getElementById('editStudentModal')); // ดึง instance ของ modal edit ที่เปิดอยู่
                const toastAlert = document.querySelectorAll('.toast'); // ดึงทุกองค์ประกอบที่มีคลาส .toast
                const headerAlert = document.querySelectorAll('.header-alert'); // ดึงทุกองค์ประกอบที่มีคลาส .header-alert
                const toastBody = document.querySelectorAll('.toast-body'); // ดึงทุกองค์ประกอบที่มีคลาส .toast-body

                toastAlert[0].style = 'display: none;'; // ปิด Toast Success
                toastAlert[1].style = 'display: none;'; // ปิด Toast Error
                modalAlert.hide(); // ปิด modal edit หลังจาก Server ส่งข้อมูลกลับมา
                // แสดง toast ตามสถานะที่ได้รับจาก Server
                if (result.status === 'success') {
                    const toastSuccess = new bootstrap.Toast(toastAlert[0]); // สร้าง instance ของ toast success
                    headerAlert[0].textContent = result.status; // กำหนดข้อความหัวข้อ toast
                    toastBody[0].textContent = result.message; // กำหนดข้อความ Body Toast
                    toastAlert[0].style = 'display: block;'; // เปิด Toast Success
                    toastSuccess.show(); // แสดง Toast
                    setTimeout(() => { // หลังจากแสดง Toast Success รอเวลา 5 วินาแล้ว Reload หน้าเพจ
                        window.location.reload(); // Reload หน้าเพจ
                    }, 5500);
                } else if (result.status === 'error') {
                    const toastError = new bootstrap.Toast(toastAlert[1]); // สร้าง instance ของ toast error
                    headerAlert[1].textContent = result.status; // กำหนดข้อความหัวข้อ toast
                    toastBody[1].textContent = result.message; // กำหนดข้อความ Body Toast
                    toastAlert[1].style = 'display: block;'; // เปิด Toast Error
                    toastError.show(); // แสดง Toast
                    setTimeout(() => { // หลังจากแสดง Toast Error รอเวลา 5 วินาแล้ว Reload หน้าเพจ
                        window.location.reload(); // Reload หน้าเพจ
                    }, 5500);
                }
            })
            .catch(error => {
                console.error('Error:', error); // แสดงข้อผิดพลาดหากมีข้อผิดพลาดในการส่งข้อมูล
            });
    });

    // Export นักเรียนเป็นไฟล์ pdf
    const exportButtom = document.querySelector('button.export');
    exportButtom.addEventListener('click', function (event) {
        const contentStudent = document.getElementById('data-student-show'); // ดึงเนื้อหานักเรียน
        const id = document.getElementsByClassName('text-data-student')[0].textContent; // ดึง id นักเรียน
        html2pdf().set({
            margin: [10, 10, 10, 10], // กำหนด Margin PDF [บน, ขวา, ล่าง, ซ้าย]
            filename: 'students-id-' + id + '.pdf', // ตั้งชื้อไฟล์
            html2canvas: { scale: 2 }, // กำกนดความละเอียดไฟล์ PDF ความละเอียดมีแค่ 1 ถึง 3
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' } // กำหนดคุณสมบัติของไฟล์ PDF
        }).from(contentStudent).save(); // Export ไฟล์ PDF นักเรียน
    });

};