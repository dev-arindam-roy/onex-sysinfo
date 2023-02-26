# ONEXCRM CHECK SYSTEM INFO

### A package for get complete system environment detail information

## Installation

### STEP 1: Run the composer command:

```shell
composer require onexcrm/sysinfo
```

### STEP 2: Laravel without auto-discovery:

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
Onex\Sysinfo\OnexSysinfoServiceProvider::class,
```

If you want to use the facade to log messages, add this to your facades in app.php:

```php
'OnexSysinfo' => Onex\Sysinfo\Sysinfo\SysinfoClassFacade::class,
```

### STEP 3: Publish the package config:

```php
php artisan vendor:publish --provider="Onex\Sysinfo\OnexSysinfoServiceProvider" --force
```

## How to use?:

> **DIRECT USE BY ROUTE**
---
<dl>
  <dt>1 <code>Just install and run the below route </span></code></dt>
  <dd><small><i>Ex: http://your-website/onex/check-sysinfo</i></small></dd>
</dl>

> **USE LIKE A HELPER IN CONTROLLER**
---
<dl>
  <dt>1 <code>Just install and call below methods </span></code></dt>
  <dd><small><i>Ex1: OnexSysinfo::getSystemInfo()</i></small></dd>
  <dd><small><i>Ex2: OnexSysinfo::getAllPaths()</i></small></dd>
  <dd><small><i>Ex3: OnexSysinfo::isStorageWritable()</i></small></dd>
  <dd><small><i>Ex4: OnexSysinfo::isCacheWritable()</i></small></dd>
  <dd><small><i>Ex5: OnexSysinfo::getAllEnvs()</i></small></dd>
  <dd><small><i>Ex6: OnexSysinfo::getServerInfo()</i></small></dd>
  <dd><small><i>Ex7: OnexSysinfo::howManyTablesInDB()</i></small></dd>
  <dd><small><i>Ex8: OnexSysinfo::getAllTablesName()</i></small></dd>
  <dd><small><i>Ex9: OnexSysinfo::getEnabledPhpExtensions()</i></small></dd>
</dl>