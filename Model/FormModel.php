<?php

declare(encoding='UTF-8');

namespace ZendApp\Model;

use ZendApp\Model\Exception\Model as ModelException;
use ZendApp\Model\FormModelAbstract as FormModelAbstract;

class FormModel extends FormModelAbstract
{
    public function save($data)
    {
        if (!$this->isValid($data)) {
            throw new ModelException;
        }
        return $this->getFinder()->save($this->getDao()->setData($data));
    }

    public function get(array $query)
    {
        return $this->getFinder()->find($query);
    }

    public function delete(array $query)
    {
        return $this->getFinder()->delete($query);
    }
}
