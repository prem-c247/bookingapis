<?php

namespace App\Services;
use App\Models\Booking;

class BookingService
{
  
  /**
     *  Initializing the Booking Modal
     * 
     */
    protected $bookingModal;

    public function __construct(Booking $bookingModal)
    {
        $this->bookingModal = $bookingModal;
    }

   /**
     *  Return Result of  All Bookings ..
     *
     * @return \Illuminate\Http\Response
     */
    public function getBooking()
    {
        return  $this->bookingModal->orderBy('id', 'DESC')->get();
    }

    /**
     *  Store Data of booking ..
     *
     * @return \Illuminate\Http\Response
     */
    public function storeBooking($data)
    {
      return  $this->bookingModal->updateOrCreate($data);
    }

   /**
     *  Return Result of  Booking Days ..
     *
     * @return \Illuminate\Http\Response
     */
    public function bookingDays()
    {
        return  $this->bookingModal->select('start_date','end_date')->get();
    }

   /**
     *  Return Result of  Free Days ..
     *
     * @return \Illuminate\Http\Response
     */
    public function freeDays($inputs)
    {
        return  $this->bookingModal->whereNotBetween('created_at', [$inputs->start_date, $inputs->end_date])->get();
    }

    
}
   