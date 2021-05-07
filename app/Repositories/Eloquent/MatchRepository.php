<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Match;

/**
 *
 */
class MatchRepository extends AbstractRepository implements MatchRepositoryInterface
{

    protected $model = Match::class;

    public function create(array $data): Bool
    {
        $user = auth()->user();
        $listRel = $user->rounds;
        $round_id = $data['round_id'];
        $exist = false;

        foreach ($listRel as $key => $value) {
            if ($round_id == $value->id) {
                $exist = true;
            }
        }

        if ($exist) {
            return (bool) $this->model->create($data);
        } else {
            return false;
        }
    }

    public function update(array $data, int $id): Bool
    {
        $register = $this->find($id);
        if ($register) {

            $user = auth()->user();
            $listRel = $user->rounds;
            $round_id = $data['round_id'];
            $exist = false;

            foreach ($listRel as $key => $value) {
                if ($round_id == $value->id) {
                    $exist = true;
                }
            }

            if ($exist) {
                return (bool) $register->update($data);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function match($match_id)
    {
        $user = auth()->user();
        // dd($user);
        $match = $user->matches()->find($match_id);

        if($match){
            return $match;
        }

        $match = Match::find($match_id);
        $betting_id = $match->round->betting->id;
        // dd($betting_id);
        $betting = $user->myBetting()->find($betting_id);
        if ($betting) {
            return $match;
        }
        // dd($match);
        return false;
    }
}
