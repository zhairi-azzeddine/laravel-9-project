<?php

namespace App\Http\Controllers;





use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpParser\Builder\Class_;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class EtudiantController extends Controller
{
     public function index(){
        $title="ETUDIANT";
        $etudiants =Etudiant::orderby("nom","asc")->get();
        return view("etudiant",compact("title","etudiants"));
    }

    public function create(){
        $classes=Classe::all();
        return view("createEtudiant",compact("classes"));
    }

    public function ajouter(Request $request){

        $request->validate(
            [
                "nom"=>"required",
                "prenom"=>"required",
                "photo"=>"required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
                "cv"=>"mimes:pdf|max:1000",
                "classe_id"=>"required"
            ]
            );

        $requestData = $request->all();
        $fileName= time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('image', $fileName, 'public');

        if($request->hasFile('cv'))
        { 
        $fileNameCV= time().$request->file('cv')->getClientOriginalName();
        $pathCV = $request->file('cv')->storeAs('cv', $fileNameCV, 'public');
        }

        $requestData["nom"] = $request->nom;
        $requestData["prenom"] = $request->prenom;
        $requestData["photo"] = '/storage/'.$path;

        if($request->hasFile('cv'))
        $requestData["cv"] = '/storage/'.$pathCV;
        else
        $requestData["cv"]="";

        $requestData["classe_id"] = $request->classe_id;
        Etudiant::create($requestData);

      
   
        

        
        return back()->with("success", "Etudiant ajouté avec Succéé");
    }

    public function DeleteSelected(Request $request){
        $ids=$request->ids;
    
        Etudiant::whereIn('id',$ids)->delete();
       
        return back()->with("deleted", "Etudiant ajouté avec Succéé");
    
    }
}
