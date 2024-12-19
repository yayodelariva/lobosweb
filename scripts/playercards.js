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
const playercardNickname = document.querySelector(".nicknameText");
const playercardHand = document.querySelector(".handText");
const playercardBall = document.querySelector(".ballText");
const playercardCategory = document.querySelector(".categoryText");
const playercardTeams = document.querySelector(".teamsText");
const playercardHeight = document.querySelector(".heightText");
const playercardYears = document.querySelector(".yearsText");
const playercardDraft = document.querySelector(".draftText");
const playercardInstagram = document.querySelector(".instagramText");
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
  "ambos",
  "1.90cm",
  "Varonil",
  "10",
  "Diestro",
  "Husky, Guerreros Jaguar, Mexicas",
  "8",
  "@luisdelariva11",
  "../../images/players/playercards/luisDeLaRivaPlayercard.jpg"
);

const barbaraFuentes = new playercard(
  "8 Barbara Fuentes Flores",
  "Extremo",
  '"Fuentes"',
  "ambos",
  "1.58m",
  "Femenil",
  "6",
  "Diestro",
  "Huskys",
  "1",
  "@_barbtender_",
  "../../images/players/playercards/barbaraFuentesPlayercard.jpg"
);

const gianniToro = new playercard(
  "7 Gianni Toro Miranda",
  "Extremo",
  '"Toro"',
  "ambos",
  "1.73m",
  "Varonil",
  "9",
  "Diestro",
  "Club Gauss, Vaquitas Marinas, Mexicas Cloth",
  "2",
  "@giannitm007",
  "../../images/players/portraits/gianniToroPortrait.jpg"
);

const danielTellez = new playercard(
  "2 Armando Daniel TÉllez Pallares",
  "Lateral",
  '"Dani"',
  "ambos",
  "1.76m",
  "Mixto",
  "6",
  "Diestro",
  "Cat Dodgeball, Blasters, Ahuizotl, TlaloCloth",
  "3",
  "@danieltp2000",
  "../../images/players/playercards/danielTellezPlayercard.jpg"
);

const fernandoLeon = new playercard(
  "12 JosÉ Fernando LeÓn MartÍnez",
  "Extremo",
  '"LeÓn"',
  "ambos",
  "172cm",
  "Mixto",
  "1",
  "Diestro",
  "Tlalocloth",
  "1",
  "@feer._mtz",
  "../../images/players/playercards/fernandoLeonPlayercard.jpg"
);

const farrellEstrada = new playercard(
  "10 Farrell Estrada Ornelas",
  "Lateral",
  '"F. Estrada"',
  "ambos",
  "1.70m",
  "Mixto",
  "3",
  "Diestro",
  "Oozma Kappa, Vaquitas Marinas",
  "1",
  "@farrell_eo",
  "../../images/players/playercards/farrellEstradaPlayercard.jpg"
);

const ceciliaRodriguez = new playercard(
  "2 Cecilia RodrÍguez de la Vega Isaza",
  "Extremo",
  '"Pinky"',
  "ambos",
  "1.56m",
  "Femenil",
  "1",
  "Diestro",
  "Quetzales, Tic Tac Cloc",
  "1",
  "@blue.sunflower._",
  "../../images/players/playercards/ceciliaRodriguezPlayercard.jpg"
);

const enriqueHuato = new playercard(
  "7 Enrique Huato Montes",
  "Extremo",
  '"Huato"',
  "ambos",
  "1.80m",
  "Mixto",
  "6",
  "Diestro",
  "Ahuizotl, Alebrijes, Clothstars",
  "4",
  "@huato82",
  "../../images/players/playercards/enriqueHuatoPlayercard.jpg"
);

const shelsyEstrada = new playercard(
  "18 Shelsy Estrada Ornelas",
  "Extremo",
  '"Ornelas"',
  "ambos",
  "1.58m",
  "Mixto",
  "3",
  "Diestro",
  "Oozma Kappa, Euler, Ballbarians",
  "3",
  "@shelsy_ornelas",
  "../../images/players/playercards/shelsyEstradaPlayercard.jpg"
);

