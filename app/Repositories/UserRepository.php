<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    protected string $model = User::class;

    public function create(array $data)
    {
        $user = $this->model::create($data);

        if (isset($data['currency_id']) || isset($data['country_id'])) {
            UserProfile::create([
                'user_id' => $user->id,
                'currency_id' => $data['currency_id'] ?? null,
                'country_id' => $data['country_id'] ?? null
            ]);
        }

        return $user;
    }

    public function update($user, array $data)
    {
        $user->update($data);

        if (isset($data['country_id']) || isset($data['currency_id'])) {

            if($user->userProfile){
                $user->userProfile->update($data);
            }
            else{
                UserProfile::create([
                    'user_id' => $user->id,
                    'currency_id' => $data['currency_id'] ?? null,
                    'country_id' => $data['country_id'] ?? null
                ]);
            }

        }
    }

    public function all(): Collection
    {
        $sort = request()->get('sort');
        $dir = request()->get('dir');
        $currency = request()->get('currency');
        $country = request()->get('country');

        $query = User::query()->select('users.*');
        if ($sort || $currency || $country) {
            $query->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'users.id');
            $query->leftJoin('currencies', 'user_profiles.currency_id', '=', 'currencies.id');
            $query->leftJoin('countries', 'user_profiles.country_id', '=', 'countries.id');
        }

        if ($sort) {
            switch ($sort) {
                case 'currency':
                    $query->orderBy("currencies.name", $dir ?? 'asc');
                    break;
                case 'country':
                    $query->orderBy("countries.name", $dir ?? 'asc');
                    break;
            }

        }
        if ($currency) {
            $query->where('currencies.name', 'like', "%$currency%");
        }
        if ($country) {
            $query->where('countries.name', 'like', "%$country%");
        }


        $result = $query->get();

        return $result;
    }

}
