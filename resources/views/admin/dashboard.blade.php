@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
@php
    $totalTrackedApplications = array_sum($statusCounts ?? []);
    $latestApplication = $latestApplications->first();
@endphp
<div class="p-6 space-y-8">
    <div class="flex flex-col gap-2">
        <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="text-sm text-gray-500">Monitor platform health, applications flow, and top-performing scholarships.</p>
    </div>

    <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Total users</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['users']) }}</p>
            <p class="mt-2 text-xs text-gray-400">Last signup: {{ optional($latestApplication?->user)->created_at?->diffForHumans() ?? '—' }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Scholarships published</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['scholarships']) }}</p>
            <p class="mt-2 text-xs text-gray-400">Including inactive drafts.</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Total applications</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['applications']) }}</p>
            <p class="mt-2 text-xs text-emerald-600">{{ $trendChartData['data'][count($trendChartData['data']) - 1] ?? 0 }} submitted this month</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Statuses monitored</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ count($statusCounts ?? []) }}</p>
            <p class="mt-2 text-xs text-gray-400">Used in the distribution chart.</p>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-2">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Application status distribution</h2>
                    <p class="text-sm text-gray-500">How review outcomes are trending.</p>
                </div>
                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
                    {{ $totalTrackedApplications }} total
                </span>
            </div>
            <div class="mt-6 grow">
                <canvas id="adminStatusChart" height="260"></canvas>
            </div>
            <dl class="mt-6 grid gap-2 text-sm">
                @forelse ($statusCounts as $status => $count)
                    <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-3">
                        <dt class="font-medium text-gray-700">{{ \Illuminate\Support\Str::headline($status) }}</dt>
                        <dd class="text-gray-900 font-semibold">{{ $count }}</dd>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No applications yet. Insights will appear once submissions arrive.</p>
                @endforelse
            </dl>
        </div>
        <div class="flex flex-col gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Monthly submissions</h2>
                        <p class="text-sm text-gray-500">Rolling six-month volume.</p>
                    </div>
                    <span class="text-xs font-semibold text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                        {{ $trendChartData['data'][count($trendChartData['data']) - 1] ?? 0 }} this month
                    </span>
                </div>
                <div class="mt-6 grow">
                    <canvas id="adminTrendChart" height="220"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Top scholarships</h2>
                        <p class="text-sm text-gray-500">Most popular by application count.</p>
                    </div>
                    <span class="text-xs text-gray-500">Last 6 months</span>
                </div>
                <ul class="mt-4 divide-y divide-gray-100">
                    @forelse ($topScholarships as $scholarship)
                        <li class="py-3 flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $scholarship->scholarship_name }}</p>
                                <p class="text-xs text-gray-500">Status: {{ \Illuminate\Support\Str::headline($scholarship->status ?? 'Unknown') }}</p>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $scholarship->applications_count }} apps</span>
                        </li>
                    @empty
                        <li class="py-3 text-sm text-gray-500">No applications have been submitted yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-2xl border border-gray-100 shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Latest applications</h2>
            <p class="text-sm text-gray-500">Five most recent submissions across all scholarships.</p>
        </div>
        @if ($latestApplications->isEmpty())
            <div class="p-6 text-sm text-gray-500">No applications have been submitted yet.</div>
        @else
            <ul class="divide-y divide-gray-100">
                @foreach ($latestApplications as $application)
                    <li class="p-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $application->user->name }}</p>
                            <p class="text-sm text-gray-500">
                                Applied for <span class="text-primary">{{ $application->scholarship->scholarship_name }}</span>
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="inline-flex items-center justify-center rounded-full px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100">
                                {{ \Illuminate\Support\Str::headline($application->status ?? 'Pending') }}
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
        const dashboardChartColors = ['#0ea5e9', '#22c55e', '#f59e0b', '#a855f7', '#f43f5e', '#6b7280'];

        const setupCanvas = (canvas) => {
            const ratio = window.devicePixelRatio || 1;
            const width = canvas.clientWidth || canvas.width;
            const height = canvas.clientHeight || canvas.height || 240;
            canvas.width = width * ratio;
            canvas.height = height * ratio;
            const ctx = canvas.getContext('2d');
            ctx.scale(ratio, ratio);
            return { ctx, width, height };
        };

        const drawDoughnutChart = (canvas, dataset) => {
            const { ctx, width, height } = setupCanvas(canvas);
            const radius = Math.min(width, height) / 2 - 8;
            const centerX = width / 2;
            const centerY = height / 2;
            const total = dataset.data.reduce((sum, value) => sum + value, 0);

            if (!total) {
                ctx.fillStyle = '#e5e7eb';
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                ctx.fill();
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
                    startAngle += sliceAngle;
                });
            }

            ctx.globalCompositeOperation = 'destination-out';
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius * 0.55, 0, Math.PI * 2);
            ctx.fill();
            ctx.globalCompositeOperation = 'source-over';
        };

        const drawLineChart = (canvas, dataset) => {
            const { ctx, width, height } = setupCanvas(canvas);
            const padding = 24;
            const chartWidth = width - padding * 2;
            const chartHeight = height - padding * 2;

            const maxValue = Math.max(...dataset.data, 1);
            const points = dataset.data.length
                ? dataset.data.map((value, index) => {
                      const step = dataset.data.length > 1 ? index / (dataset.data.length - 1) : 0;
                      const x = padding + step * chartWidth;
                      const y = padding + (1 - value / maxValue) * chartHeight;
                      return { x, y };
                  })
                : [
                      { x: padding, y: padding + chartHeight },
                      { x: padding + chartWidth, y: padding + chartHeight },
                  ];

            ctx.fillStyle = 'rgba(59, 130, 246, 0.15)';
            ctx.beginPath();
            ctx.moveTo(points[0].x, height - padding);
            points.forEach((point) => ctx.lineTo(point.x, point.y));
            ctx.lineTo(points[points.length - 1].x, height - padding);
            ctx.closePath();
            ctx.fill();

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

            ctx.fillStyle = '#1d4ed8';
            points.forEach((point) => {
                ctx.beginPath();
                ctx.arc(point.x, point.y, 3, 0, Math.PI * 2);
                ctx.fill();
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
            document.addEventListener('DOMContentLoaded', initAdminCharts, { once: true });
        }

        window.addEventListener('load', initAdminCharts, { once: true });
    </script>
@endpush
