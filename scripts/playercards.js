const equiposWrapperContainer = document.querySelector(
  ".equiposWrapperContainer"
);
const roster = document.querySelectorAll("#roster");
const playerWrapper = document.querySelectorAll(".playerWrapper");
const equiposWrapper = document.querySelector(".equiposwrapper");
const player = document.querySelector(".player");
const playerName = document.querySelector(".playerName");
const playerAge = document.querySelector(".playerAge");
const playercardDOM = document.querySelector(".playercard");
const playercardName = document.querySelector(".playercardName");
const playercardPosition = document.querySelector(".playercardPosition");
const playercardNickname = document.querySelector(".playercardNickname");
const playercardHand = document.querySelector(".playercardHand");
const playercardBall = document.querySelector(".playercardBall");
const playercardCategory = document.querySelector(".playercardCategory");
const playercardTeams = document.querySelector(".playercardTeams");
const playercardHeight = document.querySelector(".playercardHeight");
const playercardYears = document.querySelector(".playercardYears");
const playercardDraft = document.querySelector(".playercardDraft");
const playercardInstagram = document.querySelector(".playercardInstagram");
const playercardFoto = document.querySelector(".playercardFoto");
const playercardNameTag = document.createElement("div");
const cancelIcon = document.querySelector(".cancelIconContainer");
const luisPortrait = document.querySelector("#luisDeLaRiva");

class playercard {
  constructor(
    name,
    position,
    nickname,
    ball,
    height,
    category,
    years,
    hand,
    teams,
    draft,
    instagram,
    foto
  ) {
    this.name = name;
    this.position = position;
    this.nickname = nickname;
    this.ball = ball;
    this.height = height;
    this.category = category;
    this.years = years;
    this.hand = hand;
    this.teams = teams;
    this.draft = draft;
    this.instagram = instagram;
    this.image = new Image();
    this.image.src = foto;
  }

  generatePlayerCard() {
    playercardName.innerText = this.name;
    playercardPosition.innerText = this.position;
    playercardNickname.innerText = this.nickname;
    playercardHand.innerText = this.hand;
    playercardBall.innerText = this.ball;
    playercardCategory.innerText = this.category;
    playercardTeams.innerText = this.teams;
    playercardHeight.innerText = this.height;
    playercardYears.innerText = this.years;
    playercardDraft.innerText = this.draft;
    playercardInstagram.innerText = this.instagram;
    playercardFoto.appendChild(this.image);
  }
}

const luisDeLaRiva = new playercard(
  "11 Luis de la Riva",
  "Centro",
  '"de la Riva"',
  "Ambas",
  "1.90cm",
  "Varonil",
  "10",
  "Diestro",
  "Husky, Guerreros Jaguar, Mexicas",
  "8",
  "@luisdelariva11",
  "../images/players/portraits/luisDeLaRivaPortrait.jpg"
);

const barbaraFuentes = new playercard(
  "8 Barbara Fuentes Flores",
  "Extremo",
  "Fuentes",
  "Ambas",
  "1.58m",
  "Femenil",
  "6",
  "Diestro",
  "Huskys",
  "1",
  "@_barbtender_",
  "../images/players/portraits/barbaraFuentesPortrait.jpg"
);

const gianniToro = new playercard(
  "7 Gianni Toro Miranda",
  "Extremo",
  "Toro",
  "Ambas",
  "1.73m",
  "Varonil",
  "9",
  "Diestro",
  "Club Gauss / Vaquitas Marinas / Mexicas Cloth",
  "2",
  "@giannitm007",
  "../images/players/7_Gianni Toro.jpg"
);

const danielTellez = new playercard(
  "2 Armando Daniel Téllez Pallares",
  "Lateral",
  "Dani",
  "Ambas",
  "1.76m",
  "Mixto",
  "6",
  "Diestro",
  "Cat Dodgeball, Blasters, Ahuizotl, TlaloCloth",
  "3",
  "@danieltp2000",
  "../images/players/13_Daniel Tellez.jpg"
);

