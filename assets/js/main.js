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
}


function closebar() {
    var asidebar = document.getElementsByClassName('show-bar')[0];
    asidebar.style.left = '-100%'
}

// Obtenir les éléments des catégories
var men = document.getElementById("form-men");
var women = document.getElementById("form-women");
var accessories = document.getElementById("form-accessories");

// Fonction pour afficher/masquer les sous-catégories
function showSubcategory(selectedCategory) {
    // Cacher toutes les sous-catégories
    document.getElementById("checkitem1").style.display = "none";
    document.getElementById("checkitem2").style.display = "none";
    document.getElementById("checkitem3").style.display = "none";

    // Afficher la sous-catégorie correspondant à la catégorie sélectionnée
    if (selectedCategory === "men") {
        document.getElementById("checkitem1").style.display = "block";
    } else if (selectedCategory === "women") {
        document.getElementById("checkitem2").style.display = "block";
    } else if (selectedCategory === "accessories") {
        document.getElementById("checkitem3").style.display = "block";
    }
}

// Ajouter les écouteurs d'événements pour chaque catégorie
men.addEventListener("change", function() {
    showSubcategory("men");
});

women.addEventListener("change", function() {
    showSubcategory("women");
});

accessories.addEventListener("change", function() {
    showSubcategory("accessories");
});


