(function() {
    "use strict";
  
    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
      el = el.trim()
      if (all) {
        return [...document.querySelectorAll(el)]
      } else {
        return document.querySelector(el)
      }
    }
  
    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
      let selectEl = select(el, all)
      if (selectEl) {
        if (all) {
          selectEl.forEach(e => e.addEventListener(type, listener))
        } else {
          selectEl.addEventListener(type, listener)
        }
      }
    }
  
    /**
     * Easy on scroll event listener 
     */
    const onscroll = (el, listener) => {
      el.addEventListener('scroll', listener)
    }
  
    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#navbar .scrollto', true)
    const navbarlinksActive = () => {
      let position = window.scrollY + 200
      navbarlinks.forEach(navbarlink => {
        if (!navbarlink.hash) return
        let section = select(navbarlink.hash)
        if (!section) return
        if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
          navbarlink.classList.add('active')
        } else {
          navbarlink.classList.remove('active')
        }
      })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)
  
    /**
     * Scrolls to an element with header offset
     */
    const scrollto = (el) => {
      let header = select('#header')
      let offset = header.offsetHeight
  
      let elementPos = select(el).offsetTop
      window.scrollTo({
        top: elementPos - offset,
        behavior: 'smooth'
      })
    }
  
    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select('#header')
    if (selectHeader) {
      const headerScrolled = () => {
        if (window.scrollY > 100) {
          selectHeader.classList.add('header-scrolled')
        } else {
          selectHeader.classList.remove('header-scrolled')
        }
      }
      window.addEventListener('load', headerScrolled)
      onscroll(document, headerScrolled)
    }
  
    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
      const toggleBacktotop = () => {
        if (window.scrollY > 100) {
          backtotop.classList.add('active')
        } else {
          backtotop.classList.remove('active')
        }
      }
      window.addEventListener('load', toggleBacktotop)
      onscroll(document, toggleBacktotop)
    }
  
    /**
     * Mobile nav toggle
     */
    on('click', '.mobile-nav-toggle', function(e) {
      select('#navbar').classList.toggle('navbar-mobile')
      this.classList.toggle('bi-list')
      this.classList.toggle('bi-x')
    })
  
    /**
     * Mobile nav dropdowns activate
     */
    on('click', '.navbar .dropdown > a', function(e) {
      if (select('#navbar').classList.contains('navbar-mobile')) {
        e.preventDefault()
        this.nextElementSibling.classList.toggle('dropdown-active')
      }
    }, true)
  
    /**
     * Scrool with ofset on links with a class name .scrollto
     */
    on('click', '.scrollto', function(e) {
      if (select(this.hash)) {
        e.preventDefault()
  
        let navbar = select('#navbar')
        if (navbar.classList.contains('navbar-mobile')) {
          navbar.classList.remove('navbar-mobile')
          let navbarToggle = select('.mobile-nav-toggle')
          navbarToggle.classList.toggle('bi-list')
          navbarToggle.classList.toggle('bi-x')
        }
        scrollto(this.hash)
      }
    }, true)
  
    /**
     * Scroll with ofset on page load with hash links in the url
     */
    window.addEventListener('load', () => {
      if (window.location.hash) {
        if (select(window.location.hash)) {
          scrollto(window.location.hash)
        }
      }
    });
  
    /**
     * Preloader
     */
    let preloader = select('#preloader');
    if (preloader) {
      window.addEventListener('load', () => {
        preloader.remove()
      });
    }  
  })()

  // Script for the location API 
  function initMap() {
    autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'),
  {
    types:['geocode']
  });

  autocomplete.addListener('place_changed',searchNearbyPlaces)
  }

  function searchNearbyPlaces(){
    document.getElementById('places').innerHTML = ''

    var place =autocomplete.getPlace();
    console.log(place);

    map = new google.maps.Map(document.getElementById('map'),{
      center: place.geometry.location,
      zoom: 15
    });

    // Perform a nearby search for places
    service = new google.maps.places.PlacesService(map);
    service.nearbySearch({
      location: place.geometry.location,
      radius: 500,
      type: [document.getElementById('type').value]
    }, callback);

    function callback(results, status){
      if (status === google.maps.places.PlacesServiceStatus.OK){
        console.log(results);
        for (var i = 0; i < results.length; i++){
          createMarker(results[i]);
        }
      }
    }
  }

function createMarker(place) {
  var table = document.getElementById("places");
  var row = table.insertRow();
  var cell1 = row.insertCell(0);
  cell1.innerHTML = "<strong>Name:</strong> " + place.name + "<br><strong>Address:</strong> " + place.vicinity + "<br><strong>Phone:</strong> Loading...";

  // Fetch place details to get phone number
  var request = {
    placeId: place.place_id,
    fields: ['formatted_phone_number']
  };

  var service = new google.maps.places.PlacesService(map);
  service.getDetails(request, function(placeDetails, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      var phoneNumber = placeDetails.formatted_phone_number ? placeDetails.formatted_phone_number : "Not available";
      cell1.innerHTML = "<strong>Name:</strong> " + place.name + "<br><strong>Address:</strong> " + place.vicinity + "<br><strong>Phone:</strong> " + phoneNumber;
    } else {
      cell1.innerHTML = "<strong>Name:</strong> " + place.name + "<br><strong>Address:</strong> " + place.vicinity + "<br><strong>Phone:</strong> Not available";
    }
  });

  if (place.photos) {
    let photoUrl = place.photos[0].getUrl();
    var cell2 = row.insertCell(1);
    cell2.innerHTML = `<img width="300" height="300" src="${photoUrl}"/>`;
  } else {
    let photoUrl = 'https://via.placeholder.com/150';
    var cell2 = row.insertCell(1);
    cell2.innerHTML = `<img width="300" height="300" src="${photoUrl}"/>`;
  }
}
