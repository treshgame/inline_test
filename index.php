<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="submit" name="submit" value="Выгрузить в бд">
    </form>

    <?

    if(isset($_POST['submit'])){
        $comm_num = 0;
        $posts_num = 0;
        $posts = file_get_contents('https://jsonplaceholder.typicode.com/posts');
        $posts = (array)json_decode($posts);

        $comments = file_get_contents('https://jsonplaceholder.typicode.com/comments');
        $comments = (array)json_decode($comments);

        $db = new PDO('mysql:host=localhost;dbname=testdb;', 'root', '');
        foreach($comments as $comment){
            $query = $db->prepare("INSERT INTO comments (`postId`, username, email, body) VALUES (:postId, :username, :email, :body)");
            $params = [
                ':postId' => (int)$comment->postId,
                ':username' => $comment->name, 
                ':email' => $comment->email, 
                ':body' => $comment->body
            ];
            $query->execute($params);
            $comm_num++;
        }

        foreach($posts as $post){
            $query = $db->prepare("INSERT INTO posts (userId, title, body) VALUES (:userId, :title, :body)");
            $params_posts = [
                ':userId' => (int)$post->userId,
                ':title' => $post->title, 
                ':body' => $post->body
            ];
            $query->execute($params_posts);
            $posts_num++;
        }

        echo "<script>";
        echo "console.log('Загружено ".$comm_num." комментариев и ".$posts_num." записей');";
        echo "</script>";
    }
   
    ?>
</body>
</html>