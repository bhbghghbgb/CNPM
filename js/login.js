function hienthi() {
    let a = document.getElementById('form');
    let b = document.getElementById('formdk');
    let q = document.getElementById('form_quenmatkhau');
    let c = document.getElementById('backgroundDN');
    a.style.display = 'block';
    c.style.display = 'block';
    b.style.display = 'none';
    q.style.display = 'none';
    // if(b.style.display == 'block'){
    //     b.style.display = 'none';
    //     c.style.display = 'none';
    //}
    //if(a.style.display == 'none'){
    //     a.style.display = 'block';
    //     c.style.display = 'block';
    // }
    // else{
    //     a.style.display = 'none';
    //     c.style.display = 'none';
    // }
}

function tatdn() {
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('form');
    a.style.display = 'none';
    c.style.display = 'none';
}
function tatdk() {
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('formdk');
    a.style.display = 'none';
    c.style.display = 'none';
}

function hienthidangky() {
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('form');
    a.style.display = 'none';
    let b = document.getElementById('formdk');
    b.style.display = 'block';
    c.style.display = 'block';
}

function hienthidangnhap() {
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('formdk');
    a.style.display = 'none';
    c.style.display = 'block';
    let b = document.getElementById('form');
    b.style.display = 'block';
}
function hienformquenmatkhau() {
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('form');
    a.style.display = 'none';
    c.style.display = 'block';
    let b = document.getElementById('form_quenmatkhau');
    b.style.display = 'block';
}
function tatqmk() {
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('form_quenmatkhau');
    a.style.display = 'none';
    c.style.display = 'none';
}