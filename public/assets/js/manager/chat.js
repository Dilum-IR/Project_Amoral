document.onkeyup = enter;    
function enter(e) {if (e.which == 13) emptycheck();}

function validate() {
    var txt;
    if (confirm("Confirm Logout?")) {
      window.location.href="Login.html";
    }
  }

  function emptycheck(){
    var text = document.getElementById('message-input').value;

    if (text==""){
      return
    }
    else{
      text.innerHTML = "";
      sendMessage();
    }
  }

  function sendMessage(){
      var query = document.getElementById("message-input").value;
      var div = document.createElement("div");
      var p = document.createElement("p");
      p.style.background = "white";
      p.style.color = "black";
      p.style.padding = "10px";
      p.style.marginBottom = "10px";
      p.style.borderRadius = "5px";
      p.style.display = "inline-block";
      p.style.maxWidth = "60%";
      p.innerHTML = query;
      document.getElementById("chat-body").appendChild(div);
      document.getElementById("chat-body").appendChild(p);
      // response()
    }

  function response(){
      var empty = false;
      var query = document.getElementById("message-input").value;
      var input = query.toLowerCase();
      var div = document.createElement("div");
      var p = document.createElement("p");
      p.style.background = "#2a2a2a";
      p.style.color = "white";
      p.style.padding = "10px";
      p.style.borderRadius = "5px";
      p.style.display = "inline-block";
      p.style.margin = "0";
      p.style.maxWidth = "75%";
      document.getElementById("chat-body").appendChild(div);
      document.getElementById("chat-body").appendChild(p);

    }