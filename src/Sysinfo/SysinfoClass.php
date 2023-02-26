<?php
  
namespace Onex\Sysinfo\Sysinfo;

use Onex\Sysinfo\Http\Controllers\OnexSysinfoController;
  
class SysinfoClass 
{
    protected $onexSysinfoController;

    public function __construct()
    {
        $this->onexSysinfoController = new OnexSysinfoController();
    }
  
    public function getSystemInfo()
    {
        return $this->onexSysinfoController->getAllData();
    }

    public function getAllPaths()
    {
        return $this->onexSysinfoController->getPaths();
    }

    public function isStorageWritable()
    {
        return $this->onexSysinfoController->checkWritable()['is_storage_dir_writable'];
    }

    public function isCacheWritable()
    {
        return $this->onexSysinfoController->checkWritable()['is_cache_dir_writable'];
    }

    public function getAllEnvs()
    {
        return $this->onexSysinfoController->getEnv();
    }

    public function getServerInfo()
    {
        return $this->onexSysinfoController->getServerInfo();
    }

    public function howManyTablesInDB()
    {
        return count($this->onexSysinfoController->getMySqlTables());
    }

    public function getAllTablesName()
    {
        return $this->onexSysinfoController->getMySqlTables();
    }

    public function getEnabledPhpExtensions()
    {
        return $this->onexSysinfoController->getAllData()['enabled_extension'];
    }
}