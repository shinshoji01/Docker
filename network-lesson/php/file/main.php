<!DOCTYPE html>
<html>
<head>
<body>
<form action="main.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="textfile"/>
    <button type="submit" name="generate">generate !</button>
    <button type="reset" name="reset">reset</button>
</form>
<?php
if (isset($_POST['generate'])){
    $dir='audio/';
    $text = $_POST["textfile"];
    $filename = strtolower($text);
    $filename = str_replace(" ", "_", $filename);
    $filename = $dir.$filename.".wav";
    $found = findAudio($filename);
    if(!$found){ # no file in the database
        echo "getting data";
        echo $text;
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

</body>
</head>
</html>
<?php
function displayAudio($filename)
{
    ?>
    <audio controls>
    <source src="<?php echo $filename; ?>" type="audio/mpeg">
    </source>
    </audio>
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