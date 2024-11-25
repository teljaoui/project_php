document.querySelector('#search-icon').onclick = () => {
    document.querySelector('#search-form').classList.toggle('active');
}

document.querySelector('#close').onclick = () => {
    document.querySelector('#search-form').classList.remove('active');
}



var mainImg = document.getElementById("mainImg");

var smallImg = document.getElementsByClassName("small-img");

for (let i = 0; i < 4; i++) {
    smallImg[i].onclick = function () {
        mainImg.src = smallImg[i].src;
    }
}

function showaside() {
    var asidebar = document.getElementsByClassName('show-bar')[0];
    asidebar.style.left = 0
    closeprice();
}


function closebar() {
    var asidebar = document.getElementsByClassName('show-bar')[0];
    asidebar.style.left = '-100%'
}

function showprice() {
    document.querySelector('.show-price').style.left = 0;
    closebar();
}

function closeprice() {
    document.querySelector('.show-price').style.left = '-100%';
}

