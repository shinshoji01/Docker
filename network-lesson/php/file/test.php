<meta charset="UTF-8">
<title>テスト</title>
<?php
try {
        $dsn = "mysql:host=mysql;dbname=sample;";
        $db = new PDO($dsn, 'root', 'lesson');

        $sql = "SELECT * FROM test";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
} catch (PDOException $e) {
        echo $e->getMessage();
        exit;
}
?>
