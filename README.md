<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Booking Api's
- In this we have created a booking apis for the fields
- Purpose of the booking (String type)
- Starting date (Date type)
- Ending date (Date type)
- Button to submit.

 #what we did 
If the date is already booked, the Api will throw a message to inform that it's already busy and we need to check another date. Otherwise, we book that date and it became busy.

in which we have created below api's

-  Book meeting
url : http://example.com/api/booking-save 
method :post
- Get busy dates

url : http://example.com/api/busy-days
method :get

- Get free dates
url : http://example.com/api/free-days
params : 'start_date' , 'end_date' 
method :get

- Get all bookings
url : http://example.com/api/get-booking
method :get



