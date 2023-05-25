# Itonomy_DatabaseLogger module
The module enables you to log messages in database and displaying them nicely in admin grid instead of files.

Useful for logging information related to imports, specific processes, etc.

## Installation details

install module through composer
```
composer require itonomy/module-database-logger
```

## Usage

The module's logger implementation is based on Monolog. So you don't have to change much if you already use logger which implements `Psr\Log\LoggerInterface`.

You only need to replace your class which is used for logger to module's class `Itonomy\DatabaseLogger\Model\Logger`.

Example usage:

```php
<?php
$this->logger->info('test log message', ['test_var' => 'test']);
$this->logger->info('test log message', ['test_var' => 'test', 'entity_type' => 'import', 'entity_id' => '99999']);
?>
```

First one is basic log which is similar to default Magento 2 logger.

Second one is more advanced and allows you to specify entity type and entity id which can be used to group logs in admin grid. This is useful if you want to log messages related to specific entity (import, export, etc.) and display them in admin grid.
