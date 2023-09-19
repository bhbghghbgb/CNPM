function hienthi(){
    let a = document.getElementById('form');
    let b = document.getElementById('formdk');
    let c = document.getElementById('backgroundDN');
    if(b.style.display == 'block'){
        b.style.display = 'none';
        c.style.display = 'none';
    }
    if(a.style.display == 'none'){
        a.style.display = 'block';
        c.style.display = 'block';
    }
    else{
        a.style.display = 'none';
        c.style.display = 'none';
    }
}

function tatdn(){
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('form');
    a.style.display = 'none';
    c.style.display = 'none';
}
function tatdk(){
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('formdk');
    a.style.display = 'none';
    c.style.display = 'none';
}

function hienthidangky(){
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('form');
    a.style.display = 'none';
    let b = document.getElementById('formdk');
    b.style.display = 'block';
    c.style.display = 'block';
}

function hienthidangnhap(){
    let c = document.getElementById('backgroundDN');
    let a = document.getElementById('formdk');
    a.style.display = 'none';
    c.style.display = 'block';
    let b = document.getElementById('form');
    b.style.display = 'block';
}