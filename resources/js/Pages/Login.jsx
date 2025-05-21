import { useState } from "react";
import axios from "axios"; // Import your Axios instance
import { useNavigate } from "react-router-dom";

function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [message, setMessage] = useState("");
//   const navigate = useNavigate();

  const handleLogin = async () => {
  try {
  const res = await axios.post("/api/login", { email, password });
  const token = res.data.token;

  if (token) {
    localStorage.setItem("token", token);
    setMessage("Login successful");

    // Redirect after a short delay (optional)
    setTimeout(() => {
      navigate("/dashboard");
    }, 1000); // 1 second delay

  } else {
    setMessage("Token not received from backend");
  }

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
export default Login;