const randyCastillo = new playercard(
  "25 Kurt Randy Aguayo Castillo",
  "Extremo",
  '"Randy"',
  "ambos",
  "1.74m",
  "Mixto",
  "6",
  "Diestro",
  "Mugis, Quetzales, Tic Tac Cloth",
  "3",
  "@randy_cast1",
  "../../images/players/portraits/randyCastilloPortrait.jpg"
);

const edgarGalicia = new playercard(
  "9 Edgar Galicia",
  "Extremo",
  '"Eddie"',
  "ambos",
  "1.72m",
  "Mixto",
  "3",
  "Diestro",
  "Club Gauss, Vaquitas Marinas, Clothstars",
  "3",
  "@eddie.galicia",
  "../../images/players/playercards/edgarGaliciaPlayercard.jpg"
);

const estelaGalavis = new playercard(
  "10 Blanca Estela Santos Galavis",
  "Extremo",
  '"Estela"',
  "ambos",
  "1.52m",
  "Femenil",
  "3",
  "Diestro",
  "Cat Dodgeball, Oozma Kappa, Astromelias, Euler Femenil, Trooper Cloth",
  "2",
  "@estela.esg5",
  "../../images/players/playercards/estelaGalavisPlayercard.jpg"
);

const deniseMejia = new playercard(
  "8 Denise AngÉlica MejÍa GonzÁlez",
  "Extremo",
  '"Den"',
  "ambos",
  "1.60m",
  "Mixto",
  "1",
  "Diestro",
  "Alebrijes, Sirens, Tlalocloth",
  "1",
  "@deni_mejia",
  "../../images/players/playercards/deniseMejiaPlayercard.jpg"
);

const danielaCruz = new playercard(
  "14 Daniela Aitana Cruz Llanos",
  "Extremo",
  '"Danny"',
  "ambos",
  "1.67m",
  "Femenil",
  "2",
  "Diestro",
  "Gauss, Sirens",
  "3",
  "@dani_aitana06",
  "../../images/players/playercards/danielaCruzPlayercard.jpg"
);

const rogelioMorales = new playercard(
  "3 Rogelio Morales SÁnchez",
  "Extremo",
  '"Roy"',
  "ambos",
  "1.76m",
  "Mixto",
  "7",
  "Diestro",
  "Hokusai, Mandalorians, Mexicas",
  "3",
  "@roymsa",
  "../../images/players/portraits/rogelioMoralesPortrait.jpg"
);

const paolaCastillo = new playercard(
  "1 / 11 Sandra Paola Aguayo Castillo",
  "Extremo",
  '"Pao"',
  "ambos",
  "1.69m",
  "Femenil",
  "3",
  "Diestro",
  "Sirenas, Alebrijes, Tlalocloth",
  "3",
  "@_pao_castillo__",
  "../../images/players/playercards/paolaCastilloPlayercard.jpg"
);

const carlosDeLaRiva = new playercard(
  "23 Carlos Emilio de la Riva Morales",
  "Coach",
  '"Pato"',
  "ambos",
  "1.80m",
  "Mixto",
  "2",
  "Diestro",
  "Huskys, Guerreros Jaguares, Mexicas",
  "1",
  "",
  "../../images/players/playercards/carlosDeLaRivaPlayercard.jpg"
);

const cesarArellano = new playercard(
  "5 CÉsar Alejandro Arellano RuÍz",
  "Extremo",
  '"Arellano / Alex"',
  "ambos",
  "1.75m",
  "Mixto",
  "4",
  "Diestro",
  "Mexicas, Ahuizotl",
  "2",
  "",
  "../../images/players/playercards/cesarArellanoPlayercard.jpg"
);

const sabrinaHuerta = new playercard(
  "55 Sabrina Selene Huerta Monroy",
  "Extremo",
  '"Sabrix"',
  "ambos",
  "1.69m",
  "Mixto",
  "4",
  "Diestro",
  "PinUp Rebels, Mexicas",
  "2",
  "@Sabrixxa_55",
  "../../images/players/playercards/sabrinaHuertaPlayercard.jpg"
);

