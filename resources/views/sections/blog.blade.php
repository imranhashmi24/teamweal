@php
    $blogContent = getContent('blog.content', true);
    $blogs = App\Models\Blog::active()->limit(4)->get();
@endphp


<!--    BLOG SECTION-->
<section class="py-5 blog-section">
    <div class="container">
        <div class="text-center section-title">
            <h2> {{ @$blogContent->data_values->title }} </h2>
            <p> {{ @$blogContent->data_values->sub_title }} </p>
        </div>
        <div class="mt-5 row">
            @foreach ($blogs as $blog)
                <div class="pb-4 col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="blog-box h-100">
                        <div class="blog-img">
                            <img src="{{ getImage(getFilePath('blog') . '/' . $blog->image) }}" alt="Blog Image">
                        </div>

                        <div class="p-3">
                            <h6> {{ $blog->lang('title') }} </h6>
                            <p>
                                {{ strLimit(strip_tags($blog->lang('description')), 100) }}

                            </p>

                            <a href="{{ route('blog.details', $blog->slug) }}">{{ __('Read More') }} <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--    BLOG SECTION END-->
