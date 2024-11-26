const body = document.querySelector("body");
const header = document.querySelector(".header");
const dropdown = document.querySelector(".dropdown");
const dropbtn = document.querySelector(".dropbtn");
const dropdownContent = document.querySelector(".dropdown-content");
const homeMobile = document.querySelector(".homeMobile");
const equiposMobile = document.querySelector(".equiposMobile");
const palmaresMobile = document.querySelector(".palmaresMobile");
const uneteMobile = document.querySelector(".uneteMobile");
const valoresMobile = document.querySelector(".valoresMobile");
const fotosMobile = document.querySelector(".fotosMobile");
const contactoMobile = document.querySelector(".contactoMobile");

const listleft = document.querySelector(".listleft");
const equiposDesktop = document.querySelector(".equiposDesktop");
const palmaresDesktop = document.querySelector(".palmaresDesktop");
const uneteDesktop = document.querySelector(".uneteDesktop");
const listright = document.querySelector(".listright");
const valoresDesktop = document.querySelector(".valoresDesktop");
const fotosDesktop = document.querySelector(".fotosDesktop");
const contactoDesktop = document.querySelector(".contactoDesktop");
const homeDesktop = document.querySelector(".homeDesktop");
const logoLobosContainer = document.querySelector(".logoLobosContainer");
let logoLobos = document.createElement("img");

dropbtn.textContent = "Menu";

homeMobile.textContent = "Home";
equiposMobile.textContent = "Equipos";
palmaresMobile.textContent = "Palmarés";
uneteMobile.textContent = "Únete";
valoresMobile.textContent = "Valores";
fotosMobile.textContent = "Fotos";
contactoMobile.textContent = "Contacto";

equiposDesktop.textContent = "Equipos";
palmaresDesktop.textContent = "Palmarés";
uneteDesktop.textContent = "Únete";
valoresDesktop.textContent = "Valores";
fotosDesktop.textContent = "Fotos";
contactoDesktop.textContent = "Contacto";

// dropdownContent.appendChild("homeMobile");
// dropdownContent.appendChild("equiposMobile");
// dropdownContent.appendChild("palmaresMobile");
// dropdownContent.appendChild("fotosMobile");
// dropdownContent.appendChild("contactoMobile");

// NAVBAR PATHING FUNTIONALITY
if (
  window.location.pathname.includes("/equipofemenil/") ||
  window.location.pathname.includes("/equipomixto/") ||
  window.location.pathname.includes("/equipovaronil/")
) {
  homeMobile.href = "../../index.html";
  homeDesktop.href = "../../index.html";
  equiposMobile.href = "../index.html";
  equiposDesktop.href = "../index.html";
  palmaresMobile.href = "../../palmares/index.html";
  palmaresDesktop.href = "../../palmares/index.html";
  uneteMobile.href = "../../unete/index.html";
  uneteDesktop.href = "../../unete/index.html";
  valoresMobile.href = "../../valores/index.html";
  valoresDesktop.href = "../../valores/index.html";
  fotosMobile.href = "../../index.html#fotos";
  fotosDesktop.href = "../../index.html#fotos";
  contactoMobile.href = "../../index.html#contacto";
  contactoDesktop.href = "../../index.html#contacto";
  logoLobos.src = "../../images/logo-lobos.png";
  console.log("YEAAAH BUDDY");
} else if (window.location.pathname.includes("/equipos")) {
  homeMobile.href = "../index.html";
  homeDesktop.href = "../index.html";
  equiposMobile.href = "index.html";
  equiposDesktop.href = "index.html";
  palmaresMobile.href = "../palmares/index.html";
  palmaresDesktop.href = "../palmares/index.html";
  uneteMobile.href = "../unete/index.html";
  uneteDesktop.href = "../unete/index.html";
  valoresMobile.href = "../valores/index.html";
  valoresDesktop.href = "../valores/index.html";
  fotosMobile.href = "../index.html#fotos";
  fotosDesktop.href = "../index.html#fotos";
  contactoMobile.href = "../index.html#contacto";
  contactoDesktop.href = "../index.html#contacto";
  logoLobos.src = "../images/logo-lobos.png";
} else if (window.location.pathname.includes("/palmares/")) {
  homeMobile.href = "../index.html";
  homeDesktop.href = "../index.html";
  equiposMobile.href = "../equipos/index.html";
  equiposDesktop.href = "../equipos/index.html";
  palmaresMobile.href = "index.html";
  palmaresDesktop.href = "index.html";
  uneteMobile.href = "../unete/index.html";
  uneteDesktop.href = "../unete/index.html";
  valoresMobile.href = "../valores/index.html";
  valoresDesktop.href = "../valores/index.html";
  fotosMobile.href = "../index.html#fotos";
  fotosDesktop.href = "../index.html#fotos";
  contactoMobile.href = "../index.html#contacto";
  contactoDesktop.href = "../index.html#contacto";
  logoLobos.src = "../images/logo-lobos.png";
  console.log("palmares");
} else if (window.location.pathname.includes("/unete/")) {
  homeMobile.href = "../index.html";
  homeDesktop.href = "../index.html";
  equiposMobile.href = "../equipos/index.html";
  equiposDesktop.href = "../equipos/index.html";
  palmaresMobile.href = "../palmares/index.html";
  palmaresDesktop.href = "../palmares/index.html";
  uneteMobile.href = "index.html";
  uneteDesktop.href = "index.html";
  valoresMobile.href = "../valores/index.html";
  valoresDesktop.href = "../valores/index.html";
  fotosMobile.href = "../index.html#fotos";
  fotosDesktop.href = "../index.html#fotos";
  contactoMobile.href = "../index.html#contacto";
  contactoDesktop.href = "../index.html#contacto";
  logoLobos.src = "../images/logo-lobos.png";
  console.log("palmares");
} else if (window.location.pathname.includes("/valores/")) {
  homeMobile.href = "../index.html";
  homeDesktop.href = "../index.html";
  equiposMobile.href = "../equipos/index.html";
  equiposDesktop.href = "../equipos/index.html";
  palmaresMobile.href = "../palmares/index.html";
  palmaresDesktop.href = "../palmares/index.html";
  uneteMobile.href = "../unete/index.html";
  uneteDesktop.href = "../unete/index.html";
  valoresMobile.href = "index.html";
  valoresDesktop.href = "index.html";
  fotosMobile.href = "../index.html#fotos";
  fotosDesktop.href = "../index.html#fotos";
  contactoMobile.href = "../index.html#contacto";
  contactoDesktop.href = "../index.html#contacto";
  logoLobos.src = "../images/logo-lobos.png";
  console.log("palmares");
} else {
  homeMobile.href = "index.html";
  homeDesktop.href = "index.html";
  equiposMobile.href = "equipos/index.html";
  equiposDesktop.href = "equipos/index.html";
  palmaresMobile.href = "palmares/index.html";
  palmaresDesktop.href = "palmares/index.html";
  uneteMobile.href = "unete/index.html";
  uneteDesktop.href = "unete/index.html";
  valoresMobile.href = "valores/index.html";
  valoresDesktop.href = "valores/index.html";
  fotosMobile.href = "index.html#fotos";
  fotosDesktop.href = "index.html#fotos";
  contactoMobile.href = "index.html#contacto";
  contactoDesktop.href = "index.html#contacto";
  logoLobos.src = "images/logo-lobos.png";
  console.log("default");
}

// DOM BUILDING

logoLobosContainer.appendChild(logoLobos);
