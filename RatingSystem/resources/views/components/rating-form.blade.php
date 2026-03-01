@props([
    'product',
    'action' => null,
    'buttonText' => 'Submit',

    // style hooks
    'formClass' => '',
    'labelClass' => '',
    'starsWrapperClass' => '',
    'starClass' => '',
    'textareaClass' => '',
    'buttonClass' => '',
	
	
	
	'reviewDesc' => 'Review (optional):',
])

<form
    action="{{ $action ?? route('ratings.store') }}"
    method="POST"
    {{ $attributes->merge(['class' => "flex flex-col gap-3 $formClass"]) }}
>
    @csrf

    <!-- Polymorphic fields -->
<input type="hidden" name="rateable_id" value="{{ $product->getKey() }}">
<input type="hidden" name="rateable_type" value="{{ $product->getMorphClass() }}">

    <label class="font-medium {{ $labelClass }}" for="rating-{{ $product->getKey() }}">
        Rate this product:
    </label>

    <div class="flex flex-row-reverse justify-end gap-1 star-rating {{ $starsWrapperClass }}">
        @for ($i = 5; $i >= 1; $i--)
            <input
                type="radio"
                name="rating"
                value="{{ $i }}"
                id="star{{ $i }}-{{ $product->getKey() }}"
                class="hidden"
            />

            <label
                for="star{{ $i }}-{{ $product->getKey() }}"
                class="cursor-pointer text-2xl text-gray-300 {{ $starClass }}"
            >
                ★
            </label>
        @endfor
    </div>

	<label class="font-medium mt-2 {{ $labelClass }}" for="review-{{ $product->getKey() }}">
		{{ $reviewDesc }}
	</label>

	<textarea
		name="review"
		id="review-{{ $product->getKey() }}"
		rows="3"
		class="border rounded px-3 py-2 w-full resize-none {{ $textareaClass }}"
		placeholder="Write your review here..."
	></textarea>

    <button
        type="submit"
        class="font-semibold px-4 py-2 rounded mt-2 bg-yellow-500 hover:bg-yellow-600 text-black font-bold {{ $buttonClass }}"
    >
        {{ $buttonText }}
    </button>
</form>

<style>
.star-rating label {
    transition: color 0.2s ease;
}

/* hover */
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: var(--rating-star-hover, #facc15);
}

/* selected */
.star-rating input:checked ~ label {
    color: var(--rating-star-active, #facc15);
}
</style>