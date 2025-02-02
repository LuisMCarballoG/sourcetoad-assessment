# Sourcetoad Assessment

This project demonstrates an assessment built using **PHP 8.3**, following best practices for coding. Below is all the information you need to get started:

---

## 1. Requirements

- **PHP 8.3.14** or higher  
- **Composer 2.6.5**  

> **Note**: If you are using a different PHP or Composer version, ensure it meets the minimum requirements and is compatible with the project’s dependencies.

---

## 2. Project Structure

A quick glance at the folder structure:

```
sourcetoad-assessment/
├── App/
│   ├── Controllers/
│   │   └── MenuController.php
│   ├── DTO/
│   │   ├── AddressDTO.php
│   │   └── ItemDTO.php
│   ├── Infrastructure/
│   │   └── ServiceContainer.php
│   ├── Models/
│   │   ├── Cart.php
│   │   └── Customer.php
│   └── Services/
│       ├── Interfaces/
│       │   ├── DataFormatterInterface.php
│       │   └── JsonFileLoaderInterface.php
│       ├── CartCalculatorService.php
│       ├── CartPrinterService.php
│       ├── CartService.php
│       ├── JsonFileLoaderService.php
│       ├── KeyValueFormatterService.php
│       └── SortService.php
├── Storage/
│   └── Files/
│       └── guests.json
├── composer.json
├── composer.lock
├── index.php
├── php_assessment.md
├── phpstan.neon
├── pint.json
└── readme.md
```

- **App**: Contains the main logic divided into Controllers, DTOs, Models, and Services.
- **Storage**: Houses the `guests.json` file with data read by the app.
- **index.php**: Entry point to run the application.

---

## 3. Installation

1. Clone or download this repository to your local machine.
2. Open your terminal and navigate to the project’s root directory.
3. Run the following command to install all dependencies:

```bash
composer install
```

Composer will fetch and set up all required libraries for you.

---

## 4. Running the Project

1. Make sure you are in the project’s root directory.
2. Run the command:

```bash
php index.php
```

3. You should then see a menu similar to:

```bash
1. Printing Key-Value Pairs
2. Sorting Data
3. Shopping Cart
4. Exit
```

Enter the corresponding number to explore each section. The menu will remain active until you choose **Exit**.

---

## 5. Additional Scripts

In **composer.json**, you’ll find scripts that can help maintain the code base:

- **`composer pint`**: Runs Laravel Pint (code formatter).
- **`composer stan`**: Runs PHPStan (static analysis).

Example usage:
```bash
composer pint
composer stan
```

These scripts ensure code quality and consistency.


## Thank you !