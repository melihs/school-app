<?php

namespace App\Listeners;

use App\Notifications\StudentNotification;
use App\Student;
use App\Events\NotificationSent;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AddStudentByParent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddStudentEvent  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        $getParentCode = $event->user->code;
        $student = Student::where('code',$getParentCode)->first();
        $parentId = User::where('code',$student->code)->first()->value('id');
        $student->user_id = $parentId;

        try  {
            $student->save();
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'save failed',
                'message' => $exception->getMessage(),
            ],500);
        }


        try {
            User::where('email',$event->user->email)->first()->notify(new StudentNotification());
        }catch (\Exception $e) {
            return response()->json([
                'error' => 'email failed',
                'message' => $e->getMessage()
            ],404);
        }
    }
}
