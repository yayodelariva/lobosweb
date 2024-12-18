class Player {
  constructor(name, containers, portrait, id) {
    this.name = name;
    this.containers =
      Array.isArray(containers) || containers instanceof NodeList
        ? Array.from(containers)
        : [containers]; //checks if containers is an array or nodelist, and if it isnt then its a single element and converts it to an array by enclosing it in []
    this.image = new Image();
    this.image.src = portrait;
    this.image.alt = `${name}'s Portrait`;
    this.id = id;
  }

  generateDom() {
    if (!this.containers || this.containers.length === 0) {
      console.error(`Containers for ${this.name} are not defined or empty.`);
      return;
    }

    this.containers.forEach((container) => {
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
      playerWrapper.appendChild(this.image.cloneNode());

      // Clear existing content in the container and append the new wrapper
      while (container.hasChildNodes()) {
        container.removeChild(container.firstChild);
      }
      container.appendChild(playerWrapper);
    });
  }
}

const alejandroDorantesPortrait = new Player(
  "Alejandro Dorantes",
  document.querySelector("#alejandroDorantes"),
  "../../images/players/portraits/alejandroDorantesPortrait.jpg",
  "alejandroDorantes"
);

const barbaraFuentesPortrait = new Player(
  "Barbara Fuentes Flores",
  document.querySelector("#barbaraFuentes"),
  "../../images/players/portraits/barbaraFuentesPortrait.jpg",
  "barbaraFuentes"
);

const carlosDeLaRivaPortrait = new Player(
  "Carlos Emilio de la Riva Morales",
  document.querySelector("#carlosDeLaRiva"),
  "../../images/players/portraits/carlosDeLaRivaPortrait.jpg",
  "carlosDeLaRiva"
);

const ceciliaRodriguezPortrait = new Player(
  "Cecilia Rodríguez de la Vega Isaza",
  document.querySelector("#ceciliaRodriguez"),
  "../../images/players/portraits/ceciliaRodriguezPortrait.jpg",
  "ceciliaRodriguez"
);

const cesarArellanoPortrait = new Player(
  "César Alejandro Arellano Ruíz",
  document.querySelector("#cesarArellano"),
  "../../images/players/portraits/cesarArellanoPortrait.jpg",
  "cesarArellano"
);

const danielaCruzPortrait = new Player(
  "Daniela Aitana Cruz Llanos",
  document.querySelector("#danielaCruz"),
  "../../images/players/portraits/danielaCruzPortrait.jpg",
  "danielaCruz"
);

const danielTellezPortrait = new Player(
  "Armando Daniel Téllez Pallares",
  document.querySelector("#danielTellez"),
  "../../images/players/portraits/danielTellezPortrait.jpg",
  "danielTellez"
);

const deniseMejiaPortrait = new Player(
  "Denise Angélica Mejía González",
  document.querySelector("#deniseMejia"),
  "../../images/players/portraits/deniseMejiaPortrait.jpg",
  "deniseMejia"
);

const edgarGaliciaPortrait = new Player(
  "Edgar Galicia",
  document.querySelector("#edgarGalicia"),
  "../../images/players/portraits/edgarGaliciaPortrait.jpg",
  "edgarGalicia"
);

const enriqueHuatoPortrait = new Player(
  "Enrique Huato Montes",
  document.querySelector("#enriqueHuato"),
  "../../images/players/portraits/enriqueHuatoPortrait.jpg",
  "enriqueHuato"
);

const estelaGalavisPortrait = new Player(
  "Blanca Estela Santos Galavis",
  document.querySelector("#estelaGalavis"),
  "../../images/players/portraits/estelaGalavisPortrait.jpg",
  "estelaGalavis"
);

const farrellEstradaPortrait = new Player(
  "Farrel Estrada Ornelas",
  document.querySelector("#farrellEstrada"),
  "../../images/players/portraits/farrellEstradaPortrait.jpg",
  "farrellEstrada"
);

