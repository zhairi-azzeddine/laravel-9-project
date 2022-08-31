   @extends('layouts.master')
   @section('contenu')
   <form enctype="multipart/form-data" method="POST">
   @csrf
   <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-3">Liste Etudiants inscrits</h3>
      <div class="d-flex justify-content-end mb-3 mt-1">
      <a href="{{route('etudiant.create')}}" class="btn btn-success" ><i class="fa-solid fa-plus"></i> Ajouter un Etudiant</a>&nbsp
      <a href="#" class="btn btn-info text-white" ><i class="fa-solid fa-file-import"></i> List Etudiants (.xls)</a>&nbsp
      <button onclick="return confirm('Voulez Vous Supprimer ?')"  formaction="{{ route('etudiant.deleteSelected') }}" type="submit" class="btn btn-danger text-white" ><i class="fa-solid fa-trash-can"></i> Supprimer Selectioner</button>
    </div>


    <table id="etudiantTab" class="table table-bordered table-hover ">
  <thead>
    <tr style="background-color: #ebebeb;">
      <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">photo</th>
      <th scope="col">cv</th>
      <th scope="col">Classe</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
    @foreach($etudiants as $etudiant)
    <tr>
      <th scope="col"><input class="form-check-input" type="checkbox"  name="ids[{{ $etudiant->id }}]" value="{{ $etudiant->id }}"></th>
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
      <td>
        <a href="#" class="btn btn-primary text-white" ><i class="fa-solid fa-pen-to-square"></i></a>
        <a href="#" class="btn btn-warning text-white" ><i class="fa-solid fa-eye"></i></a>
        <a href="#" class="btn btn-secondary text-white" ><i class="fa-solid fa-print"></i></a>
        <a href="#" class="btn btn-danger" ><i class="fa-solid fa-trash-can"></i></a>
      </td>
    </tr>
    @endforeach
  
    
  </tbody>
  
</table>
    </form>
{{--   
  
{{$etudiants->links()}} 

// Pagination Bootstrap en ajoutent 'Paginator::useBootstrap();' a fonction boot dans App ServicesPrivider.php et $etudiants =Etudiant::orderby("nom","asc")->paginate(8);
return view("etudiant",compact("title","etudiants")); a etudiant controlleur

--}}
  </div>


   @endsection
  
  
