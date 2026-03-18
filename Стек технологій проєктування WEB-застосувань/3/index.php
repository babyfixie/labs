<?php
// interface
interface AccountInterface
{
  public function deposit($amount);// поповнення рахунку
  public function withdraw($amount);// зняття коштів
  public function getBalance();// отримання поточного балансу
}

// basic class with const
class BankAccount implements AccountInterface
{
  public const MIN_BALANCE = 0;

  protected $balance;
  protected $currency;

  // constructor for BankAccount
  public function __construct($currency = "USD", $initialBalance = 0)
  {
    if ($initialBalance < self::MIN_BALANCE) {
      throw new Exception("Помилка створення: Початковий баланс не може бути меншим за мінімальний.");
    }
    $this->currency = $currency;
    $this->balance = $initialBalance;
  }

  public function deposit($amount)
  {
    if ($amount <= 0) {
      throw new Exception("Помилка поповнення: Сума має бути більшою за нуль.");
    }
    $this->balance += $amount;
  }

  public function withdraw($amount)
  {
    if ($amount <= 0) {
      throw new Exception("Помилка зняття: Сума має бути більшою за нуль.");
    }
    if ($this->balance - $amount < self::MIN_BALANCE) {
      throw new Exception("Помилка зняття: Недостатньо коштів на рахунку.");
    }
    $this->balance -= $amount;
  }

  public function getBalance()
  {
    return number_format($this->balance, 2, '.', '') . " " . $this->currency;
  }
}

// inheritance
class SavingsAccount extends BankAccount
{
  public static $interestRate = 0.05;

  public function applyInterest()
  {
    $interest = $this->balance * self::$interestRate;
    $this->balance += $interest;
    return $interest;
  }
}

// client code
?>
<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <title>Лабораторна робота 3 - ООП</title>
  <style>
    h3,
    h2 {
      margin: 0;
    }

    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      padding: 20px;
    }

    .success {
      color: green;
    }

    .error {
      color: red;
    }

    .block {
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <h2>Результати тестування банківської системи</h2>

  <div class="block">
    <h3>Тест 1: Звичайний банківський рахунок (Успішні операції)</h3>
    <?php
    try {
      $account1 = new BankAccount("UAH", 1000);
      echo "Рахунок створено. Баланс: <b>" . $account1->getBalance() . "</b><br>";

      $account1->deposit(500);
      echo "<span class='success'>✔ Поповнено на 500 UAH.</span> Новий баланс: <b>" . $account1->getBalance() . "</b><br>";

      $account1->withdraw(200);
      echo "<span class='success'>✔ Знято 200 UAH.</span> Новий баланс: <b>" . $account1->getBalance() . "</b><br>";
    } catch (Exception $e) {
      echo "<span class='error'>" . $e->getMessage() . "</span><br>";
    }
    ?>
  </div>

  <div class="block">
    <h3>Тест 2: Накопичувальний рахунок (Статичні властивості)</h3>
    <?php
    try {
      $savings = new SavingsAccount("USD", 2000);
      echo "Накопичувальний рахунок створено. Баланс: <b>" . $savings->getBalance() . "</b><br>";
      echo "Поточна відсоткова ставка: <b>" . (SavingsAccount::$interestRate * 100) . "%</b><br>";

      $addedInterest = $savings->applyInterest();
      echo "<span class='success'>✔ Відсотки нараховано (+$addedInterest USD).</span> Новий баланс: <b>" . $savings->getBalance() . "</b><br>";
    } catch (Exception $e) {
      echo "<span class='error'>" . $e->getMessage() . "</span><br>";
    }
    ?>
  </div>

  <div class="block">
    <h3>Тест 3: Обробка винятків (Недостатньо коштів)</h3>
    <?php
    try {
      $account2 = new BankAccount("EUR", 300);
      echo "Рахунок створено. Баланс: <b>" . $account2->getBalance() . "</b><br>";
      echo "Спроба зняти 1000 EUR...<br>";

      $account2->withdraw(1000);

      echo "Новий баланс: " . $account2->getBalance() . "<br>";
    } catch (Exception $e) {
      echo "<span class='error'>✖ Перехоплено виняток: " . $e->getMessage() . "</span><br>";
    }
    ?>
  </div>

  <div class="block">
    <h3>Тест 4: Обробка винятків (Некоректна сума)</h3>
    <?php
    try {
      $account3 = new BankAccount("PLN", 500);
      echo "Рахунок створено. Баланс: <b>" . $account3->getBalance() . "</b><br>";
      echo "Спроба поповнити на -50 PLN...<br>";

      $account3->deposit(-50);

    } catch (Exception $e) {
      echo "<span class='error'>✖ Перехоплено виняток: " . $e->getMessage() . "</span><br>";
    }
    ?>
  </div>
</body>

</html>