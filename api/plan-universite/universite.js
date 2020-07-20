// Initialisation des données bâtiment
let batiments = [];
for (const [idcomposante, composante] of Object.entries(universiteJSON)) {
    for (let ibatiment = 0; ibatiment < composante.batiments.length; ibatiment++) {
        composante.batiments[ibatiment].composante = idcomposante;
        batiments.push(composante.batiments[ibatiment]);
    }
}

// Initialisation de la carte
let carte = L.map('carte').setView([47.845106, 1.933701], 15);
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

// Tous les éléments racupérés à partir de l'IDE http://overpass-turbo.eu/#.
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
            : 'Survolez/Touchez un bâtiment pour l\'identifier';
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
    info.update(batiments[e.target.feature.geometry.properties.index]);
}

function resetHighlight(e) {
    geoJSON.resetStyle(e.target);
    let couleur =
        universiteJSON[batiments[e.target.feature.geometry.properties.index].composante].couleur;
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
    div.innerHTML += 'Anaël B., pôle informatique de l\'association <a href="../..">Tribu-Terre</a><!-- Un plaisir ;) -->';
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

// Initialisation des géométries
for (let i = 0; i < batiments.length; i++) {
    batiments[i].geoJSON.properties = {index: i};
    elementsGeoJSON.addData(batiments[i].geoJSON);
    let style = {
        weight: 2,
        color: universiteJSON[batiments[i].composante].couleur,
        opacity: 1,
        fillColor: universiteJSON[batiments[i].composante].couleur,
        fillOpacity: 0.6
    }
    geoJSON = L.geoJSON(
        batiments[i].geoJSON,
        {
            style: style,
            onEachFeature: onEachFeature
        }
    ).addTo(carte);
}

// Ajouter de nouveaux bâtiments :
// https://www.openstreetmap.org/way/39838231
// http://overpass-turbo.eu/#
// https://foucaultvsnorm.sciencesconf.org/data/pages/plan_5.png