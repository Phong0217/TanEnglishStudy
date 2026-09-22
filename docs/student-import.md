# Import học sinh vào lớp

Admin và Teacher có thể tải file `.xlsx` hoặc `.csv` tại trang Lớp học.

Trong thẻ import, chọn **Tải file mẫu** để tải `student-import-template.csv`. Template đã có sẵn đúng tên cột và hai dòng ví dụ; hãy thay bằng dữ liệu thật trước khi upload.

Cột bắt buộc:

| class_name | student_name | email | password |
|---|---|---|---|
| English 7A | Nguyễn Minh | minh@example.com | MatKhau123! |

`class_name` có thể là tên hoặc mã lớp. `email` là tài khoản đăng nhập của học sinh. Mật khẩu được hash trước khi lưu và không được ghi vào log.

Teacher chỉ import được các lớp có phân công ACTIVE; Admin chỉ import trong center hiện tại. Nếu một dòng không hợp lệ, toàn bộ file sẽ rollback và không tạo ghi danh dở dang.
