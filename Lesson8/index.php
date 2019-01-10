<?php 
    
    class Cars
    {
        private $tradeMark;
        private $model;
        private $color;
        private $godVipuska;
        private $startPrice;

        public function __construct($tradeMark, $model, $color, $godVipuska, $startPrice)
        {
            $this->tradeMark = $tradeMark;
            $this->model = $model;
            $this->color = $color;
            $this->godVipuska = $godVipuska;
            $this->startPrice = $startPrice;
        }

        public function getPrice ()
        {
            if ( (date('Y') - $this->godVipuska) == 0 ) {
                return $this->startPrice;
            } elseif ( (date('Y') - $this->godVipuska ) <= 3 ) {
                return  $this->startPrice -  $this->startPrice * 0.1;
            } else {
                return  $this->startPrice -  $this->startPrice * 0.3;
            }
        }
    }

    class Televizor
    {
        private $tradeMark;
        private $model;
        private $price;
        private $color;
        private $discount = 0;
        
        public function __construct($tradeMark, $model, $price, $color, $discount = '')
        {
            $this->tradeMark = $tradeMark;
            $this->model = $model;
            $this->price = $price;
            $this->color = $color;
            $this->discount = $discount;
        }

        public function setPrice ($price)
        {
            $this->price = $price;
        }

        public function setDiscount ($discount)
        {
            $this->discount = $discount;
        }

        public function getPrice ()
        {
            if ($this->discount == 0) {
                return $this->price;
            } else {
                return $this->price * ((100-$this->discount)/100);
            }
        }

        public function getItemNames () 
        {
            $item[] = $this->tradeMark;
            $item[] = $this->model;
            $item[] = $this->price;
            $item[] = $this->color;
            $item[] = $this->discount;
            return $item;
        }
    }

    class BallPen
    {
        private $color;
        private $material;
        private $wholesale = 100;  //количество ручек от которого начинается скидка
        private $price;

        public function __construct($color, $material, $price)
        {
            $this->color = $color;
            $this->material = $material;
            $this->price = $price;
        }

        public function getPrice($itemCount)
        {
            if ($itemCount < $this->wholesale) {
                return $itemCount * $this->price;
            } else {
                return $itemCount * $this->price * 0.95;
            }
        }

        public function setWholesale($wholesale)
        {
            $this->wholesale = $wholesale;
        }

    }

    class Duck
    {
        private $wild;
        private $weight;
        private $color;
        private $name = '';

        public function __construct($wild, $weight, $color)
        {
            $this->wild = $wild;
            $this->weight = $weight;
            $this->color = $color;
        }

        public function changeName($name)
        {
            if ($this->wild == 'wild') {
                return 'Утка-то дикая, и пока Ви придумывали ей имя она улетела';
            } else {
                $this->name = $name;
                return $this->name;
            }

            
        }
    }

    class Goods
    {
        private $name;
        private $price;
        private $category;
        private $amount = 0 ;  

        public function __construct($name, $price, $category = '', $amount)
        {
            $this->name = $name;
            $this->price = $price;
            $this->category = $category;
            if (!empty($amount)) {
                $this->amount = $amount;    
            }  
        }

        public function addAmount($amount)
        {
            $this->amount = $this->amount + $amount;
            return $this->amount;
        }

        public function getAmount()
        {
            $i = rand(0, 10);
            if ($i < 5) {
                echo 'Сейчас на складе у вас '.$this->name.' - '.$this->amount.' шт.';
                return $this->amount;
            } else {
                echo 'Товаар '.$this->name.' на складе нет. Мыши съели';
                $this->amount = 0;
                return $this->amount;
            }
        }
    }





// секция работы с классом cars
    #$firstCar = new Cars('Audy', 'TT', 'white', 2000, 10300000);
    #$secondCar = new Cars('Mersedes', 'GL300', 'Black', 2018, 10000000);
    #$thirdCar = new Cars('UAZ', 'Patriot', 'Camuflage', 2019, 4500000);

    $carsArray[] = new Cars('Audy', 'TT', 'white', 2000, 10300000);
    $carsArray[] = new Cars('Mersedes', 'GL300', 'Black', 2018, 10000000);
    $carsArray[] = new Cars('UAZ', 'Patriot', 'Camuflage', 2019, 4500000);

    foreach ($carsArray as $key => $value) {
    print_r($value->getPrice());
    #echo '<br>';
    #print_r($value);
    #echo '<br>';
    }


    //работа с классом телевизор
    $tv1 = new Televizor('LG', 'lg1', 13000, 'black', 5);
    print_r($tv1->getItemNames());
    echo '<br>'.$tv1->getPrice().'<br>';
    $tv1->setDiscount(50);
    print_r($tv1->getItemNames());
    echo '<br>'.$tv1->getPrice().'<br>';
    
    $tv2 = new Televizor('Samsung', 's456', 15600, 'red', 11);
    print_r($tv2->getItemNames());
    echo '<br>'.$tv2->getPrice().'<br>';
    $tv2->setPrice(22000);
    $tv2->setDiscount(10);
    print_r($tv2->getItemNames());
    echo '<br>'.$tv2->getPrice().'<br>';


    #Работа с классом ручек
    $pen1 = new BallPen('red','plastic',20);
    echo 'Стоимость ручек до изменения оптового количества '.$pen1->getPrice(100);
    $pen1->setWholesale(500);
    echo '<br>';
    echo 'Стоимость ручек после изменения оптового количества '.$pen1->getPrice(100);
    $pen2 = new BallPen('green','metall',80);

    #А тут утки
    $duck1 = new Duck('wild', 1.2, 'black');
    echo 'Увас появилась дикая утка. Давайте придумаем ей имя<br>';
    echo '<br>';
    echo $duck1->changeName('Утка');
    echo '<br>';
    $duck2 = new Duck('nowild', 1.2, 'black');
    echo '<br>';
    echo 'Не расстраивайтесь, у Вас появилась вторая утка. Придумайте ей имя <br>';
    echo '<br>';
    echo 'Теперь Вашу утку зовут '.$duck2->changeName('Утка');

    #Товары
    $tovar1 = new Goods('Зерно', 10, '', 100);
    echo '<br>';
    $tovar1->getAmount();

    $tovar2 = new Goods('Макароны', 10, 'Съедобное', 100);


?>