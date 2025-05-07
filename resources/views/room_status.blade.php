<h2>Room Status</h2>
<p>Available Rooms: {{ $availableRooms }}</p>

@if($availableRooms == 0)
    <p style="color:red;">Fully Booked</p>
@endif
