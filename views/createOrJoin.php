<?php

    session_start();
    
    if(!isset($_SESSION['jumpkey']))
    {
        header("Location: index.php");
    }

?>

<html>
<head>
<link rel="stylesheet" href="/styles/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="/scripts/createOrJoin.js"></script>
</head>
<body id="makes">
<script>
    window.localStorage.clear();
    // allUser("<?php echo $_SESSION['jumpkey'];?>");

    

    function setup()
    {
        var makes = document.getElementById('makes');

        makes.innerHTML = `<div class='theForm match'>
        <label for='name'>Name of game match:</label>
        <input text='text' id='gname' name='gname'><br>
        <button class='button' onClick='createGameplay("<?php echo $_SESSION['jumpkey']?>");'>Create Match</button>
        </div>`;
    }

    async function join()
    {
        var makes = document.getElementById('makes');
        
        await setInterval(() => {
            
            $.post('/backend/lobbies.php',{op:'search'},function(data, status){
            lobby = JSON.parse(data);
            console.log(...lobby);

            var lobby;

            if(lobby != null)
            {
                $div = $("<div></div>");

                for(var l in lobby)
                {
                    if(lobby[l].cap != 2)
                    {
                        $div.append(`<div class='theForm match'><h3 class='selection' onclick='joinLobby("${lobby[l].id}", "<?php echo $_SESSION['jumpkey']?>");'>${lobby[l].name}</h3></div>`);
                    }
                    
                }

                makes.innerHTML = $div.html();
            }
        });

        }, 2000);

       

        
    }

    function joinLobby(x,y)
    {
        $.post('/backend/lobbies.php',{luckyNum:x,jumpjack:y, role:'second', op:'join',cap:2}, function(data, status){
            console.log(data);

            <?php $_SESSION['op'] = "join"; ?>

            window.location.href = 'lobby.php';
        });
    }
</script>
<div class="choiceWrap">
<?php echo '<div><button class="choice" onClick="setup();">Create</button></div><div><button class="choice" onclick="join();">Join</button></div>';?>


<!-- onClick="createGameplay(\''.$_SESSION['jumpkey'].'\' -->
</div>
</body>

</html>