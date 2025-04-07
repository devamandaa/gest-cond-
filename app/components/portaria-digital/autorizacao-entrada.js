import Component from '@glimmer/component';
import { tracked } from '@glimmer/tracking';
import { action } from '@ember/object';

export default class AutorizacaoEntradaComponent extends Component {
  @tracked nome = '';
  @tracked documento = '';
  @tracked dataAgendada = '';
  @tracked linkGerado = '';

  @action
  autorizarVisitante(event) {
    event.preventDefault();

    const token = Math.random().toString(36).substr(2, 8);
    this.linkGerado = `https://gest-cond.com/portaria/entrada/${token}`;

    alert('Autorização criada e link gerado com sucesso!');
  }
}
