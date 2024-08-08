<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\EmailQueueJob;
use App\Jobs\SmsQueueJob;
use App\Mail\SendEmail;
use App\Models\Question;
use App\Models\Review;
use App\Models\User;
use Illuminate\Bus\BatchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailToolsController extends Controller
{
    public $batches;
    public function __construct(BatchRepository $repository)
    {
        $this->batches = $repository;
    }


    public function index()
    {
        $userEmails = User::query()->where('role', 'customer')->select('email', 'phone')->get();
        $reviewEmails = Review::query()->pluck('email');
        $questionEmails = Question::query()->pluck('email');

        return response()->json([
            'data' => [...$userEmails, ...$reviewEmails, ...$questionEmails]
        ]);
    }

    public function sendEmails(Request $request)
    {

        $request->validate([
           'campaign' => 'required',
           'message' => 'required'
        ]);

        if($request->input('type') == 'email'){
            $request->validate([
                'subject' => 'required',
            ]);
        }


        $chunk = array_chunk($request->input('emails'), 50);
        $batch = Bus::batch([])->name($request->input('campaign'))->dispatch();

        if($request->input('type') == 'email'){
            foreach ($chunk as $emails) {
                foreach ($emails as $email) {
                    $batch->add(new EmailQueueJob($email, $request->input('subject'), $request->input('message')));

                    // mail queue system
                    // Mail::to($email)->send(new SendEmail($request->input('subject'), $request->input('message')));
                    // job system
                    // EmailQueueJob::dispatch($email, $request->input('subject'), $request->input('message'));//->delay(3);
                }
            }
        }else{
            foreach ($chunk as $numbers) {
                $batch->add(new SmsQueueJob(implode(',', $numbers), $request->input('message'))) ;
            }
        }

        return $batch;
    }

    public function getCampaign()
    {
        return $this->batches->get();
    }

    public function deleteCampaign($id)
    {
        Bus::findBatch($id)->delete();
    }


}
