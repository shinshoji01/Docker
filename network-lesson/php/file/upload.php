<?php
if(isset($_POST['save_audio']) && $_POST['save_audio']=="Upload Audio")
{
    $dir='audio/';
    $audio_path=$dir.basename($_FILES['audiofile']['name']);

    if(move_uploaded_file($_FILES['audiofile']['tmp_name'],$audio_path))
    {
        echo 'uploaded successfully.';
        echo "<br/>";

        saveAudio($audio_path);

        displayAudios();
    }
}
function displayAudios()
{
    $conn=mysqli_connect('mysql', 'root', 'lesson', 'lesson');
    if(!$conn)
    {
        die('server not connected');
    }

    $query="select * from test";

    $r=mysqli_query($conn,$query);

    while($row=mysqli_fetch_array($r))
    {
        echo '<a href="play.php?name='.$row['name'].'">'.$row['name'].'</a>';
        #echo $row["name"];
        echo "<br/>";
    }

    echo mysqli_error($conn);

    mysqli_close($conn);

}
function saveAudio($filename)
{
    $conn=mysqli_connect('mysql', 'root', 'lesson', 'lesson');
    if(!$conn)
    {
        die('server not connected');
    }
    #$pdo = new PDO('mysql:host=localhost;dbname=lesson;charset=utf8mb4','root','lesson');
    #$pdo = new PDO('mysql:host=mysql;dbname=lesson', 'lesson', 'lesson');

    #$pdo = new PDO('mysql:host=mysql;dbname=lesson', 'lesson', 'lesson');
    #$sql = "insert into test(text) values('{$fileame}')";
    #$qry = $pdo->prepare($sql);
    #$qry->execute();
    #echo "audio file path saved in database.";
    #$pdo = null;

    $query = "insert into test(name) values('{$filename}')";

    mysqli_query($conn,$query);
    #echo mysqli_error($conn);

    #echo mysqli_affected_rows($conn);


    if(mysqli_affected_rows($conn)>0)
    {
        echo "audio file path saved in database.";
        echo "<br/>";
    }

    mysqli_close($conn);
}
?>