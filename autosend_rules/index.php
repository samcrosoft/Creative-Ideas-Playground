<?php
use Samcrosoft\CreativeAutoSend\CreativeAutoSendManager;

require __DIR__."/../vendor/autoload.php";

$oManager = new CreativeAutoSendManager();
$aRequirements = [
    "session.gender == 'male' ",
    "session.age > 30 ",
    "session.age < 40 ",
    "session.age < 90 ",
    'session.isFocus == true '
];

$iCorpusNumber = 5000;
$aResult = $oManager->parseFilterRequirements($aRequirements, $iCorpusNumber, true);
echo $aResult->toJson();
