const map = L.map('map').setView([20, 0], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

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
              console.log("Clicked feature properties:", feature.properties); // Debug

              // Try multiple possible fields
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