import Controller from '@ember/controller';
import { action } from '@ember/object';
import { inject as service } from '@ember/service';

export default class ApplicationController extends Controller {
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
          this.router.transitionTo('login'); // redireciona
        } else {
          alert('Erro ao deslogar');
        }
      })
      .catch((error) => {
        console.error('Erro na requisição:', error);
      });
  }
}
