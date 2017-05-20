<html>
  <head></head>
  <body>
    <script>
      (function () {
        var xhr = new XMLHttpRequest();

        xhr.open("GET", "https://trial.z2systems.com/np/constituent/link.do?choice=logout");
        // xhr.setRequestHeader('Accept', 'application/json');
        // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function(){
          if( xhr.readyState === XMLHttpRequest.DONE ){
            window.location = "/";
          }
        };
        xhr.send();
      })();
    </script>
  </body>
</html>
