import Controller from '@ember/controller';
import { tracked } from '@glimmer/tracking';
import { action } from '@ember/object';

export default class OrdemServicoController extends Controller {
  // Filtros
  @tracked filtroTitulo = '';
  @tracked filtroStatus = '';

  // Lista de ordens de exemplo (simulado, depois vamos conectar com o back-end)
  @tracked ordens = [
    {
      id: 1,
      titulo: 'Troca de lâmpada',
      prioridade: 'baixa',
      status: 'pendente',
      data: '2025-04-03',
      responsavel: 'João da Portaria',
      anexo: null,
    },
    {
      id: 2,
      titulo: 'Reparo no portão',
      prioridade: 'alta',
      status: 'em_andamento',
      data: '2025-04-02',
      responsavel: 'Empresa SegPort',
      anexo: '/storage/ordens/portao.pdf',
    },
    {
      id: 3,
      titulo: 'Pintura da garagem',
      prioridade: 'media',
      status: 'concluida',
      data: '2025-03-30',
      responsavel: 'Zelador Carlos',
      anexo: null,
    },
  ];

  // Retorna lista filtrada
  get ordensFiltradas() {
    return this.ordens.filter((ordem) => {
      const busca = this.filtroTitulo.toLowerCase();
      const status = this.filtroStatus;

      return (
        (!busca || ordem.titulo.toLowerCase().includes(busca)) &&
        (!status || ordem.status === status)
      );
    });
  }

  // Contadores por status
  get totalPendente() {
    return this.ordens.filter((o) => o.status === 'pendente').length;
  }

  get totalAndamento() {
    return this.ordens.filter((o) => o.status === 'em_andamento').length;
  }

  get totalConcluida() {
    return this.ordens.filter((o) => o.status === 'concluida').length;
  }

  get totalCancelada() {
    return this.ordens.filter((o) => o.status === 'cancelada').length;
  }

  // Ações de filtro
  @action filtrarTitulo(event) {
    this.filtroTitulo = event.target.value;
  }

  @action filtrarStatus(event) {
    this.filtroStatus = event.target.value;
  }

  // Ações de manipulação
  @action abrirModal() {
    alert('Abrir modal de cadastro (em breve)');
  }

  @action editarOrdem(ordem) {
    alert(`Editar OS ID: ${ordem.id}`);
  }

  @action excluirOrdem(id) {
    if (confirm('Tem certeza que deseja excluir esta ordem?')) {
      this.ordens = this.ordens.filter((ordem) => ordem.id !== id);
    }
  }
}
