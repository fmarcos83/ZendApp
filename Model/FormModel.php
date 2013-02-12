<?php

declare(encoding='UTF-8');

namespace ZendApp\Model;

class FormModel
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

    public function init()
    {
        //intentionally left blank
    }

    public final function isValid(array $data)
    {
        return $this->getForm()->isValid($data);
    }

    public final function getFormType($type)
    {
        $this->formPointer = $typeName;
        return $this->getForm();
    }

    private final function getForm()
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
