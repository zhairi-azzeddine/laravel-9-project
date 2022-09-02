<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr>
        <td><b>Nom</b></td>
        <td><b>Barcode</b></td>
            
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>
          {{$etudiant->nom}}
        </td>
        <td>
        {!!DNS1D::getBarcodeHTML($etudiant->codemassar, 'C39')!!}
        </td>
       
      </tr>
      </tbody>
    </table>
  </body>
</html>