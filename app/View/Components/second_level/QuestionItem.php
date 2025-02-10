<?php

namespace App\View\Components\second_level;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class QuestionItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $question,
        public int $questionNumber,
        public string $bookId,
        public string $openModal,
        public string $show,
        public string $answer
    )
    {
        //
    }

    public function markDownAnswer()
    {
        return Str::markdown($this->answer);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.second_level.question-item');
    }
}
