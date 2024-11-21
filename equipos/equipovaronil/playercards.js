const equiposWrapperContainer = document.querySelector(
  ".equiposWrapperContainer"
);
const equiposWrapper = document.querySelector(".equiposwrapper");
const player = document.querySelector(".player");
const playerName = document.querySelector(".playerName");
const playerAge = document.querySelector(".playerAge");
const playercardDOM = document.querySelector(".playercard");
const playercardName = document.querySelector(".playercardName");
const playercardNumber = document.querySelector(".playercardNumber");
const playercardPosition = document.querySelector(".playercardPosition");
const playercardNickname = document.querySelector(".playercardNickname");
const playercardAge = document.querySelector(".playercardAge");
const playercardFoto = document.querySelector(".playercardFoto");

class playercard {
  constructor(number, name, position, nickname, birthday, age, foto) {
    this.number = number;
    this.name = name;
    this.position = position;
    this.nickname = nickname;
    this.birthday = birthday;
    this.age = age;
    this.image = new Image();
    this.image.src = foto;
  }

  generatePlayerCard() {
    playercardName.textContent = this.name;
    playercardAge.textContent = this.age;
    playercardNickname.textContent = this.nickname;
    playercardPosition.textContent = this.position;
    playercardFoto.appendChild(this.image);
  }
}

const luisDeLaRiva = new playercard(
  "11",
  "Luis de la Riva",
  "Centro",
  '"de la Riva"',
  "08/01/1992",
  "32",
  "../images/players/Luis.png"
);

const franciscoRivera = new playercard(
  "19",
  "Francisco Rivera",
  "Lateral",
  '"Fred"',
  "15/06/1997",
  "27"
);

const edgarGalicia = new playercard(
  "9",
  "Edgar Galicia",
  "Extremo",
  '"Galicia"',
  "13/08/1997",
  "27"
);

const reginaBadillo = new playercard(
  "9",
  "Regina Genoveva Badillo Vega",
  "Extremo, Lateral",
  '"Giigii"',
  "09/12/1995",
  "28"
);

const fernandoLeon = new playercard(
  "12",
  "José Fernando León Martínez",
  "Lateral, Centro",
  '"Fernando"',
  "12/03/2000",
  "24"
);

equiposWrapper.addEventListener("click", handleClickedPlayercard);

function handleClickedPlayercard(e) {
  equiposWrapperContainer.style.alignItems = "center";
  equiposWrapper.style.display = "none";
  playercardDOM.style.display = "grid";
  let clickedPlayer = e.target.id;
  switch (clickedPlayer) {
    case "luisDeLaRiva":
      alert("Luis");
      luisDeLaRiva.generatePlayerCard();
      break;
    case "franciscoRivera":
      alert("francisco");
      franciscoRivera.generatePlayerCard();
      break;
    case "edgarGalicia":
      alert("edgar");
      edgarGalicia.generatePlayerCard();
      break;
    case "reginaBadillo":
      alert("giigii");

      reginaBadillo.generatePlayerCard();
      break;
    case "fernandoLeon":
      alert("fernando");
      fernandoLeon.generatePlayerCard();
      break;
  }
}

// Luis.generatePlayerCard();
