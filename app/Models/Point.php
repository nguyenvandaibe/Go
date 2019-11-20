<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;

class Point extends Model
{
    protected $fillable = [
        'plan_id',
        'order',
        'place',
        'place_lat',
        'place_lng',
        'arrive_time',
        'depature_time',
        'vehicle',
        'activity',
    ];

    public static function createPoint($planId, array $data)
    {

    	if(Point::where('plan_id', $planId) == null) {

    		$data['order'] = 1;
    	} elseif (Point::where('plan_id', $planId)->where('order', $data['order'])->exists()) {
    		$points = Point::where('plan_id', $planId)->where('order', $data['order'])->get();

    		foreach ($points as $point) {
    			$point->update(['order' => $point->order + 1]);
    		}
    	} else {
    		$maxOrder = Point::where('plan_id', $planId)->max('order');

    		$data['order'] = $maxOrder + 1;
    	}

		$newPoint = Point::create([
            'plan_id' => $planId,
            'order' => $data['order'],
            'place' => $data['place'],
            'place_lat' => $data['place_lat'],
            'place_lng' => $data['place_lng'],
            'arrive_time' => $data['arrive_time'],
            'depature_time' => $data['depature_time'],
            'vehicle' => $data['vehicle'],
            'activity' => $data['activity'],
        ]);

		return $newPoint;

    	/*
		_Kiểm tra xem trong số các point đã có order đó hay chưa.
		_Nếu có rồi, đẩy các order từ vị trí trùng trở về sau tăng 1 đơn vị.
		_Nếu chưa có mặc định thêm vào cuối bất kể order nhập vào là bao nhiêu.
    	*/
    }

    public static function editPoint($planId, array $data)
    {
        $oldOrder = $data['old_order'];

        $newOrder = $data['new_order'];

        if ($oldOrder != $newOrder) {

            $oldOrderPoint = Point::where('order', $oldOrder);

            $newOrderPoint = Point::where('order', $newOrder);

            $oldOrderPoint->update([
                'place' => $newOrderPoint->place,
                'place_lat' => $newOrderPoint->place_lat,
                'place_lng' => $newOrderPoint->place_lng,
                'arrive_time' => $newOrderPoint->arrive_time,
                'depature_time' => $newOrderPoint->depature_time,
                'vehicle' => $newOrderPoint->vehicle,
                'activity' => $newOrderPoint->activity,
            ]);

            $newOrderPoint->update([
                'place' => $data['place'],
                'place_lat' => $data['place_lat'],
                'place_lng' => $data['place_lng'],
                'arrive_time' => $data['arrive_time'],
                'depature_time' => $data['depature_time'],
                'vehicle' => $data['vehicle'],
                'activity' => $data['activity'],
            ]);
        } else {
            $editedPoint = Point::where('plan_id', $planId)->where('order', $oldOrder);

            $editedPoint->update([
                'place' => $data['place'],
                'place_lat' => $data['place_lat'],
                'place_lng' => $data['place_lng'],
                'arrive_time' => $data['arrive_time'],
                'depature_time' => $data['depature_time'],
                'vehicle' => $data['vehicle'],
                'activity' => $data['activity'],
            ]);
        }        
    }

    public static function deletePoint($planId, $order)
    {
        Point::where('plan_id', $planId)->where('order', $order)->delete();
        
        $points = Point::where('plan_id', $planId)->where('order', '>', $order)->get();

        foreach ($points as $point) {
            $point->order -= 1;
            $point->save();
        }

    }

    public static function getPoints($planId)
    {
        return Point::where('plan_id', $planId)->get();
    }
}
