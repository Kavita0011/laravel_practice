// app1.jsx

import React from "react";
import { createRoot } from "react-dom/client";
import App from "./App";
import Members from "./Pages/MemberList";

const container = document.getElementById("app");
const root = createRoot(container);
root.render(<Members />);
// This code imports React and the createRoot function from the react-dom/client package. It also imports the App component from the App module. It then selects the HTML element with the ID "app" and creates a root for rendering the App component into that element.
// The createRoot function is used to create a root for the React application, and the render method is called to render the App component into the selected container. This is a common pattern for initializing a React application in a web page.