import React, { useEffect, useState } from "react";

const Main = () => {
  const [count, setCount] = useState<number>(localStorage.getNumber("count"));
  const [message, setMessage] = useState<string>("");

  useEffect(() => {
    localStorage.setNumber("count", count);
    setMessage("Button was pressed!!!");
    const timer = setTimeout(() => {
      setMessage("");
    }, 2000);

    // Cleanup the timeout on component unmount or when count changes
    return () => clearTimeout(timer);
  }, [count]);

  function add(): void {
    setCount((prevCount) => prevCount + 1);
  }

  function decrement(): void {
    setCount((prevCount) => prevCount - 1);
  }

  function reset(): void {
    setCount(0);
  }

  function handleChange(event: React.ChangeEvent<HTMLInputElement>): void {
    const value = parseInt(event.target.value, 10);
    if (!isNaN(value)) {
      setCount(value);
    }
  }

  return (
    <div>
      <p style={{ color: count < 0 ? "red" : "green" }}>{count}</p>
      <button onClick={add}>Add</button>
      <button onClick={decrement}>Decrement </button>
      <button onClick={reset}>Reset count</button>
      <input
        type="number"
        name="number"
        onChange={handleChange}
        placeholder="change count"
      />

      <p>{message}</p>
    </div>
  );
};

export default Main;
