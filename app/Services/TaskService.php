<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 16.07.2021
 * Time: 7:54
 */

namespace App\Services;


use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskService extends BaseService
{
    public function __construct()
    {
        $this->setRepository(TaskRepository::class);
    }

    public function userTasks($params)
    {
        if(empty($params)){
            return $this->repository->findByUser(Auth::id());
        }else{

        }
    }

    public function create($data)
    {
       $data['user_id'] = Auth::id();
        Log::info($data);

        return $this->repository->create($data);
    }

}