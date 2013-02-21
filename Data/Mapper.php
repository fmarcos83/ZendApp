<?php

declare(encoding='UTF-8');

namespace ZendApp\Data;

use ZendApp\Data\AbstractMapper as AbstractMapper;
use ZendApp\Data\DomainObject   as DomainObject;

class Mapper extends AbstractMapper
{
    public function find(array $where = null)
    {
        $result = $this->dataGateway->find($where);
        return $this->getCollection()->setData($result);
    }

    public function insert(DomainObject $domainObject)
    {
        $id = $this->dataGateway->insert($domainObject->toArray());
        $domainObject->id = $id;
        return $id;
    }

    public function update(DomainObject $domainObject)
    {
        $where = array('id=?'=>$popo->id);
        return $this->dataGateway->update($domainObject->toArray(), $where);
    }

    public function delete(array $where = null)
    {
        return $this->dataGateway->delete($where);
    }
}
