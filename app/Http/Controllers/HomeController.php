<?php

namespace App\Http\Controllers;

use App\Models\Contests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $firstPrizeCount = DB::select('select count(*) as c from contests where firstPrize = 1',[1]);
        $secondPrizeCount = DB::select('select count(*) as c from contests where secondPrize = 1',[1]);
        $contests = Contests::latest()->paginate(30);
        return view('home', compact('contests'))
            ->with('firstPrizeCount',$firstPrizeCount[0]->c)
            ->with('secondPrizeCount',$secondPrizeCount[0]->c)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function edit(Contests $contest)
    {
        return view('contests.edit', compact('contest'));
    }

    public function update(Request $request, Contests $contest)
    {
        $request->validate([
            'name' => 'required',
            'idea' => 'required',
            'email' => 'email'
        ]);
        $contest->update($request->all());
        return redirect()->route('home')
            ->with('success', 'Zgłoszenie zostało zaktualizowane');
    }

    public function destroy(Contests $contest)
    {
        $contest->delete();

        return redirect()->route('home')
            ->with('success', 'Usunięto zgłoszenie');
    }

    public function switchPrize(Request $request)
    {
        if ($request->id) {
            $contest = Contests::where('id',$request->id)->first();
            if ($request->prizeType == 1) {
                if ($contest->firstPrize == 1) {
                    $contest->firstPrize = 0;
                }
                else {
                    $contest->firstPrize = 1;
                }
            }
            if ($request->prizeType == 2) {
                if ($contest->secondPrize == 1) {
                    $contest->secondPrize = 0;
                }
                else {
                    $contest->secondPrize = 1;
                }
            }
            $contest->save();
            switch($request->prizeType) {
                case '1':
                    $firstPrizeCount = DB::select('select count(*) as c from contests where firstPrize = 1',[1]);
                    $count=$firstPrizeCount[0]->c;
                    break;
                case '2':
                    $secondPrizeCount = DB::select('select count(*) as c from contests where secondPrize = 1',[1]);
                    $count=$secondPrizeCount[0]->c;
                    break;
            }
            return($count);
        }
    }

    public function chooseContest(Request $request)
    {
        if ($request->id) {
            $contest = Contests::where('id',$request->id)->first();
            if ($contest->status == 1) {
                $contest->status = 0;
            }
            else {
                $contest->status =1;
            }
            $contest->save();
            //$count = Contests::count('')
        }
    }

}
