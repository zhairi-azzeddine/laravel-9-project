   @extends('layouts.master')
   @section('contenu')
   <form enctype="multipart/form-data" method="POST">
   @csrf
   <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-3">Liste Etudiants inscrits</h3>
      <div class="d-flex justify-content-end mb-3 mt-1">
      <a href="{{route('etudiant.create')}}" class="btn btn-success" ><i class="fa-solid fa-plus"></i> Ajouter un Etudiant</a>&nbsp
      <a href="#" class="btn btn-info text-white" ><i class="fa-solid fa-file-import"></i> List Etudiants (.xls)</a>&nbsp
      <button disabled id="btnDelete" onclick="return confirm('Voulez Vous Supprimer ?')"  formaction="{{ route('etudiant.deleteSelected') }}" type="submit" class="btn btn-danger text-white" ><i class="fa-solid fa-trash-can"></i> Supprimer Selectioner</button>
    </div>


    <table id="etudiantTab" class="table table-bordered table-hover ">
  <thead>
    <tr style="background-color: #ebebeb;">
      <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Photo</th>
      <th scope="col">CV</th>
      <th scope="col">Classe</th>
      <th scope="col">CodeBar</th>
      <th scope="col">QR Code</th>
      <th scope="col">CNI</th>
      <th scope="col">Code MASSAR</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
    @foreach($etudiants as $etudiant)
    <tr>
      <th scope="col"><input id="checkdelete" class="form-check-input" type="checkbox"  name="ids[{{ $etudiant->id }}]" value="{{ $etudiant->id }}"></th>
      <th scope="row">{{ $etudiant->id }}</th>
      <td>{{ $etudiant->nom }}</td>
      <td>{{ $etudiant->prenom }}</td>
      <td><img name="ph" src="{{ asset($etudiant->photo) }}" width="70" height="70" class="img img-responsive"  /></td>
      @if(!empty($etudiant->cv))
      <td><a href="{{ asset($etudiant->cv) }}">Telecharger <i class="fa-solid fa-download"></i></a></td>
      @else
      <td>CV indisponible</td>
      @endif
      <td>{{ $etudiant->classe->libelle }}</td>
      <td>{!!DNS1D::getBarcodeHTML($etudiant->codemassar, 'C39')!!}</td>
      <td>{!!DNS2D::getBarcodeHTML($etudiant->codemassar, 'QRCODE',3,3)!!}</td>
      <td>{{$etudiant->cni}}</td>
      <td>{{$etudiant->codemassar}}</td>
      <td>
        <a target="_self" href="{{route('etudiant.edit',['etudiant'=>$etudiant->id])}}" class="btn btn-primary text-white" ><i class="fa-solid fa-pen-to-square"></i></a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#infoEtudiantModal" class="btn btn-warning text-white" ><i class="fa-solid fa-eye"></i></a>
        <a href="{{route('etudiant.downloadPDF',['etudiantPrint'=>$etudiant->id])}}" class="btn btn-secondary text-white" ><i class="fa-solid fa-print"></i></a>
      </td>
    </tr>
    @endforeach
  
    
  </tbody>
  
</table>







<!-- Modal -->
@if(!empty($etudiant))
<div class="modal fade" id="infoEtudiantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Etudiant Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="container">
      
        <div class="d-flex justify-content-center"><img name="ph" src="{{ asset($etudiant->photo) }}" width="100" height="100" class="img img-responsive rounded-circle"  /></div>
        <div class="d-flex justify-content-center"><label><b>Numéro : </b></label> <label>{{ $etudiant->id }}</label></div>
        <div class="d-flex justify-content-center"><label><b>Prénom : </b></label> <label>{{ $etudiant->prenom }}</label></div>
        <div class="d-flex justify-content-center"><label><b>Nom : </b></label> <label>{{ $etudiant->nom }}</label></div>
        <div class="d-flex justify-content-center"><label><b>Classe : </b></label> <label>{{ $etudiant->classe->libelle }}</label></div>
        <div class="d-flex justify-content-center"><label><b>CodeBar : </b></label>  </div> 
        <div class="d-flex justify-content-center"><label>{!!DNS1D::getBarcodeHTML($etudiant->codemassar, 'C39')!!}</label></div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
</div>
@else
        @endif








    </form>
{{--   
  
{{$etudiants->links()}} 

// Pagination Bootstrap en ajoutent 'Paginator::useBootstrap();' a fonction boot dans App ServicesPrivider.php et $etudiants =Etudiant::orderby("nom","asc")->paginate(8);
return view("etudiant",compact("title","etudiants")); a etudiant controlleur

--}}
  </div>


   @endsection
  
  
