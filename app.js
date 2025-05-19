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
    countriesLayer = L.geoJSON(data, {
      style: {
        color: "#3388ff",
        weight: 1,
        fillOpacity: 0.2
      },
      onEachFeature: function (feature, layer) {
        layer.on('click', function () {
          console.log("Clicked feature properties:", feature.properties);

          const name =
            feature.properties.ADMIN ||
            feature.properties.NAME ||
            feature.properties.name ||
            "Unknown Country";

          alert("You clicked on: " + name);
        });
      }
    }).addTo(map);
  });
