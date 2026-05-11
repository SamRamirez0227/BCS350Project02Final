const timerElement = document.getElementById("timer");
const quizForm = document.getElementById("quizForm");

if (timerElement && quizForm) {
    let remaining = parseInt(timerElement.dataset.remaining, 10);

    function updateTimer() {
        if (remaining <= 0) {
            timerElement.textContent = "Time left: 0:00";
            quizForm.submit();
            return;
        }

        const minutes = Math.floor(remaining / 60);
        const seconds = remaining % 60;
        timerElement.textContent = `Time left: ${minutes}:${seconds.toString().padStart(2, "0")}`;
        remaining--;
    }

    updateTimer();
    setInterval(updateTimer, 1000);
}
