const equiposWrapperContainer = document.querySelector(
  ".equiposWrapperContainer"
);
const roster = document.querySelector("#roster");
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
  "../images/players/Luis.png"
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
  "@_barbtender_"
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
  "@giannitm007"
);

const armandoTellez = new playercard(
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
  "@danieltp2000"
);

const joseLeon = new playercard(
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
  "@feer._mtz"
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
  "@farrell_eo"
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
  "@blue.sunflower._"
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
  "@huato82"
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
  "@shelsy_ornelas"
);

const kurtRandy = new playercard(
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
  "@randy_cast1"
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
  "@eddie.galicia"
);

const blancaEstela = new playercard(
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
  "@estela.esg5"
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
  "@deni_mejia"
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
  "@dani_aitana06"
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
  "@roymsa"
);

const sandraAguayo = new playercard(
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
  "@_pao_castillo__"
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
  ""
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
  ""
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
  "@Sabrixxa_55"
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
  "@suguza8"
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
  "@Freddlechuga"
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
  "@rocio.uchiha.11"
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
  "@nanabloodstone"
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
  "@leninger7"
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
  "@axelsfla"
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
  "@J.ensn"
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
  "@gabo_sanm"
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
  "@alejandro.dorantes92"
);

roster.addEventListener("click", handleClickedPlayercard);
cancelIcon.addEventListener("click", function () {
  playercardDOM.style.display = "none";
  equiposWrapper.style.display = "flex";
});

function handleClickedPlayercard(e) {
  equiposWrapperContainer.style.alignItems = "center";
  equiposWrapper.style.display = "none";
  playercardDOM.style.display = "grid";
  let clickedPlayer = e.target.id;
  switch (clickedPlayer) {
    case "luisDeLaRiva":
      luisDeLaRiva.generatePlayerCard();
      break;
    case "franciscoRivera":
      franciscoRivera.generatePlayerCard();
      break;
    case "edgarGalicia":
      edgarGalicia.generatePlayerCard();
      break;
    case "reginaBadillo":
      reginaBadillo.generatePlayerCard();
      break;
    case "fernandoLeon":
      fernandoLeon.generatePlayerCard();
      break;
  }
}
