import { useEffect, useState } from "react";
import axios from "axios";

export default function Dashboard() {
  const [user, setUser] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const res = await axios.get("/api/me", {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });
        setUser(res.data);
      } catch (error) {
        console.error("Unauthorized or token expired");
      }
    };

    fetchData();
  }, []);

  return (
    <div>
      <h2>Dashboard</h2>
      {user ? <p>Welcome, {user.name}</p> : <p>Loading...</p>}
    </div>
  );
}
// This code defines a simple dashboard component using React. It uses the useState and useEffect hooks to manage the user state and fetch user data from the /api/me endpoint. If the request is successful, it sets the user state with the response data. If it fails, it logs an error message indicating that the user is unauthorized or the token has expired.