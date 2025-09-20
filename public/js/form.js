// window.onload เป็น Event Listener ที่จะทำงานเมื่อหน้าเว็บโหลดเสร็จ
window.onload = function() {

    // กำหนดตัวแปรที่ใช้ในการจัดการไฟล์รูปภาพ และ Event Listener สำหรับการเปลี่ยนแปลงไฟล์รูปภาพ
    const image = document.getElementById('image');
    const previewImage = document.getElementById('preview-image');
    const noImage = document.getElementById('no-image');
    image.addEventListener('change', function(event) {
        const file = event.target.files[0];
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
        
        //  แสดงรูปภาพที่เลือกลงใน Preview
        previewImage.src = URL.createObjectURL(file); // ใช้ URL.createObjectURL เพื่อสร้าง URL สำหรับไฟล์ที่เลือก
        previewImage.classList.remove('d-none'); // แสดงรูปภาพที่เลือก
        noImage.classList.add('d-none'); // ซ่อนข้อความ "No Image"

    });

    // reset image preview เมื่อมีการรีเซ็ตฟอร์ม
    const resetImahe = document.getElementById('reset');
    resetImahe.addEventListener('click', function() {
        previewImage.classList.add('d-none'); // ซ่อนรูปภาพที่เลือก
        noImage.classList.remove('d-none'); // แสดงข้อความ "No Image"
    });

    // modal success
    const successAlert = new bootstrap.Modal(document.getElementById('successAlert'));
    function showSuccessModal(text) {
        const textAlert = document.getElementById('textAlert');
        textAlert.textContent = text;
        successAlert.show();
    }

    // กำหนดค่าเริ่มต้นให้กับตัวแปรที่ใช้ในการจัดการฟอร์ม และ Event Listener บันทึกข้อมูล
    const form = document.getElementById('form-student');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // หยุดการส่งฟอร์มแบบปกติ หรือการรีเฟรชหน้าเว็บ

        const fileInput = document.getElementById('image'); // ดึงข้อมูล input ที่เป็นไฟล์รูปภาพ
        const file =  fileInput.files[0]; // ดึงไฟล์รูปภาพที่เลือก
        
        const formData = new FormData(form); // สร้าง FormData จากฟอร์มที่มีอยู่
        formData.append('form', 'form-student'); // เพิ่มข้อมูลเข้าไปใน FormData เพื่อนเอาไว้เช็คว่า form ไหนส่งข้อมูลมา
        formData.append('image', file); // เพิ่มไฟล์รูปภาพเข้าไปใน FormData
       
        for (let [key, value] of formData.entries()) {

            // ตรวจสอบว่าอีเมลว่างหรือไม่
            if (key === 'email' && value === '') { 
                formData.set(key, '-'); // ถ้าอีเมลว่างเพิ่มค่าเป็น '-'
            } else {

                // ตรวจสอบว่ามีช่องว่างในฟอร์มหรือไม่
                if (value === '') {
                    alert('กรุณากรอกข้อมูลให้ครบทุกช่อง ' + key);
                    return; // หยุดการทำงานหากมีช่องว่าง
                }
            }

            // ตรวจสอบคำนำหน้าชื่อ
            if (key === 'title' && value === '-- เลือกคำนำหน้า --') {
                alert('กรุณาเลือกคำนำหน้า');
                return; // หยุดการทำงานหากไม่เลือกคำนำหน้า
            }
            
            // ตรวจสอบว่ามีการเลือกรูปภาพหรือไม่
            if (key === 'image' && formData.get('image').size == 0) {
                alert('กรุณาเลือกรูปภาพ');
                return; // หยุดการทำงานหากไม่เลือกรูปภาพ
            }

        }

        // ส่งข้อมูลฟอร์มไปยังเซิร์ฟเวอร์ ด้วยการใช้ Fetch API
        fetch('/api/student', {
            method: 'POST', // ใช้วิธี POST ในการส่งข้อมูล
            body:  formData, // ส่งข้อมูลฟอร์มที่สร้างขึ้น
        })
        .then(response => response.text()) // แปลงข้อมูลที่ได้รับจากเซิร์ฟเวอร์เป็น JSON แล้วส่งต่อไปยัง data
        .then(data => {
            let result = JSON.parse(data); // แปลงข้อมูลที่ได้รับจากเซิร์ฟเวอร์เป็น JSON
            showSuccessModal(result.message); // แสดง Modal แจ้งเตือนว่าบันทึกข้อมูลสำเร็จ
        })
        .catch(error => {
            console.error('Error:', error); // แสดงข้อผิดพลาดหากมีข้อผิดพลาดในการส่งข้อมูล
        });
    });

    // โหลดหน้าเว็บใหม่เพื่อรีเซ็ตฟอร์ม เมื่อคลิกปุ่ม "ตกลง"
    const dismiss1 = document.getElementById('dismiss1');
    const dismiss2 = document.getElementById('dismiss2');

    dismiss1.addEventListener('click', function() {
        window.location.reload(); // โหลดหน้าเว็บใหม่
    });

    dismiss2.addEventListener('click', function() {
        window.location.reload(); // โหลดหน้าเว็บใหม่
    });

}