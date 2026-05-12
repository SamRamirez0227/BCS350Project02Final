# BrainByte

BrainByte is a online quiz application built using PHP, MySQL, HTML, CSS, and JavaScript.  
The application allows users to play quizzes either as guests or as registered users.  
Registered users can save scores, view their play history, and compete on the leaderboard.

---

# Features

## Guest Mode
- Play instantly without creating an account
- Fixed 10 random questions
- 5-minute timer
- Scores are not saved

## Registered User Features
- Create account and login securely
- Password hashing for security
- Choose quiz length:
  - 10 Questions (5 min)
  - 15 Questions (10 min)
  - 20 Questions (15 min)
  - 25 Questions (20 min)
- Randomized questions every game
- Scores saved to database
- Profile page with score history
- Global leaderboard with top players

## Quiz Features
- Random question selection from JSON question bank
- Timer system
- Score calculation
- Percentage calculation
- Replay functionality

---

# Technologies Used

## Frontend
- HTML
- CSS
- JavaScript

## Backend
- PHP
- MySQL

## Hosting
- InfinityFree

---

# Project Structure

```text
BrainByte/
│
├── assets/
│   └── style.css
│   └── logo.webp
│
├── data/
│   └── questions.json
│
├── config.php
├── functions.php
├── header.php
├── footer.php
├── index.php
├── login.php
├── signup.php
├── logout.php
├── quiz.php
├── results.php
├── profile.php
├── leaderboard.php
├── start_quiz.php
├── schema.sql
└── README.md
