
fetch('fetch_subjects.php')
    .then(response => response.json())
    .then(subjects => {
        const subjectBtnsContainer = document.getElementById('subject-buttons-container');
        
        subjects.forEach(subject => {
            const subjectButton = document.createElement('button');
            subjectButton.textContent = subject.name; // Display subject name
            subjectButton.onclick = () => startQuiz(subject.id); // Call startQuiz when clicked
            subjectBtnsContainer.appendChild(subjectButton);
        });
    })
    .catch(error => {
        console.error('Error fetching subjects:', error);
    });

let questions = [];
let currentQuestion = 0;
let score = 0;

function startQuiz(subjectId) {
    // Hide subject buttons and show quiz questions
    document.getElementById('subject-buttons-container').style.display = 'none';
    document.getElementById('questions-container').style.display = 'block';

    fetch(`fetch_questions.php?subject_id=${subjectId}`)
        .then(response => response.json())
        .then(data => {
            questions = data;
            showQuestion();
        })
        .catch(error => {
            console.error('Error fetching questions:', error);
        });
}

function showQuestion() {
    if (currentQuestion >= questions.length) {
        submitQuiz();
        return;
    }

    const question = questions[currentQuestion];
    const questionContainer = document.getElementById('questions-container');
    questionContainer.innerHTML = `
        <div class="question">
            <p>${question.question_text}</p>
            <div class="options">
                <button onclick="selectOption('${question.option_a}')">${question.option_a}</button>
                <button onclick="selectOption('${question.option_b}')">${question.option_b}</button>
                <button onclick="selectOption('${question.option_c}')">${question.option_c}</button>
                <button onclick="selectOption('${question.option_d}')">${question.option_d}</button>
            </div>
            <button onclick="nextQuestion()">Next</button>
        </div>
    `;
}

let selectedAnswer = '';
function selectOption(answer) {
    selectedAnswer = answer;
}

function nextQuestion() {
    if (selectedAnswer === questions[currentQuestion].correct_option) {
        score++;
    }
    currentQuestion++;
    showQuestion();
}function startQuiz(quizId) {
  console.log("Starting quiz for quiz_id: " + quizId); // Debugging line
  selectedSubject = quizId; // Use quiz_id here
  document.getElementById('category-page').style.display = 'none';
  document.getElementById('quiz-page').style.display = 'block';
  document.getElementById('subject-title').innerText = "Quiz for Quiz ID: " + quizId;

  fetch('fetch_questions.php?quiz_id=' + quizId)
      .then(response => response.json())
      .then(data => {
          console.log("Questions fetched:", data); // Debugging line
          questions = data;
          showQuestion();
      })
      .catch(error => {
          console.error('Error fetching questions:', error);
      });
}


function submitQuiz() {
    document.getElementById('questions-container').innerHTML = `
        <div class="question">
            <h2>Quiz Completed!</h2>
            <p>Your Score: ${score} out of ${questions.length}</p>
        </div>
    `;
}
