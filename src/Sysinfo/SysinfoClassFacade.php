<?php
  
  namespace Onex\Sysinfo\Sysinfo;
  
use Illuminate\Support\Facades\Facade;
  
class SysinfoClassFacade extends Facade
{
    protected static function getFacadeAccessor() 
    { 
        return 'sysinfoclass'; 
    }
}