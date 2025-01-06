@extends('home')

@section('content')
    <main class="flex-1 ml-64 p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Teachers List</h1>
            <button onclick="document.getElementById('addTeacherModal').classList.remove('hidden')" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-plus"></i> Add New Teacher
            </button>
        </div>

        <!-- Teachers Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($teachers as $teacher)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{$teacher->id}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$teacher->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$teacher->gender}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$teacher->email}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$teacher->subject->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <button onclick="openEditModal('{{ $teacher }}')"
                                            class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('teacher.delete', ['id' => $teacher->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
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

        <!-- Edit Teacher Modal -->
        <div id="editTeacherModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
            <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white mb-10">
                <div class="absolute top-3 right-3">
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="mt-3">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 px-1">Edit Teacher Information</h3>
                    
                    <form class="mt-2" method="POST" action="{{ route('teacher.update', ['id' => $teacher->id]) }}" id="teacherEditForm">
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
                                <label class="block text-sm font-medium text-gray-700">Main Subject</label>
                                <select id="editSubject" name="subject_id"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Teacher's NIK</label>
                                <input required type="text" id="editNIK" name="id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Additional Information Section -->
                            <div class="col-span-2">
                                <h4 class="text-md font-medium text-gray-700 mb-3 border-b pb-2 mt-4">Additional Information</h4>
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

        <!-- Add Teacher Modal -->
        <div id="addTeacherModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white mb-10">
                <div class="absolute top-3 right-3">
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="mt-3">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 px-1">Edit Teacher Information</h3>
                    
                    <form class="mt-2" method="POST" action="{{ route('teacher.add') }}">
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

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Main Subject</label>
                                <select id="editSubject" name="subject_id"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                    <option>Mathematics</option>
                                    <option>Languages</option>
                                    <option>Social Studies</option>
                                </select>
                            </div>

                            <div class="col-span-2">
                                <h4 class="text-md font-medium text-gray-700 mb-3 border-b pb-2 mt-4">Additional Information</h4>
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
        function openEditModal(teacherData) {
            teacherData = JSON.parse(teacherData)
            // Populate the form fields
            console.log(teacherData, '<<')
            document.getElementById('editName').value = teacherData.name;
            document.getElementById('editEmail').value = teacherData.email;
            document.getElementById('editPhone').value = teacherData.phone_number;
            document.getElementById('editDob').value = teacherData.dob;
            document.getElementById('editSubject').value = teacherData.subject_id;
            document.getElementById('editNIK').value = teacherData.id;
            document.getElementById('editAddress').value = teacherData.address;
            
            const form = document.getElementById('teacherEditForm');
            form.action = `/admin/teacher/${teacherData.id}`;
        
            document.getElementById('editTeacherModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editTeacherModal').classList.add('hidden');
        }

        function saveEdit() {
            closeEditModal();
        }
    </script>
@endsection