<?php
// $cats В эту переменную передаются все категории из БД
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin section. User control</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php //загрузка меню
include_once ('./files/templates/admin/admin_menu.php');?>

<div>
    <p class="selector">Категория </p>
    <form class="selector" action="" method="get">
        <input type="hidden" name="service" value="q_and_ans">
        <select name="c_id">
            <?php foreach ($cats as $cat): ?>
                <option value="<?=$cat['id']?>" <?php if (isset($_GET['c_id']) && $_GET['c_id'] == $cat['id']) {echo "selected";}?> ><?=$cat['cat_name']?></option>
            <?php endforeach;?>
            <input type="submit" value="Выбрать">
        </select>
    </form>
</div>

</body>
</html>
