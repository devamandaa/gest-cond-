import { useEffect, useRef, useState } from "react";
import { useNavigate } from "react-router-dom";

export default function Header() {
  const navigate = useNavigate();
  const [open, setOpen] = useState(false);
  const menuRef = useRef<HTMLDivElement | null>(null);

  function sair() {
    localStorage.removeItem("gc_token");
    navigate("/", { replace: true });
  }

  useEffect(() => {
    function onDown(e: MouseEvent) {
      if (!menuRef.current) return;
      if (!menuRef.current.contains(e.target as Node)) setOpen(false);
    }
    function onEsc(e: KeyboardEvent) {
      if (e.key === "Escape") setOpen(false);
    }
    document.addEventListener("mousedown", onDown);
    document.addEventListener("keydown", onEsc);
    return () => {
      document.removeEventListener("mousedown", onDown);
      document.removeEventListener("keydown", onEsc);
    };
  }, []);

  return (
    <header className="sticky top-0 z-40 w-full border-b border-slate-800 bg-slate-900/80 backdrop-blur">
      <div className="mx-auto flex max-w-7xl items-center gap-4 px-4 py-3">
        {/* logo */}
        <strong className="shrink-0 text-xl font-semibold text-white">
          <span className="text-indigo-400">Gest</span>-Cond
        </strong>

        {/* busca */}
        <label className="relative block flex-1">
          <span className="sr-only">Buscar</span>
          <input
            className="w-full rounded-xl border border-slate-700 bg-slate-800/80 px-4 py-2.5 text-sm text-slate-200 placeholder-slate-400 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40"
            placeholder="Buscar (morador, unidade, OS...)"
          />
          <span className="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
            ⌘K
          </span>
        </label>

        {/* ações */}
        <button
          className="relative inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-700 bg-slate-800 text-lg transition hover:border-slate-600 hover:bg-slate-700"
          title="Notificações"
        >
          🔔
          <span className="absolute -right-0.5 -top-0.5 inline-flex h-2.5 w-2.5 rounded-full bg-rose-500 ring-2 ring-slate-900" />
        </button>

        {/* usuário */}
        <div
          ref={menuRef}
          onClick={() => setOpen((v) => !v)}
          className="relative flex cursor-pointer items-center gap-3 rounded-xl border border-slate-700 bg-slate-800 px-3 py-2 transition hover:border-slate-600 hover:bg-slate-700"
        >
          <div className="grid h-10 w-10 place-items-center rounded-full bg-indigo-600 text-sm font-semibold text-white">
            AR
          </div>
          <div className="hidden text-left leading-tight md:block">
            <div className="text-sm font-medium text-white">Amanda Ribeiro</div>
            <div className="text-xs text-slate-400">Síndica</div>
          </div>

          {open && (
            <div className="absolute right-0 top-full mt-2 w-72 overflow-hidden rounded-xl border border-slate-700 bg-slate-800 shadow-2xl ring-1 ring-black/5">
              <div className="p-1">
                <button className="w-full rounded-lg px-3 py-2.5 text-left text-slate-200 hover:bg-slate-700">Ouvidoria</button>
                <button className="w-full rounded-lg px-3 py-2.5 text-left text-slate-200 hover:bg-slate-700">Gestão Administrativa</button>
                <button className="w-full rounded-lg px-3 py-2.5 text-left text-slate-200 hover:bg-slate-700">Gestão Financeira</button>
                <button className="w-full rounded-lg px-3 py-2.5 text-left text-slate-200 hover:bg-slate-700">Gestão Contábil-Fiscal</button>
              </div>
              <div className="border-t border-slate-700 p-1">
                <button
                  onClick={sair}
                  className="w-full rounded-lg px-3 py-2.5 text-left font-medium text-rose-400 hover:bg-rose-500/10 hover:text-rose-300"
                >
                  Sair
                </button>
              </div>
            </div>
          )}
        </div>
      </div>
    </header>
  );
}
