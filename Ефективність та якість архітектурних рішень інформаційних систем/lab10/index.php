<?php
header('Content-Type: text/html; charset=utf-8');

interface IMediator
{
  public function notify($sender, $event);
}

interface IComponent
{
  public function setMediator(IMediator $mediator);
}

class DatePicker implements IComponent
{
  protected $mediator;
  protected $selectedDate;

  public function setMediator(IMediator $mediator)
  {
    $this->mediator = $mediator;
  }

  public function selectDate($date)
  {
    $this->selectedDate = $date;
    $this->mediator->notify($this, "date_changed");
  }

  public function getSelectedDate()
  {
    return $this->selectedDate;
  }
}

class TimeSlotSelector implements IComponent
{
  protected $mediator;
  protected $availableSlots = array();

  public function setMediator(IMediator $mediator)
  {
    $this->mediator = $mediator;
  }

  public function updateAvailableSlots($date)
  {

  }

  public function renderSlots()
  {
  }
}

class ReceiverCheckbox implements IComponent
{
  protected $mediator;
  protected $checked = false;

  public function setMediator(IMediator $mediator)
  {
    $this->mediator = $mediator;
  }

  public function toggle($state)
  {
    $this->checked = $state;
    $this->mediator->notify($this, "receiver_checkbox_toggled");
  }

  public function isChecked()
  {
    return $this->checked;
  }
}

class ReceiverNameField implements IComponent
{
  protected $mediator;
  protected $enabled = false;

  public function setMediator(IMediator $mediator)
  {
    $this->mediator = $mediator;
  }

  public function setEnabled($state)
  {
    $this->enabled = $state;
  }
}

class ReceiverPhoneField implements IComponent
{
  protected $mediator;
  protected $enabled = false;

  public function setMediator(IMediator $mediator)
  {
    $this->mediator = $mediator;
  }

  public function setEnabled($state)
  {
    $this->enabled = $state;
  }
}

class PickupCheckbox implements IComponent
{
  protected $mediator;
  protected $checked = false;

  public function setMediator(IMediator $mediator)
  {
    $this->mediator = $mediator;
  }

  public function toggle($state)
  {
    $this->checked = $state;
    $this->mediator->notify($this, "pickup_checkbox_toggled");
  }

  public function isChecked()
  {
    return $this->checked;
  }
}


// Конкретний Посередник


class OrderFormMediator implements IMediator
{
  protected $datePicker;
  protected $timeSlotSelector;
  protected $receiverCheckbox;
  protected $receiverNameField;
  protected $receiverPhoneField;
  protected $pickupCheckbox;

  public function __construct(
    DatePicker $datePicker,
    TimeSlotSelector $timeSlotSelector,
    ReceiverCheckbox $receiverCheckbox,
    ReceiverNameField $receiverNameField,
    ReceiverPhoneField $receiverPhoneField,
    PickupCheckbox $pickupCheckbox
  ) {
    $this->datePicker = $datePicker;
    $this->timeSlotSelector = $timeSlotSelector;
    $this->receiverCheckbox = $receiverCheckbox;
    $this->receiverNameField = $receiverNameField;
    $this->receiverPhoneField = $receiverPhoneField;
    $this->pickupCheckbox = $pickupCheckbox;

    $datePicker->setMediator($this);
    $timeSlotSelector->setMediator($this);
    $receiverCheckbox->setMediator($this);
    $receiverNameField->setMediator($this);
    $receiverPhoneField->setMediator($this);
    $pickupCheckbox->setMediator($this);
  }

  public function notify($sender, $event)
  {
    if ($event == "date_changed") {
      echo "Посередник: дата змінена на " . $this->datePicker->getSelectedDate() . "<br>";
      $this->timeSlotSelector->updateAvailableSlots($this->datePicker->getSelectedDate());
    }

    if ($event == "receiver_checkbox_toggled") {
      $checked = $this->receiverCheckbox->isChecked();
      echo "Посередник: чекбокс 'Інша особа' = " . ($checked ? "увімкнено" : "вимкнено") . "<br>";
      $this->receiverNameField->setEnabled($checked);
      $this->receiverPhoneField->setEnabled($checked);
    }

    if ($event == "pickup_checkbox_toggled") {
      $isPickup = $this->pickupCheckbox->isChecked();
      echo "Посередник: самовивіз = " . ($isPickup ? "так" : "ні") . "<br>";
      $this->receiverCheckbox->toggle(false);
      $this->receiverNameField->setEnabled(!$isPickup);
      $this->receiverPhoneField->setEnabled(!$isPickup);
    }
  }

}

// Створюємо елементи форми
$datePicker = new DatePicker();
$timeSlotSelector = new TimeSlotSelector();
$receiverCheckbox = new ReceiverCheckbox();
$receiverName = new ReceiverNameField();
$receiverPhone = new ReceiverPhoneField();
$pickupCheckbox = new PickupCheckbox();

// Створюємо посередника
$mediator = new OrderFormMediator(
  $datePicker,
  $timeSlotSelector,
  $receiverCheckbox,
  $receiverName,
  $receiverPhone,
  $pickupCheckbox
);

echo "<b>Користувач обрав дату доставки</b><br>";
$datePicker->selectDate("2026-01-10");

echo "<br><b>Користувач увімкнув 'Отримувач інша особа'</b><br>";
$receiverCheckbox->toggle(true);

echo "<br><b>Користувач обрав самовивіз</b><br>";
$pickupCheckbox->toggle(true);

?>