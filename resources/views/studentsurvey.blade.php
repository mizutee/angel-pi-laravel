@extends('home')

@section('content')
    <style>
        .custom-radio {
            appearance: none;
            width: 1.5rem;
            height: 1.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .custom-radio:checked {
            border-color: #3b82f6;
            background-color: #3b82f6;
        }

        .custom-radio:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: white;
        }

        .custom-radio:hover:not(:checked) {
            border-color: #93c5fd;
        }

        .answer-row:hover {
            background-color: #f8fafc;
        }
    </style>
    
    <main class="flex-1 ml-64 p-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Teacher Evaluation Survey</h1>

            <form id="surveyForm" action="{{ route('survey.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white rounded-lg shadow-md p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Teacher</label>
                    <select id="teacherSelect" name="teacher_id"
                            onchange="loadTeacherQuestions()"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-lg p-3">
                        <option value="">Choose a teacher...</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">
                                @if($teacher->gender === 'Female')
                                    Mrs. {{ $teacher->name }} - {{ $teacher->subject->name }}
                                @else
                                    Mr. {{ $teacher->name }} - {{ $teacher->subject->name }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Survey Questions -->
                <div id="questionsList" class="space-y-6">
                    <!-- Teaching Methods Section -->
                    @foreach($groupedQuestions as $type => $questions)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-6 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-xl font-medium text-gray-900">{{$type}} Questions</h3>
                            </div>
                        
                            <div class="divide-y divide-gray-200">
                                <!-- Question Row -->
                                @foreach($questions as $question)
                                    <div class="p-6">
                                        <p class="text-lg font-medium text-gray-900 mb-4">{{ $question->question }}</p>
                                        
                                        <!-- Experience Rating -->
                                        <div class="bg-blue-50 p-4 rounded-lg mb-4">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm font-medium text-blue-800">Your Experience</span>
                                                <i class="fas fa-star text-blue-500"></i>
                                            </div>
                                            <div class="grid grid-cols-5 gap-8">
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="experience_{{ $question->id }}" value="1" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-red-500">Very Bad</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="experience_{{ $question->id }}" value="2" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-orange-500">Bad</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="experience_{{ $question->id }}" value="3" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-yellow-500">Normal</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="experience_{{ $question->id }}" value="4" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-green-500">Good</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="experience_{{ $question->id }}" value="5" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-green-600">Very Good</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Expectation Rating -->
                                        <div class="bg-purple-50 p-4 rounded-lg">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm font-medium text-purple-800">Your Expectation</span>
                                                <i class="fas fa-bullseye text-purple-500"></i>
                                            </div>
                                            <div class="grid grid-cols-5 gap-8">
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="expectation_{{ $question->id }}" value="1" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-red-500">Very Bad</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="expectation_{{ $question->id }}" value="2" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-orange-500">Bad</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="expectation_{{ $question->id }}" value="3" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-yellow-500">Normal</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="expectation_{{ $question->id }}" value="4" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-green-500">Good</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="expectation_{{ $question->id }}" value="5" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-green-600">Very Good</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-blue-500 text-white px-8 py-3 rounded-lg text-lg font-medium hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                            Submit Survey
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

        <!-- Success Toast -->
    <div id="successToast" 
         class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hidden">
        Survey submitted successfully!
    </div>

    <script>
        console.log("Survey validation script loaded.");
        document.getElementById('surveyForm').addEventListener('submit', function(event) {
            let allAnswered = true;

            @foreach ($questions as $question)
                if (!document.querySelector('input[name="experience_{{ $question->id }}"]:checked') || !document.querySelector('input[name="expectation_{{ $question->id }}"]:checked')) {
                    allAnswered = false;
                }
            @endforeach

            if (!allAnswered) {
                alert('Please answer all questions before submitting.');
                event.preventDefault(); // Prevent form submission
            }
        });

    
        function handleLogout() {
            if(confirm('Are you sure you want to logout?')) {
                window.location.href = 'login.html';
            }
        }
    
        function loadTeacherQuestions() {
            // This would typically load questions from backend
            console.log('Loading questions for selected teacher...');
        }
    </script>

@endsection


