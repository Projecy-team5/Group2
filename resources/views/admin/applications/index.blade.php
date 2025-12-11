@extends('layouts.dashboard')

@section('title', 'Applications')

@section('content')
<div class="p-6 pt-0">
    <div class="space-y-4">
        <!-- Page Header -->
        <div class="flex items-center py-2 justify-between gap-4">
            <div class="flex items-center gap-4 flex-1">
                <h1 class="text-3xl font-bold text-gray-900">Scholarship Applications</h1>
            </div>
        </div>


        <!-- Applications Table -->
        <div class="rounded-md border border-[#b8bbc0]">
            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm">
                    <thead class="[&_tr]:border-b">
                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">ID</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Applicant</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Scholarship</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Contact</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Submitted</th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground w-[100px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="[&_tr:last-child]:border-0">
                        @forelse($applications as $application)
                            <tr class="border-b data-[state=selected]:bg-muted hover:bg-gray-50 transition-colors duration-200">
                                <!-- ID -->
                                <td class="p-4 align-middle font-semibold text-gray-900">
                                    {{ $application->id }}
                                </td>

                                <!-- Applicant -->
                                <td class="p-4 align-middle">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <img src="{{ $application->user->profile_photo_url }}"
                                                    alt="{{ $application->user->name }}"
                                                    class="w-10 h-10 object-cover rounded-full shadow-sm border border-gray-200">
                                            @else
                                                <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full shadow-sm border border-gray-200 flex items-center justify-center">
                                                    <span class="text-blue-600 font-medium text-sm">
                                                        {{ substr($application->user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 truncate max-w-[200px]"
                                                title="{{ $application->user->name }}">
                                                {{ $application->user->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">ID: {{ $application->user->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Scholarship -->
                                <td class="p-4 align-middle">
                                    <div>
                                        <div class="font-medium text-gray-900 truncate max-w-[250px]"
                                            title="{{ $application->scholarship->scholarship_name }}">
                                            {{ Str::limit($application->scholarship->scholarship_name, 40) }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-0.5">
                                            {{ $application->scholarship->country }}
                                        </div>
                                    </div>
                                </td>

                                <!-- Contact -->
                                <td class="p-4 align-middle">
                                    <div class="flex items-center gap-2 text-sm mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                            <path d="m22 7-10 5L2 7"></path>
                                        </svg>
                                        <span class="text-gray-700 truncate max-w-[200px]">{{ $application->user->email }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span class="text-gray-600">{{ $application->phone }}</span>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="p-4 align-middle">
                                    @php
                                        $status = $application->status ?? 'pending';
                                        $statusConfig = [
                                            'pending' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'border' => 'border-yellow-200'],
                                            'approved' => ['bg' => 'bg-green-50', 'text' => 'text-green-700', 'border' => 'border-green-200'],
                                            'rejected' => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'border' => 'border-red-200'],
                                        ];
                                        $config = $statusConfig[$status] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'border' => 'border-gray-200'];
                                    @endphp
                                    <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>

                                <!-- Submitted -->
                                <td class="p-4 align-middle">
                                    <div class="flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M8 2v4"></path>
                                            <path d="M16 2v4"></path>
                                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                            <path d="M3 10h18"></path>
                                        </svg>
                                        <span class="text-gray-600">{{ $application->created_at->format('n/j/Y') }}</span>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="p-4 align-middle">
                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button type="button"
                                                class="inline-flex items-center justify-center w-8 h-8 text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                onclick="toggleDropdown('dropdown-{{ $application->id }}', this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </button>
                                        </div>
                                        <div id="dropdown-{{ $application->id }}"
                                            class="hidden fixed z-50 w-56 bg-white border border-gray-200 rounded-md shadow-lg"
                                            onclick="event.stopPropagation()"
                                            style="display: none;">
                                            <div class="py-1">
                                                @if($application->resume)
                                                    <a href="{{ asset('storage/' . $application->resume) }}"
                                                        target="_blank"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="mr-2">
                                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                            <polyline points="14 2 14 8 20 8"></polyline>
                                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                                            <polyline points="10 9 9 9 8 9"></polyline>
                                                        </svg>
                                                        View Resume
                                                    </a>
                                                @endif

                                                <button type="button"
                                                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700"
                                                    onclick="viewEssay({{ json_encode($application->motivation_essay) }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="mr-2">
                                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                    View Essay
                                                </button>

                                                <div class="border-t border-gray-100 my-1"></div>

                                                @if($application->status !== 'approved')
                                                    <form method="POST" action="{{ route('admin.applications.approve', $application) }}" class="approve-form">
                                                        @csrf
                                                        <button type="button"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-green-600 hover:bg-green-50 hover:text-green-700"
                                                            onclick="showApproveConfirmation(this.closest('form'), '{{ $application->user->name }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="mr-2">
                                                                <polyline points="20 6 9 17 4 12"></polyline>
                                                            </svg>
                                                            Approve Application
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($application->status !== 'rejected')
                                                    <form method="POST" action="{{ route('admin.applications.reject', $application) }}" class="reject-form">
                                                        @csrf
                                                        <button type="button"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700"
                                                            onclick="showRejectConfirmation(this.closest('form'), '{{ $application->user->name }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="mr-2">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                            Reject Application
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-20 text-center">
                                    <div class="max-w-md mx-auto">
                                        <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No applications yet</h3>
                                        <p class="text-gray-500">Applications from students will appear here once they start applying.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($applications->hasPages())
            <div class="mt-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-white px-4 py-3 border rounded-lg">
                    <div class="text-sm text-gray-700">
                        <span>Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $applications->total() }} results</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Essay Modal -->
<div id="essayModal" class="hidden fixed inset-0 bg-gray-900/50 z-50 flex items-center justify-center p-4" onclick="closeEssayModal()">
    <div class="bg-white rounded-lg max-w-3xl w-full max-h-[80vh] overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Motivation Essay</h3>
            <button type="button" onclick="closeEssayModal()"
                class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="px-6 py-4 overflow-y-auto max-h-[calc(80vh-120px)]">
            <p id="essayContent" class="text-gray-700 leading-relaxed whitespace-pre-wrap"></p>
        </div>
        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
            <button type="button" onclick="closeEssayModal()"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                Close
            </button>
        </div>
    </div>
</div>

<x-toast />

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: {
            popup: 'colored-toast'
        }
    });
});
</script>
@endif

