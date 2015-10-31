<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateActivityQRCode extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $activityId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($activityId)
    {
        $this->activityId = $activityId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $activity = \App\Activity::find($this->activityId);

        $qrCode = new \Endroid\QrCode\QrCode();
        $qrCode
            //->setText("http://192.168.1.189/redirect")
            ->setSize(300)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0));

        foreach ($activity->tasks as $task) {
            $task->scene = 'http://'.env('APP_HOST')."/redirect/$activity->project_id/$this->activityId/$task->id";
            $task->qrcode_url = "projects/p{$activity->project_id}-a{$this->activityId}-t{$task->id}.jpeg";
            $task->save();

            $qrCode->setText($task->scene)->render(storage_path("app/$task->qrcode_url"), 'jpg');
        }
    }
}
