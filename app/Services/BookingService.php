<?php

namespace App\Services;

use App\Models\Booking;

class BookingService
{

   /**
     *TO get  data from table .
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function getBooking()
    {
        return Booking::orderBy('id', 'DESC')->get();
    }

   /**
     *store data in table .
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function storeBooking($data)
    {
      return  Booking::updateOrCreate($data);
    }

    /**
     *get data from table .
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function bookingDays()
    {
        return  Booking::select('start_date','end_date')->get();
    }

    /**
     *get data from table .
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function freeDays($inputs)
    {
        return  Booking::whereNotBetween('created_at', [$inputs->start_date, $inputs->end_date])->get();
    }

    
}
   