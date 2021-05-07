<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BettingRepositoryInterface;

class PrincipalController extends Controller
{
    public function index(BettingRepositoryInterface $bettingRepository)
    {
        $list = $bettingRepository->list();
        return view('site.index', compact('list'));
    }

    public function signNoLogin($id)
    {
        // return redirect()->route('principal');
        return redirect(route('principal') . '#portifolio');
    }

    public function sign($id, BettingRepositoryInterface $bettingRepository)
    {
        // dd($bettingRepository->BettingUser($id));
        $bettingRepository->BettingUser($id);
        return redirect(route('principal') . '#portifolio');
    }

    public function rounds($betting_id, BettingRepositoryInterface $bettingRepository)
    {
        $rounds = $bettingRepository->rounds($betting_id);
        dd($rounds);
    }
}
