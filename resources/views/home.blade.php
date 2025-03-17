<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 min-h-screen p-4 fixed">
            <div class="mb-8">
                <div class="flex items-center gap-3 p-2 bg-gray-700 rounded-lg mb-4">
                    <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
                        @if($user->role == 'student')
                        <i class="fas fa-user-graduate text-lg"></i>
                        @elseif($user->role == 'teacher')
                        <i class="fas fa-chalkboard-teacher text-lg"></i>
                        @else
                        <i class="fas fa-user text-lg"></i>
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-300">Welcome,</span>
                        <span class="font-semibold">{{$user->name}}</span>
                    </div>
                </div>
                <div class="h-px bg-gray-700 my-4"></div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex-1">
                <ul class="space-y-2">
                    @if($user->role == 'admin')
                    <li>
                        <a href="/admin/teacher" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Teacher's List</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/teacher/overall" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-chart-line"></i>
                            <span>Teacher's Overall Score</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/student" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Student's List</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/question" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-question-circle"></i>
                            <span>Survey Questions</span>
                        </a>
                    </li>
                    @elseif($user->role == 'teacher')
                    <li>
                        <a href="/teacher/survey" class="flex items-center space-x-2 p-2 bg-gray-700 rounded-lg">
                            <i class="fas fa-chart-bar"></i>
                            <span>Evaluation Results</span>
                        </a>
                    </li>
                    @elseif($user->role == 'student')
                    <li>
                        <a href="/student/myclass" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>My Class</span>
                        </a>
                    </li>
                    <li>
                        <a href="/student/survey" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-question-circle"></i>
                            <span>Fill out survey here!</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>

            <!-- Logout Button -->
            <div class="mt-auto pt-4 border-t border-gray-700">
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="flex items-center space-x-2 text-red-400 hover:text-red-300 hover:bg-gray-700 w-full p-2 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
         @hasSection('content') 
            @yield('content')
        @else
            <main class="flex-1 ml-64 p-8">
                <h1 class="text-3xl font-bold mb-6">Welcome to Dashboard</h1>
                <p class="text-gray-600">Please select a menu item from the sidebar to get started.</p>
            </main>
        @endif
    </div>

    @if ($errors->any())
        <div id="failedToast" 
            class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
            <div class="flex-1">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button id="closeToast" class="ml-4 text-white focus:outline-none">
                &times; <!-- This is the close icon -->
            </button>
        </div>
    @endif

    <script>
        function handleLogout() {
            if(confirm('Are you sure you want to logout?')) {
                // Here you would handle the logout logic
                window.location.href = 'login.html';
            }
        }
        // document.getElementById('closeToast').addEventListener('click', function() {
        //     const toast = document.getElementById('failedToast');
        //     toast.style.display = 'none'; // Hide the toast
        // });
    </script>
</body>
</html>