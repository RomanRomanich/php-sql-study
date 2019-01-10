<?php
    /**
    * необходимо разобрать массив с ответо в удобочитаемый формат
    */
    class News
    {
        private $newsTitle;
        private $newsBody;
        private $newsDate;
        private $newsComments;

        public function __construct($newsTitle, $newsBody)
        {
            $this->newsTitle = $newsTitle;
            $this->newsBody = $newsBody;
            $this->newsDate = date('Y-m-d H:i');
        }

        public function addComment($commentBody, $commentAuthor = 'Anonimus')
        {
            $this->newsComments[] = new Comments($commentBody, $commentAuthor);
        }

        public function getNews()
        {
            $currentNews['title'] = $this->newsTitle;
            $currentNews['body'] = $this->newsBody;
            $currentNews['date'] = $this->newsDate;
            return $currentNews;
        }

        public function getComments()
        {
            foreach ($this->newsComments as $key => $value) {
                $currentNews['comments'][] = $value->getNewsComments();
            }
            return $currentNews;
        }
    }




    class Comments
    {
        protected $commentBody;
        protected $commentAuthor;
        protected $commentDate;

        public function __construct($commentBody, $commentAuthor = 'Anonimus')
        {
            $this->commentBody = $commentBody;
            $this->commentAuthor = $commentAuthor;
            $this->commentDate = date('Y-m-d H:i');
        }

        public function getNewsComments()
        {
            $currentArray['comBody'] = $this->commentBody;
            $currentArray['comAuthor'] = $this->commentAuthor;
            $currentArray['comDate'] = $this->commentDate;
            return $currentArray;
        }
    }




    $news1 = new News('ЧТо это было?', 'Вчера над городом пролетела какаятото хрень. Ученые до сих порв шоке');
    $newsSuperArray[] = new News('ЧТо это было?', 'Вчера над городом пролетела какаятото хрень. Ученые до сих порв шоке');

    $news1->addComment('Ну эти ученые как всега', 'Главный Неуч');
    $news1->addComment('Нет мы во всем разберемся, дайте только время', 'Главный Уч');
    $newsSuperArray[0]->addComment('Ну эти ученые как всега', 'Главный Неуч');
    $newsSuperArray[0]->addComment('Нет мы во всем разберемся, дайте только время', 'Главный Уч');

    $news2 = new News('Летят утки', 'Расследование взрыва в больнице идет полным ходом');
    $newsSuperArray[] = new News('Летят утки', 'Расследование взрыва в больнице идет полным ходом');

    $news2->addComment('Мочить надо этих террористов');
    $news2->addComment('Сами вы террористы');
    $newsSuperArray[1]->addComment('Мочить надо этих террористов');
    $newsSuperArray[1]->addComment('Сами вы террористы');


?>

<!DOCTYPE html>
<html>
<head>
    <title>Типа новостной сайт</title>
    <style type="text/css">

    </style>
</head>
<body>

    <?php foreach ($newsSuperArray as $value): 
    $newsArray = $value->getNews();
    $commentsArray = $value->getComments();?>

    <h2><?php echo $newsArray['title'] ?></h2>
    <p><?php echo $newsArray['body'] ?></p>
    <p><i><?php echo $newsArray['date'] ?></i></p>



        <?php foreach ($commentsArray['comments'] as $key => $valueComm): ?>

            <p><?php echo $valueComm['comBody'] ?></p>
            <p><b><?php echo $valueComm['comAuthor'] ?></b></p>
            <p><i><?php echo $valueComm['comDate'] ?></i></p>

        <?php endforeach ?>    



    <?php endforeach ?>



</body>
</html>