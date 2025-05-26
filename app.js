const map = L.map('map', {
  zoomControl: false,
  scrollWheelZoom: false,
  doubleClickZoom: false,
  boxZoom: false,
  touchZoom: false,
  dragging: false
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

    console.log(data.features);

    const allCountries = data.features.length;

    const randNum = Math.floor(Math.random() * allCountries);

    const randCountry = data.features[randNum].properties.name;

    const infoBox = document.querySelector(".question");
    infoBox.textContent = "Click on: " + randCountry;

    fetch("european_countries.json")
      .then((response) => response.json())
      .then(json => {
        let countries = json
        console.log(countries);

      })

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

          console.log(item);

          if (name == randCountry) {
            answerBox.textContent = "Correct!";
          }
          else {
            answerBox.textContent = "Wrong!"
          }
        });
      }
    }).addTo(map);
  });
