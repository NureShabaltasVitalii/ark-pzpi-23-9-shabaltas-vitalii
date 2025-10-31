<?php
declare(strict_types=1);

namespace App\Examples;

use Psr\Log\LoggerInterface;
use App\Models\User;

/**
 * Клас Example демонструє різні правила PSR-12
 */
class Example
{
    // -------------------------------------------
    // 3.2.3 Відступи — чотири пробіли, не таби
    // Погано:
    // if ($a) {
    // \tdoSomething();
    // }

    // Добре:
    public function indentExample($a)
    {
        if ($a) {
            doSomething(); // 4 пробіли для відступу
        }
    }

    // -------------------------------------------
    // 3.2.4 Фігурні дужки на новому рядку
    // Погано:
    // class A { public function foo(){return true;} }

    // Добре:
    public function bracesExample()
    {
        class A
        {
            public function foo()
            {
                return true;
            }
        }
    }

    // -------------------------------------------
    // 3.2.5 Пробіли навколо операторів і після ком
    // Погано:
    // $a=1+$b;
    // list($a,$b)=func();
    // if($a&&$b){...}

    // Добре:
    public function spacingExample($a, $b)
    {
        $sum = $a + $b;
        list($first, $second) = func();
        if ($first && $second) {
            // ...
        }
    }

    // -------------------------------------------
    // 3.2.6 Довжина рядка і розбиття виразів
    public function longLineExample($service, $firstArgument, $secondArgument, $thirdArgument, $fourthArgument, $fifthArgument)
    {
        // Погано:
        // $result = $service->doSomethingVeryLongName($firstArgument, $secondArgument, $thirdArgument, $fourthArgument, $fifthArgument);

        // Добре:
        $result = $service->doSomethingVeryLongName(
            $firstArgument,
            $secondArgument,
            $thirdArgument,
            $fourthArgument,
            $fifthArgument
        );
    }

    // -------------------------------------------
    // 3.2.7 Іменування: класи, методи, змінні, константи
    // Погано:
    // class userprofile{ public function GET_userDATA($uid){ ... } }

    // Добре:
    public function namingExample(int $userId): array
    {
        class UserProfile
        {
            public function getUserData(int $userId): array
            {
                return [];
            }
        }

        $userProfile = new UserProfile();
        return $userProfile->getUserData($userId);
    }

    // -------------------------------------------
    // 3.2.8 Сигнатури функцій/методів: типи, порядок, форматування
    // Погано:
    // function createUser($name,$email,$age=null){ /* ... */ }

    // Добре:
    public function createUser(string $name, string $email, ?int $age = null): User
    {
        return new User();
    }

    public function sendNotification(
        User $user,
        string $subject,
        string $message,
        ?\DateTimeImmutable $sendAt = null
    ): void {
        // ...
    }

    // -------------------------------------------
    // 3.2.9 Видимість та порядок членів класу
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

    // -------------------------------------------
    // 3.2.10 Обробка помилок: винятки замість тихого повернення false/null
    // Погано:
    // function openFile(string $path) { $f = @fopen($path, 'r'); if ($f === false) { return false; } return $f; }

    // Добре:
    public function openFile(string $path)
    {
        $f = fopen($path, 'r');
        if ($f === false) {
            throw new \RuntimeException(sprintf('Не вдалося відкрити файл: %s', $path));
        }
        return $f;
    }

    // -------------------------------------------
    // 3.2.11 Коментарі та документація (PHPDoc)
    /**
     * Повертає дані користувача за його ID
     *
     * @param int $id Ідентифікатор користувача
     * @return array Дані користувача
     */
    public function getUserData(int $id): array
    {
        return [];
    }

    // -------------------------------------------
    // 3.2.12 Кодування файлу та порожній рядок у кінці
    // Всі файли мають бути UTF-8 без BOM та завершуватись одним порожнім рядком
}
