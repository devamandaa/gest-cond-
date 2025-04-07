import Component from '@glimmer/component';
import { action } from '@ember/object';
import { tracked } from '@glimmer/tracking';
import { inject as service } from '@ember/service';

export default class FormVisitaComponent extends Component {
  @service store;

  @tracked nome = '';
  @tracked documento = '';
  @tracked unidadeId = '';
  @tracked moradorId = '';
  @tracked observacoes = '';
  @tracked foto = null;

  @action
  uploadFoto(event) {
    this.foto = event.target.files[0];
  }

  @action
  async salvarVisita(event) {
    event.preventDefault();

    const visita = this.store.createRecord('visita', {
      nomeVisitante: this.nome,
      documento: this.documento,
      unidadeId: this.unidadeId,
      moradorId: this.moradorId,
      observacoes: this.observacoes,
      dataEntrada: new Date(),
    });

    await visita.save();
    alert('Visita registrada com sucesso!');
  }
}