<script>
function toggleDropdown(dropdownId, buttonElement) {
    event.stopPropagation();

    // Close all other dropdowns first
    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
        if (dropdown.id !== dropdownId) {
            dropdown.classList.add('hidden');
            dropdown.style.display = 'none';
        }
    });

    // Get the clicked dropdown
    const dropdown = document.getElementById(dropdownId);
    const button = buttonElement || event.target.closest('button');

    if (dropdown.classList.contains('hidden')) {
        // Position the dropdown
        const buttonRect = button.getBoundingClientRect();
        const dropdownWidth = 224; // w-56 = 14rem = 224px
        const dropdownHeight = 200; // Approximate height

        // Calculate position
        let left = buttonRect.right - dropdownWidth;
        let top = buttonRect.bottom + 8;

        // Adjust if dropdown would go off-screen
        if (left < 10) {
            left = buttonRect.left;
        }
        if (top + dropdownHeight > window.innerHeight - 10) {
            top = buttonRect.top - dropdownHeight - 8;
        }

        // Set position and show
        dropdown.style.left = left + 'px';
        dropdown.style.top = top + 'px';
        dropdown.style.display = 'block';
        dropdown.classList.remove('hidden');
    } else {
        // Hide dropdown
        dropdown.classList.add('hidden');
        dropdown.style.display = 'none';
    }
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    const isInsideDropdown = event.target.closest('[id^="dropdown-"]') ||
                            event.target.closest('button[onclick*="toggleDropdown"]');

    if (!isInsideDropdown) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            dropdown.classList.add('hidden');
            dropdown.style.display = 'none';
        });
    }
});

// Close dropdowns on scroll and resize
['scroll', 'resize'].forEach(eventType => {
    window.addEventListener(eventType, function() {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            dropdown.classList.add('hidden');
            dropdown.style.display = 'none';
        });
    });
});

// Essay modal functions
function viewEssay(essay) {
    document.getElementById('essayContent').textContent = essay;
    document.getElementById('essayModal').classList.remove('hidden');
}

function closeEssayModal() {
    document.getElementById('essayModal').classList.add('hidden');
}

// Close modal on Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeEssayModal();
    }
});

// SweetAlert Confirmation Functions
function showApproveConfirmation(form, studentName) {
    Swal.fire({
        title: 'Approve Application?',
        html: `Are you sure you want to approve <strong>${studentName}'s</strong> application?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#22c55e',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-check"></i> Yes, Approve!',
        cancelButtonText: '<i class="fas fa-times"></i> Cancel',
        reverseButtons: true,
        customClass: {
            confirmButton: 'px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium',
            cancelButton: 'px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 font-medium mr-2'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

function showRejectConfirmation(form, studentName) {
    Swal.fire({
        title: 'Reject Application?',
        html: `Are you sure you want to reject <strong>${studentName}'s</strong> application?<br><br><small class="text-gray-500">This action can be reversed later.</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-times"></i> Yes, Reject',
        cancelButtonText: '<i class="fas fa-ban"></i> Cancel',
        reverseButtons: true,
        customClass: {
            confirmButton: 'px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium',
            cancelButton: 'px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 font-medium mr-2'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

<style>
/* Custom SweetAlert button styles */
.swal2-actions {
    gap: 0.5rem;
}

/* Toast notification styles */
.colored-toast.swal2-icon-success {
    background-color: #10b981 !important;
}

.colored-toast .swal2-title {
    color: white;
}

.colored-toast .swal2-close {
    color: white;
}

.colored-toast .swal2-html-container {
    color: white;
}
</style>

@endsection
