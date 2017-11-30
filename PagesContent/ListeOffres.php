<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 90%;
        width: 90%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 4px;
      }
    </style>
  </head>

  <body>

      <div class="container">
      <header class="page-header">
          
        <h1 class='t1'>La carte des offres disponibles en Ile-de-France</h1>
      </header>
      <section class="row">
          <p> Lorsqu'un don est posté sur PasdeGaspX, elle automatiquement placée sur la carte.</p>
          <p> Si une offre vous intéresse, vous pouvez cliquer sur le marqueur pour consulter les détails de l'offre </p>
      </section></div>


          <div id="map"></div>

    <script>
      
        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(48.8237, 2.32453),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('http://localhost/ProjetModalEncours/Utilitaires/ConnexionBDDPourCartes.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var address = markerElem.getAttribute('address');
              var titre = markerElem.getAttribute('titre');
              var quantite = markerElem.getAttribute('quantite');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));      
              var contentString = 'Ce plat s\'appelle: "'+ titre +'"'+"<br/>"+
                      "L'adresse de la recontre est fixée à : " + address+ "<br/>"+
                      "Le donneur prévoit une quantité de "+ quantite + " personnes." +"<br/>"+
                      "Consultez l'offre plus en détails <a href='http://localhost/ProjetModalEncours/index.php?name=OffreSelectionne&ID="+id+"'>"+
                    'ici</a> ';
        
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
              
              var marker = new google.maps.Marker({
                map: map,
                animation: google.maps.Animation.DROP,
                position: point,
              });
              marker.addListener('click', function() {
                infowindow.open(map, marker);
                setTimeout(function () { infowindow.close(); }, 5000);

              });
            });
          });
        }


        
      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAaVYDf2bs_OVWTX2tljyo50RhOKHoL54&callback=initMap">
    </script>
