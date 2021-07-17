<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 16.07.2021
 * Time: 6:09
 */

namespace App\Repositories;


use App\Models\Task;

class TaskRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Task::class;
    }

    public function findByUser($user_id)
    {
        return $this->getQuery()
            ->where('user_id', $user_id)
            ->orderBy('priority')
            ->orderBy('created_at','desc')
            ->get();
    }

    public function create($data)
    {
        return $this->model::create($data);
    }

}