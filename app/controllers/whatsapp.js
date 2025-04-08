import Controller from '@ember/controller';
import { tracked } from '@glimmer/tracking';
import { action } from '@ember/object';

export default class whatsappController extends Controller {
  @tracked numero = '';
  @tracked mensagem = '';

  @action
  handleSelect(event) {
    this.numero = event.target.value;
  }

  @action
  handleInput(event) {
    this.mensagem = event.target.value;
  }

  @action
  fillMessage(text) {
    this.mensagem = text;
  }

  @action
  sendMessage() {
    if (!this.numero || !this.mensagem) {
      alert('Por favor, selecione um destinatário e digite a mensagem. ');
      return;
    }

    const url = `https://wa.me/55${this.numero}?text=${encodeURIComponent(this.mensagem)}`;
    window.open(url, '_blank');
  }
}
