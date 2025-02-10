<?php

namespace App\Service;

use App\Interfaces\Repositories\IPerfilRepository;
use App\Interfaces\Services\IPerfileService;
use App\Models\Perfil;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PerfilService implements IPerfileService {

    public function __construct(
        private IPerfilRepository $perfilRepository
    ) {

    }

	public function savePerfil(Perfil $perfil): bool
    {
        $perfil = $this->perfilRepository->create($perfil);
        if(!$perfil) {
            return false;
        }
		return true;
	}

	public function deletePerfil(int $perfilId) {
		$this->perfilRepository->delete($perfilId);
	}

	public function getPerfil(int $perfilId): Perfil {
        return $this->perfilRepository->findById($perfilId);
	}

	public function getPerfilsByBook(int $bookId): Collection
    {
        return $this->perfilRepository->findPerfilsByBook($bookId);
    }

	public function updatePerfil(int $perfilId, Perfil $perfil): bool {
        $perfil = $this->perfilRepository->update($perfilId, $perfil);
        if(!$perfil) {
            return false;
        }
        return true;
	}

	public function getLevelsByBook(int $bookId): Collection {
		return $this->perfilRepository->findLevelsByBook($bookId);
	}

    public function hasSublevels(Perfil $perfil): bool
    {
      $number = $this->perfilRepository->findNumberOfSublevelInPerfil($perfil->level, $perfil->id);

      return $number > 0;

    }

    public function filterPerfils(string $search, Collection $perfils, int $bookId): Collection
    {
        if($search == '') {
            return $perfils;
        }else{
            return  $perfils
                        ->filter(function(Perfil $perfil) use ($search) {
                            return Str::contains(strtolower($perfil->level),strtolower($search)) ||
                                    Str::contains(strtolower($perfil->name),strtolower($search)) ||
                                    Str::contains(strtolower($perfil->level.' '.$perfil->name),strtolower($search));
                        });
        }
    }
}
