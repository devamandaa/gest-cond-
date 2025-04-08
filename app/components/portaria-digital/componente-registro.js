import Component from '@glimmer/component';
import { action } from '@ember/object';
import { tracked } from '@glimmer/tracking';

export default class ComponenteRegistroComponent extends Component {
  @tracked aberto = false;
  @tracked nome = '';
  @tracked telefone = '';
  @tracked documento = '';

  @action toggleForm() {
    this.aberto = !this.aberto;
  }

  @action atualizarCampo(campo, evento) {
    this[campo] = evento.target.value;
  }

  @action enviarFormulario() {
    alert(
      `Nome: ${this.nome}, Telefone: ${this.telefone}, Documento: ${this.documento}`,
    );
    this.aberto = false;
    // Aqui pode salvar na API futuramente
  }
}
