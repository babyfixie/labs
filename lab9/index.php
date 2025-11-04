<?php
header('Content-Type: text/html; charset=utf-8');

// Інтерфейси
interface IElement
{
  public function accept(IVisitor $visitor);
}

interface IVisitor
{
  public function visitCompany(Company $company);
  public function visitDepartment(Department $department);
  public function visitEmployee(Employee $employee);
}


// Класи моделі
class Employee implements IElement
{
  protected $position;
  protected $salary;

  public function __construct($position, $salary)
  {
    $this->position = $position;
    $this->salary = $salary;
  }

  public function getPosition()
  {
    return $this->position;
  }

  public function getSalary()
  {
    return $this->salary;
  }

  public function accept(IVisitor $visitor)
  {
    $visitor->visitEmployee($this);
  }
}

class Department implements IElement
{
  protected $name;
  protected $employees = array();

  public function __construct($name, array $employees)
  {
    $this->name = $name;
    $this->employees = $employees;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getEmployees()
  {
    return $this->employees;
  }

  public function accept(IVisitor $visitor)
  {
    $visitor->visitDepartment($this);
    foreach ($this->employees as $employee) {
      $employee->accept($visitor);
    }
  }
}

class Company implements IElement
{
  protected $name;
  protected $departments = array();

  public function __construct($name, array $departments)
  {
    $this->name = $name;
    $this->departments = $departments;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getDepartments()
  {
    return $this->departments;
  }

  public function accept(IVisitor $visitor)
  {
    $visitor->visitCompany($this);
    foreach ($this->departments as $department) {
      $department->accept($visitor);
    }
  }
}


// Реалізація Відвідувача
class SalaryReportVisitor implements IVisitor
{
  protected $report = '';
  protected $total = 0;

  protected function line($text)
  {
    $this->report .= htmlspecialchars($text) . "<br>\n";
  }

  public function visitCompany(Company $company)
  {
    $this->line("Компанія: " . $company->getName());
  }

  public function visitDepartment(Department $department)
  {
    $this->line("  Відділ: " . $department->getName());
  }

  public function visitEmployee(Employee $employee)
  {
    $this->line("    Посада: " . $employee->getPosition() .
      " | Зарплата: " . $employee->getSalary());
    $this->total += $employee->getSalary();
  }

  public function getReport()
  {
    $this->line("Загальна сума зарплат: " . $this->total);
    return $this->report;
  }
}


// client code
$dev1 = new Employee("Junior Developer", 1000);
$dev2 = new Employee("Senior Developer", 2500);
$hr1 = new Employee("HR Manager", 1800);

$itDepartment = new Department("IT", array($dev1, $dev2));
$hrDepartment = new Department("HR", array($hr1));

$company = new Company("TechCorp", array($itDepartment, $hrDepartment));

$reportVisitor = new SalaryReportVisitor();

echo "<h3>===== Звіт по компанії =====</h3>";
$company->accept($reportVisitor);
echo $reportVisitor->getReport();

$departmentReportVisitor = new SalaryReportVisitor();
echo "<h3>===== Звіт по відділу IT =====</h3>";
$itDepartment->accept($departmentReportVisitor);
echo $departmentReportVisitor->getReport();
?>