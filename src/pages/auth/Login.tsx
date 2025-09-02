// src/pages/auth/Login.tsx
import { useState } from "react";
import { useNavigate } from "react-router-dom";

export default function Login() {
  const navigate = useNavigate();
  const [email, setEmail] = useState("");
  const [senha, setSenha] = useState("");
  const [mostrarSenha, setMostrarSenha] = useState(false);
  const [erro, setErro] = useState("");

  function handleSubmit(e: React.FormEvent) {
    e.preventDefault();
    setErro("");

    if (!email || !senha) {
      setErro("Preencha e-mail e senha!");
      return;
    }

    // validação de demonstração
    if (email === "admin@gestcond.com" && senha === "123456") {
      localStorage.setItem("gc_token", "demo-token");
      navigate("/dashboard");
      return;
    }

    setErro("Credenciais inválidas (dica: admin@gestcond.com / 123456)");
  }

  return (
    <div className="relative min-h-screen overflow-hidden">
      {/* ===== Fundo premium: base escura + auroras + grain ===== */}
      <div className="absolute inset-0 -z-10">
        {/* base */}
        <div className="absolute inset-0 bg-[#0b1220]" />

        {/* auroras */}
        <div className="pointer-events-none absolute -top-40 -left-40 h-[60vh] w-[60vh] rounded-full blur-3xl opacity-30 bg-gradient-to-br from-indigo-500 via-purple-500 to-fuchsia-500" />
        <div className="pointer-events-none absolute bottom-[-20%] right-[-10%] h-[70vh] w-[70vh] rounded-full blur-3xl opacity-25 bg-gradient-to-tr from-sky-500 via-cyan-400 to-indigo-500" />

        {/* highlights radiais sutis */}
        <div className="absolute inset-0 opacity-[0.06] [background:radial-gradient(1000px_circle_at_20%_10%,#ffffff,transparent_40%),radial-gradient(800px_circle_at_80%_90%,#ffffff,transparent_35%)]" />

        {/* grain overlay */}
        <div className="absolute inset-0 opacity-[0.06] mix-blend-overlay [background-image:url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22 viewBox=%220 0 40 40%22><filter id=%22n%22><feTurbulence type=%22fractalNoise%22 baseFrequency=%220.8%22 numOctaves=%222%22 stitchTiles=%22stitch%22/></filter><rect width=%2240%22 height=%2240%22 filter=%22url(%23n)%22 opacity=%220.25%22/></svg>')]" />
      </div>

      {/* ===== Conteúdo ===== */}
      <div className="grid min-h-screen place-items-center px-4">
        <form
          onSubmit={handleSubmit}
          className="w-full max-w-md rounded-3xl border border-white/10 bg-white/5 p-8 shadow-[0_10px_50px_rgba(0,0,0,0.4)] backdrop-blur-xl"
        >
          <h1 className="text-center text-3xl font-semibold tracking-tight text-white">
            Gest-Cond
          </h1>
          <p className="mt-1 text-center text-sm text-white/70">
            Acesse sua conta para continuar
          </p>

          {/* E-mail */}
          <div className="mt-6">
            <label htmlFor="email" className="block text-sm text-white/80">
              E-mail
            </label>
            <input
              id="email"
              type="email"
              placeholder="Digite seu e-mail"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="mt-2 w-full rounded-xl bg-slate-800/70 border border-slate-600/60 px-4 py-3 text-slate-100 placeholder:text-slate-400 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/40 transition"
            />
          </div>

          {/* Senha */}
          <div className="mt-4">
            <label htmlFor="senha" className="block text-sm text-white/80">
              Senha
            </label>
            <div className="mt-2 relative">
              <input
                id="senha"
                type={mostrarSenha ? "text" : "password"}
                placeholder="Digite sua senha"
                value={senha}
                onChange={(e) => setSenha(e.target.value)}
                className="w-full rounded-xl bg-slate-800/70 border border-slate-600/60 px-4 py-3 pr-24 text-slate-100 placeholder:text-slate-400 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/40 transition"
              />
              <button
                type="button"
                onClick={() => setMostrarSenha((v) => !v)}
                className="absolute inset-y-0 right-2 my-auto h-9 rounded-lg px-3 text-xs font-medium text-white/80 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition"
              >
                {mostrarSenha ? "Ocultar" : "Mostrar"}
              </button>
            </div>
          </div>

          {/* Mensagem de erro */}
          {erro && (
            <div className="mt-4 rounded-xl border border-red-500/40 bg-red-500/10 px-4 py-3 text-sm text-red-200">
              {erro}
            </div>
          )}

          {/* Botão */}
          <button
            type="submit"
            className="mt-5 w-full rounded-xl bg-indigo-600 py-3 text-center text-sm font-semibold text-white shadow-lg shadow-indigo-600/30 transition hover:shadow-indigo-500/40 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400"
          >
            Entrar
          </button>

          {/* Ações secundárias */}
          <div className="mt-4 flex items-center justify-between text-sm">
            <a className="text-white/70 hover:text-white" href="#">
              Esqueci minha senha
            </a>
            <a className="text-white/70 hover:text-white" href="#">
              Criar conta
            </a>
          </div>

          {/* Dica demo */}
          <div className="mt-6 text-center text-xs text-white/60">
             <span className="font-medium"></span> /{" "}
            <span className="font-medium"></span>
          </div>
        </form>
      </div>
    </div>
  );
}
