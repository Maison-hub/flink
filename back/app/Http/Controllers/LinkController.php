<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LinkController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'nom' => 'required|string',
            'lien' => 'required|url',
            'place' => 'required|integer',
        ]);

        // Création d'un nouveau lien associé à l'utilisateur authentifié
        $user = auth()->user();
        $link = $user->links()->create($request->only(['nom', 'lien', 'place']));

        return response()->json(['message' => 'Lien créé avec succès', 'link' => $link], 201);
    }

    //get all links of a user
    public function getlinks()
    {
        $user = auth()->user();
        $links = $user->links;
        return response()->json(['links' => $links], 200);
    }

    //update a link with his id
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $link = Link::find($id);
        if (!$link) {
            return response()->json(['message' => 'Not Found Link'], 404);
        }
        if ($link->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        try {
            $link->update($request->only(['name', 'url', 'subtitle', 'place']));
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Error while updating link'], 500);
        }
        return response()->json(['message' => 'Link updated successfully', 'link' => $link], 200);
    }

    //delete a link with his id
    public function delete($id)
    {
        $link = Link::find($id);
        if (!$link) {
            return response()->json(['message' => 'Lien non trouvé'], 404);
        }
        if ($link->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $link->delete();

        return response()->json(['message' => 'Lien supprimé avec succès'], 200);
    }

    public function getAllLink($id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        $links = $user->links;
        return response()->json(['links' => $links], 200);
    }


}
