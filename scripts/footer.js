let logoTlalpanContainer = document.querySelector(".logoTlalpan");
let logoFMDBContainer = document.querySelector(".logoFMDB");
let logoCodemeContainer = document.querySelector(".logoCodeme");
let logoHitContainer = document.querySelector(".logoHit");
let logoLhasaContainer = document.querySelector(".logoLhasa");
let logoIztapalapaContainer = document.querySelector(".logoIztapalapa");
let logoAdomexContainer = document.querySelector(".logoAdomex");
let logoWDBFContainer = document.querySelector(".logoWDBF");

let logoTlalpan = document.createElement("img");
let logoFMDB = document.createElement("img");
let logoCodeme = document.createElement("img");
let logoHit = document.createElement("img");
let logoLhasa = document.createElement("img");
let logoIztapalapa = document.createElement("img");
let logoAdomex = document.createElement("img");
let logoWDBF = document.createElement("img");

const equiposFooter = document.querySelector(".equiposFooter");
const palmaresFooter = document.querySelector(".palmaresFooter");
const uneteFooter = document.querySelector(".uneteFooter");
const valoresFooter = document.querySelector(".valoresFooter");
const fotosFooter = document.querySelector(".fotosFooter");
const contactoFooter = document.querySelector(".contactoFooter");
const avisoFooter = document.querySelector(".avisoFooter");

const siteBy = document.querySelector(".siteByContainer");

equiposFooter.textContent = "Equipos";
palmaresFooter.textContent = "Palmares";
uneteFooter.textContent = "Unete";
valoresFooter.textContent = "Valores";
fotosFooter.textContent = "Fotos";
contactoFooter.textContent = "Contacto";
avisoFooter.textContent = "Aviso de Privacidad";
siteBy.textContent = "site by yayodelariva";

// FOOTER PATHING

