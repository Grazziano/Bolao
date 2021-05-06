<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BettingRepositoryInterface;
use App\Betting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class BettingRepository extends AbstractRepository implements BettingRepositoryInterface
{

    protected $model = Betting::class;

    public function create(array $data): Bool
    {
        $user = Auth()->user();
        $data['user_id'] = $user->id;
        return (bool) $this->model->create($data);
    }

    public function list(): Collection
    {
        $list = Betting::all();
        $user = Auth()->user();

        if ($user) {
            $myBetting = $user->myBetting;
            foreach ($list as $key => $value) {
                if ($myBetting->contains($value)) {
                    $value->subscriber = true;
                }
            }
        }

        return $list;
    }

    public function update(array $data, int $id): Bool
    {
        $register = $this->find($id);
        if ($register) {
            $user = Auth()->user();
            $data['user_id'] = $user->id;
            return (bool) $register->update($data);
        } else {
            return false;
        }
    }

    public function BettingUser($id)
    {
        $user = Auth()->user();
        $betting = Betting::find($id);
        if ($betting) {
            $ret = $user->myBetting()->toggle($betting->id);
            if (count($ret['attached'])) {
                return true;
            }
        }
        return false;
    }
}
