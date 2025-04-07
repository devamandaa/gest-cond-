import Component from '@glimmer/component';
import { action } from '@ember/object';
import { tracked } from '@glimmer/tracking';

export default class FormularioEventoComponent extends Component {
  @tracked titulo = '';
  @tracked descricao = '';
  @tracked dataInicio = '';
  @tracked dataFim = '';
  @tracked tipo = 'assembleia';

  @action atualizarTitulo(event) {
    this.titulo = event.target.value;
  }

  @action atualizarDescricao(event) {
    this.descricao = event.target.value;
  }

  @action atualizarDataInicio(event) {
    this.dataInicio = event.target.value;
  }

  @action atualizarDataFim(event) {
    this.dataFim = event.target.value;
  }

  @action atualizarTipo(event) {
    this.tipo = event.target.value;
  }

  @action salvarEvento(event) {
    event.preventDefault();

    console.log('Evento salvo:', {
      titulo: this.titulo,
      descricao: this.descricao,
      dataInicio: this.dataInicio,
      dataFim: this.dataFim,
      tipo: this.tipo,
    });

    alert('Evento criado com sucesso');
  }
}
