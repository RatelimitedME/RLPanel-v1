  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("users").innerHTML =
      this.responseText;
      console.log(this.responseText);
    }
  };
  xhttp.open("GET", "../api/api.php?action=getInt&int=USERS", true);
  xhttp.send();

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("blocked").innerHTML =
      this.responseText;
      console.log(this.responseText);
    }
  };
  xhttp.open("GET", "../api/api.php?action=getInt&int=BLOCKED", true);
  xhttp.send();

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("emails").innerHTML =
      this.responseText;
      console.log(this.responseText);
    }
  };
  xhttp.open("GET", "../api/api.php?action=getInt&int=EMAILS", true);
  xhttp.send();

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("signup").innerHTML =
      this.responseText;
      console.log(this.responseText);
    }
  };
  xhttp.open("GET", "../api/api.php?action=getInt&int=SIGNUP_USERS", true);
  xhttp.send();
