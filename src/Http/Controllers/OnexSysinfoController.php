<?php

namespace Onex\Sysinfo\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OnexSysinfoController extends Controller
{

    protected $onexSysInfoConfigData;

    public function __construct()
    {
        $this->onexSysInfoConfigData = config('onex-sysinfo');
    }

    public function index(Request $request)
    {
        if (!$this->onexSysInfoConfigData['authentication']['is_enabled']) {
            Session::put('onexSysinfoAdminAccessEnabled', 'NO');
        }

        if (!Session::has('onexSysinfoAdminAccessEnabled')) {
            Session::put('onexSysinfoAdminAccessEnabled', 'NO');
        }

        return view('sysinfo::index', $this->getAllData());
    }

    public function onexsysinfoAdminaccess(Request $request)
    {
        $rules = [
            'onexsysinfo_loginid' => 'required',
            'onexsysinfo_password' => 'required'
        ];

        $ruleMsgs = [
            'onexsysinfo_loginid.required' => 'Please enter login-id',
            'onexsysinfo_password.required' => 'Please enter password'
        ];

        $validation = Validator::make($request->all(), $rules, $ruleMsgs);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation, 'accessValiError')
                ->withInput($request->all())
                ->with('onexValiErrMsg', 'Please enter login-id & password');
        }

        if ($request->input('onexsysinfo_loginid') == $this->onexSysInfoConfigData['authentication']['login_id'] && $request->input('onexsysinfo_password') == $this->onexSysInfoConfigData['authentication']['password']) {
            Session::put('onexSysinfoAdminAccessEnabled', 'YES');
            return redirect()->back()->with('onexSuccessMsg', 'Access Granted');
        } else {
            return redirect()->back()->with('onexAccessErrsMsg', 'Access Denied! Wrong login-id & password');
        }
        
    }

    public function getAllData()
    {
        $dataBag = [];
        $dataBag['onexSysinfoConfig'] = $this->getOnexSysinfoConfig();
        $dataBag['versions'] = $this->getVersions();
        $dataBag['paths'] = $this->getPaths();
        $dataBag['is_writable'] = $this->checkWritable();
        $dataBag['is_env_exist'] = $this->isEnvExist();
        $dataBag['env_variables'] = $this->getEnv();
        $dataBag['require_packages'] = $this->getPackages('require');
        $dataBag['dev_packages'] = $this->getPackages('require-dev');
        $dataBag['enabled_extension'] = get_loaded_extensions();
        $dataBag['server_info'] = $this->getServerInfo();
        $dataBag['mysql_tables'] = $this->getMySqlTables();
        return $dataBag;
    }

    public function getOnexSysinfoConfig()
    {
        return $this->onexSysInfoConfigData;
    }

    public function getVersions()
    {
        $arr = [];
        $arr['laravel'] = app()->version();
        $arr['php'] = PHP_VERSION;
        $arr['mysql'] = self::getMySqlVersion();
        return $arr;
    }

    public function getPaths()
    {
        $arr = [];
        $arr['base_path'] = !empty(base_path()) ? base_path() : null;
        $arr['app_path'] = !empty(app_path()) ? app_path() : null;
        $arr['public_path'] = !empty(public_path()) ? public_path() : null;
        $arr['config_path'] = !empty(config_path()) ? config_path() : null;
        $arr['database_path'] = !empty(database_path()) ? database_path() : null;
        $arr['resource_path'] = !empty(resource_path()) ? resource_path() : null;
        $arr['storage_path'] = !empty(storage_path()) ? storage_path() : null;
        $arr['lang_path'] = !empty(lang_path()) ? lang_path() : null;
        return $arr;
    }

    public function checkWritable()
    {
        $arr = [];
        $arr['is_cache_dir_writable'] = is_writable(base_path('bootstrap/cache')) ? 'YES' : 'NO';
        $arr['is_storage_dir_writable'] = is_writable(storage_path()) ? 'YES' : 'NO';
        $arr['cache_dir_premission'] = substr(decoct(fileperms(base_path('bootstrap/cache'))), -4);
        $arr['storage_dir_premission'] = substr(decoct(fileperms(storage_path())), -4);
        return $arr;
    }

    public function isEnvExist()
    {
        $env = base_path('.env');
        if (!file_exists($env)) {
            return 'NO';
        }
        return 'YES';
    }

    public function getEnv()
    {
        return ($this->isEnvExist() == 'YES') ? $_ENV : [];
    }

    public function getPackages($key)
    {
        $arr = [];
        if (file_exists(base_path('composer.json'))) {
            $arr = json_decode(file_get_contents(base_path('composer.json')), true);
        }
        return !empty($arr[$key]) ? $arr[$key] : [];
    }
    
    public function getServerInfo()
    {
        $server = $_SERVER;
        $env = $_ENV;
        return array_diff($server, $env);
    }

    public function getMySqlTables()
    {
        try {
            $tabNames = [];
            $dbName = $this->getEnv()['DB_DATABASE'];
            $sqlKey = 'Tables_in_' . $dbName;
            $allTabs = DB::select('SHOW TABLES');
            if (!empty($allTabs) && count($allTabs)) {
                foreach ($allTabs as $k => $v) {
                    array_push($tabNames, $allTabs[$k]->$sqlKey);
                }
            } 
            return $tabNames;
        } catch (\Exception $e) {
            return [];
            //return $e->getMessage();
        }
    }

    public static function getMySqlVersion()
    {
        try {
            $pdo = DB::getPdo();
            return $pdo->query('select version()')->fetchColumn();
        } catch (\Exception $e) {
            return '';
            //return $e->getMessage();
        }
    }

    public function onexsysinfoAdminLogout(Request $request)
    {
        Session::put('onexSysinfoAdminAccessEnabled', 'NO');
        Session::forget('onexSysinfoAdminAccessEnabled');
        return redirect()->back()->with('onexSuccessMsg', 'Logout!');
    }
}