const fernandoLeonPortrait = new Player(
  "José Fernando León Martínez",
  document.querySelector("#fernandoLeon"),
  "../../images/players/portraits/fernandoLeonPortrait.jpg",
  "fernandoLeon"
);

const franciscoRiveraPortrait = new Player(
  "Francisco Rivera Ramírez",
  document.querySelector("#franciscoRivera"),
  "../../images/players/portraits/franciscoRiveraPortrait.jpg",
  "franciscoRivera"
);

const gabrielSanchezPortrait = new Player(
  "Hebert Gabriel Sánchez Martínez",
  document.querySelector("#gabrielSanchez"),
  "../../images/players/portraits/gabrielSanchezPortrait.jpg",
  "gabrielSanchez"
);

const gianniToroPortrait = new Player(
  "Gianni Toro Miranda",
  document.querySelector("#gianniToro"),
  "../../images/players/portraits/gianniToroPortrait.jpg",
  "gianniToro"
);

const jensenFernandezPortrait = new Player(
  "Jensen Fernandez",
  document.querySelector("#jensenFernandez"),
  "../../images/players/portraits/jensenFernandezPortrait.jpg",
  "jensenFernandez"
);

const lennySandovalPortrait = new Player(
  "Lenny Elizabeth Sandoval Sánchez",
  document.querySelectorAll("[id='lennySandoval']"),
  "../../images/players/portraits/lennySandovalPortrait.jpg",
  "lennySandoval"
);

const leonardoSeguraPortrait = new Player(
  "Leonardo Axel Segura Flores",
  document.querySelector("#leonardoSegura"),
  "../../images/players/portraits/leonardoSeguraPortrait.jpg",
  "leonardoSegura"
);

const luisDeLaRivaPortrait = new Player(
  "Luis Gabriel de la Riva Pérez",
  document.querySelector("#luisDeLaRiva"),
  "../../images/players/portraits/luisDeLaRivaPortrait.jpg",
  "luisDeLaRiva"
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

const rocioHernandezPortrait = new Player(
  "Rocío Guadalupe Hernández Hernández",
  document.querySelectorAll("#rocioHernandez"),
  "../../images/players/portraits/placeholderfemale.jpg",
  "rocioHernandez"
);

const rogelioMoralesPortrait = new Player(
  "Rogelio Morales Sánchez",
  document.querySelector("#rogelioMorales"),
  "../../images/players/portraits/rogelioMoralesPortrait.jpg",
  "rogelioMorales"
);

const sabrinaHuertaPortrait = new Player(
  "Sabrina Selene Huerta Monroy",
  document.querySelector("#sabrinaHuerta"),
  "../../images/players/portraits/sabrinaHuertaPortrait.jpg",
  "sabrinaHuerta"
);

const saraCeronPortrait = new Player(
  "Sara Flora María Cerón Garrido",
  document.querySelectorAll("[id='saraCeron']"),
  "../../images/players/portraits/placeholderfemale.jpg",
  "saraCeron"
);

const shelsyEstradaPortrait = new Player(
  "Shelsy Estrada Ornelas",
  document.querySelector("#shelsyEstrada"),
  "../../images/players/portraits/shelsyEstradaPortrait.jpg",
  "shelsyEstrada"
);

const susanaGutierrezPortrait = new Player(
  "Susana Ximena Gutiérrez Alanis",
  document.querySelectorAll("[id='susanaGutierrez']"),
  "../../images/players/portraits/susanaGutierrezPortrait.jpg",
  "susanaGutierrez"
);

// DOM GENERATION

//LOBOS ROJOS
susanaGutierrezPortrait.generateDom();
saraCeronPortrait.generateDom();
ceciliaRodriguezPortrait.generateDom();
sabrinaHuertaPortrait.generateDom();
rocioHernandezPortrait.generateDom();
lennySandovalPortrait.generateDom();

//LOBOS NEGROS
