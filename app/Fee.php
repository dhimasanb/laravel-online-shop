<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use RajaOngkir;
use App\Product;

class Fee extends Model
{
    protected $fillable = ['origin', 'destination', 'courier', 'service',
        'weight', 'cost', 'updated_at'];

    public static function getCost($origin_id, $destination_id, $weight, $courier, $service)
    {
        $fee = static::firstOrCreate([
            'origin'      => $origin_id,
            'destination' => $destination_id,
            'weight'      => $weight,
            'courier'     => $courier,
            'service'     => $service
        ]);

        if ($fee->haveCost() && !$fee->isNeedUpdate()) return $fee->cost;
        return $fee->populateCost();
    }

    protected function haveCost()
    {
        return $this->cost > 0;
    }

    protected function isNeedUpdate()
    {
        return $this->updated_at->diffInDays(Carbon::today()) > 7;
    }

    public function populateCost()
    {
        $params = $this->toArray();
        $costs = RajaOngkir::Cost($params)->get();

        $cost = 0;
        foreach ($costs[0]['costs'] as $result) {
            if ($result['service'] == $this->service) {
                $cost = $result['cost'][0]['value'];
                break;
            }
        }

        $cost = $cost > 0 ? $cost : config('rajaongkir.fallback_fee');
        // update cost & force update `updated_at` field
        $this->update(['cost' => $cost, 'updated_at'=>Carbon::today()]);
        return $cost;
    }
}
