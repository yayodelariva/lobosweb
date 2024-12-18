class Player {
  constructor(name, container, portrait, id) {
    this.name = name;
    this.container = container;
    this.image = new Image();
    this.image.src = portrait;
    this.image.alt = `${name}'s Portrait`;
    this.id = id;
  }

  generateDom() {
    if (!this.container) {
      console.error(`Container for ${this.name} is not defined.`);
      return;
    }

    // Create a wrapper for player info
    const playerWrapper = document.createElement("div");
    playerWrapper.classList.add("playerWrapper");
    playerWrapper.setAttribute("id", this.id);

    // Create and append player name
    const playerName = document.createElement("div");
    playerName.classList.add("playerName");
    playerName.innerText = this.name;
    playerWrapper.appendChild(playerName);

    // Append player image
    playerWrapper.appendChild(this.image);

    // Append wrapper to the container
    while (this.container.hasChildNodes()) {
      this.container.removeChild(this.container.firstChild);
    }
    this.container.appendChild(playerWrapper);
  }
}

const luisDeLaRivaPortrait = new Player(
  "Luis Gabriel de la Riva Pérez",
  document.querySelector("#luisDeLaRiva"),
  "../../images/players/portraits/luisDeLaRivaPortrait.jpg",
  "luisDeLaRiva"
);

const barbaraFuentesPortrait = new Player(
  "Barbara Fuentes Flores",
  document.querySelector("#barbaraFuentes"),
  "../../images/players/portraits/barbaraFuentesPortrait.jpg",
  "barbaraFuentes"
);

const edgarGaliciaPortrait = new Player(
  "Edgar Galicia",
  document.querySelector("#edgarGalicia"),
  "../../images/players/portraits/edgarGaliciaPortrait.jpg",
  "edgarGalicia"
);

const gianniToroPortrait = new Player(
  "Gianni Toro Miranda",
  document.querySelector("#gianniToro"),
  "../../images/players/portraits/gianniToroPortrait.jpg",
  "gianniToro"
);

const danielTellezPortrait = new Player(
  "Armando Daniel Téllez Pallares",
  document.querySelector("#danielTellez"),
  "../../images/players/portraits/danielTellezPortrait.jpg",
  "danielTellez"
);

const paolaCastilloPortrait = new Player(
  "Sandra Paola Aguayo Castillo",
  document.querySelector("#paolaCastillo"),
  "../../images/players/portraits/paolaCastilloPortrait.jpg",
  "paolaCastillo"
);

const randyCastilloPortrait = new Player(
  "Kurt Randy Aguayo Castillo",
  document.querySelector("#randyCastillo"),
  "../../images/players/portraits/randyCastilloPortrait.jpg",
  "randyCastillo"
);

const fernandoLeonPortrait = new Player(
  "José Fernando León Martínez",
  document.querySelector("#fernandoLeon"),
  "../../images/players/portraits/fernandoLeonPortrait.jpg",
  "fernandoLeon"
);

const farrellEstradaPortrait = new Player(
  "Farrel Estrada Ornelas",
  document.querySelector("#farrellEstrada"),
  "../../images/players/portraits/farrellEstradaPortrait.jpg",
  "farrellEstrada"
);

const sabrinaHuertaPortrait = new Player(
  "Sabrina Selene Huerta Monroy",
  document.querySelector("#sabrinaHuerta"),
  "../../images/players/portraits/sabrinaHuertaPortrait.jpg",
  "sabrinaHuerta"
);

// DOM GENERATION
luisDeLaRivaPortrait.generateDom();
barbaraFuentesPortrait.generateDom();
edgarGaliciaPortrait.generateDom();
gianniToroPortrait.generateDom();
danielTellezPortrait.generateDom();
paolaCastilloPortrait.generateDom();
randyCastilloPortrait.generateDom();
fernandoLeonPortrait.generateDom();
farrellEstradaPortrait.generateDom();
sabrinaHuertaPortrait.generateDom();
