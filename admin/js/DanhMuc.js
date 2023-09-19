function exit(){
    let a = document.getElementById("form_dm");
    a.style.display = "none";

    let MaDanhMuc = document.getElementById("MaDanhMuc");
    MaDanhMuc.value = "";

    let TenDanhMuc = document.getElementById("TenDanhMuc");
    TenDanhMuc.value = "";
}

function add(){

    let form = document.getElementById("form_dm");
    form.style.display = "block";

    let nd = document.getElementById("tt_dm");
    nd.value = "Thêm thông tin danh mục";
}

function edit(MaDanhMuc,TenDanhMuc) { 
    let input1 = document.getElementById("MaDanhMuc");
    input1.readOnly = true;
    input1.value = MaDanhMuc;

    let input2 = document.getElementById("TenDanhMuc");
    input2.value = TenDanhMuc;

    let form = document.getElementById("form_dm");
    form.style.display = "block";


    let nd = document.getElementById("tt_dm");
    nd.value = "Sửa thông tin danh mục";
}
