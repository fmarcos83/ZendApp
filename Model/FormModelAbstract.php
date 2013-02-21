<?php

declare(encoding='UTF-8');

namespace ZendApp\Model;

use ZendApp\Model\HelperFactory as ModelHelperFactory;

class FormModelAbstract
{
    //lazyloading forms registry
    private $forms = array();
    //lazyloading forms pointer
    protected $formPointer = '';
    protected $formsPrefixClassName = '';

    public final function __construct()
    {
        //Extension points
        $this->init();
    }

    public final function isValid(array $data)
    {
        return $this->getForm()->isValid($data);
    }

    public function init()
    {
        //intentionally left blank
    }

    protected function getDao()
    {
        return ModelHelperFactory::getDao(get_called_class());
    }

    protected function getCollection()
    {
        return ModelHelperFactory::getCollection(get_called_class());
    }

    protected function getFinder()
    {
        return ModelHelperFactory::getFinder(get_called_class());
    }

    protected final function getFormType($type)
    {
        $this->formPointer = $typeName;
        return $this->getForm();
    }

    protected final function getForm()
    {
        $typeName = ucfirst($this->formPointer);
        $className = '';
        if(!isset($this->forms[$typeName]))
        {
            $className = implode('', array($this->formsPrefixClassName, $typeName));
            $this->forms[$typeName] = new $className;
        }
        return $this->forms[$typeName];
    }

}
