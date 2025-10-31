<?php
declare(strict_types=1);



/*
   3.2.1 Початок файлу: <?php та declare(strict_types=1);
*/

//  Поганий приклад
<?php
// ……
// ?>

//  Гарний приклад
<?php
declare(strict_types=1);

namespace App\Services;

class Example
{
    // ...
}

/* 
   3.2.2 namespace і use — порядок і розташування
*/

//  Поганий приклад
<?php
use Psr\Log\LoggerInterface;
namespace App\Controllers;

class C { }

//  Гарний приклад
<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Psr\Log\LoggerInterface;

class UserController
{
    // ...
}

/* 
   3.2.3 Відступи — чотири пробіли, не таби
*/

//  Поганий приклад (із табами або змішаними відступами)
if ($a) {
	doSomething();
}

//  Гарний приклад
if ($a) {
    doSomething();
}

/* 
   3.2.4 Розташування фігурних дужок
*/

//  Поганий приклад
class A { public function foo(){return true;} }

//  Гарний приклад
class A
{
    public function foo()
    {
        return true;
    }
}

/*
   3.2.5 Пробіли навколо операторів і після ком
 */

//  Поганий приклад
$a=1+$b;
list($a,$b)=func();
if($a&&$b){...}

//  Гарний приклад
$a = 1 + $b;
list($a, $b) = func();
if ($a && $b) {
    // ...
}

/*
   3.2.6 Коментарі та документація (PHPDoc)
*/

//  Поганий приклад
class User {
    public function getData($id) { /* ... */ }
}

//  Гарний приклад
/**
 * Клас користувача
 */
class UserGood
{
    /**
     * Повертає дані користувача за його ID
     *
     * @param int $id Ідентифікатор користувача
     * @return array Дані користувача
     */
    public function getData(int $id): array
    {
        // ...
    }
}

/*
   3.2.7 Кодування файлу та порожній рядок у кінці
 */

//  Поганий приклад
<?php
class ExampleBad { /* ... */ }   // немає порожнього рядка у кінці, файл може містити BOM
//  Гарний приклад
<?php
class ExampleGood
{
    // ...
}

// (UTF-8 без BOM, один порожній рядок у кінці)

/*
   3.2.8 Довжина рядка і розбиття виразів
 */

//  Поганий приклад
$result = $service->doSomethingVeryLongName($firstArgument,
$secondArgument, $thirdArgument, $fourthArgument,
$fifthArgument);

//  Гарний приклад
$result = $service->doSomethingVeryLongName(
    $firstArgument,
    $secondArgument,
    $thirdArgument,
    $fourthArgument,
    $fifthArgument
);

/* 
   3.2.9 Іменування: класи, методи, змінні, константи
 */

//  Поганий приклад
class userprofile{
    public function GET_userDATA($uid){ /* ... */ }
}

//  Гарний приклад
class UserProfile
{
    public function getUserData(int $userId): array
    {
        // ...
    }
}

/* 
   3.2.10 Сигнатури функцій/методів: типи, порядок, форматування
*/

//  Поганий приклад
function createUser($name,$email,$age=null){ /* ... */ }

//  Гарний приклад
function createUser(string $name, string $email, ?int $age = null): User
{
    // ...
}

//  Приклад довгої сигнатури
public function sendNotification(
    User $user,
    string $subject,
    string $message,
    ?\DateTimeImmutable $sendAt = null
): void {
    // ...
}

/* 
   3.2.11 Видимість та порядок членів класу
 */

//  Поганий приклад
class A1 {
    function do() {}
    private $a;
    public $b;
}

//  Гарний приклад
class A2
{
    public const DEFAULT_LIMIT = 10;

    private int $a;
    public string $b;

    public function __construct(string $b)
    {
        $this->b = $b;
    }

    public function doSomething(): void
    {
        // ...
    }

    protected function helper(): void
    {
        // ...
    }

    private function internal(): void
    {
        // ...
    }
}

/* 
   3.2.12 Обробка помилок: винятки замість false/null
*/

//  Поганий приклад
function openFileBad(string $path) {
    $f = @fopen($path, 'r');
    if ($f === false) {
        return false;
    }
    return $f;
}

//  Гарний приклад
function openFileGood(string $path)
{
    $f = fopen($path, 'r');
    if ($f === false) {
        throw new \RuntimeException(sprintf('Не вдалося відкрити файл: %s', $path));
    }

    return $f;
}