const fernandoLeon = new playercard(
  "12 José Fernando León Martínez",
  "Extremo",
  "León",
  "Ambas",
  "172cm",
  "Mixto",
  "1",
  "Diestro",
  "Tlalocloth",
  "1",
  "@feer._mtz",
  "../images/players/12_Fernando Leon.jpg"
);

const farrellEstrada = new playercard(
  "10 Farrell Estrada Ornelas",
  "Lateral",
  "F. Estrada",
  "Ambas",
  "1.70m",
  "Mixto",
  "3",
  "Diestro",
  "Oozma Kappa | Vaquitas Marinas",
  "1",
  "@farrell_eo",
  "../images/players/10_Farrell Estrada Ornelas.jpg"
);

const ceciliaRodriguez = new playercard(
  "2 Cecilia Rodríguez de la Vega Isaza",
  "Extremo",
  "Pinky",
  "Ambas",
  "1.56m",
  "Femenil",
  "1",
  "Diestro",
  "Quetzales, Tic Tac Cloc",
  "1",
  "@blue.sunflower._",
  "../images/players/2_Cecilia Rodriguez (Pinky).jpg"
);

const enriqueHuato = new playercard(
  "7 Enrique Huato Montes",
  "Extremo",
  "Huato",
  "Ambas",
  "1.80m",
  "Mixto",
  "6",
  "Diestro",
  "Ahuizotl Alebrijes Clothstars",
  "4",
  "@huato82",
  "../images/players/7_Enrique Huato.jpg"
);

const shelsyEstrada = new playercard(
  "18 Shelsy Estrada Ornelas",
  "Extremo",
  "Ornelas",
  "Ambas",
  "1.58m",
  "Mixto",
  "3",
  "Diestro",
  "Oozma Kappa / Euler / Ballbarians",
  "3",
  "@shelsy_ornelas",
  "../images/players/18_Shelsy Estrada Ornelas.jpg"
);

const randyCastillo = new playercard(
  "25 Kurt Randy Aguayo Castillo",
  "Extremo",
  "Randy",
  "Ambas",
  "1.74m",
  "Mixto",
  "6",
  "Diestro",
  "Mugis, Quetzales y Tic Tac Cloth",
  "3",
  "@randy_cast1",
  "../images/players/25_Randy Castillo.jpg"
);

const edgarGalicia = new playercard(
  "9 Edgar Galicia",
  "Extremo",
  "Eddie",
  "Ambas",
  "1.72m",
  "Mixto",
  "3",
  "Diestro",
  "Club Gauss/Vaquitas Marinas/Clothstars",
  "3",
  "@eddie.galicia",
  "../images/players/9_Edgar Galicia.jpg"
);

const estelaGalavis = new playercard(
  "10 Blanca Estela Santos Galavis",
  "Extremo",
  "Estela",
  "Ambas",
  "1.52m",
  "Femenil",
  "3",
  "Diestro",
  "Cat Dodgeball, Oozma Kappa, Astromelias, Euler Femenil y Trooper Cloth",
  "2",
  "@estela.esg5",
  "../images/players/10_Estela Galavis.jpg"
);

const deniseMejia = new playercard(
  "8 Denise Angélica Mejía González",
  "Extremo",
  "Den",
  "Ambas",
  "1.60m",
  "Mixto",
  "1",
  "Diestro",
  "Alebrijes, Sirens, Tlalocloth",
  "1",
  "@deni_mejia",
  "../images/players/8_Denise Mejía.jpg"
);

const danielaCruz = new playercard(
  "14 Daniela Aitana Cruz Llanos",
  "Extremo",
  "Danny",
  "Ambas",
  "1.67m",
  "Femenil",
  "2",
  "Diestro",
  "2, mixto-Gauss femenil-Sirens",
  "3",
  "@dani_aitana06",
  "../images/players/24_Daniela Aitana Cruz.jpg"
);

const rogelioMorales = new playercard(
  "3 Rogelio Morales Sánchez",
  "Extremo",
  "Roy",
  "Ambas",
  "1.76m",
  "Mixto",
  "7",
  "Diestro",
  "Hokusai, Mandalorians, Mexicas",
  "3",
  "@roymsa",
  "../images/players/3_Rogelio Morales.jpg"
);

