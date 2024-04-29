// document.addEventListener('DOMContentLoaded', function () {
//     const slides = document.querySelectorAll('.full-screen-slide');
//     let currentSlide = 0;

//     function showSlide(n) {
//         slides.forEach(slide => slide.style.display = 'none');
//         slides[n].style.display = 'block';
//     }

//     function nextSlide() {
//         currentSlide = (currentSlide + 1) % slides.length;
//         showSlide(currentSlide);
//     }

//     function prevSlide() {
//         currentSlide = (currentSlide - 1 + slides.length) % slides.length;
//         showSlide(currentSlide);
//     }

//     // Automatic sliding
//     setInterval(nextSlide, 10000); // Change slide every 10 seconds

//     // Button click events
//     const nextBtns = document.querySelectorAll('.slide-btn-right');
//     const prevBtns = document.querySelectorAll('.slide-btn-left');

//     nextBtns.forEach(btn => {
//         btn.addEventListener('click', nextSlide);
//     });

//     prevBtns.forEach(btn => {
//         btn.addEventListener('click', prevSlide);
//     });
// });

const slides = document.querySelectorAll('.full-screen-slide');
        let currentSlide = 0;

        function showSlide(n) {
            slides.forEach(slide => slide.style.display = 'none');
            slides[n].style.display = 'block';
            
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        // Automatic sliding
        setInterval(nextSlide, 30000); // Change slide every 10 seconds


let popupNew = document.querySelector(".popup-new");
let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

function openNew(button){

    let data = JSON.parse(button.getAttribute("data-design"));

    console.log(data);

    document.querySelector(".popup-new .design");
    document.querySelector(".popup-new .design").src = '/project_Amoral/public/uploads/collection/' + data.image_name;
    document.querySelector(".popup-new input[name='img']").value = '../collection/' + data.image_name;
    document.querySelector(".popup-new input[name='material']").value = data.material;
    document.querySelector(".popup-new input[name='printing_type']").value = data.printing_type;
    document.querySelector(".popup-new input[name='unit_price']").value = data.price;
    document.querySelector(".popup-new .unitPrice").innerHTML = data.price;

    var marker1;
    // var marker2;
    var map;
    // var map2;
  
// Define the center coordinates and the radius

    var center = { lat: 5.9497, lng: 80.5353 };
    var radius = 100000;

    map = new google.maps.Map(document.getElementById("new-order-map"), {
        center: center,
        zoom: 5,
    });


    

    // Add a circle to each map
    
        var circle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            // fillColor: '#FF0000',
            // fillOpacity: 0.35,
            map: map,
            center: center,
            radius: radius,
        });

        

        

        var latitude, longitude;
        circle.addListener("click", function (event) {
          var distance = google.maps.geometry.spherical.computeDistanceBetween(event.latLng, circle.getCenter());
          if (distance <= circle.getRadius()) {
            if (marker1) {
              marker1.setMap(null);
            }



        
            // Get the clicked location's latitude and longitude
            latitude = event.latLng.lat();
            longitude = event.latLng.lng();
        
            console.log(latitude);
        
            marker1 = new google.maps.Marker({
              position: {
                lat: latitude,
                lng: longitude,
              },
              map: map,
            });
        
  
          }
          
            document.querySelector('.popup-new input[name="latitude"]').value = latitude;
            document.querySelector('.popup-new input[name="longitude"]').value = longitude;  
            console.log( latitude );

            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(
                function (position) {
                  var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                  };
          
                  // Set the map's center to the user's current location
                  map.setCenter(pos);
                  // map2.setCenter(pos);
                  
                  map.setZoom(8);
                  // map2.setZoom(15);
          
                  var distanceToCenter = google.maps.geometry.spherical.computeDistanceBetween(center, pos);
                  if (distanceToCenter > radius) {
                    // document.querySelector('.error.delmap').innerHTML = "You are outside the delivery area";
                  }
                  else{
                    // Add a marker at the user's current location
                    marker1 = new google.maps.Marker({
                      position: pos,
                      map: map,
                      title: "Your Location",
                    });
    
                  }
        
                },
                function () {
                  handleLocationError(true, map.getCenter());
                  // handleLocationError(true, map2.getCenter());
                }
    

         
                );
    
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, map.getCenter());
            // handleLocationError(false, map2.getCenter());
            }
        });






    


    popupNew.classList.add("is-visible");
    document.body.style.overflow = "hidden";
    sidebar.style.pointerEvents = "none";
    nav.style.pointerEvents = "none";
}

function closeNew(){
    popupNew.classList.remove("is-visible");
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";
}

function handleLocationError(browserHasGeolocation, pos) {
    var infoWindow = new google.maps.InfoWindow({
      content: browserHasGeolocation
        ? "Error: The Geolocation service failed."
        : "Error: Your browser doesn't support geolocation.",
    });

    var marker = new google.maps.Marker({
        position: pos,
        map: map,
      });
    
      marker.addListener("click", function () {
        infoWindow.open(map, marker);
      });
    }

let newForm = document.querySelector('.popup-new form');
    function validateNewOrder() {
        let errors = {};
        // pdf and images
      
        // sizes
        let sizes = document.querySelectorAll('.popup-new input[type="number"]');
        let total = 0;
        sizes.forEach(size => {
            total += parseInt(size.value);
        });
      
        if (total === 0) {
            // event.preventDefault();
            errors['sizes0'] = ' *Please select a size';
        }
      
        // dispatch date
        let dates = document.querySelectorAll('.popup-new input[type="date"]');
        let dateSelected = false;
      
        dates.forEach(date => {
            if (date.value !== '') {
                dateSelected = true;
            }
        });
      
        if (!dateSelected) {
            // event.preventDefault();
            errors['dates'] = ' *Please select a date';
        }
      
        clearErrorMsg(newForm);
                
        // let errors = validateNewOrder();
        console.log(Object.values(errors));
        if (Object.keys(errors).length > 0) {
            displayErrorMsg(errors, newForm);
            // event.preventDefault();
        }
      
        // console.log(errors);
      
        if(Object.keys(errors).length === 0){
            return true;
        }else{
            return false;
        }
      
      }

      function displayErrorMsg(errors, form) {

        for (const key in errors) {
            if (Object.hasOwnProperty.call(errors, key)) {
                const error = errors[key];
                form.querySelector(`.error.${key}`).innerText = error;
            }
        }
    }
    
    
    
    function clearErrorMsg(form) {
        // console.log('clear');
        let errorElements = form.querySelectorAll('.error');
    
      errorElements.forEach((errorElement) => {
        errorElement.innerText = "";
      });
    }
      