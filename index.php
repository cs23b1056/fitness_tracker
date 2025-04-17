<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracker</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo">
                <h1>Fitness Tracker</h1>
            </div>
            <ul class="nav-links">
                <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="#"><i class="fas fa-dumbbell"></i> Workouts</a></li>
                <li><a href="#"><i class="fas fa-chart-line"></i> Progress</a></li>
                <li><a href="#"><i class="fas fa-trophy"></i> PRs</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="search-bar">
                    <input type="text" placeholder="Search workouts or exercises...">
                </div>
                <div class="user-profile">
                    <img src="https://via.placeholder.com/40" alt="Profile" class="profile-pic">
                    <span class="username">John Doe</span>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard">
                <div class="stats-cards">
                    <div class="card">
                        <h3>Today's Workout</h3>
                        <select name="tod_wkt" id="1">
                            <option value="push">Push Day</option>
                            <option value="pull">Pull Day</option>
                            <option value="leg">Leg Day</option>
                        </select>
                        <button class="start-workout">Start Workout</button>
                    </div>
                    <div class="card">
                        <h3>Last Workout</h3>
                        <p>Pull Day - 2 days ago</p>
                        <p>6 exercises, 24 sets</p>
                    </div>
                    <div class="card">
                        <h3>Weekly Progress</h3>
                        <p>3 workouts completed</p>
                        <p>+2.5kg on Bench Press</p>
                    </div>
                </div>

                <!-- Recent Workouts -->
                <div class="recent-workouts">
                    <h2>Recent Workouts</h2>
                    <div class="workout-list">
                        <!-- Workout items will be populated by JavaScript -->
                    </div>
                </div>

                <!-- Quick Add -->
                <div class="quick-add">
                    <h2>Quick Add</h2>
                    <div class="add-options">
                        <button class="add-btn" onclick="showAddWorkoutModal()">
                            <i class="fas fa-plus"></i> New Workout
                        </button>
                        
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modals -->
    <div id="addWorkoutModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Workout</h2>
            <form id="workoutForm">
                <input id="wkt_name" type="text" placeholder="Workout Name" required>
                <textarea id="wkt_desc"placeholder="Workout Description"></textarea>
                <select id="wkt_catg" required>
                    <option value="">Select Category</option>
                    <option value="Chest">Chest</option>
                    <option value="Back">Back</option>
                    <option value="Legs">Legs</option>
                    <option value="Shoulders">Shoulders</option>
                    <option value="Arms">Arms</option>
                </select>
                <input id="wkt_weight" type="number" placeholder="Weight lifted" step="0.1" required>
                <input id="wkt_sets" type="number" placeholder="Sets" required>
                <input id="wkt_reps" type="number" placeholder="Reps" required>
                <button class="abc" onclick="addalert()">Create Workout</button>
            </form>
        </div>
    </div>

    

    <script src="script.js"></script>
</body>
</html>