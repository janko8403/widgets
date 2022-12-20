<?php

namespace App\Http\Controllers;

use App\Mail\ContestConfirm;
use App\Models\Contests;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function welcome()
    {
        $agecheck = session('agecheck');
        if (!isset($agecheck) || $agecheck == 0) {
            session(['agecheck' => 0, 'isDone' => 0]);
            return view('welcome');
        }
        else {
            switch ($agecheck) {
                case '1':
                    $isDone = session('isDone');
                    return view('menu')->with('isDone',$isDone);
                    break;
                case '2':
                    return view('age-denied');
                    break;
            }
        }
    }

    public function verifyAge(Request $request)
    {
        $age = explode('-',$request->age);
        $d1 = new DateTime($age[1].'-'.$age[0].'-01');
        $d2 = new DateTime();

        $diff = $d2->diff($d1);
        if ($diff->y >= 18) {
            session(['agecheck' => 1, 'isDone' => 0,'age' => $request->age]);
        }
        else {
            session(['agecheck' => 2, 'isDone' => 0]);
        }
    }

    public function getInspirations()
    {
        $agecheck = session('agecheck');
        if ($agecheck == 1) {
            return view('inspirations');
        }
        else {
            return view('age-denied');
        }
    }

    public function getReg()
    {
        $agecheck = session('agecheck');
        if ($agecheck == 1) {
            return view('regulamin');
        }
        else {
            return view('age-denied');
        }
    }

    public function getStart()
    {
        $agecheck = session('agecheck');
        if ($agecheck == 1) {
            return view('prestart');
        }
        else {
            return view('age-denied');
        }
    }

    public function getIdea()
    {
        $agecheck = session('agecheck');
        if ($agecheck == 1) {
            return view('idea-description');
        }
        else {
            return view('age-denied');
        }
    }

    public function getUserData()
    {
        $agecheck = session('agecheck');
        if ($agecheck == 1) {
            return view('idea-user');
        }
        else {
            return view('age-denied');
        }
    }

    public function getThankYou()
    {
        $agecheck = session('agecheck');
        if ($agecheck == 1) {
            return view('idea-final');
        }
        else {
            return view('age-denied');
        }
    }

    public function getFinal(Request $request)
    {
        $this->ageCheck();

        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $idea = $request->idea;

        $contest = new Contests();
        $contest->name = $name;
        $contest->phone = $phone;
        $contest->email = $email;
        $contest->idea = $idea;
        $contest->validationString = $this->generateRandomString('20');
        $contest->validated = 0;
        $contest->birth_date = session('agecheck');
        $contest->save();
        Mail::to($contest->email)->send(new ContestConfirm($contest->validationString));
        session(['isDone' => 1]);

        return view('idea-final');
    }

    public function verifyConfirmString($confirmString)
    {
        $contest = Contests::where('validationString','=',$confirmString)->first();
        if ($contest) {
            $contest->validated = 1;
            $contest->save();
        }
        return view('link-confirmed');
    }

    private function ageCheck()
    {
        $agecheck = session('agecheck');
        if ($agecheck != 1) {
            return view('age-denied');
        }
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
