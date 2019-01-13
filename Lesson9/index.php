<?php 
    #был ли получен GET-запрос или пока все чисто
    if (empty($_GET['name'])) {
        $nameQuery = "%";
        $namePlaceholder = 'Название';
        $formName = '';
    } else {
        $namePlaceholder = $_GET['name'];
        $nameQuery = "%".$_GET['name']."%";
        $formName = $_GET['name'];
    }

    if (empty($_GET['author'])) {
        $authorQuerry = "%";
        $authorPlaceholder = 'Автор';
        $formAuthor = '';
    } else {
        $authorQuerry = "%".$_GET['author']."%";
        $authorPlaceholder = $_GET['author'];
        $formAuthor = $_GET['author'];
    }

    if (empty($_GET['isbn'])) {
        $isbnQuery = "%";
        $isbnPlaceholder = 'ISBN';
        $formIsbn = '';
    } else {
        $isbnQuery = "%".$_GET['isbn']."%";
        $isbnPlaceholder = $_GET['isbn'];
        $formIsbn = $_GET['isbn'];
    }

    
    #подключаемся к БД
    $user = 'rbagrov';
    $pass = 'neto1918';
    $dbBooks = new PDO('mysql:host=localhost;dbname=netology_lessons', $user, $pass);
         
    #Формируем запрос к БД
    $statemant = $dbBooks->prepare("SELECT `name`, `author`, `year`, `genre`, `isbn` FROM `books` WHERE `name` LIKE :name AND `author` LIKE :author AND `isbn` LIKE :isbn");
    $statemant->execute([":name" => $nameQuery, ":author" => $authorQuerry, ":isbn" =>  $isbnQuery]);
    $queryResult = $statemant->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Работа с БД</title>
    <style type="text/css">
        table {
            margin-top: 15px;
            border-collapse: collapse;
        }
        thead tr {
            font-weight: bold;
            background-color: #a9a9a9;
        }

        tbody tr:nth-child(even) {
            background-color: lightgrey;
        }
        td {
            padding: 3px;
            border-width: 1px;
            border-style: solid;
            border-color: #cccccc;
        }
    </style>
</head>
<body>
    <h2>Маленькая библиотечка</h2>

    <form action="" method="get">
        <input type="text" name="name" value="<?php echo $formName ?>" placeholder="<?php echo $namePlaceholder ?>">
        <input type="text" name="author" value="<?php echo $formAuthor ?>" placeholder="<?php echo $authorPlaceholder ?>">
        <input type="text" name="isbn" value="<?php echo $formIsbn ?>" placeholder="<?php echo $isbnPlaceholder ?>">
        <input type="submit" value="Поиск">
    </form>

    <table>
        <thead>
            <tr>
                <td>Название</td><td>Автор</td><td>Год</td><td>Жанр</td><td>isbn</td>
            </tr>    
        </thead>
        <tbody>
        <?php foreach ($queryResult as $value): ?>
            <tr>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['author'] ?></td>
                <td><?php echo $value['year'] ?></td>
                <td><?php echo $value['genre'] ?></td>
                <td><?php echo $value['isbn'] ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>