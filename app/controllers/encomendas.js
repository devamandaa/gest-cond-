import Controller from '@ember/controller';
import { action } from '@ember/object';
import { tracked } from '@glimmer/tracking';

export default class EncomendasController extends Controller {
  @tracked nomeMorador = '';
  @tracked bloco = '';
  @tracked apartamento = '';
  @tracked descricao = '';
  @tracked dataChegada = '';
  @tracked foto = null;
  @tracked transportadora = '';
  @tracked sucesso = false;

  @action
  atualiza(campo, event) {
    this[campo] = event.target.value;
  }

  @action
  selecionaFoto(event) {
    this.foto = event.target.files[0];
  }

  @action
  async salvarEncomenda(event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append('nomeMorador', this.nomeMorador);
    formData.append('bloco', this.bloco);
    formData.append('apartamento', this.apartamento);
    formData.append('descricao', this.descricao);
    formData.append('dataChegada', this.dataChegada);
    formData.append('transportadora', this.transportadora);

    if (this.foto) {
      formData.append('foto', this.foto);
    }

    try {
      await fetch('http://localhost:8000/api/encomendas', {
        method: 'POST',
        body: formData,
      });

      this.sucesso = true;

      // limpa os campos
      this.nomeMorador = '';
      this.bloco = '';
      this.apartamento = '';
      this.descricao = '';
      this.dataChegada = '';
      this.transportadora = '';
      this.foto = null;
    } catch (error) {
      alert('Erro ao salvar encomenda');
      console.error(error);
    }
  }
}
