<?php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
// 2, 6 y 7. Método para CREAR comentario
public function store(Request $request)
{
$validated = $request->validate([
'album_id' => 'required|exists:albums,id',
'title' => 'required|string|max:100',
'content' => 'required|string|min:5',
]);

// Asociación automática del usuario autenticado
$validated['user_id'] = auth()->id();

Review::create($validated);

return back()->with('success', 'Comentario publicado con éxito.');
}

// 3. Método para EDITAR propio comentario
public function update(Request $request, Review $review)
{
// 5. Verificar autorización
if (auth()->id() !== $review->user_id) {
abort(403, 'No tienes permiso para editar esta reseña.');
}

$validated = $request->validate([
'title' => 'required|string|max:100',
'content' => 'required|string|min:5',
]);

$review->update($validated);

return back()->with('success', 'Reseña actualizada.');
}

// 4. Método para ELIMINAR
public function destroy(Review $review)
{
// 5. Verificar autorización (Creador o Admin)
// Nota: Asumiendo que tienes un campo 'is_admin' en User, si no, quita esa parte
if (auth()->id() !== $review->user_id && !auth()->user()->is_admin) {
abort(403, 'Acción no autorizada.');
}

$review->delete();

return back()->with('success', 'Comentario eliminado.');
}
}
