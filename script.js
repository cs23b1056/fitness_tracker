// Sample workout data
const recentWorkouts1 = [
    {
        name: "Push Day",
        date: "2024-03-15",
        exercises: 6,
        
    },
    {
        name: "Pull Day",
        date: "2024-03-13",
        exercises: 5,
        
    },
    {
        name: "Leg Day",
        date: "2024-03-11",
        exercises: 7,
        
    }
];

// Populate recent workouts
function populateRecentWorkouts() {
    const workoutList = document.querySelector('.workout-list');
    var recentWorkouts2=[];
    var xml1 = new XMLHttpRequest();
    xml1.onreadystatechange = function () {
        if (xml1.readyState === 4 && xml1.status === 200) {
            recentWorkouts2=xml1.responseText;
          //alert("Response: " + xml1.responseText);
        }
      };
    xml1.open("GET", "wkt_manage_get.php", false);
    xml1.setRequestHeader("Content-Type", "application/json");

    xml1.send();
    //alert("rest api response:" + recentWorkouts2);
    let recentWorkouts=JSON.parse(recentWorkouts2);
    workoutList.innerHTML = recentWorkouts.map(workout => `
        <div class="workout-item">
            <h3>${workout.wkt_name}</h3>
            <p>started at: ${workout.wkt_stime}</p>
            <p>duration: ${workout.wkt_desc}</p>
            <p>category: ${workout.wkt_catg}</p>
            <p>weight(in kg): ${workout.wkt_weight}</p>
            <p>sets: ${workout.wkt_sets}</p>
            <p>reps: ${workout.wkt_reps}</p>
        </div>
    `).join('');
}

/*function populateRecentExercises() {
    const exerciseList = document.querySelector('.exercise-list');
    var recentExercises=[];
    var xml2 = new XMLHttpRequest();
    xml2.onreadystatechange = function () {
        if (xml2.readyState === 4 && xml2.status === 200) {
            recentExercises=xml2.responseText;
          //alert("Response: " + xml1.responseText);
        }
      };
    xml2.open("GET", "ex_manage_get.php", false);
    xml2.setRequestHeader("Content-Type", "application/json");

    xml2.send();
    //alert("rest api response:" + recentWorkouts2);
    let recentExercises2=JSON.parse(recentExercises);
    exerciseList.innerHTML = recentExercises2.map(exercise => `
        <div class="exercise-item">
            <p>${exercise.ex_name} ${exercise.ex_catg} ${exercise.ex_equ}</p>
        </div>
    `).join('');
}*/

// Modal functions
function showAddWorkoutModal() {
    document.getElementById('addWorkoutModal').style.display = 'block';
    
}

/*function showAddExerciseModal() {
    document.getElementById('addExerciseModal').style.display = 'block';
}*/
function addalert(){
    let wn=document.getElementById('wkt_name').value;
    let wd=document.getElementById('wkt_desc').value;
    let wc=document.getElementById('wkt_catg').value;
    let ww=document.getElementById('wkt_weight').value;
    let ws=document.getElementById('wkt_sets').value;
    let wr=document.getElementById('wkt_reps').value;
    if(wn==""||wd==""){
        alert("please provide workout name and description");
        return;
    }
    //alert("workoutname.....: " + first + "workoutdesc: " + last);
    var xml1 = new XMLHttpRequest();
    xml1.onreadystatechange = function () {
        if (xml1.readyState === 4 && xml1.status === 200) {
          alert("Response: " + xml1.responseText);
        }
      };
    xml1.open("POST", "wkt_manage_post.php", false);
    xml1.setRequestHeader("Content-Type", "application/json");

    var data = JSON.stringify({
        workout_name: wn,
        workout_desc: wd,
        workout_catg: wc,
        workout_weight: ww,
        workout_sets: ws,
        workout_reps: wr
    });
    xml1.send(data);
    populateRecentWorkouts();
    //alert("ajaxdone");
}

/*function addalert2(){
    let en=document.getElementById('ex_name').value;
    let ec=document.getElementById('ex_catg').value;
    let eqn=document.getElementById('ex_equ').value;
    if(en==""||ec==""){
        alert("please provide workout name and description");
        return;
    }
    //alert("workoutname.....: " + first + "workoutdesc: " + last);
    var xml2 = new XMLHttpRequest();
    xml2.onreadystatechange = function () {
        if (xml2.readyState === 4 && xml2.status === 200) {
          alert("Response: " + xml2.responseText);
        }
      };
    xml2.open("POST", "ex_manage_post.php", false);
    xml2.setRequestHeader("Content-Type", "application/json");

    var data = JSON.stringify({
        ex_name: en,
        ex_cat: ec,
        ex_eq:eqn
    });
    xml2.send(data);
    populateRecentExercises();
    //alert("ajaxdone");
}*/

// Close modals when clicking the close button
document.querySelectorAll('.close').forEach(button => {
    button.onclick = function() {
        this.closest('.modal').style.display = 'none';
    }
});

// Close modals when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}

// Form submissions
document.getElementById('workoutForm').onsubmit = function(e) {
    e.preventDefault();
    // Here you would typically send the data to your backend
    //alert('Workout created successfully!');
    this.closest('.modal').style.display = 'none';
};

/*document.getElementById('exerciseForm').onsubmit = function(e) {
    e.preventDefault();
    // Here you would typically send the data to your backend
    alert('Exercise added successfully!');
    this.closest('.modal').style.display = 'none';
};*/

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    populateRecentWorkouts();
});