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
            displayAudio("audio/shoshoinoue.wav");
        }
        ?>
        <?php
        if (isset($_POST['generate'])){
            $dir='audio/';
            $text = $_POST["textfile"];
            $filename = strtolower($text);
            $filename = str_replace(" ", "_", $filename);
            $filename = $dir.$filename.".wav";
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
            displayAudio($filename);
        }
        ?>

        <p> <img src="./images/singing_colored.png" alt="singing" title="singing" width="200"> </p>
        
    </div>
</div>

</body>
</html>
<?php
function displayAudio($filename)
{
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
