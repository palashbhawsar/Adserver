<?php
function Prebid ()
{
    $aConf = $GLOBALS['_MAX']['CONF'];
    $query="SELECT * FROM `rv_affiliates`"; 
    $res = OA_Dal_Delivery_query($query);
    $data = OA_Dal_Delivery_fetchAssoc($res);
    $agencyquery="SELECT fraud_status,threshold FROM `rv_agency`"; 
    $agencyres = OA_Dal_Delivery_query($agencyquery);
    $agencydata = OA_Dal_Delivery_fetchAssoc($agencyres);
    $data['agencyfraud'] = $agencydata['fraud_status'];
    $data['agencyfraudval'] = $agencydata['threshold'];
    $data['system_prebid'] = 1;
    return $data;
}
$system_prebid = 1;
MAX_Dal_Delivery_Include();
if($system_prebid == 1)
{
    $prebid = Prebid();
}
?>

