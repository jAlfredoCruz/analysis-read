<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Repositories\IAuthorRepository;
use App\Interfaces\Repositories\IBookRepository;
use App\Interfaces\Repositories\IGeneralQuestionRepository;
use App\Interfaces\Repositories\IClassificationRepository;
use App\Interfaces\Repositories\IOwnCategoryRepository;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\GeneralQuestionRepository;
use App\Service\ManagerService;
use App\Repository\OwnCategoryRepository;
use App\Service\GeneralQuestionService;
use App\Interfaces\Services\IClassificationService;
use App\Repository\ClassificationRepository;
use App\Service\ClassificationService;
use App\Interfaces\Repositories\ISynthesisRepository;
use App\Repository\SynthesisRepository;
use App\Interfaces\Services\ISynthesisService;
use App\Service\SynthesisService;
use App\Interfaces\Repositories\IPerfilRepository;
use App\Repository\PerfilRepository;
use App\Interfaces\Services\IPerfileService;
use App\Service\PerfilService;
use App\Interfaces\Repositories\IProblemRepository;
use App\Repository\ProblemRepository;
use App\Interfaces\Services\IProblemService;
use App\Service\ProblemService;
use App\Service\TermService;
use App\Interfaces\Services\ITermService;
use App\Interfaces\Repositories\ITermRepository;
use App\Repository\TermRepository;
use App\Interfaces\Repositories\ISentenceRepository;
use App\Repository\SentenceRepository;
use App\Interfaces\Services\ISentenceService;
use App\Service\SentenceService;
use App\Interfaces\Repositories\IArgumentRepository;
use Illuminate\Support\Facades\URL;
use App\Repository\ArgumentRepository;
use App\Interfaces\Services\IArgumentService;
use App\Service\ArgumentService;
use App\Service\DesinformationService;
use App\Interfaces\Repositories\IDesinformationRepository;
use App\Repository\IlogicRepository;
use App\Repository\IncompleteRepository;
use App\Interfaces\Repositories\IIncompleteRepository;
use App\Interfaces\Services\IIncompleteService;
use App\Service\IlogicService;
use App\Service\IncompleteService;
use App\Interfaces\Services\IIlogicService;
use App\Interfaces\Repositories\IIlogicRepository;
use App\Interfaces\Services\IMisinformationService;
use App\Repository\MisinformationRepository;
use App\Interfaces\Repositories\IMisinformationRepository;
use App\Service\MisinformationService;
use App\Repository\DesinformationRepository;
use App\Interfaces\Services\IDesinformationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthorRepository::class, AuthorRepository::class);
        $this->app->bind(IBookRepository::class, BookRepository::class);
        $this->app->bind(IOwnCategoryRepository::class, OwnCategoryRepository::class);
        $this->app->bind(ManagerService::class, function () {
            return new ManagerService(
                $this->app->make(IAuthorRepository::class),
                $this->app->make(IBookRepository::class),
                $this->app->make(IOwnCategoryRepository::class)
            );
        });
        $this->app->bind(IGeneralQuestionRepository::class, GeneralQuestionRepository::class);
        $this->app->bind(GeneralQuestionService::class, function(){
            return new GeneralQuestionService(
                $this->app->make(IGeneralQuestionRepository::class)
            );
        });
        $this->app->bind(IClassificationRepository::class, ClassificationRepository::class);
        $this->app->bind(IClassificationService::class, ClassificationService::class);
        $this->app->bind(ClassificationService::class, function () {
            return new ClassificationService(
                $this->app->make(IClassificationRepository::class),
                $this->app->make(IOwnCategoryRepository::class)
            );
        });

        $this->app->bind(ISynthesisRepository::class, SynthesisRepository::class);
        $this->app->bind(ISynthesisService::class, SynthesisService::class);
        $this->app->bind(SynthesisService::class, function () {
            return new SynthesisService(
                $this->app->make(ISynthesisRepository::class)
            );
        });

        $this->app->bind(IPerfilRepository::class, PerfilRepository::class);
        $this->app->bind(IPerfileService::class, PerfilService::class);
        $this->app->bind(PerfilService::class, function(){
            return new PerfilService(
                $this->app->make(IPerfilRepository::class)
            );
        });

        $this->app->bind(IProblemRepository::class, ProblemRepository::class);
        $this->app->bind(IProblemService::class, ProblemService::class);
        $this->app->bind(ProblemService::class, function(){
            return new ProblemService(
                $this->app->make(IProblemRepository::class)
            );
        });

        $this->app->bind(ITermService::class, TermService::class);
        $this->app->bind(ITermRepository::class, TermRepository::class);
        $this->app->bind(TermService::class, function(){
            return new TermService(
                $this->app->make(ITermRepository::class)
            );
        });

        $this->app->bind(ISentenceRepository::class, SentenceRepository::class);
        $this->app->bind(ISentenceService::class, SentenceService::class);
        $this->app->bind(SentenceService::class, function(){
            return new SentenceService(
                $this->app->make(ISentenceRepository::class)
            );
        });

        $this->app->bind(IArgumentRepository::class, ArgumentRepository::class);
        $this->app->bind(IArgumentService::class, ArgumentService::class);
        $this->app->bind(ArgumentService::class, function(){
            return new ArgumentService(
                $this->app->make(IArgumentRepository::class)
            );
        });

        $this->app->bind(IDesinformationRepository::class, DesinformationRepository::class);
        $this->app->bind(IDesinformationService::class, DesinformationService::class);
        $this->app->bind(DesinformationService::class, function(){
            return new DesinformationService(
                $this->app->make(IDesinformationRepository::class)
            );
        });

        $this->app->bind(IMisinformationRepository::class, MisinformationRepository::class);
        $this->app->bind(IMisinformationService::class, MisinformationService::class);
        $this->app->bind(MisinformationService::class, function(){
            return new MisinformationService(
                $this->app->make(IMisinformationRepository::class)
            );
        });

        $this->app->bind(IIlogicRepository::class, IlogicRepository::class);
        $this->app->bind(IIlogicService::class, IlogicService::class);
        $this->app->bind(IlogicService::class, function(){
            return new IlogicService(
                $this->app->make(IIlogicRepository::class)
            );
        });

        $this->app->bind(IIncompleteRepository::class, IncompleteRepository::class);
        $this->app->bind(IIncompleteService::class, IncompleteService::class);
        $this->app->bind(IncompleteService::class, function(){
            return new IncompleteService(
                $this->app->make(IIncompleteRepository::class)
            );
        });



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
