<?php

namespace sockball\logistics;

use sockball\logistics\base\STO\STOLogistics;
use sockball\logistics\base\YTO\YTOLogistics;
use sockball\logistics\base\ZTO\ZTOLogistics;
use sockball\logistics\base\BEST\BESTLogistics;
use sockball\logistics\base\DANN\DANNLogistics;
use sockball\logistics\base\CHPO\CHPOLogistics;

class Logistics
{
    public const TYPE_STO = 'sto';
    public const TYPE_YTO = 'yto';
    public const TYPE_ZTO = 'zto';
    public const TYPE_BEST = 'baishi';
    public const TYPE_DANN = 'danniao';
    public const TYPE_CHPO = 'china post';
    public const RESPONSE_SUCCESS = 0;
    public const RESPONSE_FAILED = -1;

    protected static $_logisticsInstances = [];
    private static $instance = null;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public static function getInstance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getLatestTrace(string $type, string $waybillNo, bool $force = false)
    {
        return $this->getLogisticsInstance($type)->getLatestTrace($waybillNo, $force);
    }

    public function getFullTraces(string $type, string $waybillNo, bool $force = false)
    {
        return $this->getLogisticsInstance($type)->getFullTraces($waybillNo, $force);
    }

    public function getOriginTraces(string $type, string $waybillNo, bool $force = false)
    {
        return $this->getLogisticsInstance($type)->getOriginTraces($waybillNo, $force);
    }

    protected function getLogisticsInstance($type)
    {
        switch ($type)
        {
            case self::TYPE_STO:
            default:
                if (!isset(self::$_logisticsInstances[$type]))
                {
                    self::$_logisticsInstances[$type] = new STOLogistics();
                }
                break;

            case self::TYPE_YTO:
                if (!isset(self::$_logisticsInstances[$type]))
                {
                    self::$_logisticsInstances[$type] = new YTOLogistics();
                }
                break;

            case self::TYPE_ZTO:
                if (!isset(self::$_logisticsInstances[$type]))
                {
                    self::$_logisticsInstances[$type] = new ZTOLogistics();
                }
                break;

            case self::TYPE_BEST:
                if (!isset(self::$_logisticsInstances[$type]))
                {
                    self::$_logisticsInstances[$type] = new BESTLogistics();
                }
                break;

            case self::TYPE_DANN:
                if (!isset(self::$_logisticsInstances[$type]))
                {
                    self::$_logisticsInstances[$type] = new DANNLogistics();
                }
                break;

            case self::TYPE_CHPO:
                if (!isset(self::$_logisticsInstances[$type]))
                {
                    self::$_logisticsInstances[$type] = new CHPOLogistics();
                }
                break;
        }

        return self::$_logisticsInstances[$type];
    }
}
