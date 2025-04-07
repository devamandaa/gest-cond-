import Component from '@glimmer/component';
import { tracked } from '@glimmer/tracking';
import { action } from '@ember/object';
import { inject as service } from '@ember/service';

export default class FormEncomendaComponent extends Component {
  @service store;

  @tracked entregadorNome = '';
  @tracked empresa = '';
  @tracked unidadeId = '';
  @tracked status = 'aguardando';
  @tracked foto = null;

  @action
  uploadFoto(event) {
    this.foto = event.target.files[0];
  }

  @action
  selecionarStatus(event) {
    this.status = event.target.value;
  }

  @action
  async salvarEncomenda(event) {
    event.preventDefault();

    const encomenda = this.store.createRecord('encomenda', {
      entregadorNome: this.entregadorNome,
      empresa: this.empresa,
      unidadeId: this.unidadeId,
      status: this.status,
      dataEntrega: new Date(),
    });

    await encomenda.save();
    alert('Encomenda registrada com sucesso!');
  }
}
