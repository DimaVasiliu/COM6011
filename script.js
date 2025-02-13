    const usernameInput = document.getElementById("username");
    const startScreen = document.getElementById("start-screen");
    const gameContainer = document.getElementById("game-container");
    const answerInput = document.getElementById("answer-input");
    const submitButton = document.getElementById("submit-button");
    const scrambledWordElement = document.getElementById("scrambled-word");
    const progressBar = document.getElementById("progress-bar");
    const timerElement = document.getElementById("timer");
    const gameOverPopup = document.getElementById("game-over-popup");
    const finalScoreElement = document.getElementById("final-score");

    let timeLeft = 15;
    let score = 0;
    let words = [];
    let currentWordIndex = 0;
    let gameTimer;

    async function fetchWords() {
        try {
            const response = await fetch("fetch_words.php");
            words = await response.json();
            if (words.length > 0) {
                displayNextWord();
            } else {
                scrambledWordElement.textContent = "No words available!";
            }
        } catch (error) {
            console.error("Error fetching words:", error);
        }
    }

    window.startGame = function () {
        const username = usernameInput.value.trim();
        if (username === "") {
            alert("⚠️ Please enter your name to start the game.");
            return;
        }

        startScreen.style.display = "none";
        gameContainer.style.display = "block";
        fetchWords();
        startTimer();
    };

    function displayNextWord() {
        if (currentWordIndex < words.length) {
            scrambledWordElement.textContent = words[currentWordIndex].scrambled_word;
        } else {
            endGame();
        }
    }

    function submitAnswer() {
        const userAnswer = answerInput.value.trim().toLowerCase();
        const correctAnswer = words[currentWordIndex]?.word.toLowerCase();
        if (userAnswer === correctAnswer) {
            score++;
        }
        currentWordIndex++;
        answerInput.value = "";
        displayNextWord();
    }

    function startTimer() {
        gameTimer = setInterval(() => {
            timeLeft--;
            timerElement.textContent = `⏳ ${timeLeft}s`;
            progressBar.style.width = `${(timeLeft / 15) * 100}%`;

            if (timeLeft <= 0) {
                endGame();
            }
        }, 1000);
    }

    function endGame() {
        clearInterval(gameTimer);
        gameContainer.style.display = "none";
        gameOverPopup.style.display = "block";
        finalScoreElement.textContent = `You scored ${score} points!`;
        saveScore(usernameInput.value, score);
    }

    function saveScore(username, score) {
        fetch("check.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `username=${encodeURIComponent(username)}&score=${score}`
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        console.log("✅ JavaScript Loaded!");  

    answerInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            submitAnswer();
        }
    });

    submitButton.addEventListener("click", submitAnswer);
});

document.addEventListener("DOMContentLoaded", () => {
    console.log("✅ JavaScript Loaded!");

    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", () => {
            let username = button.dataset.username;
            if (confirm(`Delete ${username}?`)) {
                fetch("delete.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `username=${encodeURIComponent(username)}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === "success") {
                        document.getElementById(`user-${username}`).remove();
                        console.log(`✅ Deleted: ${username}`);
                    } else {
                        console.error("❌ Error:", data.message);
                    }
                })
                .catch(err => console.error("⚠️ Request failed:", err));
            }
        });
    });
});

