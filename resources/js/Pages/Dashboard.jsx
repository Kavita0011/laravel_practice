import { useEffect, useState } from "react";
import axios from "axios";

export default function Dashboard() {
  const [user, setUser] = useState(null);
    // Fetch user data from the API
useEffect(() => {
  const fetchData = async () => {
    try {
      const res = await axios.get("/", {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`
        },
      });
      setUser(res.data);
    } catch (error) {
      console.error("Not authorized. Redirecting to login.");
      window.location.href = "/login";
    }
  };
    fetchData();
  }, []);
  return (
    <div>
      <h2>Dashboard</h2>
      {user ? <p>Welcome, {user.name}</p> : <p>Loading...</p>}
        {/* Display user information */}
        {user && (
            <div>
                <p>Email: {user.email}</p>
                <p>Role: {user.role}</p>
            </div>
        )}
        {/* Add more user information as needed */}
        {/* Add a button to navigate to the member list */}
        <button
            onClick={() => {
                window.location.href = "/members";
            }}>admin</button>
      {/* logout button */}
        <button
            onClick={() => {
            localStorage.removeItem("token");
            window.location.href = "/login";
            }}> Logout</button>
    </div>
  );
}
// This code defines a simple dashboard component using React. It uses the useState and useEffect hooks to manage the user state and fetch user data from the /api/me endpoint. If the request is successful, it sets the user state with the response data. If it fails, it logs an error message indicating that the user is unauthorized or the token has expired.