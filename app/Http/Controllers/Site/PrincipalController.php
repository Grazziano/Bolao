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
        return redirect(route('principal') . '#portfolio');
    }

    public function sign($id, BettingRepositoryInterface $bettingRepository)
    {
        // dd($bettingRepository->BettingUser($id));
        $bettingRepository->BettingUser($id);
        return redirect(route('principal') . '#portfolio');
    }

    public function rounds($betting_id, BettingRepositoryInterface $bettingRepository)
    {
        $columnList = [
            'id' => '#',
            'title' => trans('bolao.title'),
            'betting_title' => trans('bolao.bet'),
            'date_start_site' => trans('bolao.date_start'),
            'date_end_site' => trans('bolao.date_end'),
        ];
        $betting = $bettingRepository->find($betting_id);

        $page = trans('bolao.round_list') . ' (' . $betting->title . ')';

        $list = $bettingRepository->rounds($betting_id);

        $routeName = "rounds.matches";

        if (!$list) {
            return redirect(route('principal') . '#portfolio');
        }

        $breadcrumb = [
            (object)['url' => route('principal') . '#portfolio', 'title' => trans('bolao.betting_list')],
            (object)['url' => '', 'title' => trans('bolao.list', ['page' => $page])],
        ];

        return View('site.rounds', compact('list', 'page', 'columnList', 'breadcrumb', 'routeName'));
        // dd($rounds);
    }

    public function matches($round_id, BettingRepositoryInterface $bettingRepository)
    {
        $list = $bettingRepository->matches($round_id);
        // dd($list->toArray());

        if (!$list) {
            return redirect()->route('principal');
        }

        $betting = $bettingRepository->findBetting($round_id);
        $page = trans('bolao.match_list');
        $routeName = "rounds.matches";

        $columnList = [
            'id' => '#',
            'title' => trans('bolao.title'),
            'round_title' => trans('bolao.round'),
            'stadium' => trans('bolao.stadium'),
            'date_site' => trans('bolao.date'),
        ];

        $breadcrumb = [
            (object)['url' => route('principal') . '#portfolio', 'title' => trans('bolao.betting_list')],
            (object)['url' => route('rounds', $betting->id), 'title' => trans('bolao.round_list'). " ($betting->title)"],
            (object)['url' => '', 'title' => trans('bolao.list', ['page' => $page])],
        ];

        return View('site.rounds', compact('list', 'page', 'columnList', 'breadcrumb', 'routeName'));
    }
}
