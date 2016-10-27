<?php
/**
 * Created by PhpStorm.
 * User: adebola
 * Date: 27/10/2016
 * Time: 16:21
 */

namespace Samcrosoft\CreativeAutoSend;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Collection;
use Samcrosoft\CreativeAutoSend\Corpus\SessionCorpus;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Class CreativeAutoSendManager
 * @package Samcrosoft\CreativeAutoSend
 */
class CreativeAutoSendManager
{

    /**
     * @var null|Generator
     */
    var $oFaker = null;
    /**
     * @var ExpressionLanguage
     */
    private $oExpression;

    /**
     * CreativeAutoSendManager constructor.
     */
    public function __construct()
    {
        $this->setFaker();

        // set the expression language
        $this->setExpressionManager();

    }


    protected function setExpressionManager()
    {
        $oExpression = new ExpressionLanguage();
        $this->oExpression = $oExpression;
    }

    /**
     * @return ExpressionLanguage
     */
    protected function getExpressionManager()
    {
        return $this->oExpression;
    }

    protected function setFaker()
    {
        $this->oFaker = Factory::create();
    }

    /**
     * @return Generator|null
     */
    public function getFaker()
    {
        return $this->oFaker;
    }


    /**
     * @param int $iNum
     * @return Collection
     */
    public function getCorpusList($iNum = 10)
    {
        $aList = collect(range(0, $iNum))->map(function () {
            return new SessionCorpus($this->getFaker());
        });
        return $aList;
    }


    /**
     * @param $sRule
     * @param $oCorpus
     * @param bool $bCastToBool
     * @return bool|string|mixed
     */
    public function evaluateRule($sRule, $oCorpus, $bCastToBool = true)
    {

        #dd($oCorpus, $sRule);

        $mEvaluationResult = $this->getExpressionManager()
            ->evaluate($sRule, [
                'session' => $oCorpus
            ]);

        $mEvaluationResult = $bCastToBool ? (bool) $mEvaluationResult : $mEvaluationResult;
        return $mEvaluationResult;
    }


    public function parseFilterRequirements(array $aRequirement, $iCorpusNumber = 20)
    {
        $aCorpus = $this->getCorpusList($iCorpusNumber);
        #$aCorpusBackup = $aCorpus;

        collect($aRequirement)->each(function($sRule) use(&$aCorpus) {
            $aCorpus = $aCorpus->filter(function($oCurrentCorpus) use($sRule) {
                $bResult = $this->evaluateRule($sRule, $oCurrentCorpus);
                return $bResult;
            });

            #echo $aCorpus->toJson();
            #dd();
        });

        return $aCorpus;
    }

}