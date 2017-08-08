<?php
function checkFraud($threshold,$campaignid){
    $key="http://174.37.213.67/check?ck=8D9bDGk0mPwYREuMhdDq";//$data[end_point];
    $clientIp = "173.255.232.166"; //$_SERVER['REMOTE_ADDR'];
    $url =$key."&output=JSON&rt=display&ip=".$clientIp."&s=506&p=309&a=CD3547&cmp=$campaignid";
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
return $fraudvalue;
}

?>

