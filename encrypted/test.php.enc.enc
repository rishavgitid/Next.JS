<?php

global $whmcs;
use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\DistributorDashboard\Helper;

$distributorAdminId = $whmcs->get_req_var("id");
$distributorDetails = getDistDetails($distributorAdminId);
$getApplication  = getResubmitLog($distributorDetails->email);
$response = processResubmitLog($getApplication);

function getDistDetails($distributorAdminId) {
    return Capsule::table('mod_distributors')
        ->where('id', $distributorAdminId)
        ->select('email', 'first_name', 'last_name')
        ->first();
}
function getResubmitLog($email) {
    $response = Capsule::table('distibutor_resubmission')
        ->leftJoin('tbladmins', 'distibutor_resubmission.admin_id', '=', 'tbladmins.id')
        ->where('distibutor_resubmission.email', $email)
        ->select(
            'distibutor_resubmission.email',
            'distibutor_resubmission.created_at',
            'distibutor_resubmission.admin_id',
            'distibutor_resubmission.updated_at',
            'distibutor_resubmission.profile_detail',
            'distibutor_resubmission.admin_message',
            'tbladmins.firstname',
            'tbladmins.lastname'
        )
        ->get();

    return $response;
}

function processResubmitLog($response) {
    foreach ($response as $record) { 
        if (!empty($record->profile_detail)) { 
            $jsonData = json_decode($record->profile_detail, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($jsonData)) { 
                unset($jsonData['responsetype'], $jsonData['token'], $jsonData['type']);

                /* Update phone with phone_code if available */
                if (isset($jsonData['phone']) && isset($jsonData['phone_code'])) {
                    $jsonData['phone'] = '+' . $jsonData['phone_code'] . ' ' . $jsonData['phone'];
                    unset($jsonData['phone_code']); // Remove phone_code if no longer needed
                }

                if ($jsonData['country']) {
                    $countries = new \WHMCS\Utility\Country();
                    $allCountry = $countries->getCountryNameArray();
                    $countryCode = strtoupper($jsonData['country']);
                    
                    foreach ($allCountry as $code => $name) {
                        if ($jsonData['country'] == $code) {
                            $jsonData['country'] = $name; 
                            break;
                        }
                    }
                }

                // Move 'note', 'tell_us_about', and 'cloud_spend_other' to the end of the array
                $keysToMove = ['tos', 'eula', 'privacy',
                'spend','server_deploy_days', 'cloud_service_none', 'cloud_service_aws', 'cloud_service_gcp', 'cloud_service_azure',
                'cloud_service_other', 'cloud_service_on_prem', 'cloud_service_ofekdist','note', 'tell_us_about', 'cloud_spend_other'];
                foreach ($keysToMove as $key) {
                    if (isset($jsonData[$key])) {
                        $value = $jsonData[$key];
                        unset($jsonData[$key]);
                        $jsonData[$key] = $value; 
                    }
                }

                // Remove underscores and capitalize the first letter of each word
                $formattedData = [];
                foreach ($jsonData as $key => $value) {
                    $formattedKey = ucwords(str_replace('_', ' ', $key)); // Remove underscores and capitalize
                    $formattedData[$formattedKey] = $value;
                }

                /* Re-encode to JSON and update the profile_detail field */
                $record->profile_detail = json_encode($formattedData, JSON_PRETTY_PRINT);
            } else {
                /* Handle invalid JSON case */
                error_log("Invalid JSON in profile_detail for email: " . $record->email);
            }
        }
    }

    return $response; // Return the updated response
}


if($_POST['fun']=='upadte_status'){
    
        $helper = new Helper();
            $result = $helper->updateStutas();
            echo json_encode($result);
            exit();    
        }
$this->tplVar['disrecord'] = $getApplication;
$this->tplVar['diseamil'] = $distributorDetails;
?>
