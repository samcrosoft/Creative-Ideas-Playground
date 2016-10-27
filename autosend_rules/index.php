<?php
use Samcrosoft\CreativeAutoSend\CreativeAutoSendManager;

require __DIR__."/../vendor/autoload.php";

$oManager = new CreativeAutoSendManager();
$aRequirements = [
    "session.gender == 'male' ",
    "session.age > 30 ",
    "session.age < 40 ",
    'session.isFocus == true '
];
$aResult = $oManager->parseFilterRequirements($aRequirements, 50);

echo $aResult->toJson();
