const map = L.map('map', {
  zoomControl: false,
  scrollWheelZoom: true,
  doubleClickZoom: false,
  boxZoom: false,
  touchZoom: false,
  dragging: true
});

const europeBounds = [
  [34.5, -25.0],
  [72.0, 45.0]
];

map.fitBounds(europeBounds);

let countriesLayer;

fetch('https://raw.githubusercontent.com/datasets/geo-countries/master/data/countries.geojson')
  .then(response => response.json())
  .then(data => {
    const allCountries = data.features.length;
    const selectedCountries = [];
    let currentQuestion = 0;
    let score = 0;

    fetch('european_countries.json')
      .then(response => response.json())
      .then(europeanData => {
        const countriesPool = [...europeanData];
        for (let i = 0; i < 10 && countriesPool.length > 0; i++) {
          const randNum = Math.floor(Math.random() * countriesPool.length);
          const randCountry = countriesPool.splice(randNum, 1)[0];
          selectedCountries.push(randCountry);
        }

        const infoBox = document.querySelector(".question");
        infoBox.textContent = "Click on: " + selectedCountries[currentQuestion];

        countriesLayer = L.geoJSON(data, {
          style: {
            color: "#3388ff",
            weight: 1,
            fillOpacity: 0.2
          },
          onEachFeature: function (feature, layer) {
            layer.on('click', function (item) {
              const name = feature.properties.name || "Unknown Country";
              const answerBox = document.querySelector(".answer");
              const scoreBox = document.querySelector(".score");

              if (currentQuestion < selectedCountries.length) {
                if (name == selectedCountries[currentQuestion]) {
                  answerBox.style.color = 'green';
                  answerBox.textContent = "Correct!";
                  score++;

                  setTimeout(() => {
                    answerBox.textContent = '';
                  }, 700)

                } else {
                  answerBox.style.color = 'red';
                  answerBox.textContent = "Wrong!";

                  setTimeout(() => {
                    answerBox.textContent = '';
                  }, 700)
                }
                
                currentQuestion++;
                if (currentQuestion < selectedCountries.length) {
                  setTimeout(() => {
                    infoBox.textContent = "Click on: " + selectedCountries[currentQuestion];
                  }, 700)
                } else {
                  setTimeout(() => {
                    infoBox.textContent = "Quiz finished!";
                    answerBox.style.color = 'black';
                    answerBox.textContent = 'Uw score van 0-100:';
                    scoreBox.textContent = score * 10;
                  }, 700);
                }
              }
            });
          }
        }).addTo(map);
      });
  });
