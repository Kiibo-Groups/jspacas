<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<table>
  <thead>
    <tr>
      <td style="background: #000000;color:#FFFFFF;width:200px;"><b>Clave</b></td>
      <td style="background: #000000;color:#FFFFFF;width:200px;"><b>Descripcion</b></td> 
    </tr>
  </thead>
  <tbody>
    @foreach($data as $row) 
        <tr>
            <td style="width:200px;">{{ $row['Clave'] }}</td>
            <td style="width:200px;">{{ $row['Descripcion'] }}</td> 
        </tr>
    @endforeach   
    </tbody>
</table>
</body>
</html>