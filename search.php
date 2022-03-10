<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="fragment">
        <input type="submit" name="submit">
    </form>

    <?
    
    if(isset($_POST['submit'])){
        $frag = trim($_POST['fragment']);
        if(strlen($frag) > 3){
            $db = new PDO('mysql:host=localhost;dbname=testdb;', 'root', '');
            $query = $db->prepare("SELECT * FROM comments WHERE body LIKE ?");
            $query->execute(["%$frag%"]);
            $result = $query->fetchAll();
            if($result){
                foreach($result as $item){
                    $query = $db->prepare("SELECT title FROM posts WHERE id = ?");
                    $query->execute([$item['postId']]);
                    $res = $query->fetch();
                    echo "<p>Title:".$res['title']."</p>";
                    echo "<p>Comment: ".$item['body']."</p>";
                }
                
            }
        }else{
            echo "<p>Введите фрагмент не короче 3 символов</p>";
        }
    }

    ?>
</body>
</html>