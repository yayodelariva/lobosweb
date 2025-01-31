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
  "ALEJANDRO DORANTES",
  document.querySelector("#alejandroDorantes"),
  "../../images/players/portraits/alejandroDorantes.jpg",
  "alejandroDorantes"
);

const barbaraFuentesPortrait = new Player(
  "BARBARA FUENTES FLORES",
  document.querySelector("#barbaraFuentes"),
  "../../images/players/portraits/barbaraFuentesPortrait.jpg",
  "barbaraFuentes"
);

const carlosDeLaRivaPortrait = new Player(
  "CARLOS EMILIO DE LA RIVA MORALES",
  document.querySelector("#carlosDeLaRiva"),
  "../../images/players/portraits/carlosDeLaRivaPortrait.jpg",
  "carlosDeLaRiva"
);

const ceciliaRodriguezPortrait = new Player(
  "CECILIA RODRÍGUEZ DE LA VEGA ISAZA",
  document.querySelector("#ceciliaRodriguez"),
  "../../images/players/portraits/ceciliaRodriguezPortrait.jpg",
  "ceciliaRodriguez"
);

const cesarArellanoPortrait = new Player(
  "CÉSAR ALEJANDRO ARELLANO RUÍZ",
  document.querySelector("#cesarArellano"),
  "../../images/players/portraits/cesarArellanoPortrait.jpg",
  "cesarArellano"
);

const danielaCruzPortrait = new Player(
  "DANIELA AITANA CRUZ LLANOS",
  document.querySelector("#danielaCruz"),
  "../../images/players/portraits/danielaCruzPortrait.jpg",
  "danielaCruz"
);

const danielTellezPortrait = new Player(
  "ARMANDO DANIEL TÉLLEZ PALLARES",
  document.querySelector("#danielTellez"),
  "../../images/players/portraits/danielTellezPortrait.jpg",
  "danielTellez"
);

const deniseMejiaPortrait = new Player(
  "DENISE ANGÉLICA MEJÍA GONZÁLEZ",
  document.querySelector("#deniseMejia"),
  "../../images/players/portraits/deniseMejiaPortrait.jpg",
  "deniseMejia"
);

const edgarGaliciaPortrait = new Player(
  "EDGAR GALICIA",
  document.querySelector("#edgarGalicia"),
  "../../images/players/portraits/edgarGaliciaPortrait.jpg",
  "edgarGalicia"
);

const enriqueHuatoPortrait = new Player(
  "ENRIQUE HUATO MONTES",
  document.querySelector("#enriqueHuato"),
  "../../images/players/portraits/enriqueHuatoPortrait.jpg",
  "enriqueHuato"
);

const estelaGalavisPortrait = new Player(
  "BLANCA ESTELA SANTOS GALAVIS",
  document.querySelector("#estelaGalavis"),
  "../../images/players/portraits/estelaGalavisPortrait.jpg",
  "estelaGalavis"
);

const farrellEstradaPortrait = new Player(
  "FARREL ESTRADA ORNELAS",
  document.querySelector("#farrellEstrada"),
  "../../images/players/portraits/farrellEstradaPortrait.jpg",
  "farrellEstrada"
);

const fernandoLeonPortrait = new Player(
  "JOSÉ FERNANDO LEÓN MARTÍNEZ",
  document.querySelector("#fernandoLeon"),
  "../../images/players/portraits/fernandoLeonPortrait.jpg",
  "fernandoLeon"
);

const franciscoRiveraPortrait = new Player(
  "FRANCISCO RIVERA RAMÍREZ",
  document.querySelector("#franciscoRivera"),
  "../../images/players/portraits/placeholdermale.jpg",
  "franciscoRivera"
);

const gabrielSanchezPortrait = new Player(
  "HEBERT GABRIEL SÁNCHEZ MARTÍNEZ",
  document.querySelector("#gabrielSanchez"),
  "../../images/players/portraits/gabrielSanchez.jpg",
  "gabrielSanchez"
);

