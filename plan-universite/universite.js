async function init() {
    let universiteJSON = await fetch(
        'https://bde-tribu-terre.fr/api/universite/'
    ).then(response => response.json().then(value => {
        let searchParams = new URLSearchParams(window.location.search);
        console.log(searchParams.has('batiment'));

        for (let [idComposante, composante] of Object.entries(value.data)) {
            if (searchParams.has('groupeBatiments') && searchParams.get('groupeBatiments') !== idComposante) {
                continue;
            }
            composante.batiments.forEach(
                batiment => {
                    if (searchParams.has('batiment') && searchParams.get('batiment') !== batiment.id) {
                        return;
                    }
                    batiment.composante = idComposante;
                    fetch(
                        'https://bde-tribu-terre.fr/api/universite/geoJSON/?id=' + batiment.id
                    ).then(response => response.json().then(value => {
                        batiment.geoJSON = value.data;

                        // Initialisation des géométries
                        batiment.geoJSON.properties = {index: batiment.id};
                        elementsGeoJSON.addData(batiment.geoJSON);
                        let style = {
                            weight: 2,
                            color: universiteJSON[batiment.composante].couleur,
                            opacity: 1,
                            fillColor: universiteJSON[batiment.composante].couleur,
                            fillOpacity: 0.6
                        }
                        geoJSON = L.geoJSON(
                            batiment.geoJSON,
                            {
                                style: style,
                                onEachFeature: onEachFeature
                            }
                        ).addTo(carte);
                    }))
                }
            )
        }
        return value.data;
    }))

// Initialisation des données bâtiment
    let batiments = new Map();
    for (const [idcomposante, composante] of Object.entries(universiteJSON)) {
        for (const [, batiment] of Object.entries(composante.batiments)) {
            batiment.composante = idcomposante;
            batiments.set(batiment.id, batiment);
        }
    }

// Initialisation de la carte
    let carte = L.map('carte').setView(L.latLng(47.843513, 1.934346), 15);
    L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}',
        {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'tribu-terre/ckcm8zb851eor1jo4hbtehlaw',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoidHJpYnUtdGVycmUiLCJhIjoiY2tjdGJ6aml3MHZ2YjJ5bHdkNWMwMDU2MiJ9.ERo6ou9VlclQ8_3Ec8hbnA'
        }
    ).addTo(carte);
    let elementsGeoJSON = L.geoJSON().addTo(carte);

// Tous les éléments récupérés à partir de l'IDE http://overpass-turbo.eu/#.
// Construction de l'objet
    let geoJSON;

// Bulle d'info
// Initialisation
    let info = L.control();
    info.onAdd = function () {
        this._div = L.DomUtil.create('div', 'well info text-center');
        this.update();
        return this._div;
    };
    info.update = function (batiment) {
        this._div.innerHTML =
            batiment ?
                '<span class="pc"><b>' + universiteJSON[batiment.composante].titre + '</b></span><br><h4>' + batiment.libelle_long + '</h4>'
                : 'Survolez/Touchez un bâtiment en surbrillance pour l\'identifier';
    };
    info.addTo(carte);

// Mises à jour des infos
    function highlightFeature(e) {
        e.target.setStyle(
            {
                weight: 5,
                fillOpacity: 0.8
            }
        );
        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            e.target.bringToFront();
        }
        info.update(batiments.get(e.target.feature.geometry.properties.index));
    }

    function resetHighlight(e) {
        geoJSON.resetStyle(e.target);
        let couleur = universiteJSON[batiments.get(e.target.feature.geometry.properties.index).composante].couleur;
        e.target.setStyle(
            {
                weight: 2,
                color: couleur,
                opacity: 1,
                fillColor: couleur,
                fillOpacity: 0.6
            }
        );
        info.update();
    }

    let selected;

    function clickTouch(e) {
        if (selected) {
            resetHighlight(selected)
        }
        selected = e;
        geoJSON.resetStyle(e);
        highlightFeature(e);
    }

    function onEachFeature(feature, layer) {
        layer.on(
            {
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: clickTouch
            }
        );
    }

// Crédits à l'association
    let TT = L.control({position: 'bottomright'});
    TT.onAdd = function () {
        let div = L.DomUtil.create('div', 'leaflet-control-attribution leaflet-control');
        div.innerHTML += 'Anaël B., pôle informatique de l\'association <a href="..">Tribu-Terre</a><!-- Un plaisir ;) -->';
        return div;
    };
    TT.addTo(carte);

// Légende
    let legend = L.control({position: 'bottomright'});
    legend.onAdd = function () {
        let div = L.DomUtil.create('div', 'well info legend');
        let elementsLegende = '';
        for (const [, objet] of Object.entries(universiteJSON)) {
            elementsLegende += '<i style="background:' + objet.couleur + '"></i> ' + objet.legende + '<br>';
        }
        div.innerHTML += '<div class="text-center">' +
            '<button ' +
            'class="btn btn-primary" ' +
            'type="button" ' +
            'data-toggle="collapse" ' +
            'data-target="#legende" ' +
            'aria-expanded="false" ' +
            'aria-controls="collapseExample"' +
            '>' +
            'Légende' +
            '</button>' +
            '</div>' +
            '<div class="collapse" id="legende">' +
            elementsLegende +
            '</div>';
        return div;
    };
    legend.addTo(carte);
}

init();

// Ajouter de nouveaux bâtiments :
// https://www.openstreetmap.org/way/39838231
// http://overpass-turbo.eu/#
// https://foucaultvsnorm.sciencesconf.org/data/pages/plan_5.png
