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
  <dt>>> <code>Just install and run the below route </span></code></dt>
</dl>
```
Ex: http://your-website/onex/check-sysinfo

Ex: http://localhost:8000/onex/check-sysinfo
```

> **USE LIKE A HELPER IN CONTROLLER**
---
<dl>
  <dt>>>> <code>Just install and call below methods </span></code></dt>
</dl>
>> Ex1: OnexSysinfo::getSystemInfo()
>> Ex2: OnexSysinfo::getAllPaths()
>> Ex3: OnexSysinfo::isStorageWritable()
>> Ex4: OnexSysinfo::isCacheWritable()
>> Ex5: OnexSysinfo::getAllEnvs()
>> Ex6: OnexSysinfo::getServerInfo()
>> Ex7: OnexSysinfo::howManyTablesInDB()
>> Ex8: OnexSysinfo::getAllTablesName()
>> Ex9: OnexSysinfo::getEnabledPhpExtensions()

#### You can modify the configuration settings in - "config/onex-sysinfo.php":

```php
/** If you want to disable the route then make it false */
'is_route_enabled' => true,
```

```php
/** If you want to change the route prefix */
'route_prefix' => 'onex',
```

```php
/** If you want to change the route name or path */
'route_name' => 'check-sysinfo',
```

```php
/** If you want to enable the securiry for access the system information
 *  Then make it ('is_enabled') true and also you can set login-id and password 
 */
'authentication' => [
    'is_enabled' => env('ONEX_SYSINFO_AUTH_ENABLED', false),
    'login_id' => env('ONEX_SYSINFO_ID', 'onexadmin'),
    'password' => env('ONEX_SYSINFO_PASSWORD', 'onexpassword')
]
```