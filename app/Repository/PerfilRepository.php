<?php

namespace App\Repository;

use App\Interfaces\Repositories\IPerfilRepository;
use App\Models\Perfil;
use Illuminate\Database\Eloquent\Collection;

class PerfilRepository implements IPerfilRepository
{
	public function create(Perfil $myPerfil): Perfil
	{
		$perfil = new Perfil();
        $perfil->name = $myPerfil->name;
        $perfil->level = $myPerfil->level;
        $perfil->text = $myPerfil->text;
        $perfil->book_id = $myPerfil->book_id;
        $perfil->save();

        return $perfil;
	}

	public function delete(int $perfilId): void
	{
        $perfil = Perfil::find($perfilId);
        $perfil->delete();
	}

	public function findById(int $id): Perfil
	{
		return Perfil::find($id);
	}

	public function findLikeNameAndLevel(string $name, string $level, int $bookId): Collection
	{
		$perfils = Perfil::where('name', 'like', "%$name%")
            ->orWhere('level', 'like', "%$level%")
            ->where('book_id', $bookId)
            ->orderBy('level')
            ->get();

        return $perfils;
	}

    public function findPerfilsByBook(int $bookId): Collection
    {
        return Perfil::where('book_id', $bookId)->get();
    }

    public function findLevelsByBook(int $bookId): Collection
    {
        return Perfil::select('level')
            ->where('book_id', $bookId)
            ->groupBy('level')
            ->get();
    }

	public function update(int $perfilId, Perfil $myPerfil): Perfil
	{
		$perfil = Perfil::find($perfilId);
        $perfil->name = $myPerfil->name;
        $perfil->level = $myPerfil->level;
        $perfil->text = $myPerfil->text;
        $perfil->save();

        return $perfil;
	}

    public function findNumberOfSublevelInPerfil(string $level, int $perfilId): int
    {
        $subLevelCount = Perfil::where('level','LIKE', '%'.$level.'%')
                            ->where('id', '!=', $perfilId)
                            ->count();
        return $subLevelCount;
    }
}
