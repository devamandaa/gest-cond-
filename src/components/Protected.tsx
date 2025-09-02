import { Outlet, Navigate } from "react-router-dom";

export default function Protected() {
  // Verifica se existe token no localStorage
  const isAuthed = Boolean(localStorage.getItem("gc_token"));

  // Se estiver logado, renderiza a rota filha (<Outlet />)
  // Senão, redireciona para a página de Login ("/")
  return isAuthed ? <Outlet /> : <Navigate to="/" replace />;
}
