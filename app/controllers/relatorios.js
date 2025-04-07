import Controller from '@ember/controller';
import { action } from '@ember/object';
import { tracked } from '@glimmer/tracking';
import fetch from 'fetch';

export default class RelatoriosOcorrenciasController extends Controller {
  @tracked dataInicio = null;
  @tracked dataFim = null;
  @tracked status = '';
  @tracked resultados = null;
  @tracked pdfLink = null;

  @action
  setStatus(event) {
    this.status = event.target.value;
  }

  @action
  async gerarRelatorio() {
    try {
      const response = await fetch('/api/relatorios/ocorrencias', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          data_inicio: this.dataInicio,
          data_fim: this.dataFim,
          status: this.status,
          exportar_pdf: false
        })
      });

      if (!response.ok) throw new Error('Erro na requisição');

      const data = await response.json();
      this.resultados = data;
      this.pdfLink = null;
    } catch (error) {
      alert('Erro ao gerar relatório');
      console.error(error);
    }
  }

  @action
  async exportarPDF() {
    try {
      const response = await fetch('/api/relatorios/ocorrencias', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          data_inicio: this.dataInicio,
          data_fim: this.dataFim,
          status: this.status,
          exportar_pdf: true
        })
      });

      if (!response.ok) throw new Error('Erro ao gerar PDF');

      const blob = await response.blob();
      this.pdfLink = URL.createObjectURL(blob);
    } catch (error) {
      alert('Erro ao exportar PDF');
      console.error(error);
    }
  }
}
