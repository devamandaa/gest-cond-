import Controller from '@ember/controller';
import { action } from '@ember/object';
import { inject as service } from '@ember/service';

export default class LoginController extends Controller {
  @service router;

  email = '';
  password = '';
  errorMessage = '';

  @action
  updateUsername(event) {
    this.email = event.target.value;
    this.set('errorMessage', '');
  }

  @action
  updatePassword(event) {
    this.password = event.target.value;
    this.set('errorMessage', '');
  }

  @action
  login(event) {
    event.preventDefault();

    if (this.email.trim().toLowerCase() === 'amanda' && this.password === '123') {
      this.set('errorMessage', '');
      this.router.transitionTo('index'); // <- aqui está o segredo!

    } else {
      this.set('errorMessage', 'Usuário ou senha incorretos.');
    }
  }
}
