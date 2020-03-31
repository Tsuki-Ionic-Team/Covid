        // add the JavaScript here

        mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2YWxlcnRlciIsImEiOiJjazhiYWVlMjMwNDU1M2ZucGF3dWVlYzU4In0.AHdSxfPkWwTQmMgUJ-8Tvg';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/devalerter/ck8bc1stc0r3v1iqqg27s9c55',
            center: [101.228492, 12.565], // starting position
            zoom: 4.6
        });

        map.on('load', function() {
            // Add a source for the state polygons.
            map.addSource('states', {
                'type': 'geojson',
                // 'data': 'https://raw.githubusercontent.com/apisit/thailand.json/master/thailandwithdensity.json'
                'data': 'http://localhost/@work/Covid/service/province/thailand.json'
            });

            // Add a layer showing the state polygons.
            map.addLayer({
                'id': 'states-layer',
                'type': 'fill',
                'source': 'states',
                'paint': {
                    'fill-color': 'rgba(100, 200, 240, 0.4)',
                    'fill-outline-color': 'rgba(0, 0, 0, 0.5)'
                }
            });

            // When a click event occurs on a feature in the states layer, open a popup at the
            // location of the click, with description HTML from its properties.
            map.on('click', 'states-layer', function(e) {
                new mapboxgl.Popup()
                    .setLngLat(e.lngLat)
                    .setHTML(e.features[0].properties.name)
                    .addTo(map);
            });

            // Change the cursor to a pointer when the mouse is over the states layer.
            map.on('mouseenter', 'states-layer', function() {
                map.getCanvas().style.cursor = 'pointer';
            });

            // Change it back to a pointer when it leaves.
            map.on('mouseleave', 'states-layer', function() {
                map.getCanvas().style.cursor = '';
            });

            // [ ======================================================================= ]

            // Add Pin Marker
            map.addLayer({
                id: 'point',
                type: 'circle',
                source: {
                    type: 'geojson',
                    data: {
                        type: 'FeatureCollection',
                        features: [{
                            type: 'Feature',
                            properties: {},
                            geometry: {
                                type: 'Point',
                                coordinates: [101.228492, 12.565]
                            }
                        }]
                    }
                },
                paint: {
                    'circle-radius': 10,
                    'circle-color': '#3887be'
                }
            });

        });