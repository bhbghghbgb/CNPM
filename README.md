* Hướng dẫn cài đặt project bằng XAMPP :

 B1 : Cài đặt môi trường :Bạn cần có những phần mềm sau:

+ XAMPP gồm Apache, PHP, MySQL : download tại https://www.apachefriends.org/download.html
+ Trình soạn thảo mã nguồn (VSCode, Sublime Text, PHPStorm, …) (Ở đây sử dụng VSCode) : download tại https://code.visualstudio.com/download

 B2 : Download project từ github https://github.com/bhbghghbgb/CNPM

+ Lưu thư mục vừa tải về vào trong XAMPP theo dịa chỉ : xampp\htdocs\
![image](https://github.com/user-attachments/assets/a220d4a0-628e-4801-b915-99980d6149be)

 B3 :Import file sql vào mysql

+ Vào trang web http://localhost/phpmyadmin/
![image](https://github.com/user-attachments/assets/1bd78a00-cb9c-4f35-81f7-3817ef28e210)

+ Vào Cơ sở dữ liệu --> Nhập tên CSDL lưu trong DatabaseServer --> Tạo 
  ![image](https://github.com/user-attachments/assets/ecfcc4ad-f182-49f7-9677-0521c25912e6)

+ Sau tạo xong chọn Nhập( Import ) --> Chọn file sql lưu trong DatabaseServer --> Nhập (Import)
![image](https://github.com/user-attachments/assets/0f539bed-7c48-4c84-b56a-d8142a88e075)

    Như vậy bạn đã hoàn thành xong các bước để chạy project 

 B4 : Chạy Project : Có 2 cách 

 + C1 : Chạy bằng XAMPP : Trong XAMPP đã cài đặt sẵn php và Apache nên bạn chỉ cần bật XAMPP là được 

    - Sau khi hoàn thành các bước trên bật XAMPP Control Panel --> Bật MySQL và Apache --> Vào trình duyệt gõ http://localhost/project_name
   ![image](https://github.com/user-attachments/assets/4d240454-a3ad-46dd-836d-744fa64dbdac)

    - Dùng VSCode để chỉnh sửa , debug lại project

 + C2 : Dùng PHP built-in server 

    - Sau khi hoàn thành các bước trên bật XAMPP Control Panel --> Bật MySQL và Apache để kết nối tới mysql và bật server
   ![image](https://github.com/user-attachments/assets/fe8c8113-2592-45ac-958e-b648241e0ce9)

    - Dùng VSCode để mở sourcode project --> Vào terminal gõ lệnh php -S localhost:8000
   ![image](https://github.com/user-attachments/assets/ecf90835-96a8-42f8-9e0a-1489573af312)

    - Vào trình duyệt gõ http://localhost:8000 để hiện project 
