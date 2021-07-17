<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 16.07.2021
 * Time: 6:11
 */

namespace App\Services;


class BaseService
{
    public $repository;

    public function setRepository($repository)
    {
        $this->repository = app($repository);

        return $this;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->repository, $name)) {
            return call_user_func_array([$this->repository, $name], $arguments);
        }

        throw new \BadMethodCallException();
    }
}