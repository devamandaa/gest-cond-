import { useState } from "react";

type Item = { key: string; label: string };

const MODULES: Item[] = [
  { key: "dashboard", label: "Visão Geral" },
  { key: "moradores", label: "Moradores" },
  { key: "boletos", label: "Boletos" },
  { key: "comunicados", label: "Comunicados" },
  { key: "encomendas", label: "Encomendas" },
  { key: "financeiro", label: "Financeiro" },
  { key: "funcionarios", label: "Funcionários" },
  { key: "ocorrencias", label: "Ocorrências" },
  { key: "ordem-servico", label: "Ordem de Serviço" },
  { key: "portaria", label: "Portaria" },
  { key: "reservas", label: "Reservas" },
  { key: "relatorios", label: "Relatórios" },
];

export default function Sidebar({ onSelect }: { onSelect?: (k: string) => void }) {
  const [active, setActive] = useState<string>("dashboard");

  function select(k: string) {
    setActive(k);
    onSelect?.(k);
    // futuramente: navigate(`/${k}`)
  }

  return (
    <aside className="sticky top-[64px] h-[calc(100vh-64px)] w-[240px] shrink-0 border-r border-slate-800 bg-slate-900/60 p-3">
      <nav className="space-y-1">
        {MODULES.map((m) => {
          const isActive = active === m.key;
          return (
            <button
              key={m.key}
              onClick={() => select(m.key)}
              className={[
                "flex w-full items-center justify-between rounded-lg px-3 py-2 text-left text-sm transition",
                isActive
                  ? "bg-slate-800/90 text-white border border-slate-700 shadow"
                  : "text-slate-300 hover:text-white hover:bg-slate-800/70 border border-transparent hover:border-slate-700",
              ].join(" ")}
            >
              <span className="truncate">{m.label}</span>
              <span className={["ml-3 h-1 w-6 rounded-full", isActive ? "bg-indigo-500" : "bg-transparent"].join(" ")} />
            </button>
          );
        })}
      </nav>
    </aside>
  );
}
