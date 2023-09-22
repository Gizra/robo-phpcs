##Description

`gizra/robo-phpcs` is a PHP trait that provides a Robo command to check the coding standard of Drupal projects. This library makes it easy to adhere to Drupal and DrupalPractice coding standards. It's implemented as a PHP trait which you can include in your Robo tasks.

## Requirements

- PHP 8.1 or higher
- Robo 4.0 or higher

## Installation

Install this package as a development dependency via composer:

```bash
composer require --dev gizra/robo-phpcs
```

## Usage

Include the `PhpcsTasks` trait in your `RoboFile.php` to use the `phpcs` command in your tasks.

```php
<?php

namespace YourNamespace;

use Robo\Tasks;
use GizraRobo\PhpcsTasks;

class RoboFile extends Tasks {
  use PhpcsTasks;

  // Your other tasks
}
```

### Running the phpcs task

Once the trait is included, you can use the `phpcs` task in your Robo commands:

```bash
robo phpcs
```

This will run the PHP Code Sniffer and the PHP Code Beautifier and Fixer for the directories specified, adhering to Drupal and DrupalPractice coding standards.

## Options and Configuration

The trait includes a set list of directories and file types to scan. If you want to customize this, you can override the `phpcs()` method in your `RoboFile.php`.
