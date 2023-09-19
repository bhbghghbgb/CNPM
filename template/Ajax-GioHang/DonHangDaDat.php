<script>
    SoTrang = 1;
    from = "";
    to = "";
    $(document).ready(function() {
        // Thuc hien viec in thong tin vao bang lan dau
        $.get('./template/Ajax-GioHang/Ajax-GioHang.php',
        {   
            Trang:SoTrang,
            <?php 
                if(isset($_SESSION['MaTaiKhoan'])){
                    echo "MaTK:" . $_SESSION['MaTaiKhoan'];
                }
            ?>
        },
        function(data){
            $('#donhanglist').html(data);
        });


        //In them cac don hang
        $('#xemthem').click(function(){
            SoTrang += 1;
            $.get('./template/Ajax-GioHang/Ajax-GioHang.php',
            {   
                Trang:SoTrang,
                From:from,
                To:to,
                <?php 
                    if(isset($_SESSION['MaTaiKhoan'])){
                        echo "MaTK:" . $_SESSION['MaTaiKhoan'];
                    }
                ?>
            },
            function(data){
                    $('#donhanglist').append(data);
            });
        });

        //Thuc hien viec loc bang theo dieu kien
        
        $('#btn-Loc').click(function(){
            from = $('#from').val();
            to = $('#to').val();

            SoTrang = 1;

            $.get('./template/Ajax-GioHang/Ajax-GioHang.php',
            {   
                Trang:SoTrang,
                From:from,
                To:to,
                <?php 
                    if(isset($_SESSION['MaTaiKhoan'])){
                        echo "MaTK:" . $_SESSION['MaTaiKhoan'];
                    }
                ?>
            },
            function(data){
                $('#donhanglist').html(data);
            });
        });
        

        $('#btn-Refresh').click(function() {
            //Reset lại 2 biến from và to
            from = "";
            to = "";

            SoTrang = 1;

            $.get('./template/Ajax-GioHang/Ajax-GioHang.php',
            {   
                Trang:SoTrang,
                From:from,
                To:to,
                <?php 
                    if(isset($_SESSION['MaTaiKhoan'])){
                        echo "MaTK:" . $_SESSION['MaTaiKhoan'];
                    }
                ?>
            },
            function(data){
                $('#donhanglist').html(data);
            });
        });

    });

    

    


</script>


<?php
    if(isset($_SESSION['MaTaiKhoan'])){
        $MaTK = $_SESSION['MaTaiKhoan'];
?>
    <div id="donhang_container">
        <div id = "title"><h2>Danh sách các đơn hàng đã đặt</h2></div>
        <div id = "Loc">
            <label for = "from">Từ: </label>
            <input type = "date" name = "from" id = "from" required>
            <label for = "to">Đến: </label>
            <input type = "date" name = "to" id = "to" required>
            <button id = "btn-Loc">Lọc</button>
            <button id = "btn-Refresh">Refresh</button>
        </div>
        <div id = "donhang"> 
            <table id="donhanglist">
                

            </table>
        </div>
        <div id = "xemthem_block">
            <div id = "xemthem">Xem thêm</div>
        </div>
    </div>
<?php
    }

?>