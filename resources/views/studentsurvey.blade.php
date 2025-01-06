@extends('home')

@section('content')
    <style>
        /* Custom radio button styling */
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

        /* Highlight effect for answer row */
        .answer-row:hover {
            background-color: #f8fafc;
        }
    </style>
    
    <main class="flex-1 ml-64 p-8">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Teacher Evaluation Survey</h1>

            <form action="{{ route('survey.submit') }}" method="POST" class="space-y-6">
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
                    @foreach($groupedQuestions as $type => $questions)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-6 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-xl font-medium text-gray-900">{{$type}} Questions</h3>
                            </div>
                            
                            <div class="divide-y divide-gray-200">
                                <!-- Question Row -->
                                 @foreach($questions as $question)
                                    <div class="answer-row p-6 transition-colors duration-150">
                                        <div class="flex items-center gap-8">
                                            <div class="flex-1">
                                                <p class="text-gray-900 text-lg">{{$question->question}}</p>
                                            </div>
                                            <div class="grid grid-cols-5 gap-8">
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="{{$question->id}}" value="1" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-red-500">Very Bad</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="{{$question->id}}" value="2" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-orange-500">Bad</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="{{$question->id}}" value="3" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-yellow-500">Normal</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="{{$question->id}}" value="4" class="custom-radio">
                                                    <span class="text-sm font-medium text-gray-500 group-hover:text-green-500">Good</span>
                                                </label>
                                                <label class="flex flex-col items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="{{$question->id}}" value="5" class="custom-radio">
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
        document.getElementById('surveyForm').addEventListener('submit', function(event) {
            let allAnswered = true;

            // Check each question
            @foreach ($questions as $question)
                if (!document.querySelector('select[name="{{ $question->id }}"]').value) {
                    allAnswered = false;
                    break;
                }
            @endforeach

            if (!allAnswered) {
                event.preventDefault(); // Prevent form submission
                alert('Please answer all questions before submitting.');
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

        function handleSurveySubmit(event) {
            event.preventDefault();
            console.log(event, '<< ini event')
            // Show success message
            const toast = document.getElementById('successToast');
            toast.classList.remove('hidden');
            
            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('hidden');
                // Optionally redirect or reset form
                document.getElementById('teacherSelect').value = '';
            }, 3000);
        }

        function handleSurveySubmit(event) {
            event.preventDefault(); // Prevent the default form submission

            // Create an object to hold the answers
            const answers = {};

            // Get all the radio inputs
            const radioInputs = document.querySelectorAll('input[type="radio"]:checked');

            // Loop through the checked radio inputs and collect their values
            radioInputs.forEach(input => {
                answers[input.name] = input.value; // input.name is the question ID, input.value is the selected answer
            });

            // Get the selected teacher ID
            const teacherId = document.getElementById('teacherSelect').value;

            // Add the teacher ID to the answers object
            answers.teacher_id = teacherId;
            console.log(answers, '<< ini answers yeahanjg')
            // Send the data to the server using fetch
            // fetch('/submit-survey', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token
            //     },
            //     body: JSON.stringify(answers) // Convert the answers object to JSON
            // })
            // .then(response => {
            //     if (response.ok) {
            //         return response.json(); // Parse the JSON response
            //     }
            //     throw new Error('Network response was not ok.');
            // })
            // .then(data => {
            //     // Handle success (e.g., show a success message)
            //     console.log('Survey submitted successfully:', data);
            // })
            // .catch(error => {
            //     // Handle error
            //     console.error('There was a problem with the fetch operation:', error);
            // });
        }
    </script>
@endsection