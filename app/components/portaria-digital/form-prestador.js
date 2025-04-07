import Component from '@glimmer/component';
import { action } from '@ember/object';
import { tracked } from '@glimmer/tracking';
import { inject as service } from '@ember/service';

export default class FormPrestadorComponent extends Component {
  @service store;

  @tracked nome = '';
  @tracked empresa = '';
  @tracked funcao = '';
  @tracked documento = '';
  @tracked unidadeId = '';
  @tracked responsavelId = '';
  @tracked documentos = [];

  @action
  uploadDocumentos(event) {
    this.documentos = Array.from(event.target.files);
  }

  @action
  async salvarPrestador(event) {
    event.preventDefault();

    const prestador = this.store.createRecord('prestador', {
      nome: this.nome,
      empresa: this.empresa,
      funcao: this.funcao,
      documento: this.documento,
      unidadeId: this.unidadeId,
      responsavelId: this.responsavelId,
      dataEntrada: new Date(),
    });

    await prestador.save();
    alert('Prestador registrado com sucesso!');
  }
}