const paolaCastillo = new playercard(
  "1 / 11 Sandra Paola Aguayo Castillo",
  "Extremo",
  "Pao",
  "Ambas",
  "1.69m",
  "Femenil",
  "3",
  "Diestro",
  "Sirenas, Alebrijes y Tlalocloth",
  "3",
  "@_pao_castillo__",
  "../images/players/1_Paola Castillo.jpg"
);

const carlosDeLaRiva = new playercard(
  "23 Carlos Emilio de la Riva Morales",
  "Extremo",
  "Pato",
  "Ambas",
  "1.80m",
  "Mixto",
  "2",
  "Diestro",
  "Huskys, Guerreros Jaguares, Mexicas",
  "1",
  "",
  "../images/players/Coach_Carlos de la Riva (Pato).jpg"
);

const cesarArellano = new playercard(
  "5 César Alejandro Arellano Ruíz",
  "Extremo",
  "Arellano / Alex",
  "Ambas",
  "1.75m",
  "Mixto",
  "4",
  "Diestro",
  "Mexicas, Ahuizotl",
  "2",
  "",
  "../images/players/55_César Arellano.jpg"
);

const sabrinaHuerta = new playercard(
  "55 Sabrina Selene Huerta Monroy",
  "Extremo",
  "Sabrix",
  "Ambas",
  "1.69m",
  "Mixto",
  "4",
  "Diestro",
  "PinUp Rebels, Mexicas",
  "2",
  "@Sabrixxa_55",
  "../images/players/55_Sabrina Huerta.jpg"
);

const susanaGutierrez = new playercard(
  "8 Susana Ximena Gutiérrez Alanis",
  "Extremo",
  "Susy",
  "Ambas",
  "1.65m",
  "Mixto",
  "5",
  "Diestro",
  "Alebrijes, Pin Up Rebels, Clothstars",
  "2",
  "@suguza8",
  "../images/players/18_Susana Gutierrez.jpg"
);

const franciscoRivera = new playercard(
  "19 Francisco Rivera Ramírez",
  "Extremo",
  "Fred",
  "Ambas",
  "1.74m",
  "Mixto",
  "2",
  "Diestro",
  "Blasters, Guerreros Jaguar",
  "Cero",
  "@Freddlechuga",
  "../images/players/19_Francisco Rivera.jpg"
);

const rocioHernandez = new playercard(
  "11 Rocio Guadalupe Hernández Hernández",
  "Extremo",
  "Uchiha",
  "Ambas",
  "1.54m",
  "Mixto",
  "1.5",
  "Diestro",
  "Mapaches/Astromelias",
  "1",
  "@rocio.uchiha.11",
  "../images/players/11_Rocio_Hernandez.jpg"
);

const saraCeron = new playercard(
  "7 Sara Flora María Cerón Garrido",
  "Extremo",
  "Nana",
  "Ambas",
  "1.60m",
  "Mixto",
  "Ninguno",
  "Diestro",
  "Lobos",
  "Ninguna",
  "@nanabloodstone",
  "../images/players/7_Sara_Ceron.jpg"
);

const lennySandoval = new playercard(
  "15 Lenny Elizabeth Sandoval Sanchez",
  "Extremo",
  "Lenny",
  "Ambas",
  "1.55m",
  "Mixto",
  "Casi 2",
  "Diestro",
  "Quetzales",
  "1",
  "@leninger7",
  "../images/players/15_Lenny Sandoval.jpg"
);

const leonardoSegura = new playercard(
  "3 Leonardo Axel Segura Flores",
  "Extremo",
  "Axel",
  "Ambas",
  "1.7m",
  "Mixto",
  "1",
  "Diestro",
  "Rebel Deadlock",
  "0",
  "@axelsfla",
  "../images/players/3_Leonardo_Segura.jpg"
);

const jensenFernandez = new playercard(
  "22 Jensen Fernandez",
  "Extremo",
  "Jensen",
  "Ambas",
  "170cm",
  "Mixto",
  "11",
  "Diestro",
  "Mugis, Oozma Kappa",
  "2",
  "@J.ensn",
  "../images/players/22_Jensen_Fernandez.jpg"
);

