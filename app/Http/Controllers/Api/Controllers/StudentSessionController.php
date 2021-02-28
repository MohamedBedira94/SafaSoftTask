<?php

namespace App\Http\Controllers\Api\Controllers;

use App\Classes\SessionOperation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreSessionsRequest;

class StudentSessionController extends Controller
{
    private $sessionOperation;

    public function __construct(SessionOperation $sessionOperation)
    {
        $this->sessionOperation = $sessionOperation;
    }

    public function register_sessions(StudentStoreSessionsRequest $request){

          $items = $this->sessionOperation
              ->calSessnumsFinishingChapters($request)
              ->calWeeksnumsFinishingSessions()
              ->loopingInsideWeeksSessions();

          return response()->json($items,200);


    }
}
