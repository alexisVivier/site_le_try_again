function initMap(){
    console.log(Math.round($(window).width()/57));
    var positions = [
        [47.2451248,-1.5540562,'Facs'],['null','null','null'],//FACS
        [47.2609307,-1.5853243,'IMIE'],[47.2104545,-1.5688996,'EPITECH'],//IMIE, EPITECH
        [47.205624,-1.5411497,'YNOV'],['null','null','null'],//YNOV
        [47.1747275,-1.6180474,'E-sport Academy'],[47.2451248,-1.5540562,'Facs'],//E-SPORT ACADEMY, FACS
        [47.2171455,-1.5562332,'EPSI'],['null','null','null'],//EPSI
        [47.2006661,-1.5755484, 'Hangar à bananes'],['null','null','null']//HANGAR A BANANE
    ];
    var options = {
        center:{lat: 47.215, lng: -1.5688996},
        zoom:13,
        scrollwheel:false,
        mapTypeControl:false,
        styles:[
  {
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.neighborhood",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "landscape.man_made",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#3d3d3d"
      }
    ]
  },
  {
    "featureType": "landscape.man_made",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#6c6c6c"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#2c2c2c"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#2c2c2c"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#bde089"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#595959"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#ebe2d8"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#7a7a7a"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#7a7a7a"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#141414"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#272727"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#afd5ec"
      }
    ]
  }
]
    } 
    
    var map = new google.maps.Map(document.getElementById("co_map"), options);
    
    var markers = [];
    for(var i=0; i<positions.length;i++){
        if(typeof positions[i][0] != 'null'){
            var marker= new google.maps.Marker({
                position:{lat: positions[i][0], lng: positions[i][1]},
                map: map,
                title: positions[i][2],
                icon:{
                    url:'../../images/marker_petit_gris.png',
                    anchor: new google.maps.Point(20,40)
                },
                animation: google.maps.Animation.DROP
            });
            
            markers.push(marker);  
        }else{
            markers.push('undefined');
        }
    }  
    
    google.maps.event.addDomListener(window, "resize", function() {
       var center = map.getCenter();
       google.maps.event.trigger(map, "resize");
       map.setCenter(center); 
    });
    
    
    //Actions au click sur une dayCard
    $(".co_dayCard").click(function(){
        
        console.log($(this).index()+"click");     
        $(".co_dayCard").css({"background-color":"white"});
        $(this).css({"background-color":"#B4D87D"});
    
        
        
        var scroll = $(window).scrollTop();
  
        $('html,body').animate({
            scrollTop: $("#co_map").offset().top
        }, 'slow');
        
        for(var i=0;i<markers.length;i++){
            if(markers[i] != 'undefined'){
                console.log(i+' Mise en gris');
                markers[i].setIcon('../../images/marker_petit_gris.png');
                markers[i].setZIndex(0);
            }
        }
        console.log(markers[$(this).index()*2]);
        console.log(markers[$(this).index()*2+1]);
        
        if(markers[$(this).index()*2]!='undefined'){
            markers[$(this).index()*2].setIcon('../../images/marker.png');
            markers[$(this).index()*2].setZIndex(100);
        }
        if(markers[$(this).index()*2+1]!='undefined'){
            markers[$(this).index()*2+1].setIcon('../../images/marker.png');
            markers[$(this).index()*2+1].setZIndex(100);
        }
        
        
        
        
    });
}
google.maps.event.addDomListener(window, 'load', initMap);



















