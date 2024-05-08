import { useEffect, useState } from 'react';
import './App.css';
import { quiz } from './quizData';

function App() {
  const [randomNumber, setRandomNumber] = useState(0);

  const randomQuiz = () => {
    setRandomNumber(Math.floor(Math.random() * quiz.length));
  };

  return (
    <div className="App">
      <div className="quiz-container">
        <p>{quiz[randomNumber]}</p>
        <button onClick={randomQuiz}>Random quiz</button>
      </div>
    </div>
  );
}

export default App;
