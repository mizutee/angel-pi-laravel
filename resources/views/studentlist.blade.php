@extends('home')

@section('content')
    <main class="flex-1 ml-64 p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Students List</h1>
            <button onclick="document.getElementById('addStudentModal').classList.remove('hidden')" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-plus"></i> Add New Student
            </button>
        </div>

        <!-- Students Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($students->isEmpty())
                        <p>No students found.</p>
                    @else
                        @foreach($students as $student)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{$student->id}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$student->name}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$student->gender}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$student->email}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <button onclick="openEditModal('{{ $student }}')"
                                                class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('student.delete', ['id' => $student->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
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
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Edit Student Modal -->
        <div id="editStudentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
            <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white mb-10">
                <div class="absolute top-3 right-3">
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="mt-3">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 px-1">Edit Student Information</h3>
                    
                    <form class="mt-2" method="POST" action="{{ route('student.update', ['id' => $student->id]) }}" id="studentEditForm">
                        @csrf
                        @method('PUT')
                        <!-- Grid layout for form fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Personal Information Section -->
                            <div class="col-span-2">
                                <h4 class="text-md font-medium text-gray-700 mb-3 border-b pb-2">Personal Information</h4>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" id="editName" name="name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input required type="email" id="editEmail" name="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input required type="tel" id="editPhone" name="phone_number"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                <input required type="date" id="editDob" name="dob"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Professional Information Section -->
                            <div class="col-span-2">
                                <h4 class="text-md font-medium text-gray-700 mb-3 border-b pb-2 mt-4">Professional Information</h4>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Student's NIK</label>
                                <input required type="text" id="editNIK" name="id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Address</label>
                                <input id="editAddress" name="address"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></input>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-2 pt-4 mt-4 border-t">
                            <button type="button" onclick="closeEditModal()" 
                                    class="bg-white text-gray-700 px-4 py-2 rounded-md border hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Student Modal -->
        <div id="addStudentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white mb-10">
                <div class="absolute top-3 right-3">
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="mt-3">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 px-1">Edit Student Information</h3>
                    
                    <form class="mt-2" method="POST" action="{{ route('student.add') }}">
                        @csrf
                        @method('POST')
                        <!-- Grid layout for form fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Personal Information Section -->
                            <div class="col-span-2">
                                <h4 class="text-md font-medium text-gray-700 mb-3 border-b pb-2">Personal Information</h4>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" id="editName" name="name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input required type="email" id="editEmail" name="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input required type="tel" id="editPhone" name="phone_number"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                <input required type="date" id="editDob" name="dob"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Gender</label>
                                <select id="editSubject" name="gender"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                </select>
                            </div>

                            <!-- Professional Information Section -->
                            <div class="col-span-2">
                                <h4 class="text-md font-medium text-gray-700 mb-3 border-b pb-2 mt-4">Professional Information</h4>
                            </div>
                            
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Address</label>
                                <input id="editAddress" name="address"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></input>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-2 pt-4 mt-4 border-t">
                            <button type="button" onclick="closeEditModal()" 
                                    class="bg-white text-gray-700 px-4 py-2 rounded-md border hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function openEditModal(studentData) {
            studentData = JSON.parse(studentData)
            // Populate the form fields
            console.log(studentData, '<<')
            document.getElementById('editName').value = studentData.name;
            document.getElementById('editEmail').value = studentData.email;
            document.getElementById('editPhone').value = studentData.phone_number;
            document.getElementById('editDob').value = studentData.dob;
            document.getElementById('editNIK').value = studentData.id;
            document.getElementById('editAddress').value = studentData.address;
            
            const form = document.getElementById('studentEditForm');
            form.action = `/admin/student/${studentData.id}`;
        
            document.getElementById('editStudentModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editStudentModal').classList.add('hidden');
            document.getElementById('addStudentModal').classList.add('hidden');
        }

        function saveEdit() {
            closeEditModal();
        }
    </script>
@endsection