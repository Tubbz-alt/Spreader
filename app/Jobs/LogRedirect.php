<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\DispatchLog, App\PRequestLog;

class LogRedirect extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $logId = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($logId)
    {
        $this->logId = $logId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $log = DispatchLog::find($this->logId);
        $prequest = [
            'project_id' => $log->project_id,
            'activity_id' => $log->activity_id,
            'task_id' => $log->task_id,
            'request_udid' => MD5("$log->remote_addr#$log->user_agent"), // udid
            'requested_at' => $log->created_at
        ];

        if ($log->task_id && $task = \App\Task::find($log->task_id)) {
            $prequest['term_id'] = $task->term_id;
            $prequest['amigo_id'] = $task->amigo_id;
        }

        PRequestLog::create($prequest);
    }
}
