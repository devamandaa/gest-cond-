import { Routes, Route } from "react-router-dom";
import Login from "./pages/auth/Login";
import Dashboard from "./pages/auth/Dashboard";
import Protected from "./components/Protected";

export default function App() {
  return (
    <Routes>
      {/* rota pública */}
      <Route path="/" element={<Login />} />

      {/* rotas protegidas */}
      <Route element={<Protected />}>
        <Route path="/dashboard" element={<Dashboard />} />
      </Route>
    </Routes>
  );
}
