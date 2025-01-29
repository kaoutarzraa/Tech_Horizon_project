<? 
namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;


class managerController extends Controller
{
    public function index($themeId)
    {
        // Récupérer le thème spécifique et ses articles
        $theme = Theme::with(['articles', 'manager'])->findOrFail($themeId);

        // Vérifier si l'utilisateur connecté est le responsable de ce thème
        if (auth::id() !== $theme->manager_id) {
            abort(403, 'Vous n\'avez pas accès à ce thème.');
        }

        // Statistiques
        $articleCount = $theme->articles()->count();
        $subscriberCount = 0; // Ajouter la logique si nécessaire

        // Renvoyer la vue avec les données
        return view('manager.index', [
            'theme' => $theme,
            'articles' => $theme->articles,
            'articleCount' => $articleCount,
            'subscriberCount' => $subscriberCount,
        ]);
    }
}