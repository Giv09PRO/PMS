@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
                <div class="p-8">

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Students Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-blue-800">Students</h3>
                                    <p class="text-4xl font-bold text-blue-600">{{ \App\Models\Student::count() }}</p>
                                </div>
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <a href="{{ route('students.index') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                Manage Students
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>

                        <!-- Teachers Card -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-green-800">Teachers</h3>
                                    <p class="text-4xl font-bold text-green-600">{{ \App\Models\Teacher::count() }}</p>
                                </div>
                                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <a href="{{ route('teachers.index') }}" class="mt-4 inline-flex items-center text-green-600 hover:text-green-800 transition-colors">
                                Manage Teachers
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>

                        <!-- Classes Card -->
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-purple-800">Classes</h3>
                                    <p class="text-4xl font-bold text-purple-600">{{ \App\Models\SchoolClass::count() }}</p>
                                </div>
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <a href="{{ route('SchoolClasses.index') }}" class="mt-4 inline-flex items-center text-purple-600 hover:text-purple-800 transition-colors">
                                Manage Classes
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Attendance Chart -->
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <h3 class="text-lg font-semibold mb-4">Weekly Attendance</h3>
                            <canvas id="attendanceChart" class="w-full h-64"></canvas>
                        </div>

                        <!-- Fees Collection Chart -->
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <h3 class="text-lg font-semibold mb-4">Fees Collection</h3>
                            <canvas id="feesChart" class="w-full h-64"></canvas>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Attendance Stats -->
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-2xl shadow-md">
                            <h3 class="text-xl font-bold mb-2 text-yellow-800">Today's Attendance</h3>
                            <p class="text-4xl font-bold text-yellow-600">{{ \App\Models\Attendance::whereDate('created_at', today())->count() }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('attendance.index') }}" class="text-yellow-600 hover:text-yellow-800 transition-colors inline-flex items-center">
                                    View Details
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>

                        <!-- Exams Stats -->
                        <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-2xl shadow-md">
                            <h3 class="text-xl font-bold mb-2 text-red-800">Upcoming Exams</h3>
                            <p class="text-4xl font-bold text-red-600">{{ \App\Models\Exam::where('exam_date', '>=', today())->count() }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('exams.index') }}" class="text-red-600 hover:text-red-800 transition-colors inline-flex items-center">
                                    View Schedule
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>

                        <!-- Fees Stats -->
                        <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-6 rounded-2xl shadow-md">
                            <h3 class="text-xl font-bold mb-2 text-teal-800">Pending Fees</h3>
                            <p class="text-4xl font-bold text-teal-600">{{ \App\Models\Fee::where('payment_status', 'pending')->count() }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('fees.index') }}" class="text-teal-600 hover:text-teal-800 transition-colors inline-flex items-center">
                                    View Fees
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart.js example for attendance
        const ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctxAttendance, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                datasets: [{
                    label: 'Attendance',
                    data: [12, 19, 10, 15, 13],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Chart.js example for fees collection
        const ctxFees = document.getElementById('feesChart').getContext('2d');
        const feesChart = new Chart(ctxFees, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Fees Collected',
                    data: [3000, 2000, 4000, 5000],
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
<style>
        .fa, .fas, .far {
            font-size: 0.9em;
        }
    </style>

