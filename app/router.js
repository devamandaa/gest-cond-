import EmberRouter from '@ember/routing/router';
import config from 'gent-cond/config/environment';

export default class Router extends EmberRouter {
  location = config.locationType;
  rootURL = config.rootURL;
}

Router.map(function () {
  this.route('login'); 
  

  this.route('boletos');
  this.route('reservas');
  this.route('ocorrencias');
  this.route('comunicados');
  this.route('financeiro');
  this.route('moradores');
  this.route('agenda-do-sindico');
  this.route('ordem-servico');
  this.route('portaria');
  this.route('encomendas');
  this.route('relatorios');
  this.route('whatsapp');
  this.route('funcionarios');

  this.route('relatorios', function () {
    this.route('ocorrencia'); // rota: /relatorios/ocorrencias
  });
  this.route('home');
});
