<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 17.07.2021
 * Time: 7:08
 */

namespace App\Listeners;


use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;

class TaskCreatedLog
{
    public function handle(TaskCreated $event)
    {
        Log::channel('tasks')->info($event->task->created_at.": New task \" ".$event->task->text."\" created.");

    }
}