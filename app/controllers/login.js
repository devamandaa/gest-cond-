import Controller from '@ember/controller';
import { action } from '@ember/object';
import { inject as service } from '@ember/service';

export default class LoginController extends Controller {
  @service router;

  username = '';
  password = '';
  errorMessage = '';

  @action
  updateUsername(event) {
    this.username = event.target.value;
  }

  @action
  updatePassword(event) {
    this.password = event.target.value;
  }

  @action
  async login(event) {
    event.preventDefault();

    try {
        let response = await fetch('http://127.0.0.1:8000/api/login', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              email: this.username,
              password: this.password
            })
          });

      if (!response.ok) {
        throw new Error('Usuário ou senha inválidos');
      }

      let data = await response.json();

      // Armazena token (caso queira usar em futuras requisições)
      localStorage.setItem('token', data.token || '');

      // Redireciona para a página principal
      this.router.transitionTo('index'); // ou 'home' se quiser outra rota
    } catch (error) {
      this.errorMessage = error.message;
    }
  }
}
