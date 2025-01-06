@extends('home')

@section('content')
    <main class="flex-1 ml-64 p-8">
        <h1 class="text-2xl font-bold mb-6">My Class Schedule</h1>
        
        <!-- Class Schedule Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Monday Classes -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-calendar-day mr-2 text-blue-500"></i>
                    Monday
                </h2>
                <div class="space-y-4">
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-800">Mathematics</h3>
                                <p class="text-sm text-gray-600">Mrs. Sarah Johnson</p>
                            </div>
                            <span class="text-sm text-gray-500">08:00 - 09:30</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            Room: 301
                        </div>
                    </div>

                    <div class="p-3 bg-green-50 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-800">Physics</h3>
                                <p class="text-sm text-gray-600">Mr. Robert Smith</p>
                            </div>
                            <span class="text-sm text-gray-500">10:00 - 11:30</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            Room: Lab 2
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tuesday Classes -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-calendar-day mr-2 text-green-500"></i>
                    Tuesday
                </h2>
                <div class="space-y-4">
                    <div class="p-3 bg-purple-50 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-800">Literature</h3>
                                <p class="text-sm text-gray-600">Ms. Emily Brown</p>
                            </div>
                            <span class="text-sm text-gray-500">09:00 - 10:30</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            Room: 205
                        </div>
                    </div>

                    <div class="p-3 bg-yellow-50 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-800">Chemistry</h3>
                                <p class="text-sm text-gray-600">Dr. Michael Lee</p>
                            </div>
                            <span class="text-sm text-gray-500">11:00 - 12:30</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            Room: Lab 1
                        </div>
                    </div>
                </div>
            </div>

            <!-- More days... -->
        </div>
    </main>
@endsection