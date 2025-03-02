<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Cache-Control: public, max-age=7200');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: POST");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {    
   return json_encode(array('status'=>'success'));    
}    

/**
 * WHMCS Custom API handler
 * It will receive api request, valid ip, authenticate, authorize request and sent response
 * 
 * required:
 * @adminuser
 * @adminpassword
 * 
 */

require_once dirname(__FILE__) . "/../init.php";

use WHMCS\Api\ApplicationSupport\Route\Middleware\Authentication;

//$response = array('status'=>'error','message'=>'Invalid request.');

try
{
    
    $request = WHMCS\Api\ApplicationSupport\Http\ServerRequest::fromGlobals();
    
    #validate request method
    
    if($request->getMethod() !== 'POST')
    {
        //throw new Exception('Invalid request method');
    }
    
    /*
     * validate api username and password
     */
    
    if(empty($request->getUsername()))
    {
        throw new Exception('API username is required');
    }
    
    if(empty($request->getPassword()))
    {
        throw new Exception('API password is required');
    }
    
    if(empty($request->getAction()))
    {
        throw new Exception('API action is required');
    }
    
    /*
     * authenticate api username and password
     */
    $apiUsername = $request->getUsername();
    $apiPassword = $request->getPassword();
    $action = strtolower($request->getAction());
    $postData= $_REQUEST;//$request->getParsedBody();

    /**
     * cloudflare will create issues,as it proxied the original ip
     * 
     * https://developers.cloudflare.com/support/troubleshooting/restoring-visitor-ips/restoring-original-visitor-ips/
     * 
     */
    //lumen_checkIPAPIResquest();
    
    //$device = lumen_authenticateAPIResquest($apiUsername,$apiPassword);
    
    //lumen_authorizeAPIResquest($device,$action);
 
    if (!isValidforPath($action)) 
    {
        throw new Exception("Invalid api action");
    }

    if (!file_exists(ROOTDIR . "/includes/api/" . $action . ".php")) 
    {
        throw new Exception("API function not found");
    }

    $response = localAPI($action,$postData);
        
    #insert log in WHMCS
    logModuleCall('React API', $request->getAction(), $postData, $response);

    //$response = array('status'=>$results['result'],'data'=>$results,'message'=>!empty($results['message'])?$results['message']:$results['result']);    
}
catch(Exception $ex)
{
    #insert log in WHMCS
    logModuleCall('React API', $request->getAction(),$postData,$ex->getMessage());
    
    $response = array('status'=>'error','message'=>$ex->getMessage());
}

echo json_encode($response);
exit;

/**
 * custom function
 * 
 * @param type $apiUsername
 * @param type $apiPassword
 * @return type
 * @throws \WHMCS\Exception\Api\AuthException
 */

function lumen_authenticateAPIResquest($apiUsername,$apiPassword)
{
    $auth = new Authentication();
    
    $device = $auth->verifyDeviceCredentials($apiUsername,$apiPassword);
    $admin = $device->admin;
    
    
    if ($admin) 
    {
        if (!$admin->isAllowedToAuthenticate()) 
        {
            throw new \WHMCS\Exception\Api\AuthException("Access Denied: Authentication not permitted");
        }
        
        
        if (!$admin->hasPermission("API Access")) 
        {
            throw new \WHMCS\Exception\Api\AuthException("Admin do not have api access permission");
        }
        
        return $device;
        
    }
    
    throw new \WHMCS\Exception\Api\AuthException("Access Denied");
}

/**
 * 
 * @param type $device
 * @param type $action
 * @return boolean
 */
function lumen_authorizeAPIResquest($device,$action)
{
    if (!$device->permissions()->isAllowed($action)) 
    {
        return "Invalid Permissions: API action \"" . $action . "\" is not allowed";
    }
    
    return true;
}

/**
 * 
 * @throws \WHMCS\Exception\Api\AuthException
 * @return boolean
 */
function lumen_checkIPAPIResquest()
{
    if (\App::isVisitorIPBanned()) 
    {
        throw new \WHMCS\Exception\Api\AuthException("IP Banned");
    }
    
    if (!in_array(\App::getRemoteIp(), lumen_getAllowedIps())) 
    {
        throw new \WHMCS\Exception\Api\AuthException("Invalid IP " . \App::getRemoteIp());
    }
    
    return true;
}


function lumen_getAllowedIps()
{
    $allowedIps = safe_unserialize(\WHMCS\Config\Setting::getValue("APIAllowedIPs"));
    $cleanedIps = array();
    
    foreach ($allowedIps as $key => $allowedIp) 
    {
        if (!empty($allowedIp["ip"]) && trim($allowedIp["ip"])) 
        {
            $cleanedIps[] = trim($allowedIp["ip"]);
        }
    }
    return $cleanedIps;
}