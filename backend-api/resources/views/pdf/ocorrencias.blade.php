<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Relatório de Ocorrências</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 14px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
  </style>
</head>
<body>
  <h1>Relatório de Ocorrências</h1>
  <table>
    <thead>
      <tr>
        <th>Título</th>
        <th>Status</th>
        <th>Criado em</th>
      </tr>
    </thead>
    <tbody>
      @foreach($ocorrencias as $ocorrencia)
        <tr>
          <td>{{ $ocorrencia->titulo }}</td>
          <td>{{ ucfirst($ocorrencia->status) }}</td>
          <td>{{ $ocorrencia->created_at->format('d/m/Y H:i') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
