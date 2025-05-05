# Hướng dẫn cài đặt project bằng XAMPP :
 B1 : Cài đặt môi trường

Bạn cần có những phần mềm sau:

+ XAMPP gồm Apache, PHP, MySQL : download tại https://www.apachefriends.org/download.html
+ Trình soạn thảo mã nguồn (VSCode, Sublime Text, PHPStorm, …) (Ở đây sử dụng VSCode) : download tại https://code.visualstudio.com/download

 B2 : Download project từ github https://github.com/bhbghghbgb/CNPM

+ Lưu thư mục vừa tải về vào trong XAMPP theo dịa chỉ : xampp\htdocs\

 B3 :Import file sql vào mysql

+ Vào trang web http://localhost/phpmyadmin/ --> Vào Cơ sở dữ liệu --> Nhập tên CSDL lưu trong DatabaseServer
+ Sau tạo xong chọn Nhập( Import ) --> Chọn file sql lưu trong DatabaseServer --> Nhập (Import)

    Như vậy bạn đã hoàn thành xòn các bước để chạy project 

 B4 : Chạy Project : Có 2 cách 

 + C1 : Chạy bằng XAMPP : Trong XAMPP đã cài đặt sẵn php và Apache nên bạn chỉ cần bật XAMPP là được 

    - Sau khi hoàn thành các bước trên bật XAMPP Control Panel --> Bật MySQL và Apache --> Vào trình duyệt gõ http://localhost/project_name
    - Dùng VSCode để chỉnh sửa , debug lại projectw

 + C2 : Dùng PHP built-in server 

    - Sau khi hoàn thành các bước trên bật XAMPP Control Panel --> Bật MySQL và Apache để kết nối tới mysql và bật server
    - Dùng VSCode để mở sourcode project --> Vào terminal gõ lệnh php -S localhost:8000
    - Vào trình duyệt gõ http://localhost:8000 để hiện project 