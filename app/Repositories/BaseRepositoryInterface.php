<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 16.07.2021
 * Time: 5:36
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

Interface BaseRepositoryInterface
{

    public function getQuery();

    public function findById($id);

    public function findAll();

}