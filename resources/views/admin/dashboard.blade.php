@extends('layouts.dashboard')

@section('title', __('Admin Dashboard'))

@section('content')
    @php
        $totalTrackedApplications = array_sum($statusCounts ?? []);
        $latestApplication = $latestApplications->first();
    @endphp
    <div class="p-6 space-y-8">
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-bold text-gray-900">{{ __('Admin Dashboard') }}</h1>
            <p class="text-sm text-gray-500">{{ __('Monitor platform health, applications flow, and top-performing scholarships.') }}</p>
        </div>

        <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">{{ __('Total users') }}</p>
                <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['users']) }}</p>
                <p class="mt-2 text-xs text-gray-400">{{ __('Last signup:') }}
                    {{ optional($latestApplication?->user)->created_at?->diffForHumans() ?? '—' }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">{{ __('Scholarships published') }}</p>
                <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['scholarships']) }}</p>
                <p class="mt-2 text-xs text-gray-400">{{ __('Including inactive drafts.') }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">{{ __('Total applications') }}</p>
                <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['applications']) }}</p>
                <p class="mt-2 text-xs text-emerald-600">
                    {{ __(':count submitted this month', ['count' => $trendChartData['data'][count($trendChartData['data']) - 1] ?? 0]) }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">{{ __('Statuses monitored') }}</p>
                <p class="mt-3 text-3xl font-semibold text-gray-900">{{ count($statusCounts ?? []) }}</p>
                <p class="mt-2 text-xs text-gray-400">{{ __('Used in the distribution chart.') }}</p>
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">{{ __('Application status distribution') }}</h2>
                        <p class="text-sm text-gray-500">{{ __('How review outcomes are trending.') }}</p>
                    </div>
                    <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
                        {{ __(':count total', ['count' => $totalTrackedApplications]) }}
                    </span>
                </div>
                <div class="mt-6 grow">
                    <canvas id="adminStatusChart" height="260"></canvas>
                </div>
                <dl class="mt-6 grid gap-2 text-sm">
                    @forelse ($statusCounts as $index => $status)
                        @php
                            $colors = ['#0ea5e9', '#22c55e', '#f59e0b', '#a855f7', '#f43f5e', '#6b7280'];
                            $statusIndex = array_search($index, array_keys($statusCounts));
                            $color = $colors[$statusIndex % count($colors)];
                        @endphp
                        <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-3">
                            <dt class="flex items-center gap-3 font-medium text-gray-700">
                                <span class="w-3 h-3 rounded-full flex-shrink-0"
                                    style="background-color: {{ $color }}"></span>
                                {{ \Illuminate\Support\Str::headline($index) }}
                            </dt>
                            <dd class="text-gray-900 font-semibold">{{ $status }}</dd>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">{{ __('No applications yet. Insights will appear once submissions arrive.') }}
                        </p>
                    @endforelse
                </dl>
            </div>
            <div class="flex flex-col gap-6">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">{{ __('Monthly submissions') }}</h2>
                            <p class="text-sm text-gray-500">{{ __('Rolling six-month volume.') }}</p>
                        </div>
                        <span class="text-xs font-semibold text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                            {{ __(':count this month', ['count' => $trendChartData['data'][count($trendChartData['data']) - 1] ?? 0]) }}
                        </span>
                    </div>
                    <div class="mt-6 grow">
                        <canvas id="adminTrendChart" height="220"></canvas>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">{{ __('Top scholarships') }}</h2>
                            <p class="text-sm text-gray-500">{{ __('Most popular by application count.') }}</p>
                        </div>
                        <span class="text-xs text-gray-500">{{ __('Last 6 months') }}</span>
                    </div>
                    <ul class="mt-4 divide-y divide-gray-100">
                        @forelse ($topScholarships as $scholarship)
                            <li class="py-3 flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $scholarship->scholarship_name }}</p>
                                    <p class="text-xs text-gray-500">{{ __('Status:') }}
                                        {{ \Illuminate\Support\Str::headline(__($scholarship->status ?? 'Unknown')) }}</p>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">{{ $scholarship->applications_count }}
                                    {{ __('apps') }}</span>
                            </li>
                        @empty
                            <li class="py-3 text-sm text-gray-500">{{ __('No applications have been submitted yet.') }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </section>

        <section class="bg-white rounded-2xl border border-gray-100 shadow-sm">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">{{ __('Latest applications') }}</h2>
                <p class="text-sm text-gray-500">{{ __('Five most recent submissions across all scholarships.') }}</p>
            </div>
            @if ($latestApplications->isEmpty())
                <div class="p-6 text-sm text-gray-500">{{ __('No applications have been submitted yet.') }}</div>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach ($latestApplications as $application)
                        <li class="p-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $application->user->name }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ __('Applied for') }} <span
                                        class="text-primary">{{ $application->scholarship->scholarship_name }}</span>
                                </p>
                            </div>
                            <div class="flex items-center gap-4">
                                <span
                                    class="inline-flex items-center justify-center rounded-full px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100">
                                    {{ \Illuminate\Support\Str::headline(__($application->status ?? 'Pending')) }}
                                </span>
                                <span class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        window.dashboardTranslations = {
            noData: @js(__('No data')),
            totalLabel: @js(__('Total')),
        };
        const dashboardChartColors = ['#0ea5e9', '#22c55e', '#f59e0b', '#a855f7', '#f43f5e', '#6b7280'];

        const setupCanvas = (canvas) => {
            const ratio = window.devicePixelRatio || 1;
            const width = canvas.clientWidth || canvas.width;
            const height = canvas.clientHeight || canvas.height || 240;
            canvas.width = width * ratio;
            canvas.height = height * ratio;
            const ctx = canvas.getContext('2d');
            ctx.scale(ratio, ratio);
            return {
                ctx,
                width,
                height
            };
        };

        const drawDoughnutChart = (canvas, dataset) => {
            const {
                ctx,
                width,
                height
            } = setupCanvas(canvas);
            const radius = Math.min(width, height) / 2 - 8;
            const centerX = width / 2;
            const centerY = height / 2;
            const total = dataset.data.reduce((sum, value) => sum + value, 0);

            if (!total) {
                // Empty state
                ctx.fillStyle = '#e5e7eb';
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                ctx.fill();

                // Empty state text
                ctx.fillStyle = '#9ca3af';
                ctx.font = '14px sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(window.dashboardTranslations.noData, centerX, centerY);
            } else {
                let startAngle = -Math.PI / 2;
                dataset.data.forEach((value, index) => {
                    const sliceAngle = (value / total) * Math.PI * 2;
                    ctx.beginPath();
                    ctx.moveTo(centerX, centerY);
                    ctx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle);
                    ctx.closePath();
                    ctx.fillStyle = dashboardChartColors[index % dashboardChartColors.length];
                    ctx.fill();

                    // Add percentage labels on larger slices
                    if (sliceAngle > 0.2) { // Only show if slice is > ~11%
                        const percentage = ((value / total) * 100).toFixed(0);
                        const labelAngle = startAngle + sliceAngle / 2;
                        const labelRadius = radius * 0.75;
                        const labelX = centerX + Math.cos(labelAngle) * labelRadius;
                        const labelY = centerY + Math.sin(labelAngle) * labelRadius;

                        ctx.fillStyle = '#ffffff';
                        ctx.font = 'bold 14px sans-serif';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText(percentage + '%', labelX, labelY);
                    }

                    startAngle += sliceAngle;
                });

                // Draw total in center
                ctx.fillStyle = '#1f2937';
                ctx.font = 'bold 24px sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(total, centerX, centerY - 8);

                ctx.fillStyle = '#6b7280';
                ctx.font = '12px sans-serif';
                ctx.fillText(window.dashboardTranslations.totalLabel, centerX, centerY + 12);
            }

            // Cut out center for doughnut effect
            ctx.globalCompositeOperation = 'destination-out';
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius * 0.55, 0, Math.PI * 2);
            ctx.fill();
            ctx.globalCompositeOperation = 'source-over';
        };

        const drawLineChart = (canvas, dataset) => {
            const {
                ctx,
                width,
                height
            } = setupCanvas(canvas);
            const padding = 24;
            const bottomPadding = 50; // Extra space for labels
            const chartWidth = width - padding * 2;
            const chartHeight = height - padding - bottomPadding;

            const maxValue = Math.max(...dataset.data, 1);
            const points = dataset.data.length ?
                dataset.data.map((value, index) => {
                    const step = dataset.data.length > 1 ? index / (dataset.data.length - 1) : 0;
                    const x = padding + step * chartWidth;
                    const y = padding + (1 - value / maxValue) * chartHeight;
                    return {
                        x,
                        y,
                        value
                    };
                }) :
                [{
                        x: padding,
                        y: padding + chartHeight,
                        value: 0
                    },
                    {
                        x: padding + chartWidth,
                        y: padding + chartHeight,
                        value: 0
                    },
                ];

            // Draw filled area under line
            ctx.fillStyle = 'rgba(59, 130, 246, 0.15)';
            ctx.beginPath();
            ctx.moveTo(points[0].x, height - bottomPadding);
            points.forEach((point) => ctx.lineTo(point.x, point.y));
            ctx.lineTo(points[points.length - 1].x, height - bottomPadding);
            ctx.closePath();
            ctx.fill();

            // Draw line
            ctx.strokeStyle = '#3b82f6';
            ctx.lineWidth = 2;
            ctx.beginPath();
            points.forEach((point, index) => {
                if (index === 0) {
                    ctx.moveTo(point.x, point.y);
                } else {
                    ctx.lineTo(point.x, point.y);
                }
            });
            ctx.stroke();

            // Draw points
            ctx.fillStyle = '#1d4ed8';
            points.forEach((point) => {
                ctx.beginPath();
                ctx.arc(point.x, point.y, 4, 0, Math.PI * 2);
                ctx.fill();
            });

            // Draw month labels on x-axis
            ctx.fillStyle = '#6b7280';
            ctx.font = '11px sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'top';

            if (dataset.labels && dataset.labels.length) {
                dataset.labels.forEach((label, index) => {
                    const step = dataset.labels.length > 1 ? index / (dataset.labels.length - 1) : 0;
                    const x = padding + step * chartWidth;
                    const y = height - bottomPadding + 8;
                    ctx.fillText(label, x, y);
                });
            }

            // Draw values above points
            ctx.fillStyle = '#1f2937';
            ctx.font = 'bold 12px sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';
            points.forEach((point) => {
                if (point.value > 0) {
                    ctx.fillText(point.value, point.x, point.y - 8);
                }
            });
        };

        let adminChartsInitialized = false;

        const initAdminCharts = () => {
            if (adminChartsInitialized) {
                return;
            }
            adminChartsInitialized = true;

            const statusConfig = @json($statusChartData);
            const trendConfig = @json($trendChartData);

            const statusCanvas = document.getElementById('adminStatusChart');
            if (statusCanvas) {
                drawDoughnutChart(statusCanvas, statusConfig);
            }

            const trendCanvas = document.getElementById('adminTrendChart');
            if (trendCanvas) {
                drawLineChart(trendCanvas, trendConfig);
            }
        };

        if (document.readyState !== 'loading') {
            initAdminCharts();
        } else {
            document.addEventListener('DOMContentLoaded', initAdminCharts, {
                once: true
            });
        }

        window.addEventListener('load', initAdminCharts, {
            once: true
        });
    </script>
@endpush
