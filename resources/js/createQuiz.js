
function collectQuizData() {
    const quizTitle = document.querySelector('input[name="quiz_title"]').value;
    const questions = document.querySelectorAll('.question_options');
    let quizData = {
        title: quizTitle,
        questions: []
    };

    questions.forEach((questionDiv, index) => {
        let questionText = questionDiv.querySelector('.question_input').value;
        let answers = Array.from(questionDiv.querySelectorAll('.answer_text')).map(input => input.value);
        let correctAnswer = Array.from(questionDiv.querySelectorAll('.answer_input')).findIndex(input => input.checked);
        
        quizData.questions.push({
            question: questionText,
            options: answers,
            correctAnswer: correctAnswer
        });
    });

    return quizData;
}

async function submitQuiz(event) {
    event.preventDefault(); // Prevent default form submission

    let quizData = collectQuizData(); // Collect the quiz data as JSON
    console.log(quizData); // You can check the data in the browser console

    try {
        const response = await fetch('/quiz/create/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',  // Set headers to send JSON
                'Accept': 'application/json'
            },
            body: JSON.stringify(quizData)  // Send the quiz data in JSON format
        });

        if (response.ok) {
            alert('Quiz submitted successfully');
        } else {
            const errorData = await response.json(); // Extract error message
            console.error('Failed to submit quiz:', errorData);
            alert('Failed to submit quiz: ' + errorData.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while submitting the quiz');
    }
}