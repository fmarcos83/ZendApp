<?php
/**
 * DataGateway for SQL Db wraps up Zend_Db_Table
 *
 * PHP version 5.3
 *
 * @category ZendApp
 * @package  DataGateway
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/lgpl.txt
 * @link     ZendApp\Data\DataGateway
 * @see      Zend_Db_Adapter_Abstract
 * @see      DataGatewayInterface
 * @see      Mapper
 **/

declare(encoding='UTF-8');

namespace ZendApp\Data\DataGateway;

use ZendApp\Data\DataGateway\DataGatewayInterface as DataGatewayInterface;

/**
 * DbDataGateway class
 *
 * Uses Zend_Db_Table to abstract persistence layer
 *
 * @category ZendApp
 * @package  DataGateway
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/lgpl.txt
 * @link     ZendApp\Data\DataGateway
 * @see      Zend_Db_Adapter_Abstract
 * @see      DataGatewayInterface
 * @see      Mapper
 **/
class DbDataGateway implements DataGatewayInterface
{
    private $_tableGateway = null;

    /**
     * instantiates a Zend_Db_Table if $tableName is set
     *
     * @param (String) $tableName OPTIONAL sets Zend_Db_Table name if present
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __construct($tableName = null)
    {
        //intended especially for testing porpouses so it can be easily mocked
        (!isset($tableName))||$this->setTableGateway(new \Zend_Db_Table($tableName));
    }

    /**
     * sets an instance of \Zend_Db_Table this method is mainly
     * used for testing porpouses on Zend_Db_Table mocks dependency injection
     *
     * @param (\Zend_Db_Table) $_tableGateway an instance of Zend_Db_Table
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function setTableGateway(\Zend_Db_Table $_tableGateway)
    {
        $this->_tableGateway = $_tableGateway;
    }

    /**
     * inserts a new row in the database
     *
     * @param (array) $data dictionary where keys are column names and
     *                      values column value
     *
     * @return (int)  last id
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function insert(array $data)
    {
        return $this->_tableGateway->insert($data);
    }

    /**
     * update rows in the db
     *
     * @param (array) $data  dictionary where keys match db table columns
     *                       and values the values to be inserted in db
     * @param (array) $where dictionary where keys are where clauses with
     *                       question mark (?) placeholders and value will
     *                       the value to substitute the placeholder with
     *
     * @return (int)         the number of afected rows
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function update(array $data, array $where)
    {
        return $this->_tableGateway->update($data, $where);
    }

    /**
     * forwards to Zend_Db_Table fetchAll method
     *
     * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
     * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @param int                               $count  OPTIONAL An SQL LIMIT count.
     * @param int                               $offset OPTIONAL An SQL LIMIT offset.
     *
     * @return array rowset converted to array
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function find()
    {
        $result = call_user_func_array(
            array($this->_tableGateway, 'fetchAll'),
            func_get_args()
        );
        return $result->toArray();
    }

    /**
     * deletes rows in the db
     *
     * @param (array) $where dictionary where keys are where clauses with
     *                       question mark (?) placeholders and value will
     *                       the value to substitute the placeholder with
     *
     * @return (int)         number of deleted rows
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function delete(array $where)
    {
        return $this->_tableGateway->delete($where);
    }
}
