<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<title>FAQ</title>
</head>
<body>
<header>

	<h1>FAQ</h1>

</header>
<a href="?admin=1" class="my-a">Войти как администратор</a>



<section class="cd-faq">
	<ul class="cd-faq-categories">

        <?php foreach ($cats as $catKey => $category): ?>
		<li><a <?php if($catKey == 0) {echo "class=\"selected\"";}?>  href="#<?=$category['id']?>"><?=$category['cat_name']?></a></li>
        <?php endforeach;?>
		<li><a href="#addquest">Задать вопрос</a></li>
	</ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">
        <?php foreach ($quests as $catKey => $category): ?>
        <ul id="<?=$category['id']?>" class="cd-faq-group">
            <li class="cd-faq-title"><h2><?=$category['cat_name']?></h2></li>

            <?php foreach ($category[$category['id']] as $questKey => $quest): ?>
               <li>
                   <a class="cd-faq-trigger" href="#0"><?=$quest['quest']?></a>
                <div class="cd-faq-content">
                    <p><?=$quest['answer']?></p>
                </div> <!-- cd-faq-content -->
                </li>
            <?php endforeach;?>
        </ul> <!-- cd-faq-group -->
        <?php endforeach;?>

		<ul id="addquest" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Задать вопрос</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">Задайте Ваш вопрос</a>
				<div class="cd-faq-content">
                    <form action="" method="post">
                        <input type="hidden" name="add_quest" value="1">
                        <p>Выберите тему вопроса</p>
                        <p><select name="category_id">
                                <option disabled value="">Тема вопроса</option>
                                <?php foreach ($allCats as $key => $value): ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['cat_name'] ?></option>
                                <?php endforeach; ?>
                            </select></p>
                        <p>Напишите Ваш вопрос</p>
                        <p><textarea name="quest" cols="50" rows="5"></textarea></p>
                        <p>Как Вас зовут</p>
                        <p><input type="text" name="quester_name"></p>
                        <p>Укажите Вашу электронную почту</p>
                        <p><input type="email" name="quester_mail"></p>
                        <p><input type="submit" value="Задать вопрос"></p>
                    </form>
				</div> <!-- cd-faq-content -->
			</li>

		</ul> <!-- cd-faq-group -->


    </div> <!-- cd-faq-items -->
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>