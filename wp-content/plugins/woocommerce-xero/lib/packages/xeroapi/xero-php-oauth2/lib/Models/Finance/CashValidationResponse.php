<?php
/**
 * CashValidationResponse
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
 * Xero Finance API
 *
 * The Finance API is a collection of endpoints which customers can use in the course of a loan application, which may assist lenders to gain the confidence they need to provide capital.
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

namespace Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance;

use \ArrayAccess;
use \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\FinanceObjectSerializer;
use \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\StringUtil;
use ReturnTypeWillChange;

/**
 * CashValidationResponse Class Doc Comment
 *
 * @category Class
 * @package  XeroAPI\XeroPHP
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class CashValidationResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CashValidationResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'account_id' => 'string',
        'statement_balance' => '\Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance\StatementBalanceResponse',
        'statement_balance_date' => '\DateTime',
        'bank_statement' => '\Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance\BankStatementResponse',
        'cash_account' => '\Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance\CashAccountResponse'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'account_id' => 'uuid',
        'statement_balance' => null,
        'statement_balance_date' => 'date',
        'bank_statement' => null,
        'cash_account' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'account_id' => 'accountId',
        'statement_balance' => 'statementBalance',
        'statement_balance_date' => 'statementBalanceDate',
        'bank_statement' => 'bankStatement',
        'cash_account' => 'cashAccount'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'account_id' => 'setAccountId',
        'statement_balance' => 'setStatementBalance',
        'statement_balance_date' => 'setStatementBalanceDate',
        'bank_statement' => 'setBankStatement',
        'cash_account' => 'setCashAccount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'account_id' => 'getAccountId',
        'statement_balance' => 'getStatementBalance',
        'statement_balance_date' => 'getStatementBalanceDate',
        'bank_statement' => 'getBankStatement',
        'cash_account' => 'getCashAccount'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['account_id'] = isset($data['account_id']) ? $data['account_id'] : null;
        $this->container['statement_balance'] = isset($data['statement_balance']) ? $data['statement_balance'] : null;
        $this->container['statement_balance_date'] = isset($data['statement_balance_date']) ? $data['statement_balance_date'] : null;
        $this->container['bank_statement'] = isset($data['bank_statement']) ? $data['bank_statement'] : null;
        $this->container['cash_account'] = isset($data['cash_account']) ? $data['cash_account'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets account_id
     *
     * @return string|null
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     *
     * @param string|null $account_id The Xero identifier for an account
     *
     * @return $this
     */
    public function setAccountId($account_id)
    {

        $this->container['account_id'] = $account_id;

        return $this;
    }



    /**
     * Gets statement_balance
     *
     * @return \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance\StatementBalanceResponse|null
     */
    public function getStatementBalance()
    {
        return $this->container['statement_balance'];
    }

    /**
     * Sets statement_balance
     *
     * @param \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance\StatementBalanceResponse|null $statement_balance statement_balance
     *
     * @return $this
     */
    public function setStatementBalance($statement_balance)
    {

        $this->container['statement_balance'] = $statement_balance;

        return $this;
    }



    /**
     * Gets statement_balance_date
     *
     * @return \DateTime|null
     */
    public function getStatementBalanceDate()
    {
        return $this->container['statement_balance_date'];
    }

    /**
     * Sets statement_balance_date
     *
     * @param \DateTime|null $statement_balance_date UTC Date when the last bank statement item was entered into Xero. This date is represented in ISO 8601 format.
     *
     * @return $this
     */
    public function setStatementBalanceDate($statement_balance_date)
    {

        $this->container['statement_balance_date'] = $statement_balance_date;

        return $this;
    }



    /**
     * Gets bank_statement
     *
     * @return \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance\BankStatementResponse|null
     */
    public function getBankStatement()
    {
        return $this->container['bank_statement'];
    }

    /**
     * Sets bank_statement
     *
     * @param \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance\BankStatementResponse|null $bank_statement bank_statement
     *
     * @return $this
     */
    public function setBankStatement($bank_statement)
    {

        $this->container['bank_statement'] = $bank_statement;

        return $this;
    }



    /**
     * Gets cash_account
     *
     * @return \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance\CashAccountResponse|null
     */
    public function getCashAccount()
    {
        return $this->container['cash_account'];
    }

    /**
     * Sets cash_account
     *
     * @param \Automattic\WooCommerce\Xero\Vendor\XeroAPI\XeroPHP\Models\Finance\CashAccountResponse|null $cash_account cash_account
     *
     * @return $this
     */
    public function setCashAccount($cash_account)
    {

        $this->container['cash_account'] = $cash_account;

        return $this;
    }


    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            FinanceObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }
}