if (
  window.location.pathname.includes("/equipofemenil/") ||
  window.location.pathname.includes("/equipomixto/") ||
  window.location.pathname.includes("/equipovaronil/")
) {
  equiposFooter.href = "../index.html";
  palmaresFooter.href = "../../palmares/index.html";
  uneteFooter.href = "../../unete/index.html";
  valoresFooter.href = "../../valores/index.html";
  fotosFooter.href = "../../index.html#fotos";
  contactoFooter.href = "../../index.html#contacto";
  avisoFooter.href = "../../privacy.html";
  siteBy.href = "https://www.github.com/yayodelariva";
  logoTlalpan.src = "../../images/logosfooter/logoTlalpan.png";
  logoFMDB.src = "../../images/logosfooter/FMDB-Rojo-V.png";
  logoCodeme.src = "../../images/logosfooter/codeme_logo.jpg";
  logoHit.src = "../../images/logosfooter/logo-hit-morado.png";
  logoLhasa.src = "../../images/logosfooter/logoLhasa.png";
  logoIztapalapa.src = "../../images/logosfooter/logoIztapalapa.jpeg";
  logoAdomex.src = "../../images/logosfooter/adomex-cuadrado.png";
  logoWDBF.src = "../../images/logosfooter/WDBF_logo.png";
  logoTlalpanContainer.href = "https://alcaldiatlalpan.mx/";
  logoFMDBContainer.href =
    "https://www.facebook.com/federacionmexicanadedodgeball";
  logoCodemeContainer.href = "https://www.codeme.com.mx/";
  logoHitContainer.href = "https://www.instagram.com/hitdodgeballgear/";
  logoLhasaContainer.href = "https://www.facebook.com/AguaLhasa";
  logoIztapalapaContainer.href = "https://www.iztapalapa.cdmx.gob.mx";
  logoAdomexContainer.href = "https://www.adomexdodgeball.com/";
  logoWDBFContainer.href = "https://worlddodgeballfederation.com/";
} else if (window.location.pathname.includes("/equipos")) {
  equiposFooter.href = "index.html";
  palmaresFooter.href = "../palmares/index.html";
  uneteFooter.href = "../unete/index.html";
  valoresFooter.href = "../valores/index.html";
  fotosFooter.href = "../index.html#fotos";
  contactoFooter.href = "../index.html#contacto";
  avisoFooter.href = "../privacy.html";
  siteBy.href = "https://www.github.com/yayodelariva";
  logoTlalpan.src = "../images/logosfooter/logoTlalpan.png";
  logoFMDB.src = "../images/logosfooter/FMDB-Rojo-V.png";
  logoCodeme.src = "../images/logosfooter/codeme_logo.jpg";
  logoHit.src = "../images/logosfooter/logo-hit-morado.png";
  logoLhasa.src = "../images/logosfooter/logoLhasa.png";
  logoIztapalapa.src = "../images/logosfooter/logoIztapalapa.jpeg";
  logoAdomex.src = "../images/logosfooter/adomex-cuadrado.png";
  logoWDBF.src = "../images/logosfooter/WDBF_logo.png";
  logoTlalpanContainer.href = "https://alcaldiatlalpan.mx/";
  logoFMDBContainer.href =
    "https://www.facebook.com/federacionmexicanadedodgeball";
  logoCodemeContainer.href = "https://www.codeme.com.mx/";
  logoHitContainer.href = "https://www.instagram.com/hitdodgeballgear/";
  logoLhasaContainer.href = "https://www.facebook.com/AguaLhasa";
  logoIztapalapaContainer.href = "https://www.iztapalapa.cdmx.gob.mx";
  logoAdomexContainer.href = "https://www.adomexdodgeball.com/";
  logoWDBFContainer.href = "https://worlddodgeballfederation.com/";
} else if (window.location.pathname.includes("/palmares/")) {
  equiposFooter.href = "../equipos/index.html";
  palmaresFooter.href = "index.html";
  uneteFooter.href = "../unete/index.html";
  valoresFooter.href = "../valores/index.html";
  fotosFooter.href = "../index.html#fotos";
  contactoFooter.href = "../index.html#contacto";
  avisoFooter.href = "../privacy.html";
  siteBy.href = "https://www.github.com/yayodelariva";
  logoTlalpan.src = "../images/logosfooter/logoTlalpan.png";
  logoFMDB.src = "../images/logosfooter/FMDB-Rojo-V.png";
  logoCodeme.src = "../images/logosfooter/codeme_logo.jpg";
  logoHit.src = "../images/logosfooter/logo-hit-morado.png";
  logoLhasa.src = "../images/logosfooter/logoLhasa.png";
  logoIztapalapa.src = "../images/logosfooter/logoIztapalapa.jpeg";
  logoAdomex.src = "../images/logosfooter/adomex-cuadrado.png";
  logoWDBF.src = "../images/logosfooter/WDBF_logo.png";
  logoTlalpanContainer.href = "https://alcaldiatlalpan.mx/";
  logoFMDBContainer.href =
    "https://www.facebook.com/federacionmexicanadedodgeball";
  logoCodemeContainer.href = "https://www.codeme.com.mx/";
  logoHitContainer.href = "https://www.instagram.com/hitdodgeballgear/";
  logoLhasaContainer.href = "https://www.facebook.com/AguaLhasa";
  logoIztapalapaContainer.href = "https://www.iztapalapa.cdmx.gob.mx";
  logoAdomexContainer.href = "https://www.adomexdodgeball.com/";
  logoWDBFContainer.href = "https://worlddodgeballfederation.com/";
} else if (window.location.pathname.includes("/unete/")) {
  equiposFooter.href = "../equipos/index.html";
  palmaresFooter.href = "../palmares/index.html";
  uneteFooter.href = "index.html";
  valoresFooter.href = "../valores/index.html";
  fotosFooter.href = "../index.html#fotos";
  contactoFooter.href = "../index.html#contacto";
  avisoFooter.href = "../privacy.html";
  siteBy.href = "https://www.github.com/yayodelariva";
  logoTlalpan.src = "../images/logosfooter/logoTlalpan.png";
  logoFMDB.src = "../images/logosfooter/FMDB-Rojo-V.png";
  logoCodeme.src = "../images/logosfooter/codeme_logo.jpg";
  logoHit.src = "../images/logosfooter/logo-hit-morado.png";
  logoLhasa.src = "../images/logosfooter/logoLhasa.png";
  logoIztapalapa.src = "../images/logosfooter/logoIztapalapa.jpeg";
  logoAdomex.src = "../images/logosfooter/adomex-cuadrado.png";
  logoWDBF.src = "../images/logosfooter/WDBF_logo.png";
  logoTlalpanContainer.href = "https://alcaldiatlalpan.mx/";
  logoFMDBContainer.href =
    "https://www.facebook.com/federacionmexicanadedodgeball";
  logoCodemeContainer.href = "https://www.codeme.com.mx/";
  logoHitContainer.href = "https://www.instagram.com/hitdodgeballgear/";
  logoLhasaContainer.href = "https://www.facebook.com/AguaLhasa";
  logoIztapalapaContainer.href = "https://www.iztapalapa.cdmx.gob.mx";
  logoAdomexContainer.href = "https://www.adomexdodgeball.com/";
  logoWDBFContainer.href = "https://worlddodgeballfederation.com/";
} else if (window.location.pathname.includes("/valores/")) {
  equiposFooter.href = "../equipos/index.html";
  palmaresFooter.href = "../palmares/index.html";
  uneteFooter.href = "../unete/index.html";
  valoresFooter.href = "index.html";
  fotosFooter.href = "../index.html#fotos";
  contactoFooter.href = "../index.html#contacto";
  avisoFooter.href = "../privacy.html";
  siteBy.href = "https://www.github.com/yayodelariva";
  logoTlalpan.src = "../images/logosfooter/logoTlalpan.png";
  logoFMDB.src = "../images/logosfooter/FMDB-Rojo-V.png";
  logoCodeme.src = "../images/logosfooter/codeme_logo.jpg";
  logoHit.src = "../images/logosfooter/logo-hit-morado.png";
  logoLhasa.src = "../images/logosfooter/logoLhasa.png";
  logoIztapalapa.src = "../images/logosfooter/logoIztapalapa.jpeg";
  logoAdomex.src = "../images/logosfooter/adomex-cuadrado.png";
  logoWDBF.src = "../images/logosfooter/WDBF_logo.png";
  logoTlalpanContainer.href = "https://alcaldiatlalpan.mx/";
  logoFMDBContainer.href =
    "https://www.facebook.com/federacionmexicanadedodgeball";
  logoCodemeContainer.href = "https://www.codeme.com.mx/";
  logoHitContainer.href = "https://www.instagram.com/hitdodgeballgear/";
  logoLhasaContainer.href = "https://www.facebook.com/AguaLhasa";
  logoIztapalapaContainer.href = "https://www.iztapalapa.cdmx.gob.mx";
  logoAdomexContainer.href = "https://www.adomexdodgeball.com/";
  logoWDBFContainer.href = "https://worlddodgeballfederation.com/";
} else {
  equiposFooter.href = "equipos/index.html";
  palmaresFooter.href = "palmares/index.html";
  uneteFooter.href = "unete/index.html";
  valoresFooter.href = "valores/index.html";
  fotosFooter.href = "index.html#fotos";
  contactoFooter.href = "index.html#contacto";
  avisoFooter.href = "privacy.html";
  siteBy.href = "https://www.github.com/yayodelariva";
  logoTlalpan.src = "images/logosfooter/logoTlalpan.png";
  logoFMDB.src = "images/logosfooter/FMDB-Rojo-V.png";
  logoCodeme.src = "images/logosfooter/codeme_logo.jpg";
  logoHit.src = "images/logosfooter/logo-hit-morado.png";
  logoLhasa.src = "images/logosfooter/logoLhasa.png";
  logoIztapalapa.src = "images/logosfooter/logoIztapalapa.jpeg";
  logoAdomex.src = "images/logosfooter/adomex-cuadrado.png";
  logoWDBF.src = "images/logosfooter/WDBF_logo.png";
  logoTlalpanContainer.href = "https://alcaldiatlalpan.mx/";
  logoFMDBContainer.href =
    "https://www.facebook.com/federacionmexicanadedodgeball";
  logoCodemeContainer.href = "https://www.codeme.com.mx/";
  logoHitContainer.href = "https://www.instagram.com/hitdodgeballgear/";
  logoLhasaContainer.href = "https://www.facebook.com/AguaLhasa";
  logoIztapalapaContainer.href = "https://www.iztapalapa.cdmx.gob.mx";
  logoAdomexContainer.href = "https://www.adomexdodgeball.com/";
  logoWDBFContainer.href = "https://worlddodgeballfederation.com/";
}

// DOM BUILDING

logoTlalpanContainer.appendChild(logoTlalpan);
logoFMDBContainer.appendChild(logoFMDB);
logoCodemeContainer.appendChild(logoCodeme);
logoHitContainer.appendChild(logoHit);
logoLhasaContainer.appendChild(logoLhasa);
logoIztapalapaContainer.appendChild(logoIztapalapa);
logoAdomexContainer.appendChild(logoAdomex);
logoWDBFContainer.appendChild(logoWDBF);
