<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title> Demo of Tacotron2 and WaveGlow</title>
</head>
<body>
<h1>
Introduction
</h1>
<p> 
This website contains the demo of a text-to-speech conversion system using deeplearning models: Tacotron2 and WaveGlow.
</p>
<form action="main.php" method="POST">
<div class="wrapper">
    <div> 
        <br>
        <br>
        <br>
        <p> <input type="text" name="textfile"/> </p>
        <p> <img src="./images/pencil_eraser_colored.png" alt="pencil and eraser" title="pencil and eraser" width="200"> </p>
    </div>
    <div>
        <p>
        <input type="hidden" value="hidden" name="generate" />
        <input type="image" name="generate" value="" src="./images/three_arrow_colored.png"  alt="generate" width="200">
        </p>
    </div>
</form>
    <div> 
        <?php
        if (!isset($_POST['generate'])){
            $text = "shoshoinoue";
            $filename = text2filename($text);
            echo "<center><font size='5' face='ＭＳ ゴシック'> ".$text." </font></center>";
            displayAudio($filename);
        }
        ?>
        <?php
        if (isset($_POST['generate'])){
            $text = $_POST["textfile"];
            echo "<center>".$text."</center>";
            echo "<br>";
            $filename = text2filename($text);
            $found = findAudio($filename);
            if(!$found){ # no file in the database
                #echo "getting data";
                #echo $text;
                $cmd = "sudo docker exec -it network-lesson_python_1 python3 /work/get_audio.py --text "."'".$text."'";
                exec($cmd);
                #exec($cmd, $opt, $status);
                #$opt;
                #print_r($opt);

                #if ($status !==0){
                #    echo "Error_Code:".$status;
                #}

                saveAudio($filename);
            }
            #echo $_POST['textfile'];
            displayAudio($text);
        }
        ?>

        <p> <img src="./images/singing_colored.png" alt="singing" title="singing" width="200"> </p>
        
    </div>
    <div> </div>
    <!-- <div><p><font size="6">Examples</font></p></div> -->
    <div><h1>Examples</h1></div>
    <div> </div>
    <!-- 1st example-->
    <div>
        <?php $text = "Please, wash your hands before eating." ?>
        <br>
        <div class=area>
            <?php echo "<p><font size='5' face='ＭＳ ゴシック'>".$text."</font></p>"?>
        </div>
    </div>
    <div>
        <div class=area>
        <img src="./images/wash_hands.png" alt="wash_hands" title="wash_hands" width="100">
        </div>
    </div>
    <div>
        <div class=area>
        <?php displayAudio(text2filename($text))?>
        </div>
    </div>
    <!-- 2nd example-->
    <div>
        <?php $text = "Mt. Fuji is the highest mountain in Japan." ?>
        <br>
        <div class=area>
            <?php echo "<p><font size='5' face='ＭＳ ゴシック'>".$text."</font></p>"?>
        </div>
    </div>
    <div>
        <div class=area>
        <img src="./images/mtfuji_colored.png" alt="mtfuji" title="mtfuji" width="100">
        </div>
    </div>
    <div>
        <div class=area>
        <?php displayAudio(text2filename($text))?>
        </div>
    </div>
    <!-- 3rd example-->
    <div>
        <?php $text = "Tokyo Skytree is over three hundred taller than Tokyo Tower." ?>
        <br>
        <div class=area>
            <?php echo "<p><font size='5' face='ＭＳ ゴシック'>".$text."</font></p>"?>
        </div>
    </div>
    <div>
        <div class=area>
        <img src="./images/skytree.png" alt="skytree" title="skytree" width="100">
        </div>
    </div>
    <div>
        <div class=area>
        <?php displayAudio(text2filename($text))?>
        </div>
    </div>
    <!-- 4th example-->
    <div>
        <?php $text = "A recent innivation that helps people in the world." ?>
        <br>
        <div class=area>
            <?php echo "<p><font size='5' face='ＭＳ ゴシック'>".$text."</font></p>"?>
        </div>
    </div>
    <div>
        <div class=area>
        <img src="./images/online_chatting.png" alt="online_chatting" title="online_chatting" width="100">
        </div>
    </div>
    <div>
        <div class=area>
        <?php displayAudio(text2filename($text))?>
        </div>
    </div>
</div>



</body>
</html>
<?php
function text2filename($text)
{
    $dir='audio/';
    $filename = strtolower($text);
    $filename = str_replace(" ", "_", $filename);
    $filename = $dir.$filename.".wav";
    return $filename;
}
function displayAudio($text)
{
    $filename = text2filename($text)
    ?>
    <p>
    <audio controls>
    <source src="<?php echo $filename; ?>" type="audio/mpeg">
    </source>
    </audio>
    </p>
<?php
}
function findAudio($filename)
{
    $conn=mysqli_connect('mysql', 'root', 'lesson', 'lesson');
    if(!$conn)
    {
        die('server not connected');
    }

    $query="select id from test where name='".$filename."'";
    $r=mysqli_query($conn,$query);
    $rowcount = mysqli_num_rows($r);
    mysqli_close($conn);

    return $rowcount>0;

}
function saveAudio($filename)
{
    $conn=mysqli_connect('mysql', 'root', 'lesson', 'lesson');
    if(!$conn)
    {
        die('server not connected');
    }

    $query = "insert into test(name) values('{$filename}')";
    mysqli_query($conn,$query);
    #if(mysqli_affected_rows($conn)>0)
    #{
    #    echo "audio file path saved in database.";
    #    echo "<br/>";
    #}
    mysqli_close($conn);
}
?>
