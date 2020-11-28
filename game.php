<?php

    session_start();
    
    if(!isset($_SESSION['jumpkey']))
    {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles/aim.css">
<link rel="stylesheet" href="styles/game.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="/scripts/aim.js"></script>
</head>
<body onload="aim('<?php echo $_SESSION['jumpkey']; ?>');">


</body>
</html>