
<link rel="stylesheet" href="../../../css/PhanQuyen.css" >

<link rel="stylesheet" href="../../../css/bootstrap.min.css" >
<?php
    include("../../../../db/DAOPhanQuyen.php");
    $db = new DAOPhanQuyen();
    $db->connect();

    $MaQuyen = $_GET['id'];

?>
<form action="" method="POST">
        <div id="check_item">
            <a id="exit" href="../../../index.php?id=pq">X</a>
            <div class="row">
                <?php
                    $data = $db->getListCTQ();
                    $i = 0;
                    while ($i < count($data))
                    {
                ?>
                        <div class="col-6">
                            <label for=<?php echo $data[$i][0]?> class="checkbox_item w-100 ">
                                <input type="checkbox" name=<?php echo $data[$i][0]?> class="checkbox" id=<?php echo $data[$i][0]?> <?php if($db->checkQuyen($MaQuyen, $data[$i][0])==true) echo "checked"?>/> 
                                <span><?php echo $data[$i][2]?></span>
                                <i class="fas fa-circle"></i>     
                            </label>
                        </div>
                <?php
                        $i++;
                    }
                
                ?>
            </div>

        </div>


    <div id="submit">
        <input type=submit name="edit" id="edit" value="Thực hiện phân quyền"/>
    </div>
</form>


<?php
    if(isset($_POST['edit'])){
        if($db->delete($MaQuyen)){
            $i = 0;
            while ($i < count($data)){
                if(isset($_POST[$data[$i][0]])){
                    $db->insert($MaQuyen, $data[$i][0]);
                
                }
                $i++;
            }
            
        } 

        echo "<script>alert('Phân quyền thành công !');window.location='../../../index.php?id=pq';</script>";
    }
?>