const susanaGutierrez = new playercard(
  "8 Susana Ximena GutiÉrrez Alanis",
  "Extremo",
  '"Susy"',
  "ambos",
  "1.65m",
  "Mixto",
  "5",
  "Diestro",
  "Alebrijes, Pin Up Rebels, Clothstars",
  "2",
  "@suguza8",
  "../../images/players/playercards/susanaGutierrezPlayercard.jpg"
);

const franciscoRivera = new playercard(
  "19 Francisco Rivera RamÍrez",
  "Extremo",
  '"Fred"',
  "ambos",
  "1.74m",
  "Mixto",
  "2",
  "Diestro",
  "Blasters, Guerreros Jaguar",
  "Cero",
  "@Freddlechuga",
  "../../images/players/playercards/logo-lobos.png"
);

const rocioHernandez = new playercard(
  "11 Rocio Guadalupe HernÁndez HernÁndez",
  "Extremo",
  '"Uchiha"',
  "ambos",
  "1.54m",
  "Mixto",
  "1.5",
  "Diestro",
  "Mapaches/Astromelias",
  "1",
  "@rocio.uchiha.11",
  "../../images/players/playercards/logo-lobos.png"
);

const saraCeron = new playercard(
  "7 Sara Flora MarÍa CerÓn Garrido",
  "Extremo",
  '"Nana"',
  "ambos",
  "1.60m",
  "Mixto",
  "Ninguno",
  "Diestro",
  "Lobos",
  "",
  "@nanabloodstone",
  "../../images/players/playercards/logo-lobos.png"
);

const lennySandoval = new playercard(
  "15 Lenny Elizabeth Sandoval Sanchez",
  "Extremo",
  '"Lenny"',
  "ambos",
  "1.55m",
  "Mixto",
  "Casi 2",
  "Diestro",
  "Quetzales",
  "1",
  "@leninger7",
  "../../images/players/portraits/lennySandovalPortrait.jpg"
);

const leonardoSegura = new playercard(
  "3 Leonardo Axel Segura Flores",
  "Extremo",
  '"Axel"',
  "ambos",
  "1.7m",
  "Mixto",
  "1",
  "Diestro",
  "Rebel Deadlock",
  "",
  "@axelsfla",
  "../../images/players/playercards/logo-lobos.png"
);

const jensenFernandez = new playercard(
  "22 Jensen Fernandez",
  "Extremo",
  '"Jensen"',
  "ambos",
  "170cm",
  "Mixto",
  "11",
  "Diestro",
  "Mugis, Oozma Kappa",
  "2",
  "@J.ensn",
  "../../images/players/playercards/logo-lobos.png"
);

const gabrielSanchez = new playercard(
  "21 Hebert Gabriel SÁnchez MartÍnez",
  "Extremo",
  '"Gabo jefe"',
  "ambos",
  "1.73m",
  "Mixto",
  "2 meses",
  "Diestro",
  "",
  "1",
  "@gabo_sanm",
  "../../images/players/playercards/logo-lobos.png"
);

const alejandroDorantes = new playercard(
  "5 Alejandro Dorantes",
  "Extremo",
  '"Dorantes"',
  "ambos",
  "1.80m",
  "Mixto",
  "4",
  "Diestro",
  "Quetzales",
  "2",
  "@alejandro.dorantes92",
  "../../images/players/playercards/logo-lobos.png"
);

const icon = document.createElement("img");
icon.src = "../../../icons/close.png";

playerWrapper.forEach((a) =>
  a.addEventListener("click", handleClickedPlayercard)
);
cancelIcon.addEventListener("click", closePlayercard);

function handleClickedPlayercard(e) {
  console.log("click");
  equiposWrapperContainer.style.alignItems = "center";
  equiposWrapper.style.display = "none";
  playercardDOM.style.display = "grid";
  cancelIcon.appendChild(icon);
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

function closePlayercard() {
  playercardDOM.style.display = "none";
  equiposWrapper.style.display = "flex";
  if (playercardFoto.hasChildNodes()) {
    playercardFoto.removeChild(playercardFoto.lastChild);
  }
}
