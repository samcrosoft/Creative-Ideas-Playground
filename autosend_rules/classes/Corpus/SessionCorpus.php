<?php
namespace Samcrosoft\CreativeAutoSend\Corpus;
use Faker\Generator;

/**
 * Created by PhpStorm.
 * User: adebola
 * Date: 27/10/2016
 * Time: 16:22
 */
class SessionCorpus
{

    var $sFirstName = null;
    var $sLastName = null;
    var $gender = null;
    var $isFocus = false;
    var $sTitle;
    var $age;
    var $deadlineDate;

    /**
     * SessionCorpus constructor.
     * @param Generator $oFaker
     */
    public function __construct(Generator $oFaker)
    {
        $bIsFemale = $oFaker->boolean();
        $sGender = !$bIsFemale ? 'male' : 'female';
        $this->sTitle = $oFaker->title($sGender);
        $this->sFirstName = $oFaker->firstName($sGender);
        $this->sLastName = $oFaker->lastName($sGender);
        $this->gender = $sGender;
        $this->deadlineDate = $oFaker->dateTimeBetween('-2 years', '+ 10 month')->format(DATE_RFC2822);
        $this->age = $oFaker->numberBetween(20, 100);
        $this->isFocus = $oFaker->boolean();
    }


    public function focusFirstName()
    {
        return $this->sFirstName;
    }

    public function focusLastName()
    {
        return $this->sLastName;
    }

}