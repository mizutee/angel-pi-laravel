@extends('home')

@section('content')
    <main class="flex-1 ml-64 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Survey Questions</h1>
                <button onclick="document.getElementById('addQuestionModal').classList.remove('hidden')" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="fas fa-plus"></i> Add New Question
                </button>
            </div>

            <!-- Questions Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($questions as $question)
                        <tr>
                            <td class="px-6 py-4">{{$loop->iteration}}</td>
                            <td class="px-6 py-4">
                                <div class="line-clamp-2">{{$question->question}}</div>
                            </td>
                            <td class="px-6 py-4">{{$question->type->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <button onclick="openEditModal({{$question}})" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('question.delete', ['id' => $question->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                        @csrf
                                        @method("DELETE")
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Add Question Modal -->
            <div id="addQuestionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white mb-10">
                    <div class="absolute top-3 right-3">
                        <button onclick="document.getElementById('addQuestionModal').classList.add('hidden')" 
                                class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <div class="mt-3">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Add New Survey Question</h3>
                        <form class="mt-2" method="POST" action="{{ route('question.add') }}">
                            @csrf
                            @method("POST")
                            <div class="grid grid-cols-1 gap-4">
                                <!-- Question Content -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Question Text</label>
                                    <textarea rows="3" name="question"
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                              placeholder="Enter your question here..."></textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Category</label>
                                        <select name="type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @foreach($types as $type) 
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Answer Scale Preview -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Answer Scale Preview</label>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="grid grid-cols-5 gap-4 text-center text-sm">
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-red-100 rounded-lg">Very Bad</div>
                                                <div class="text-gray-600">1</div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-red-50 rounded-lg">Bad</div>
                                                <div class="text-gray-600">2</div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-gray-100 rounded-lg">Normal</div>
                                                <div class="text-gray-600">3</div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-green-50 rounded-lg">Good</div>
                                                <div class="text-gray-600">4</div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-green-100 rounded-lg">Very Good</div>
                                                <div class="text-gray-600">5</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Notes -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Additional Notes (Optional)</label>
                                    <textarea rows="2" 
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                              placeholder="Any additional context or notes about this question..."></textarea>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end gap-2 pt-4 mt-4 border-t">
                                <button type="button" 
                                        onclick="document.getElementById('addQuestionModal').classList.add('hidden')"
                                        class="bg-white text-gray-700 px-4 py-2 rounded-md border hover:bg-gray-50">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Add Question
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="editQuestionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white mb-10">
                    <div class="absolute top-3 right-3">
                        <button onclick="closeEditModal()" 
                                class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
            
                    <div class="mt-3">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Edit Survey Question</h3>
                        <form id="editQuestionForm" method="POST" action="{{ route('question.update', ['id' => $question->id]) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editQuestionId">
                            <div class="grid grid-cols-1 gap-4">
                                <!-- Question Content -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Question Text</label>
                                    <textarea id="question" name="question"
                                            rows="3" 
                                            required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Enter your question here..."></textarea>
                                </div>
            
                                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                    <div class="">
                                        <label class="block text-sm font-medium text-gray-700">Category</label>
                                        <select id="type" name="type_id"
                                                required
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
            
                                <!-- Answer Scale Preview -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Answer Scale Preview</label>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="grid grid-cols-5 gap-4 text-center text-sm">
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-red-100 rounded-lg">Very Bad</div>
                                                <div class="text-gray-600">1</div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-red-50 rounded-lg">Bad</div>
                                                <div class="text-gray-600">2</div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-gray-100 rounded-lg">Normal</div>
                                                <div class="text-gray-600">3</div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-green-50 rounded-lg">Good</div>
                                                <div class="text-gray-600">4</div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="w-full p-2 bg-green-100 rounded-lg">Very Good</div>
                                                <div class="text-gray-600">5</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Action Buttons -->
                            <div class="flex justify-end gap-2 pt-4 mt-4 border-t">
                                <button type="button" 
                                        onclick="closeEditModal()"
                                        class="bg-white text-gray-700 px-4 py-2 rounded-md border hover:bg-gray-50">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>


<!-- Success Message Toast -->
<div id="successToast" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hidden">
    Changes saved successfully!
</div>

<script>
    function openEditModal(questionData) {
        // Populate the form with existing data
        document.getElementById('editQuestionId').value = questionData.id;
        document.getElementById('question').value = questionData.question;
        document.getElementById('type').value = questionData.type.id;

        const form = document.getElementById('editQuestionForm');
        form.action = `/admin/question/${questionData.id}`;

        document.getElementById('editQuestionModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editQuestionModal').classList.add('hidden');
        // Reset form
        document.getElementById('editQuestionForm').reset();
    }

    function handleEditSubmit(event) {
        event.preventDefault();
        
        // Get form data
        const formData = {
            id: document.getElementById('editQuestionId').value,
            question: document.getElementById('editQuestionText').value,
            category: document.getElementById('editCategory').value,
            notes: document.getElementById('editNotes').value
        };

        // Here you would typically send this data to your backend
        console.log('Updating question:', formData);

        // Show success message
        const toast = document.getElementById('successToast');
        toast.classList.remove('hidden');
        
        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);

        // Close modal
        closeEditModal();
    }

    function deleteQuestion(id) {
        if (confirm('Are you sure you want to delete this question?')) {
            // Here you would typically send delete request to your backend
            console.log('Deleting question:', id);
        }
    }
</script>
@endsection