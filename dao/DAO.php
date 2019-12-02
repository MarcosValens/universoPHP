<?php

interface DAO
{
    function get($id);

    function getAll();

    function save($obj);

    function update($obj);

    function delete($obj);
}
