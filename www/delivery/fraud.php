<?php
function Demo ()
{
    $aConf = $GLOBALS['_MAX']['CONF'];
    $query="SELECT * FROM `rv_affiliates`"; 
    $res = OA_Dal_Delivery_query($query);
    $data = OA_Dal_Delivery_fetchAssoc($res);
    $thres_hold = $data['threshold'];
    $campaignid=$data['affiliateid'];

    if($data['fraud_status']==1)
    {
        checkFraud($thres_hold,$campaignid);
    }
    return $data;
}


function checkFraud($thres_hold,$campaignid){
   $query="SELECT * FROM `rv_fraudcheck`"; 
    $res = OA_Dal_Delivery_query($query);
    $data = OA_Dal_Delivery_fetchAssoc($res);
    $key=$data[end_point];
    $clientIp = $_SERVER['REMOTE_ADDR'];
    $url =$key."&output=JSON&rt=display&ip==127.43.0.1&s=506ssadds3sds5843&p=309&a=CD3547&cmp=$campaignid";
    $feed = file_get_contents($url);
    $obj = json_decode($feed);
    $riskScore = $obj->{'riskScore'};
    $fraudvalue = false;

    if(isset($obj->{'nonSuspect'}))
    {
        $fraudvalue =  "nonSuspect";
    }else if(isset($obj->{'suspect'}))
    {
        $fraudvalue =  "suspect";
        
        
    }
    if($fraudvalue == "suspect")
    {
        if($riskScore > $thres_hold){
            echo "in if";
        }
        
    }

}
MAX_Dal_Delivery_Include();
Demo();


?>