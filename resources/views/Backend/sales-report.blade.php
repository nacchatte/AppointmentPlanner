<html>
<head>
    <title>Sales Report : {{ $month }} / {{ $year }}</title>

    <!-- Add your CSS styles here if needed -->
</head>
<body>
    <h1>Sales Report - {{ $month }} / {{ $year }} </h1>

    <p>Total Earnings: RM {{ $totalEarnings }}</p>
    <p>Total Appointment: {{$totalAppointments}}</p>
    <p>Completed Appointments: {{ $completedAppointments }} / {{$totalAppointments}}</p>
    <p>Upcoming Appointments: {{ $upcomingAppointments }} / {{$totalAppointments}}</p>
    <p>Cancelled Appointments: {{ $cancelledAppointments }} / {{$totalAppointments}}</p>

</body>
</html>
