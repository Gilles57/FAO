import L from 'leaflet';

// function initMap(villes) {
//     console.log('initmap')
    // let lat = 47.260751953373706;
    // let lon = 6.045450869180901;
    // let zoom = 6;
    // // let villes = {{villes | raw }} ;
    // console.log(villes)
    // let nb_villes = Object.keys(villes).length;
    //
    // // On initialise la latitude et la longitude du centre de la carte
    // let pref;
    //
    // for (let i = 0; i < nb_villes; i++) {
    //     if (villes[i]['preferred'] === true) {
    //         lat = villes[i]['lat'];
    //         lon = villes[i]['lon'];
    //         pref = i;
    //     }
    // }
    //
    //
    // // Nous définissons le dossier qui contiendra les marqueurs
    // const iconBase = '/images/carte/';
    // // Créer l'objet "ma_carte" et l'insérer dans l'élément HTML qui a l'ID "map"
    // let map = L.map('map').setView([lat, lon], zoom);
    // // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut.
    // // Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     minZoom: 1,
    //     maxZoom: 19,
    //     attribution: '© OpenStreetMap'
    // }).addTo(map);
    //
    //
    // // Nous parcourons la liste des villes
    // let myIcon;
    // for (const index in villes) {
    //     // Nous définissons l'icône à utiliser pour le marqueur, sa taille affichée (iconSize), sa position (iconAnchor) et le décalage de son ancrage (popupAnchor)
    //     console.log(ville[index])
    //     if (ville[index]['preferred'] == true) {
    //         myIcon = L.icon({
    //             iconUrl: iconBase + "pin_green.webp",
    //             iconSize: [60, 60],
    //             iconAnchor: [30, 30],
    //             popupAnchor: [-3, -30],
    //         });
    //     } else {
    //         myIcon = L.icon({
    //             iconUrl: iconBase + "pin_grey.webp",
    //             iconSize: [30, 30],
    //             iconAnchor: [15, 15],
    //             popupAnchor: [-3, -30],
    //         });
    //     }
    //
    //     var marker = L.marker([villes[ville].lat, villes[ville].lon], {icon: myIcon}).addTo(map);
    //     marker.bindPopup(villes[ville].nom);
    //
    // }
// }
