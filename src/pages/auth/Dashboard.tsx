import Header from "../../components/Header";
import Sidebar from "../../components/Sidebar";

export default function Dashboard() {
  return (
    <>
      <Header />

      <main className="bg-slate-900 text-slate-50">
        <div className="mx-auto flex max-w-7xl gap-6 px-6 py-6">
          {/* Sidebar fixa à esquerda */}
          <Sidebar />

          {/* Conteúdo principal */}
          <section className="min-w-0 flex-1">
            {/* Hero */}
            <header className="mb-8">
              <h1 className="text-3xl md:text-4xl font-bold tracking-tight">
                Bem-vinda ao <span className="text-indigo-300">Gest-Cond</span>
              </h1>
              <p className="mt-2 text-slate-300">
                Visão geral do condomínio e atalhos para ações do dia.
              </p>
            </header>

            {/* KPIs */}
            <div className="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
              <div className="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-5">
                <p className="text-sm text-slate-400">Moradores ativos</p>
                <p className="mt-1 text-3xl font-extrabold">120</p>
                <p className="mt-1 text-xs text-emerald-300">+3 este mês</p>
              </div>

              <div className="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-5">
                <p className="text-sm text-slate-400">Ocupação</p>
                <p className="mt-1 text-3xl font-extrabold">78%</p>
                <div className="mt-3 h-2 w-full rounded-full bg-slate-700/60">
                  <div className="h-2 rounded-full bg-indigo-500" style={{ width: "78%" }} />
                </div>
                <p className="mt-1 text-xs text-slate-400">24 vagas</p>
              </div>

              <div className="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-5">
                <p className="text-sm text-slate-400">Arrecadação (mês)</p>
                <p className="mt-1 text-3xl font-extrabold">R$ 12.300</p>
                <p className="mt-1 text-xs text-amber-300">15 pendentes</p>
              </div>

              <div className="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-5">
                <p className="text-sm text-slate-400">Inadimplência</p>
                <p className="mt-1 text-3xl font-extrabold">8,4%</p>
                <p className="mt-1 text-xs text-slate-400">Meta &lt; 6%</p>
              </div>
            </div>

            {/* Linha com 2 colunas: esquerda 2/3, direita 1/3 */}
            <div className="grid gap-6 lg:grid-cols-3">
              {/* Coluna esquerda */}
              <div className="space-y-6 lg:col-span-2">
                {/* Ações rápidas */}
                <div className="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-5">
                  <div className="mb-3 flex items-center justify-between">
                    <h3 className="text-lg font-semibold">Ações rápidas</h3>
                    <button className="text-xs text-indigo-300 hover:underline">configurar atalhos</button>
                  </div>
                  <div className="flex flex-wrap gap-3">
                    {[
                      { id: "morador", label: "+ Cadastrar morador" },
                      { id: "reserva", label: "📆 Nova reserva" },
                      { id: "boleto", label: "🧾 Gerar boleto" },
                      { id: "os", label: "🧰 Abrir O.S." },
                      { id: "comunicado", label: "🔔 Criar comunicado" },
                    ].map((a) => (
                      <button
                        key={a.id}
                        className="rounded-xl border border-slate-700/60 bg-slate-800/60 px-4 py-2 text-sm font-semibold hover:border-indigo-500 hover:bg-slate-800/90"
                      >
                        {a.label}
                      </button>
                    ))}
                  </div>
                </div>

                {/* Boletos a vencer */}
                <div className="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-5">
                  <div className="mb-3 flex items-center justify-between">
                    <h3 className="text-lg font-semibold">Boletos a vencer (7 dias)</h3>
                    <button className="text-xs text-indigo-300 hover:underline">ver todos</button>
                  </div>
                  <div className="overflow-hidden rounded-xl border border-slate-700/60">
                    <table className="min-w-full text-sm">
                      <thead className="bg-slate-900/60 text-slate-300">
                        <tr>
                          <th className="px-4 py-2 text-left font-medium">Unidade</th>
                          <th className="px-4 py-2 text-left font-medium">Morador</th>
                          <th className="px-4 py-2 text-left font-medium">Vencimento</th>
                          <th className="px-4 py-2 text-left font-medium">Valor</th>
                          <th className="px-4 py-2 text-left font-medium">Situação</th>
                        </tr>
                      </thead>
                      <tbody className="divide-y divide-slate-700/60">
                        {[
                          { id: 1, unidade: "A103", nome: "Ana Souza", venc: "03/09", valor: "R$ 420,00", sit: "Em aberto" },
                          { id: 2, unidade: "B204", nome: "Carlos Lima", venc: "04/09", valor: "R$ 420,00", sit: "Em aberto" },
                          { id: 3, unidade: "C501", nome: "João Silva", venc: "06/09", valor: "R$ 420,00", sit: "Negociação" },
                        ].map((b) => (
                          <tr key={b.id} className="hover:bg-slate-800/40">
                            <td className="px-4 py-2">{b.unidade}</td>
                            <td className="px-4 py-2">{b.nome}</td>
                            <td className="px-4 py-2">{b.venc}</td>
                            <td className="px-4 py-2">{b.valor}</td>
                            <td className="px-4 py-2">
                              <span className="rounded-full bg-amber-500/15 px-2 py-0.5 text-xs text-amber-300">
                                {b.sit}
                              </span>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>

                {/* Ocorrências abertas */}
                <div className="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-5">
                  <div className="mb-3 flex items-center justify-between">
                    <h3 className="text-lg font-semibold">Ocorrências abertas</h3>
                    <button className="text-xs text-indigo-300 hover:underline">nova ocorrência</button>
                  </div>
                  <ul className="space-y-2">
                    {[
                      { id: "oc1", titulo: "Barulho após horário (Bloco B)", prioridade: "Alta" },
                      { id: "oc2", titulo: "Lâmpada queimada no térreo (C)", prioridade: "Média" },
                      { id: "oc3", titulo: "Vazamento no 203 (A)", prioridade: "Alta" },
                    ].map((o) => (
                      <li
                        key={o.id}
                        className="rounded-lg border border-slate-700/60 bg-slate-800/60 px-4 py-3"
                      >
                        <div className="flex items-center justify-between">
                          <p className="font-medium">{o.titulo}</p>
                          <span
                            className={[
                              "rounded-full px-2 py-0.5 text-xs",
                              o.prioridade === "Alta"
                                ? "bg-rose-500/15 text-rose-300"
                                : "bg-amber-500/15 text-amber-300",
                            ].join(" ")}
                          >
                            {o.prioridade}
                          </span>
                        </div>
                      </li>
                    ))}
                  </ul>
                </div>
              </div>

              {/* Coluna direita */}
              <div className="space-y-6">
                {/* Agenda de hoje */}
                <div className="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-5">
                  <h3 className="mb-3 text-lg font-semibold">Agenda de hoje</h3>
                  <ul className="space-y-2 text-sm">
                    {[
                      { id: "ag1", hora: "09:00", item: "Reunião com zeladoria" },
                      { id: "ag2", hora: "14:00", item: "Visita manutenção elevador" },
                      { id: "ag3", hora: "18:30", item: "Assembleia extraordinária" },
                    ].map((a) => (
                      <li
                        key={a.id}
                        className="flex items-center justify-between rounded-lg border border-slate-700/60 bg-slate-800/60 px-3 py-2"
                      >
                        <span className="text-slate-300">{a.item}</span>
                        <span className="rounded-md bg-slate-900/60 px-2 py-0.5 text-xs text-slate-400">
                          {a.hora}
                        </span>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Reservas próximas */}
                <div className="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-5">
                  <h3 className="mb-3 text-lg font-semibold">Reservas (próximos 3 dias)</h3>
                  <ul className="space-y-2 text-sm">
                    {[
                      { id: "rv1", quando: "Hoje 19:00", item: "Salão de festas – Apto 302" },
                      { id: "rv2", quando: "Amanhã 10:00", item: "Churrasqueira – Apto 104" },
                      { id: "rv3", quando: "Qui 20:00", item: "Quadra – Apto 501" },
                    ].map((r) => (
                      <li
                        key={r.id}
                        className="flex items-center justify-between rounded-lg border border-slate-700/60 bg-slate-800/60 px-3 py-2"
                      >
                        <span className="text-slate-300">{r.item}</span>
                        <span className="rounded-md bg-indigo-500/10 px-2 py-0.5 text-xs text-indigo-300">
                          {r.quando}
                        </span>
                      </li>
                    ))}
                  </ul>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>
    </>
  );
}
