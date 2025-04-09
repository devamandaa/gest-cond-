// app/controllers/index.js
import Controller from '@ember/controller';
import { inject as service } from '@ember/service';
import { action } from '@ember/object';

export default class IndexController extends Controller {
  @service router;

  @action
  logout() {
    fetch('http://localhost:8000/api/logout', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
        'Content-Type': 'application/json'
      }
    })
      .then((response) => {
        if (response.ok) {
          localStorage.removeItem('token');
          this.router.transitionTo('login'); // redireciona para a rota de login
        } else {
          console.error('Erro ao deslogar');
        }
      })
      .catch((error) => {
        console.error('Erro na requisição de logout:', error);
      });
  }
}
