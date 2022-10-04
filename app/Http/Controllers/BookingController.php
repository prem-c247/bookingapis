<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;
use App\Services\BookingService;
use Illuminate\Support\Facades\{Log,Response,Validator};

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
                return Response::json(
                    [
                        'data' => $bookings,
                    ],
                    201
                );
            } else {
                $bookingData = $this->bookingService->getBooking();
                return view('bookings.index', compact('bookingData'));
            }
        } catch (Exception $exception) {
            return Response::json(
                [
                    Log::error($exception->getMessage()),
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
        $validator = Validator::make(
            $request->all(),
            [
                'purpose' => ['required', 'string', 'max:50'],
                'start_date' => ['required', 'unique:bookings,start_date'],
                'end_date' => ['required'],
            ],
            [
                'purpose.required' => "Please Enter Purpose",
                'start_date.unique' => 'Booking Date Already Busy',
                'start_date.required' => 'Please Select Start Date',
                'end_date.required' => 'Please Select End Date',
            ]
        );
        if ($request->is('api/*')) {
            // if any error return back request with input errors
            if ($validator->fails()) {
                return Response::json(
                    [
                        'status' => 'error',
                        'error' => $validator->errors(),
                    ],
                    400
                );
            }
        } else {
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'error' => $validator->errors(),
                ]);
            }
        }

        try {
            $inputs = $validator->validated();
            $this->bookingService->storeBooking($inputs);
            return Response::json(
                [
                    'status' => 'success',
                    'message' => 'Booking created successfully',
                ],
                200
            );
        } catch (Exception $exception) {
            return Response::json(
                [
                    Log::error($exception->getMessage()),
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
            if ($bookingDays) {
                return Response::json(
                    [
                        'data' => $bookingDays,
                    ],
                    201
                );
            } else {
                return Response::json(
                    [
                        'message' => 'No Booking Days Found',
                    ],
                    400
                );
            }
        } catch (Exception $exception) {
            return Response::json(
                [
                    Log::error($exception->getMessage()),
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
            $inputs  = $request ;
            $bookingDays = $this->bookingService->freeDays($inputs);
            if ($bookingDays) {
                return Response::json(
                    [
                        'data' => $bookingDays,
                    ],
                    201
                );
            } else {
                return Response::json(
                    [
                        'message' => 'No Free Days Found',
                    ],
                    400
                );
            }
        } catch (Exception $exception) {
            return Response::json(
                [
                    Log::error($exception->getMessage()),
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ],
                400
            );
        }
    }

  
}
