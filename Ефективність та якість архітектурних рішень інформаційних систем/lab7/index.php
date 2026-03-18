<?php
header('Content-Type: text/html; charset=utf-8');

interface DeliveryStrategy
{
  // Метод для розрахунку вартості доставки
  public function calculateDeliveryCost($orderAmount);
}

// Стратегія: Самовивіз
class PickupDelivery implements DeliveryStrategy
{
  public function calculateDeliveryCost($orderAmount)
  {
    // У разі самовивозу доставка безкоштовна
    return 0.0;
  }
}

// Стратегія: Доставка зовнішньою службою
class ExternalServiceDelivery implements DeliveryStrategy
{
  public function calculateDeliveryCost($orderAmount)
  {
    return 50.0; // Приклад значення
  }
}

// Стратегія: Доставка власною службою
class InternalServiceDelivery implements DeliveryStrategy
{
  public function calculateDeliveryCost($orderAmount)
  {
    return 30.0; // Приклад значення
  }
}

// Контекст — клас, який використовує певну стратегію доставки
class DeliveryContext
{
  // Змінна для збереження поточної стратегії доставки
  private $deliveryStrategy;

  // Встановлення стратегії доставки
  public function setDeliveryStrategy(DeliveryStrategy $strategy)
  {
    $this->deliveryStrategy = $strategy;
  }

  // Розрахунок вартості доставки за обраною стратегією
  public function calculateCost($orderAmount)
  {
    if (!$this->deliveryStrategy) {
      throw new Exception("Не обрано спосіб доставки!");
    }
    return $this->deliveryStrategy->calculateDeliveryCost($orderAmount);
  }
}

// ==== Демонстрація роботи ====
$orderAmount = 350.00;
$context = new DeliveryContext();

// Користувач обирає "самовивіз"
$context->setDeliveryStrategy(new PickupDelivery());
echo "Самовивіз: " . $context->calculateCost($orderAmount) . " грн\n";

// Користувач обирає "зовнішня служба доставки"
$context->setDeliveryStrategy(new ExternalServiceDelivery());
echo "Зовнішня служба: " . $context->calculateCost($orderAmount) . " грн\n";

// Користувач обирає "власна служба доставки"
$context->setDeliveryStrategy(new InternalServiceDelivery());
echo "Власна служба: " . $context->calculateCost($orderAmount) . " грн\n";
?>