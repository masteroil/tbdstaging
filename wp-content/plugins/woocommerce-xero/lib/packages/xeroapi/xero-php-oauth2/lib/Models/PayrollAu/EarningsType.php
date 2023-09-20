<?php
/**
 * EarningsType
 *
 * PHP version 5
 *
 * @category Class
 * @package  XeroAPI\XeroPHP
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 *
 * @license MIT
 * Modified by woocommerce on 28-August-2023 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

/**
 * Xero Payroll AU API
 *
 * This is the Xero Payroll API for orgs in Australia region.
 *
 * Contact: api@xero.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\PayrollAu;
use \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\PayrollAuObjectSerializer;
use \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\StringUtil;
use ReturnTypeWillChange;

/**
 * EarningsType Class Doc Comment
 *
 * @category Class
 * @package  XeroAPI\XeroPHP
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class EarningsType
{
    /**
     * Possible values of this enum
     */
    const FIXED = 'FIXED';
    const ORDINARYTIMEEARNINGS = 'ORDINARYTIMEEARNINGS';
    const OVERTIMEEARNINGS = 'OVERTIMEEARNINGS';
    const ALLOWANCE = 'ALLOWANCE';
    const LUMPSUMD = 'LUMPSUMD';
    const EMPLOYMENTTERMINATIONPAYMENT = 'EMPLOYMENTTERMINATIONPAYMENT';
    const LUMPSUMA = 'LUMPSUMA';
    const LUMPSUMB = 'LUMPSUMB';
    const BONUSESANDCOMMISSIONS = 'BONUSESANDCOMMISSIONS';
    const LUMPSUME = 'LUMPSUME';
    const LUMPSUMW = 'LUMPSUMW';
    const DIRECTORSFEES = 'DIRECTORSFEES';
    const PAIDPARENTALLEAVE = 'PAIDPARENTALLEAVE';
    const WORKERSCOMPENSATION = 'WORKERSCOMPENSATION';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::FIXED,
            self::ORDINARYTIMEEARNINGS,
            self::OVERTIMEEARNINGS,
            self::ALLOWANCE,
            self::LUMPSUMD,
            self::EMPLOYMENTTERMINATIONPAYMENT,
            self::LUMPSUMA,
            self::LUMPSUMB,
            self::BONUSESANDCOMMISSIONS,
            self::LUMPSUME,
            self::LUMPSUMW,
            self::DIRECTORSFEES,
            self::PAIDPARENTALLEAVE,
            self::WORKERSCOMPENSATION,
        ];
    }
}

