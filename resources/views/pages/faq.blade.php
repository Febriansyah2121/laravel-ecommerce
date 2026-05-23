@extends('layouts.app')

@section('title', 'FAQ - LaravelShop')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Frequently Asked <span class="text-primary">Questions</span></h1>
        <p class="text-muted">Pertanyaan yang sering diajukan oleh pelanggan</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            @foreach($faqs as $index => $faq)
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-header bg-white border-0 pt-3">
                        <h5 class="mb-0">
                            <button class="btn w-100 text-start d-flex justify-content-between align-items-center" 
                                    data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}" style="text-decoration: none;">
                                <span><i class="fas fa-question-circle text-primary me-2"></i> {{ $faq['question'] }}</span>
                                <i class="fas fa-chevron-down text-muted"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="faq{{ $index }}" class="collapse {{ $index == 0 ? 'show' : '' }}">
                        <div class="card-body pt-0">
                            <p class="text-muted">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.card-header button').forEach(button => {
    button.addEventListener('click', () => {
        const icon = button.querySelector('.fa-chevron-down');
        if (icon) {
            icon.style.transform = icon.style.transform === 'rotate(180deg)' ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    });
});
</script>

<style>
.card-header button {
    background: none;
    border: none;
    color: #333;
    font-weight: 600;
}
.card-header button i {
    transition: transform 0.3s;
}
</style>
@endsection