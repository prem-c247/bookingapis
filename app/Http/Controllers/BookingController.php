<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Services\BookingService;

class BookingController extends Controller
{
    /**
     *  Initializing the Booking Service
     * 
     */
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

   /**
     * Return Result of All Bookings 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->is('api/*')) {
                $bookings = $this->bookingService->getBooking();
                return \Response::json(['status' => 'success','data' => $bookings],200);
            } else {
                $bookingData = $this->bookingService->getBooking();
                return view('bookings.index', compact('bookingData'));
            }
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return \Response::json(
                ['status' => 'error','message' => $exception->getMessage(),],501);
        }
    }

   /**
     * Store Result of Booking or check if the booking is not already exists
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validated request
        $validator = \Validator::make(
            $request->all(),
            [
                'purpose' => ['required', 'string', 'max:50'],
                'start_date' => ['required','date:yyyy-mm-dd','unique:bookings,start_date'],
                'end_date' => ['required','date:yyyy-mm-dd', 'after_or_equal:start_date'],
            ],
            [
                'purpose.required' => "Please Enter Purpose",
                'start_date.unique' => 'Booking Date Already Busy',
                'start_date.required' => 'Please Select Start Date',
                'end_date.required' => 'Please Select End Date',
                'end_date.after_or_equal'=> 'End Date Should Be Greater Or Equal to Start Date'
            ]
        );
      
        if ($validator->fails()) {
            return response()->json(['status' => 'error','error' => $validator->errors()],203);
        }
       try {
            $data = [
                'purpose'=>$request->purpose,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date
            ];
            $bookedData = $this->bookingService->storeBooking($data);
            return \Response::json(
                ['status' => 'success','message' => 'Booking created successfully','data' => $bookedData],201);
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return \Response::json(
                ['status' => 'error','message' => $exception->getMessage(),],501);
        }
    }

   /**
     *  Return Result of  Booking Days ..
     *
     * @return \Illuminate\Http\Response
     */
    public function bookingDays()
    {
        try {
            $bookingDays = $this->bookingService->bookingDays();
            $message = 'Busy Days Get Successfully';
            if (count($bookingDays) == 0) {
                $message =  'No Booking Days Found';
            }
            return \Response::json(
                ['status' => 'success','data' => $bookingDays,'message' => $message],200);
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return \Response::json(
                ['status' => 'error',  'message' => $exception->getMessage(),],501 );
        }
    }

   /**
     *  Return Result of Free Days List ..
     *
     * @return \Illuminate\Http\Response
     */
    public function freeDays(Request $request)
    {
         // validated request
          $validator = \Validator::make(
            $request->all(),
            [
                'start_date' => ['required','date:yyyy-mm-dd'],
                'end_date' => ['required','date:yyyy-mm-dd'],
            ] );
      
            if ($validator->fails()) {
                return response()->json(['status' => 'error','error' => $validator->errors()],203);
            }

       try {
            $data = [
                  'start_date'=>$request->start_date,
                  'end_date'=>$request->end_date
                ];
            $bookingDays = $this->bookingService->freeDays($data);
            $message = 'Free Booking Get Successfully';
            if (count($bookingDays) == 0) {
                $message =  'No Free Days Found';
            }
            return \Response::json([
                'status' => 'success','data' => $bookingDays,'message' => $message
            ],200 );
            
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return \Response::json(
                ['status' => 'error','message' => $exception->getMessage()],501
            );
        }
    }
}
