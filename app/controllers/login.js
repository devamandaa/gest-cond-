import Controller from '@ember/controller';
import { action } from '@ember/object';

export default class LoginController extends Controller {
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

    if (this.email === '@amanda' && this.password === '12345') {
      this.set('errorMessage', '');
      alert('Login bem-sucedido!');
      // Redirecionar se quiser
      // this.transitionToRoute('dashboard');
    } else {
      this.set('errorMessage', 'Usuário ou senha incorretos.');
    }
  }
}
