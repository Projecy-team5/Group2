@extends('layouts.dashboard')

@section('content')
    <div class="p-6 pt-0">
        <div class="space-y-6 w-full">
            @if (session('success'))
                <div class="rounded-md bg-green-50 border border-green-200 px-4 py-3 text-green-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('admin.business-settings.update') }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{__('Organization Details')}}</h2>
                        <p class="text-sm text-gray-500 mt-1">{{__('These fields power the About, Contact, and footer sections.')}}
                        </p>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{__('Organization Name')}}<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $settings->name) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary"
                                    required />
                                @error('name')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{__('Support Email')}}</label>
                                <input type="email" name="email" value="{{ old('email', $settings->email) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary" />
                                @error('email')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{__('Phone Number')}}</label>
                                <input type="text" name="phone" value="{{ old('phone', $settings->phone) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary" />
                                @error('phone')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{__('Website URL')}}</label>
                                <input type="url" name="website" value="{{ old('website', $settings->website) }}"
                                    placeholder="https://"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary" />
                                @error('website')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{__('Address')}}</label>
                            <textarea name="address" rows="3"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('address', $settings->address) }}</textarea>
                            @error('address')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{__('Footer Text')}}</label>
                            <textarea name="footer_text" rows="3"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary">{{ old('footer_text', $settings->footer_text) }}</textarea>
                            @error('footer_text')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{__('Brand Assets')}}</h2>
                        <p class="text-sm text-gray-500 mt-1">{{__('Used on the landing page navigation, emails, and browser tab.')}}</p>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{__('Logo')}}</label>
                                <input type="file" id="logoInput" name="logo" accept="image/*"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white" />
                                <p class="text-xs text-gray-500 mt-2">PNG, JPG, or SVG. Recommended min height 80px.</p>
                                @error('logo')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                                <div id="logoPreviewWrapper" class="mt-4 hidden">
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">{{__('New Logo Preview')}}</p>
                                    <div class="border border-dashed border-gray-300 rounded-lg p-3 bg-gray-50">
                                        <img id="logoPreview" src="" alt="New logo preview"
                                            class="h-16 object-contain mx-auto">
                                    </div>
                                </div>
                                @if ($settings->logo_url)
                                    <div class="mt-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">{{__('Current Logo')}}</p>
                                        <img src="{{ $settings->logo_url }}" alt="{{__('Current logo')}}"
                                            class="h-16 object-contain">
                                    </div>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{__('Favicon')}}</label>
                                <input type="file" id="faviconInput" name="favicon"
                                    accept=".png,.jpg,.jpeg,.svg,.ico,.webp"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white" />
                                <p class="text-xs text-gray-500 mt-2">{{__('PNG, SVG, ICO up to 1MB. Ideally 64x64px square.')}}</p>
                                @error('favicon')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                                <div id="faviconPreviewWrapper" class="mt-4 hidden">
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">{{__('New Favicon Preview')}}</p>
                                    <div
                                        class="h-12 w-12 border border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50">
                                        <img id="faviconPreview" src="" alt="{{__('New favicon preview')}}"
                                            class="h-8 w-8 object-contain">
                                    </div>
                                </div>
                                @if ($settings->favicon_url)
                                    <div class="mt-4">
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">{{__('Current Favicon')}}</p>
                                        <div
                                            class="h-12 w-12 border border-gray-200 rounded-lg flex items-center justify-center bg-white">
                                            <img src="{{ $settings->favicon_url }}" alt="{{__('Current favicon')}}"
                                                class="h-8 w-8 object-contain">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-primary px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                        {{__('Save Changes')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const setupPreview = (inputId, wrapperId, imageId) => {
                const fileInput = document.getElementById(inputId);
                const wrapper = document.getElementById(wrapperId);
                const previewImage = document.getElementById(imageId);

                if (!fileInput || !wrapper || !previewImage) {
                    return;
                }

                fileInput.addEventListener('change', (event) => {
                    const file = event.target.files && event.target.files[0];

                    if (!file) {
                        wrapper.classList.add('hidden');
                        previewImage.src = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImage.src = e.target?.result ?? '';
                        wrapper.classList.toggle('hidden', !previewImage.src);
                    };
                    reader.readAsDataURL(file);
                });
            };

            setupPreview('logoInput', 'logoPreviewWrapper', 'logoPreview');
            setupPreview('faviconInput', 'faviconPreviewWrapper', 'faviconPreview');
        });
    </script>
@endpush
