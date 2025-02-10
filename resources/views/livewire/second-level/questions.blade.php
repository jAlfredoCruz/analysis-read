<div>
    <ul class="text-xl font-semibold mt-5 list-decimal mb-5">
        <li>
            <x-second_level.question-item
                question="¿De que trata el libro como un todo?"
                question-number="1"
                :book-id="$book->id"
                open-modal="openModal1"
                show="open1"
                :answer="$answer1"
            />
        </li>
        <li >
            <x-second_level.question-item
                question="¿Que dice el libro en detalle y como lo dice?"
                question-number="2"
                :book-id="$book->id"
                open-modal="openModal2"
                show="open2"
                :answer="$answer2"
            />
        </li>
        <li class="text-center mb-5">
            <x-second_level.question-item
                question="¿Es el libro verdad o solo parcialmente?"
                question-number="3"
                :book-id="$book->id"
                open-modal="openModal3"
                show="open3"
                :answer="$answer3"
            />
        </li>
        <li class="text-center mb-5">
            <p class="m-2">¿Que importancia tiene?</p>
            <x-second_level.question-item
                question="¿Que importancia tiene?"
                question-number="4"
                :book-id="$book->id"
                open-modal="openModal4"
                show="open4"
                :answer="$answer4"
            />
        </li>
    </ul>
</div>
