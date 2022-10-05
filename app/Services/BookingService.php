<?php

namespace App\Services;

use App\Models\Booking;

class BookingService
{

   /**
     * Return result from the modal.
     *
     * @return \Illuminate\Http\Response
     */
    protected $bookingModal;

    public function __construct(Booking $bookingModal)
    {
        $this->bookingModal = $bookingModal;
    }

   /**
     *TO get  data from table .
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function getBooking()
    {
        return  $this->bookingModal->orderBy('id', 'DESC')->get();
    }

   /**
     *store data in table .
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function storeBooking($data)
    {
      return  $this->bookingModal->updateOrCreate($data);
    }

    /**
     *get data from table .
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function bookingDays()
    {
        return  $this->bookingModal->select('start_date','end_date')->get();
    }

    /**
     *get data from table .
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function freeDays($inputs)
    {
        return  $this->bookingModal->whereNotBetween('created_at', [$inputs->start_date, $inputs->end_date])->get();
    }

    
}
   