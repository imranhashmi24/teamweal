<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.template.update', $template->id) }}" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto">
                        @csrf
                        <div class="mb-5">
                            <label for="">@lang('Title')</label>
                            <input type="text" name="title" value="{{ $template->title }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. title">
                        </div>
                        <div class="mb-5">
                            <label for="">@lang('Subject')</label>
                            <input type="text" name="subject" value="{!! $template->subject !!}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. subject">
                        </div>
                        <div class="mb-5">
                            <label for="">@lang('Message')</label>
                            <textarea name="message_body" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" cols="30"
                            rows="8">{!! $template->message_body !!}</textarea>
                            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500">{{ __('The Shortcuts you can use') }}
                            <strong>{{ $template->short_code }}</strong></p>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">@lang('Update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
