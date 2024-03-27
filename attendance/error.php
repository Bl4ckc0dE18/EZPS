<noscript>
<center><b><h1>ERROR!</h1></b></center>
<center><b>This page needs JavaScript activated to work. </p></b></center>

<style>div { display:none; }</style>
</noscript>

<body oncontextmenu="return false">
    
</body>
<script>
document.onkeydown = function(e) {
    if(event.keyCode == 123) {
       return false;
       header('location: logout.php');
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
       return false;
       header('location: logout.php');
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
       return false;
       header('location: logout.php');
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
       return false;
       header('location: logout.php');
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
       return false;
       header('location: logout.php');
    }
  }
  
  if(time() - $_SESSION['timestamp'] > 300) { //subtract new timestamp from the old one
   
    unset($_SESSION['username'], $_SESSION['password'], $_SESSION['timestamp']);
    $_SESSION['logged_in'] = false;
    header("Location: " . index.php); //redirect to index.php
    exit;
} else {
    $_SESSION['timestamp'] = time(); //set new timestamp
}
  </script>
