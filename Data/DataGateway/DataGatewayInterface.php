<?php
declare(encoding='UTF-8');

namespace ZendApp\Data\DataGateway;

interface DataGatewayInterface
{
    function insert(array $data);
    function update(array $data, array $where);
    function find(array $where);
    function delete(array $where);
}