const gianniToroPortrait = new Player(
  "GIANNI TORO MIRANDA",
  document.querySelector("#gianniToro"),
  "../../images/players/portraits/gianniToroPortrait.jpg",
  "gianniToro"
);

const jensenFernandezPortrait = new Player(
  "JENSEN FERNANDEZ",
  document.querySelector("#jensenFernandez"),
  "../../images/players/portraits/placeholdermale.jpg",
  "jensenFernandez"
);

const lennySandovalPortrait = new Player(
  "LENNY ELIZABETH SANDOVAL SÁNCHEZ",
  document.querySelectorAll("[id='lennySandoval']"),
  "../../images/players/portraits/lennySandovalPortrait.jpg",
  "lennySandoval"
);

const leonardoSeguraPortrait = new Player(
  "LEONARDO AXEL SEGURA FLORES",
  document.querySelector("#leonardoSegura"),
  "../../images/players/portraits/placeholdermale.jpg",
  "leonardoSegura"
);

const luisDeLaRivaPortrait = new Player(
  "LUIS GABRIEL DE LA RIVA PÉREZ",
  document.querySelector("#luisDeLaRiva"),
  "../../images/players/portraits/luisDeLaRivaPortrait.jpg",
  "luisDeLaRiva"
);

const paolaCastilloPortrait = new Player(
  "SANDRA PAOLA AGUAYO CASTILLO",
  document.querySelector("#paolaCastillo"),
  "../../images/players/portraits/paolaCastilloPortrait.jpg",
  "paolaCastillo"
);

const randyCastilloPortrait = new Player(
  "KURT RANDY AGUAYO CASTILLO",
  document.querySelector("#randyCastillo"),
  "../../images/players/portraits/randyCastilloPortrait.jpg",
  "randyCastillo"
);

const rocioHernandezPortrait = new Player(
  "ROCÍO GUADALUPE HERNÁNDEZ HERNÁNDEZ",
  document.querySelectorAll("#rocioHernandez"),
  "../../images/players/portraits/placeholderfemale.jpg",
  "rocioHernandez"
);

const rogelioMoralesPortrait = new Player(
  "ROGELIO MORALES SÁNCHEZ",
  document.querySelector("#rogelioMorales"),
  "../../images/players/portraits/rogelioMoralesPortrait.jpg",
  "rogelioMorales"
);

const sabrinaHuertaPortrait = new Player(
  "SABRINA SELENE HUERTA MONROY",
  document.querySelector("#sabrinaHuerta"),
  "../../images/players/portraits/sabrinaHuertaPortrait.jpg",
  "sabrinaHuerta"
);

const saraCeronPortrait = new Player(
  "SARA FLORA MARÍA CERÓN GARRIDO",
  document.querySelectorAll("[id='saraCeron']"),
  "../../images/players/portraits/placeholderfemale.jpg",
  "saraCeron"
);

const shelsyEstradaPortrait = new Player(
  "SHELSY ESTRADA ORNELAS",
  document.querySelector("#shelsyEstrada"),
  "../../images/players/portraits/shelsyEstradaPortrait.jpg",
  "shelsyEstrada"
);

const susanaGutierrezPortrait = new Player(
  "SUSANA XIMENA GUTIÉRREZ ALANIS",
  document.querySelectorAll("[id='susanaGutierrez']"),
  "../../images/players/portraits/susanaGutierrezPortrait.jpg",
  "susanaGutierrez"
);

// DOM GENERATION

//LOBOS ROJOS
luisDeLaRivaPortrait.generateDom();
enriqueHuatoPortrait.generateDom();
edgarGaliciaPortrait.generateDom();
alejandroDorantesPortrait.generateDom();
danielTellezPortrait.generateDom();
fernandoLeonPortrait.generateDom();
cesarArellanoPortrait.generateDom();
gianniToroPortrait.generateDom();
//LOBOS NEGROS
gabrielSanchezPortrait.generateDom();
//COACH
carlosDeLaRivaPortrait.generateDom();
