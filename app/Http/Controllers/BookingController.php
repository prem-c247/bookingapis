<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Services\BookingService;


class BookingController extends Controller
{
    /**
     * Return result from the service.
     *
     * @return \Illuminate\Http\Response
     */
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     *to get all data.
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->is('api/*')) {
                $bookings = $this->bookingService->getBooking();
                return \Response::json(
                    [
                        'status' => 'success',
                        'data' => $bookings,
                    ],
                    201
                );
            } else {
                $bookingData = $this->bookingService->getBooking();
                return view('bookings.index', compact('bookingData'));
            }
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return \Response::json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ],
                400
            );
        }
    }

    /**
     *store booking data
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validated request
        $validator = \Validator::make(
            $request->all(),
            [
                'purpose' => ['required', 'string', 'max:50'],
                'start_date' => ['required', 'unique:bookings,start_date'],
                'end_date' => ['required','after_or_equal:start_date'],
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
                return response()->json([
                    'status' => 'error',
                    'error' => $validator->errors(),
                ],
                    400);
            }
      
        try {
            $data = [
                'purpose'=>$request->purpose,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date
            ];
            $this->bookingService->storeBooking($data);
            return \Response::json(
                [
                    'status' => 'success',
                    'message' => 'Booking created successfully',
                ],
                200
            );
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return \Response::json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ],
                400
            );
        }
    }

    /**
     *to get busy days.
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function bookingDays()
    {
        try {
            $bookingDays = $this->bookingService->bookingDays();
           
            if (count($bookingDays) == 0) {
                $bookingDays =  'No Booking Days Found';
            }

            return \Response::json(
                [
                    'status' => 'success',
                    'data' => $bookingDays,
                ],
                201
            );
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return \Response::json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ],
                400
            );
        }
    }

    /**
     *to get free days.
     * @param $user_id current login user id
     * @return \Illuminate\Http\Response
     */
    public function freeDays(Request $request)
    {
        try {
            $inputs  = $request;
            $bookingDays = $this->bookingService->freeDays($inputs);
            if (count($bookingDays) == 0) {
                $bookingDays =  'No Free Days Found';
            }
            return \Response::json(
                [
                    'status' => 'success',
                    'data' => $bookingDays,
                ],
                201
            );
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return \Response::json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ],
                400
            );
        }
    }

  
}
