<?php

namespace App\Http\Controllers;




use Illuminate\Support\Facades\View;
use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpParser\Builder\Class_;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;
use PDF;


class EtudiantController extends Controller
{
     public function index(){
        $titre="Gestion Etudiant";
        $title="ETUDIANT";
        $etudiants =Etudiant::orderby("nom","asc")->get();
        return view("etudiant",compact("titre","etudiants"));
        
       
    }

    public function create(){
        $classes=Classe::all();
        return view("createEtudiant",compact("classes"));
    }

    public function edit(Etudiant $etudiant){
        $classes=Classe::all();
        return view("editEtudiant",compact("etudiant","classes"));
    }

    public function show(Etudiant $etudiant){
        $classes=Classe::all();
        return view("showEtudiant",compact("etudiant","classes"));
    }

    public function ajouter(Request $request){

        $request->validate(
            [
                "nom"=>"required",
                "prenom"=>"required",
                "photo"=>"required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
                "cv"=>"mimes:pdf|max:1000",
                "classe_id"=>"required",
                "codemassar"=>"required|string|min:10|max:10"
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
        $requestData["cni"] = $request->cni;
        $requestData["codemassar"] = $request->codemassar;
        Etudiant::create($requestData);

      
   
        

        
        return back()->with("success", "Etudiant ajouté avec Succéé");
    }

    public function DeleteSelected(Request $request){
        $ids=$request->ids;
        File::delete("/storage/image/1662341833Profile.jpg");
    
        Etudiant::whereIn('id',$ids)->delete();
       
        return back()->with("deleted", "Etudiant supprimer avec Succéé");
    
    }


    public function update(Request $request, Etudiant $etudiant){

        $request->validate(
            [
                
                "photo"=>"required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
                "cv"=>"mimes:pdf|max:1000",
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
        $etudiant->update($requestData);

      
   
        

        
        return back()->with("success", "Etudiant mis a jour avec Succéé");
    }

   

    public function downloadPDF($id) {
        $etudiant = Etudiant::find($id);
        
        $pdf = PDF::loadView('pdf', compact('etudiant'));
        
        return $pdf->download('etudiant.pdf');
}


}
