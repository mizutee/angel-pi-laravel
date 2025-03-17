@extends('home')

@section('content')
    <main class="flex-1 ml-64 p-8">
        <div class="container mx-auto p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Overall Teacher Performance</h2>

            <!-- PDF Download Button -->
            <div class="flex justify-end mb-4">
                {{-- <a href="/admin/teacher/overall/download" 
                   class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Download as PDF
                </a> --}}
                <form action="{{ route('teacher.overall.download') }}" method="GET">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Download as PDF
                    </button>
                </form>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 shadow-lg rounded-lg">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Teacher</th>
                            <th class="px-4 py-3 text-left">Subject</th>
                            <th class="px-4 py-3 text-center">Experience Avg</th>
                            <th class="px-4 py-3 text-center">Expectation Avg</th>
                            <th class="px-4 py-3 text-center">Final Score</th>
                            <th class="px-4 py-3 text-center">Grade</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($teachers as $teacher)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-3">{{ $teacher->name }}</td>
                            <td class="px-4 py-3">{{ $teacher->subject }}</td>
                            <td class="px-4 py-3 text-center">{{ $teacher->exp_avg }}</td>
                            <td class="px-4 py-3 text-center">{{ $teacher->expc_avg }}</td>
                            <td class="px-4 py-3 text-center">{{ $teacher->final_score }}</td>
                            <td class="px-4 py-3 text-center font-bold">{{ $teacher->grade }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        
            <!-- Signature Section -->
            <div class="mt-8 flex justify-between">
                <div class="text-center">
                    <p class="font-bold">Inspector</p>
                    <div class="h-16"></div> <!-- Space for signature -->
                    <p class="border-t border-black inline-block px-8">Signature</p>
                </div>
                <div class="text-center">
                    <p class="font-bold">School's Boss</p>
                    <div class="h-16"></div> <!-- Space for signature -->
                    <p class="border-t border-black inline-block px-8">Signature</p>
                </div>
            </div>
        </div>
    </main>
@endsection
