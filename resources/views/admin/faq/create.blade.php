@extends('layouts.masterlayout')

@section('content')
<div class="container mt-4">
    <h4>Add FAQs with Multiple Categories</h4>

    <form action="{{route('admin.faq.store')}}" method="POST">
        @csrf

        <div id="category-group">
            <div class="category-item border border-secondary rounded p-3 mb-4 bg-light">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-semibold">Category 1</h5>
                    <button type="button" class="btn btn-sm btn-danger remove-category">Remove Category</button>
                </div>

                <input type="text" name="categories[0][category]" class="form-control mb-3" placeholder="Enter category name (e.g. How To Buy)" required>

                <div class="faq-group">
                    <div class="faq-item border rounded p-3 mb-3 bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label>Question</label>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-faq">X</button>
                        </div>
                        <input type="text" name="categories[0][faqs][0][question]" class="form-control" placeholder="Enter question">

                        <label class="mt-2">Answer</label>
                        <textarea name="categories[0][faqs][0][answer]" class="form-control" rows="2" placeholder="Enter answer"></textarea>
                    </div>
                </div>

                <button type="button" class="btn btn-sm btn-outline-primary add-faq">+ Add FAQ</button>
            </div>
        </div>

        <button type="button" id="add-category" class="btn btn-outline-secondary mb-3 mt-3">+ Add Category</button>
        <br>
        <button type="submit" class="btn btn-success">Save FAQs</button>
    </form>
</div>

<script>
let categoryCount = 1;

// ✅ Add new Category
document.getElementById('add-category').addEventListener('click', function() {
    const container = document.getElementById('category-group');
    const newCategory = document.createElement('div');
    newCategory.classList.add('category-item', 'border', 'border-secondary', 'rounded', 'p-3', 'mb-4', 'bg-light');

    newCategory.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="fw-semibold">Category ${categoryCount + 1}</h5>
            <button type="button" class="btn btn-sm btn-danger remove-category">Remove Category</button>
        </div>

        <input type="text" name="categories[${categoryCount}][category]" class="form-control mb-3" placeholder="Enter category name" required>

        <div class="faq-group">
            <div class="faq-item border rounded p-3 mb-3 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label>Question</label>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-faq">X</button>
                </div>
                <input type="text" name="categories[${categoryCount}][faqs][0][question]" class="form-control" placeholder="Enter question">

                <label class="mt-2">Answer</label>
                <textarea name="categories[${categoryCount}][faqs][0][answer]" class="form-control" rows="2" placeholder="Enter answer"></textarea>
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-outline-primary add-faq">+ Add FAQ</button>
    `;

    container.appendChild(newCategory);
    categoryCount++;
});

// ✅ Handle Add / Remove for FAQs & Categories
document.addEventListener('click', function(e) {
    // Add new FAQ
    if (e.target.classList.contains('add-faq')) {
        const categoryItem = e.target.closest('.category-item');
        const faqGroup = categoryItem.querySelector('.faq-group');
        const categoryIndex = Array.from(document.querySelectorAll('.category-item')).indexOf(categoryItem);
        const faqCount = faqGroup.querySelectorAll('.faq-item').length;

        const newFaq = document.createElement('div');
        newFaq.classList.add('faq-item', 'border', 'rounded', 'p-3', 'mb-3', 'bg-white');
        newFaq.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label>Question</label>
                <button type="button" class="btn btn-sm btn-outline-danger remove-faq">X</button>
            </div>
            <input type="text" name="categories[${categoryIndex}][faqs][${faqCount}][question]" class="form-control" placeholder="Enter question">

            <label class="mt-2">Answer</label>
            <textarea name="categories[${categoryIndex}][faqs][${faqCount}][answer]" class="form-control" rows="2" placeholder="Enter answer"></textarea>
        `;
        faqGroup.appendChild(newFaq);
    }

    // Remove FAQ
    if (e.target.classList.contains('remove-faq')) {
        e.target.closest('.faq-item').remove();
    }

    // Remove Category
    if (e.target.classList.contains('remove-category')) {
        e.target.closest('.category-item').remove();
    }
});
</script>
@endsection
