<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD05Y1-CDKCsrPPZ_tTVNqACa4I0gY5yB0&libraries=places&callback=initMap"
    async defer>
  </script>
  <script>assets/js/main.js</script>
</head>
<body>
  <div class="container">
    <br><br>
    <h1 class="text-center">Find a Lawyer/Solicitor!</h1>
    <div id="map"></div>
    <div class="form-group">
      <label for="location">Search for a location:</label>
      <br><br>
      <input type="text" id="autocomplete" class="form-control" placeholder="Enter a location">
  </div>
  <br>
  <div class="form-group">
    <label for="type">Select the service you require:</label>
     <br>
     <select class="form-control" id="type">
       <option value="lawyer">Lawyer</option>
     </select>
  </div>
  <br><br>
  <table class="table table-bordered table-striped" id="places"></table>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>