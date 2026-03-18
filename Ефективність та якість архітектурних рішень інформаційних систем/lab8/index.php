<?php
header('Content-Type: text/html; charset=utf-8');

// Абстрактний клас, що визначає шаблонний метод оновлення сутності
abstract class AbstractEntityUpdater
{
  // Шаблонний метод — описує загальний процес оновлення
  public final function updateEntity($entityData)
  {
    $entity = $this->getEntity($entityData);  // Отримання об'єкта
    if (!$this->validateData($entity)) {  // Валідація даних
      $this->onValidationFailed($entity); // Хук у разі невдачі
      return $this->formResponse(400, 'Validation failed');
    }

    $this->saveEntity($entity); // Збереження об'єкта
    $this->afterSave($entity);  // Хук після збереження
    return $this->formResponse(200, 'Success', $entity);  // Формування відповіді
  }

  // Отримання сутності (абстрактний метод)
  abstract protected function getEntity($entityData);

  // Валідація даних (абстрактний метод)
  abstract protected function validateData($entity);

  // Збереження сутності (абстрактний метод)
  abstract protected function saveEntity($entity);

  // Формування відповіді (можна перевизначати)
  protected function formResponse($code, $status, $data = null)
  {
    return array('code' => $code, 'status' => $status);
  }

  // Хук — викликається у разі невдалої валідації
  protected function onValidationFailed($entity)
  {
  }

  // Хук — викликається після збереження
  protected function afterSave($entity)
  {
  }
}

// Клас для оновлення Товару
class ProductUpdater extends AbstractEntityUpdater
{
  protected function getEntity($entityData)
  {
    return $entityData;
  }

  protected function validateData($entity)
  {
    // Перевірка даних товару
    return isset($entity['name']) && isset($entity['price']);
  }

  protected function saveEntity($entity)
  {
  }

  protected function onValidationFailed($entity)
  {
  }
}

// Клас для оновлення Користувача
class UserUpdater extends AbstractEntityUpdater
{
  protected function getEntity($entityData)
  {
    return $entityData;
  }

  protected function validateData($entity)
  {
    if (isset($entity['email'])) {
      unset($entity['email']);
    }
    return isset($entity['name']);
  }

  protected function saveEntity($entity)
  {
  }
}

// Клас для оновлення Замовлення
class OrderUpdater extends AbstractEntityUpdater
{
  protected function getEntity($entityData)
  {
    return $entityData;
  }

  protected function validateData($entity)
  {
    // Перевірка замовлення
    return isset($entity['orderId']) && isset($entity['status']);
  }

  protected function saveEntity($entity)
  {
    // Збереження замовлення
  }

  protected function formResponse($code, $status, $data = null)
  {
    return array(
      'code' => $code,
      'status' => $status,
      'order' => json_encode($data)
    );
  }
}

// ==== Демонстрація роботи ====
$productData = array('name' => 'Лаб8', 'price' => 200);
$userData = array('name' => 'Іван', 'email' => 'test@example.com');
$orderData = array('orderId' => 123, 'status' => 'new');

$productUpdater = new ProductUpdater();
$userUpdater = new UserUpdater();
$orderUpdater = new OrderUpdater();

echo "<pre>";
print_r($productUpdater->updateEntity($productData));
print_r($userUpdater->updateEntity($userData));
print_r($orderUpdater->updateEntity($orderData));
echo "</pre>";
?>