const gabrielSanchez = new playercard(
  "21 Hebert Gabriel Sánchez Martínez",
  "Extremo",
  "Gabo jefe",
  "Ambas",
  "1.73m",
  "Mixto",
  "2 meses",
  "Diestro",
  "No",
  "1",
  "@gabo_sanm",
  "../images/players/21_Hebert_Gabriel.jpg"
);

const alejandroDorantes = new playercard(
  "5 Alejandro Dorantes",
  "Extremo",
  "Dorantes",
  "Ambas",
  "1.80m",
  "Mixto",
  "4",
  "Diestro",
  "Quetzales",
  "2",
  "@alejandro.dorantes92",
  "../images/players/5_Alejandro_Dorantes.jpg"
);

playerWrapper.forEach((a) =>
  a.addEventListener("click", handleClickedPlayercard)
);
cancelIcon.addEventListener("click", function () {
  playercardDOM.style.display = "none";
  equiposWrapper.style.display = "flex";
  if (playercardFoto.hasChildNodes()) {
    playercardFoto.removeChild(playercardFoto.lastChild);
  }
});

function handleClickedPlayercard(e) {
  console.log("click");
  equiposWrapperContainer.style.alignItems = "center";
  equiposWrapper.style.display = "none";
  playercardDOM.style.display = "grid";
  let clickedPlayer = e.target.id;
  switch (clickedPlayer) {
    case "luisDeLaRiva":
      luisDeLaRiva.generatePlayerCard();
      break;
    case "barbaraFuentes":
      barbaraFuentes.generatePlayerCard();
      break;
    case "gianniToro":
      gianniToro.generatePlayerCard();
      break;
    case "danielTellez":
      danielTellez.generatePlayerCard();
      break;
    case "fernandoLeon":
      fernandoLeon.generatePlayerCard();
      break;
    case "farrellEstrada":
      farrellEstrada.generatePlayerCard();
      break;
    case "ceciliaRodriguez":
      ceciliaRodriguez.generatePlayerCard();
      break;
    case "enriqueHuato":
      enriqueHuato.generatePlayerCard();
      break;
    case "shelsyEstrada":
      shelsyEstrada.generatePlayerCard();
      break;
    case "randyCastillo":
      randyCastillo.generatePlayerCard();
      break;
    case "edgarGalicia":
      edgarGalicia.generatePlayerCard();
      break;
    case "estelaGalavis":
      estelaGalavis.generatePlayerCard();
      break;
    case "deniseMejia":
      deniseMejia.generatePlayerCard();
      break;
    case "danielaCruz":
      danielaCruz.generatePlayerCard();
      break;
    case "rogelioMorales":
      rogelioMorales.generatePlayerCard();
      break;
    case "paolaCastillo":
      paolaCastillo.generatePlayerCard();
      break;
    case "carlosDeLaRiva":
      carlosDeLaRiva.generatePlayerCard();
      break;
    case "cesarArellano":
      cesarArellano.generatePlayerCard();
      break;
    case "sabrinaHuerta":
      sabrinaHuerta.generatePlayerCard();
      break;
    case "susanaGutierrez":
      susanaGutierrez.generatePlayerCard();
      break;
    case "franciscoRivera":
      franciscoRivera.generatePlayerCard();
      break;
    case "rocioHernandez":
      rocioHernandez.generatePlayerCard();
      break;
    case "saraCeron":
      saraCeron.generatePlayerCard();
      break;
    case "lennySandoval":
      lennySandoval.generatePlayerCard();
      break;
    case "leonardoSegura":
      leonardoSegura.generatePlayerCard();
      break;
    case "jensenFernandez":
      jensenFernandez.generatePlayerCard();
      break;
    case "gabrielSanchez":
      gabrielSanchez.generatePlayerCard();
      break;
    case "alejandroDorantes":
      alejandroDorantes.generatePlayerCard();
      break;
    default:
      equiposWrapperContainer.style.alignItems = "center";
      equiposWrapper.style.display = "flex";
      playercardDOM.style.display = "none";
      break;
  }
}
