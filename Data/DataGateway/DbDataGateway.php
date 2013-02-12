<?php
declare(encoding='UTF-8');

namespace ZendApp\Data\DataGateway;

use ZendApp\Data\DataGateway\DataGatewayInterface as DataGatewayInterface;

class DbDataGateway implements DataGatewayInterface
{
    protected $tableGateway = null;
    protected $tableName = '';

    public function __construct($tableName = null)
    {
        $this->tableName = $tableName;
        if ($this->tableName) {
            $this->setTableGateway(new \Zend_Db_Table($this->tableName));
        }
    }

    public function setTableGateway(\Zend_Db_Table $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getTableGateway()
    {
        return $this->tableGateway;
    }

    public function insert(array $data)
    {
        return $this->tableGateway->insert($data);
    }

    public function update(array $data, array $where)
    {
        return $this->tableGateway->update($data, $this->_quoteWhereClauses($where));
    }

    public function find()
    {
        $result = call_user_func_array(array($this->tableGateway, 'select'), func_get_args());
        return $this->tableGateway->fetchAll($result);
    }

    public function delete(array $where)
    {
        return $this->tableGateway->delete($this->_quoteWhereClauses($where));
    }

    //TODO: better in an abstract class
    private function _quoteWhereClauses($where)
    {
        $whereClauses = array();
        foreach($where as $awhereClause=>$quoteValue)
        {
            $whereClauses[]=$this->tableGateway->getAdapter()->quoteInto($awhereClause, $quoteValue);
        }
        return $whereClauses;
    }
}
