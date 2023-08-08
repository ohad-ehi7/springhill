<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AdminController extends Controller
{
    public function read()
    {
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = 'read';
        return view('admin.admin.read', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Admin';
        return view('admin.admin.add', $data);
    }

    public function insert(Request $request)
    {

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        return redirect('/admin/admin/read')->with('success', "user successfuly created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit New Admin';
            return view('admin.admin.edit', $data);
        } else {
            abort(404);
        }
    }
    
    public function update($id , Request $request){
       
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
         } 
        $user->save();
        return redirect('/admin/admin/read')->with('success', "user successfuly updated"); 
    }
    // public function delete($id){
       
    //     $user = User::getSingle($id);
    //     $user->is_delete= 1;
    //     $user->delete();
    //     return redirect('/admin/admin/read')->with('success', "user successfuly deleted"); 
    // }
    public function delete($id){
        // Étape 1 : Supprimer les données associées à l'utilisateur
        // Par exemple, si vous avez d'autres tables liées à l'utilisateur, vous devrez les supprimer ici.
    
        // Exemple :
        // Supposons que vous avez une table "posts" avec une colonne "user_id" qui fait référence à l'utilisateur à supprimer.
        // Vous pouvez supprimer les posts associés à l'utilisateur comme ceci :
        // Post::where('user_id', $id)->delete();
    
        // Assurez-vous de remplacer "Post" par le nom de votre modèle de données approprié et d'ajouter d'autres suppressions nécessaires.
    
        // Étape 2 : Supprimer l'utilisateur lui-même de la base de données
        $user = User::find($id);
    
        if (!$user) {
            // Si l'utilisateur n'existe pas, vous pouvez afficher un message d'erreur ou rediriger vers une page d'erreur.
            return redirect('/admin/admin/read')->with('error', "Utilisateur introuvable !");
        }
    
        // Supprimer l'utilisateur de la base de données
        $user->delete();
    
        return redirect('/admin/admin/read')->with('success', "Utilisateur supprimé avec succès"); 
    }
    
}
