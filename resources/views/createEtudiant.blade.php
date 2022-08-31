@extends('layouts.master')
   @section('contenu')
   <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-3">Ajout Etudiant</h3>


      <div class="justify-content-center mb-3 mt-1 ">

      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

      <form enctype="multipart/form-data" class="f1" method="post" action="{{ route('etudiant.ajouter') }}">

         @csrf
  <div class="mb-3">
    <label for="nom" class="form-label">Nom</label>
    <input type="text" class="form-control" name="nom" aria-describedby="nom" required>
  </div>
  <div class="mb-3">
    <label for="prenom" class="form-label">Prénom</label>
    <input type="text" class="form-control" name="prenom" required>
  </div>

  <div class="mb-3">
    <label  for="photo" class="form-label">Photo</label>
    <input type="file" class="form-control" name="photo" required>
  </div>

  <div class="mb-3">
    <label for="cv" class="form-label">CV</label>
    <input type="file" class="form-control" name="cv" >
  </div>

  <div class="mb-3">
    <label for="classe_id" class="form-label">Classe</label>
    <select class="form-control" name="classe_id" required>
    <option disabled selected value="">Selectionner une classe</option>
    @foreach($classes as $classe)
      <option value="{{$classe->id}}">{{$classe->libelle}}</option>
    
    @endforeach
    </select>
  </div>

 
  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Enregisrer</button>

  <button href="{{ route('etudiantsPage') }}" class="btn btn-danger"> <i class="fa-solid fa-square-xmark"></i> Annuler</button>
</form>

      </div>
  
  </div>


   @endsection
  
  
