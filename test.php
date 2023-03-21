<?php
echo '테스트';

$test = 3;
$tt = 5;

echo $test;

var_dump($test);

$string = "aaaaaaaaaaa";

if($test<$tt){
    echo $string;
}

$arr = array(3,2,1);

echo sizeof($arr);

foreach($arr as $a){
    echo $a;
}
echo count($arr);

echo '<br>';

$q = 'q-q-q-q';

$aa = explode("-",$q);

echo count($aa);

function printer(){
    echo 'print';
}

printer();

function increment(&$para)
{
    $para++;
}

$value = 1;

increment($value);

echo $value;

echo gettype($value);

settype($value,"string");

echo gettype($value);

echo is_int($value);

$array = array('a','c','b');

echo current($array);

sort($array,SORT_STRING);

$ss = array(1,2,3,4,5,2,2,1,2,3);

sort($ss,SORT_NUMERIC);

print_r($ss);

echo '<br>';

echo strcmp('aasdasdsadsd','a');
echo ucwords("hello, world!");

$ww = 'aasa adaa awaa';

$dd = explode(' ',$ww);

$str2 = implode('!',$dd);

print_r($str2);

class first{
    public $pop;

    function __construct($a){
        $this->pop = $a;
        echo '객체 생성';
    }
    function __destructor(){
        echo '객체 제거';
    }

    function overTest(){
        echo 'first';
    }
}

class second extends first{

    public $pop;

    public const aswwd = 'ww';
    public static $star = 'asssd';
    function overTest()
    {
        echo 'second';
    }
}

echo '<br>';echo '<br>';

echo second::aswwd;

echo '<br>';echo '<br>';

echo second::$star;

echo '<br>';echo '<br>';

$sec = new second('zzz');

echo $sec->overTest();

echo $sec->pop;

define('tkdtn','wjdtkdtn');


class overlo {

    private $overarr = array();

    public function __set($na,$va){
        $this->overarr[$na]=$va;
    }
    public function __get($na){
        echo $this->overarr[$na];
    }
}

class meover{

    public function __call($name,$arg){
        echo join(",",$arg).'에서 접근 불가 메소드를 호출';
    }

    public static function __callStatic($name,$arg){
        echo join(',',$arg).'에서 접근 불가 메소드 호출';
    }
}

$meo = new meover();

$meo->testmethod('집');

meover::test('정적');

echo '<br>';echo '<br>';

class A {
    public static function foo(){
        static::who();
    }
    public static function who(){
        var_dump(__CLASS__);
    }
}
class B extends A{
    public static function test(){

        A::foo();
        parent::foo();
        self::foo();
    }

    public static function who()
    {
        var_dump(__CLASS__);
    }
}
$b = new B();
$b->test();


echo '<br>';echo '<br>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameMsg = "이름을 입력해 주세요!";
    } else {
        $name = $_POST["name"];
    }

    if (!isset($_POST["gender"]) || $_POST["gender"]==false) {
        $genderMsg = "성별을 선택해 주세요!";
    } else {
        $gender = $_POST["gender"];
    }
    $email = $_POST["email"];
    $website = $_POST["website"];
    if (empty($_POST["favtopic"])) {
        $favtopicMsg = "하나 이상 골라주세요!";
    } else {
        $favtopic = $_POST["favtopic"];
    }
    $comment = $_POST["comment"];

}

echo "<h2>입력된 회원 정보</h2>";
echo "이름 : ".$name."<br>";
echo "성별 : ".$gender."<br>";
echo "이메일 : ".$email."<br>";
echo "홈페이지 : ".$website."<br>";
echo "관심 있는 분야 : ";

if (!empty($favtopic)) {
    foreach ($favtopic as $value) {
        echo $value." ";
    }
}

echo "<br>기타 : ".$comment; ?>

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    이름 : <input type="text" name="name">

    성별 :

    <input type="radio" name="gender" value="female">여자

    <input type="radio" name="gender" value="male">남자

    이메일 : <input type="text" name="email">

    홈페이지 : <input type="text" name="website">

    관심 있는 분야 :

    <input type="checkbox" name="favtopic[]" value="movie"> 영화

    <input type="checkbox" name="favtopic[]" value="music"> 음악

    <input type="checkbox" name="favtopic[]" value="game"> 게임

    <input type="checkbox" name="favtopic[]" value="coding"> 코딩

    기타 : <textarea name="comment"></textarea>

    <input type="submit" value="전송">

</form>

