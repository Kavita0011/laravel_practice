import { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [message, setMessage] = useState("");
  const navigate = useNavigate();

  const handleLogin = async () => {
    try {
      const res = await axios.post("/api/login", {
        email: email,
        password: password,
      });
      localStorage.setItem("token", res.data.token);
      setMessage("Login successful");
      navigate("/dashboard");
    } catch (error) {
      setMessage(error.response?.data?.message || "Login failed");
    }
  };

  return (
    <div>
      <h2>Login</h2>
      <input
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        placeholder="Email"
      />
      <input
        value={password}
        onChange={(e) => setPassword(e.target.value)}
        placeholder="Password"
        type="password"
      />
      <button onClick={handleLogin}>Login</button>
      <p>{message}</p>
    </div>
  );
}
// // This code defines a simple login component using React. It uses the useState hook to manage the email, password, and message states. When the user clicks the login button, it sends a POST request to the /api/login endpoint with the email and password. If successful, it stores the token in local storage and navigates to the dashboard page. If it fails, it sets an error message.
// // The component also includes input fields for the email and password, and a button to trigger the login process. The message state is used to display feedback to the user regarding the login status.