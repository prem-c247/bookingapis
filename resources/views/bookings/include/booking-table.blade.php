 <tbody>
     @forelse ($bookingData as $booking)
         <tr>
             <td class="text-center text-muted">{{ $loop->index + 1 }}</td>
             <td>{{ ucwords($booking->purpose) ?? '' }}</td>
             <td class="text-center">{{ $booking->start_date ?? '' }}</td>
             <td class="text-center">{{ $booking->end_date ?? '' }}</td>
         </tr>
     @empty

         <tr>
             <td class="text-center" colspan="6">
                 @lang('no_booking')
             </td>
         </tr>
     @endforelse

 </tbody>
